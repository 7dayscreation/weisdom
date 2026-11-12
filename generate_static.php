<?php
/**
 * Static HTML Generator for Weisdom Design Build
 * Generates pure static HTML pages ready for GitHub and Cloudflare Pages.
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

    // Run PHP in sub-process to avoid shared variable pollution
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

    // Post-processing
    // 1. Convert internal navigation links to root-relative
    $internalLinks = [
        'https://weisdom.co.in/connect/' => '/connect/',
        'https://weisdom.co.in/ample-living/amenities/' => '/ample-living/amenities/',
        'https://weisdom.co.in/ample-living/family-life/' => '/ample-living/family-life/',
        'https://weisdom.co.in/ample-living/' => '/ample-living/',
        'https://weisdom.co.in/ampleton/' => '/ampleton/',
        'https://weisdom.co.in/privacy-policy/' => '/privacy-policy/',
        'https://weisdom.co.in/rera-policy/' => '/rera-policy/',
        'href="https://weisdom.co.in/"' => 'href="/"',
        'href="https://weisdom.co.in"' => 'href="/"',
    ];

    foreach ($internalLinks as $from => $to) {
        $rendered = str_replace($from, $to, $rendered);
    }

    // 2. Convert assets src and stylesheet links to root-relative `/assets/`
    // Protect OpenGraph / Twitter / Schema full URLs first
    $rendered = preg_replace_callback('/(<meta\s+property="og:image"\s+content=")([^"]+)(")/i', function($m) {
        return $m[1] . (strpos($m[2], 'http') === 0 ? $m[2] : 'https://weisdom.co.in' . $m[2]) . $m[3];
    }, $rendered);

    $rendered = preg_replace_callback('/(<meta\s+name="twitter:image"\s+content=")([^"]+)(")/i', function($m) {
        return $m[1] . (strpos($m[2], 'http') === 0 ? $m[2] : 'https://weisdom.co.in' . $m[2]) . $m[3];
    }, $rendered);

    // Make local asset tags root-relative
    $rendered = str_replace('https://weisdom.co.in/assets/', '/assets/', $rendered);

    // Ensure OG/Twitter images keep full domain
    $rendered = preg_replace('/(<meta\s+property="og:image"\s+content=")\/assets\//i', '$1https://weisdom.co.in/assets/', $rendered);
    $rendered = preg_replace('/(<meta\s+name="twitter:image"\s+content=")\/assets\//i', '$1https://weisdom.co.in/assets/', $rendered);
    $rendered = str_replace('"logo": "/assets/images/logo-dark.png"', '"logo": "https://weisdom.co.in/assets/images/logo-dark.png"', $rendered);

    // Ensure canonical has full domain
    $rendered = preg_replace('/<link\s+rel="canonical"\s+href="[^"]*"/i', '<link rel="canonical" href="' . $p['canonical'] . '"', $rendered);
    $rendered = preg_replace('/<meta\s+property="og:url"\s+content="[^"]*"/i', '<meta property="og:url" content="' . $p['canonical'] . '"', $rendered);

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
    "/assets/rendom/about-01.jpg",
    "/assets/rendom/about-02.jpg",
    "/assets/rendom/about-03.jpg",
    "/assets/rendom/about-04.jpg",
    "/assets/rendom/about-05.jpg",
    "/assets/rendom/about-06.jpg"
];

function loadMedia() {
    if (mediaFiles && mediaFiles.length) {
        displayMedia(getRandomItem(mediaFiles));
    }
}';
        // Normalize line breaks for matching
        $renderedNormalized = str_replace("\r\n", "\n", $rendered);
        $searchFetchNormalized = str_replace("\r\n", "\n", $searchFetch);
        $replaceFetchNormalized = str_replace("\r\n", "\n", $replaceFetch);

        if (strpos($renderedNormalized, $searchFetchNormalized) !== false) {
            $rendered = str_replace($searchFetchNormalized, $replaceFetchNormalized, $renderedNormalized);
        } else {
            // Regex fallback
            $rendered = preg_replace('/function\s+loadMedia\(\)\s*\{[^}]*fetch\("rendom\.php"\)[^}]*\}\s*\}/s', $replaceFetch, $rendered);
        }
    }

    file_put_contents($p['target'], $rendered);
    echo "Saved: " . $p['target'] . " (" . strlen($rendered) . " bytes)\n";
}

echo "All 8 static HTML pages successfully generated!\n";
