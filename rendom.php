<?php
$dir = 'assets/rendom/'; // Set your folder path here

// Check if the directory exists
if (!is_dir($dir)) {
    echo json_encode([]); // Return an empty array if the directory doesn't exist
    exit;
}

$files = array_diff(scandir($dir), array('.', '..'));
$mediaFiles = [];

// Loop through the files and filter by valid media extensions
foreach ($files as $file) {
    // Get the full file path
    $filePath = $dir . $file;
    
    // Check if it's a valid media file (image or video)
    if (is_file($filePath) && preg_match('/\.(jpg|jpeg|png|gif|mp4|webm|ogg)$/i', $file)) {
        $mediaFiles[] = $filePath;
    }
}

// Return the array of media file paths as JSON
header('Content-Type: application/json');
echo json_encode($mediaFiles);
?>
