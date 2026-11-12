<?php
/**
 * Static HTML Generator for Weisdom Design Build
 * Generates portable static HTML pages that work seamlessly on:
 * 1. Localhost subfolder (http://localhost/wisdom/index.html)
 * 2. Direct browser file opening (file:///...)
 * 3. Local built-in server (php -S localhost:8000)
 * 4. GitHub Pages (both root and repo subfolder)
 * 5. Cloudflare Pages & Custom Domain (https://weisdom.co.in)
 */

ini_set('default_charset', 'UTF-8');
if (function_exists('mb_internal_encoding')) {
    mb_internal_encoding('UTF-8');
}

$pages = [
    [
        'source' => __DIR__ . '/index.php',
        'target' => __DIR__ . '/index.html',
        'rel_dir' => '',
        'canonical' => 'https://weisdom.co.in/',
    ],
    [
        'source' => __DIR__ . '/ample-living/index.php',
        'target' => __DIR__ . '/ample-living/index.html',
        'rel_dir' => 'ample-living',
        'canonical' => 'https://weisdom.co.in/ample-living/',
    ],
    [
        'source' => __DIR__ . '/ample-living/amenities/index.php',
        'target' => __DIR__ . '/ample-living/amenities/index.html',
        'rel_dir' => 'ample-living/amenities',
        'canonical' => 'https://weisdom.co.in/ample-living/amenities/',
    ],
    [
        'source' => __DIR__ . '/ample-living/family-life/index.php',
        'target' => __DIR__ . '/ample-living/family-life/index.html',
        'rel_dir' => 'ample-living/family-life',
        'canonical' => 'https://weisdom.co.in/ample-living/family-life/',
    ],
    [
        'source' => __DIR__ . '/ampleton/index.php',
        'target' => __DIR__ . '/ampleton/index.html',
        'rel_dir' => 'ampleton',
        'canonical' => 'https://weisdom.co.in/ampleton/',
    ],
    [
        'source' => __DIR__ . '/connect/index.php',
        'target' => __DIR__ . '/connect/index.html',
        'rel_dir' => 'connect',
        'canonical' => 'https://weisdom.co.in/connect/',
    ],
    [
        'source' => __DIR__ . '/privacy-policy/index.php',
        'target' => __DIR__ . '/privacy-policy/index.html',
        'rel_dir' => 'privacy-policy',
        'canonical' => 'https://weisdom.co.in/privacy-policy/',
    ],
    [
        'source' => __DIR__ . '/rera-policy/index.php',
        'target' => __DIR__ . '/rera-policy/index.html',
        'rel_dir' => 'rera-policy',
        'canonical' => 'https://weisdom.co.in/rera-policy/',
    ],
];

foreach ($pages as $p) {
    echo "Processing: " . $p['source'] . " -> " . $p['target'] . "\n";

    $phpCode = '
        ini_set("default_charset", "UTF-8");
        $_SERVER["HTTPS"] = "on";
        $_SERVER["SERVER_PORT"] = 443;
        $_SERVER["HTTP_HOST"] = "weisdom.co.in";
        $_SERVER["DOCUMENT_ROOT"] = ' . var_export(__DIR__, true) . ';
        chdir(dirname(' . var_export($p['source'], true) . '));
        ob_start();
        include ' . var_export($p['source'], true) . ';
        $html = ob_get_clean();
        echo $html;
    ';

    $tempScript = __DIR__ . '/temp_runner.php';
    file_put_contents($tempScript, '<?php ' . $phpCode);

    $rendered = shell_exec('C:\\xampp\\php\\php.exe ' . escapeshellarg($tempScript));
    @unlink($tempScript);

    if (empty($rendered)) {
        die("Error rendering " . $p['source'] . "\n");
    }

    // Determine relative prefix based on depth
    if ($p['rel_dir'] === '') {
        $rootPrefix = '';
    } else {
        $parts = explode('/', trim($p['rel_dir'], '/'));
        $rootPrefix = str_repeat('../', count($parts));
    }

    // 1. Convert internal navigation links to portable relative links
    $linkMap = [
        'https://weisdom.co.in/connect/' => $rootPrefix . 'connect/',
        'https://weisdom.co.in/ample-living/amenities/' => $rootPrefix . 'ample-living/amenities/',
        'https://weisdom.co.in/ample-living/family-life/' => $rootPrefix . 'ample-living/family-life/',
        'https://weisdom.co.in/ample-living/' => $rootPrefix . 'ample-living/',
        'https://weisdom.co.in/ampleton/' => $rootPrefix . 'ampleton/',
        'https://weisdom.co.in/privacy-policy/' => $rootPrefix . 'privacy-policy/',
        'https://weisdom.co.in/rera-policy/' => $rootPrefix . 'rera-policy/',
        'href="https://weisdom.co.in/"' => 'href="' . ($rootPrefix !== '' ? $rootPrefix : './') . '"',
        'href="https://weisdom.co.in"' => 'href="' . ($rootPrefix !== '' ? $rootPrefix : './') . '"',
    ];

    foreach ($linkMap as $from => $to) {
        $rendered = str_replace($from, $to, $rendered);
    }

    // 2. Make local assets relative while protecting SEO tags
    // Protect canonical and og:url (always full production URL)
    $rendered = preg_replace('/<link\s+rel="canonical"\s+href="[^"]*"/i', '<link rel="canonical" href="' . $p['canonical'] . '"', $rendered);
    $rendered = preg_replace('/<meta\s+property="og:url"\s+content="[^"]*"/i', '<meta property="og:url" content="' . $p['canonical'] . '"', $rendered);

    // Convert assets URL to relative path
    $rendered = str_replace('https://weisdom.co.in/assets/', $rootPrefix . 'assets/', $rendered);

    // Ensure OG/Twitter images keep full domain
    $rendered = preg_replace('/(<meta\s+property="og:image"\s+content=")[^"]*"/i', '$1https://weisdom.co.in/assets/images/logo-dark.png"', $rendered);
    $rendered = preg_replace('/(<meta\s+name="twitter:image"\s+content=")[^"]*"/i', '$1https://weisdom.co.in/assets/images/logo-dark.png"', $rendered);

    // Keep schema logo absolute
    $rendered = str_replace('"logo": "' . $rootPrefix . 'assets/images/logo-dark.png"', '"logo": "https://weisdom.co.in/assets/images/logo-dark.png"', $rendered);
    $rendered = str_replace('"logo": "/assets/images/logo-dark.png"', '"logo": "https://weisdom.co.in/assets/images/logo-dark.png"', $rendered);

    // 3. Replace token query string on CSS/JS with version string
    $rendered = preg_replace('/\?token=[a-f0-9]{32}/', '?v=1.0', $rendered);

    // 4. In index.html, replace rendom.php fetch with static media rotator
    if ($p['rel_dir'] === '') {
        $searchFetch = 'function loadMedia() {
    fetch("rendom.php")
        .then(res => res.json())
        .then(files => {
            if (files.length) {
                displayMedia(getRandomItem(files));
            }
        })
        .catch(err => console.error(err));
}';

        $replaceFetch = 'const mediaFiles = [
    "assets/rendom/about-01.jpg",
    "assets/rendom/about-02.jpg",
    "assets/rendom/about-03.jpg",
    "assets/rendom/about-04.jpg",
    "assets/rendom/about-05.jpg",
    "assets/rendom/about-06.jpg"
];

function loadMedia() {
    if (mediaFiles && mediaFiles.length) {
        displayMedia(getRandomItem(mediaFiles));
    }
}';
        $renderedNormalized = str_replace("\r\n", "\n", $rendered);
        $searchFetchNormalized = str_replace("\r\n", "\n", $searchFetch);
        $replaceFetchNormalized = str_replace("\r\n", "\n", $replaceFetch);

        if (strpos($renderedNormalized, $searchFetchNormalized) !== false) {
            $rendered = str_replace($searchFetchNormalized, $replaceFetchNormalized, $renderedNormalized);
        } else {
            $rendered = preg_replace('/function\s+loadMedia\(\)\s*\{[^}]*fetch\("rendom\.php"\)[^}]*\}\s*\}/s', $replaceFetch, $rendered);
        }
    }

    file_put_contents($p['target'], $rendered);
    echo "Saved: " . $p['target'] . " (" . strlen($rendered) . " bytes)\n";
}

echo "All 8 static HTML pages successfully generated with portable relative paths!\n";
