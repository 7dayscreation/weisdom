<?php
// Detect protocol
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";

// Detect host
$domain = $_SERVER['HTTP_HOST'];

// Set folder based on environment
if (strpos($domain, 'localhost') !== false) {
    // Localhost (XAMPP)
    $folder = '/wisdom/'; 
} elseif (strpos($domain, 'weisdom.co.in') !== false) {
    // Demo server
    $folder = '/';
} else {
    // Client live site
    $folder = '/';
}

// Base URL
$base_url = $protocol . $domain . $folder;

// Assets URL
$assets = $base_url . "assets/";

if (!headers_sent()) {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: accelerometer=(), camera=(), geolocation=(), gyroscope=(), microphone=()');
}

// Helper function for internal links
function url($path = "") {
    global $base_url;
    return $base_url . ltrim($path, "/");
}

// =========================
// Site Info
// =========================
$site_name = "Weisdom Design Build";
$site_email = "info@weisdom.co.in";
$site_phone = "+91 90190 03131";
$site_address = "Ample Living, Beside Umarose Nursery, Koba-Gandhinagar Highway, Kudasan, Gandhinagar";
$site_logo = $assets . "images/logo-dark.png";

// =========================
// SEO Defaults
// =========================
$seo_default = [
    "title" => "Weisdom Design Build - New Venture Build by Architects",
    "description" => "Weisdom Design Build provides innovative architecture, design, and construction solutions with excellence and integrity.",
    "keywords" => "architecture, design, construction, real estate, Weisdom",
    "author" => "Weisdom Design Build",
    "image" => $site_logo,
    "url" => url(""),
    "robots" => "index, follow"
];

// Per-page SEO overrides
$seo_page = [
    "ample-living" => [
        "title" => "Ample Living | Weisdom Design Build",
        "description" => "Discover Ample Living by Weisdom Design Build, thoughtfully designed spaces with greenery and open areas.",
        "keywords" => "ample living, green spaces, architecture, Weisdom",
        "image" => $assets . "ample-living/ample-living-social.jpg"
    ],
    "ample-living/amenities" => [
        "title" => "Amenities | Ample Living | Weisdom Design Build",
        "description" => "Explore the amenities of Ample Living including parks, recreational areas, and community spaces.",
        "keywords" => "ample living, amenities, parks, community, Weisdom",
        "image" => $assets . "ample-living/amenities/amenities-social.jpg"
    ],
    "ample-living/family-life" => [
        "title" => "Family Life | Ample Living | Weisdom Design Build",
        "description" => "Experience family-friendly spaces designed for a balanced lifestyle in Ample Living.",
        "keywords" => "ample living, family, lifestyle, Weisdom",
        "image" => $assets . "ample-living/family-life/family-social.jpg"
    ],
    "ampleton" => [
        "title" => "Ampleton | Weisdom Design Build",
        "description" => "Explore Ampleton, a premium development by Weisdom Design Build offering modern living spaces.",
        "keywords" => "ampleton, real estate, architecture, Weisdom",
        "image" => $assets . "ampleton/ampleton-social.jpg"
    ],
    "connect" => [
        "title" => "Connect with Us | Weisdom Design Build",
        "description" => "Get in touch with Weisdom Design Build for inquiries, consultations, or project details.",
        "keywords" => "contact, connect, Weisdom, architecture, real estate",
        "image" => $assets . "images/connect-social.jpg"
    ],
    "privacy-policy" => [
        "title" => "Privacy Policy | Weisdom Design Build",
        "description" => "Read Weisdom Design Build's privacy policy outlining how we protect your information.",
        "keywords" => "privacy policy, Weisdom, website, data protection",
        "image" => $assets . "images/privacy-social.jpg"
    ],
    "rera-policy" => [
        "title" => "RERA Policy | Weisdom Design Build",
        "description" => "Learn about Weisdom Design Build's RERA compliance and policy details.",
        "keywords" => "RERA, policy, real estate, Weisdom",
        "image" => $assets . "images/rera-social.jpg"
    ],
];

// =========================
// Helper function to get SEO
// =========================
function seo($key, $page = "") {
    global $seo_default, $seo_page;
    if ($page && isset($seo_page[$page][$key])) {
        return $seo_page[$page][$key];
    }
    if ($key === "url" && $page) {
        return url(trim($page, "/") . "/");
    }
    return $seo_default[$key] ?? "";
}

function esc($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function local_path_from_url($url) {
    global $base_url;

    if (strpos($url, $base_url) !== 0) {
        return null;
    }

    $relative_path = ltrim(substr($url, strlen($base_url)), '/');

    if ($relative_path === '') {
        return rtrim(__DIR__, DIRECTORY_SEPARATOR);
    }

    return __DIR__ . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relative_path);
}

function seo_image($page = "") {
    global $seo_default, $site_logo;

    $candidate = seo('image', $page);
    $candidate_path = $candidate ? local_path_from_url($candidate) : null;

    if ($candidate_path && is_file($candidate_path)) {
        return $candidate;
    }

    $default_image = $seo_default['image'] ?? $site_logo;
    $default_path = $default_image ? local_path_from_url($default_image) : null;

    if ($default_path && is_file($default_path)) {
        return $default_image;
    }

    return $site_logo;
}

function canonical_url($page = "") {
    return seo('url', $page);
}

// =========================
// Search Engine Verification
// =========================
$google_verification = "gU49rJuXoRMfFTcBrb3LD3lr2UNCLiQH4NNKA2JdCLc";
$bing_verification = "YOUR_BING_SITE_VERIFICATION_CODE";

// =========================
// Google Analytics & Tag Manager
// =========================
$google_analytics_id = "G-E3DFZWW1Q7"; // Google Analytics
$google_tag_manager_id = "GTM-P4GDC46J";  // Google Tag Manager

// =========================
// JSON-LD Schema for Organization
// =========================
$schema_organization = [
    "@context" => "https://schema.org",
    "@type" => "Organization",
    "name" => $site_name,
    "url" => $base_url,
    "logo" => $site_logo,
    "email" => $site_email,
    "telephone" => $site_phone,
    "address" => [
        "@type" => "PostalAddress",
        "streetAddress" => $site_address,
        "addressLocality" => "Gandhinagar",
        "addressRegion" => "Gujarat",
        "postalCode" => "382421",
        "addressCountry" => "IN"
    ],
    "sameAs" => [
        "https://www.facebook.com/WeisdomOfficial/",
        "https://www.instagram.com/weisdomofficial/",
        "https://www.linkedin.com/company/weisdom-official/",
        "https://youtube.com/@weisdomofficials/"
    ]
];
// Generate a secret token for CSS/JS protection
if (!defined('SECURE_TOKEN')) {
    define('SECURE_TOKEN', substr(md5($base_url . 'your-secret-salt'), 0, 32));
}

?>
