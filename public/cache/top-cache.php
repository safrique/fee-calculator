<?php

$url = $_SERVER["SCRIPT_NAME"];
$break = Explode('/', $url);
$file = $break[count($break) - 1];
$cacheFile = 'cached-' . substr_replace($file, "", -4);

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['term']) && !empty($_POST['amount'])) {
    $cacheFile .= ('-' . $_POST['term'] . '-' . $_POST['amount']);
}

$cacheFile = str_replace('.', '-', "public/cache/cached_files/$cacheFile") . '.html';
$cacheTime = 18000;

// Serve from the cache if it is younger than $cachetime
if (file_exists($cacheFile) && time() - $cacheTime < filemtime($cacheFile)) {
    echo "<!-- Cached copy, generated " . date('H:i', filemtime($cacheFile)) . " -->\n";
    readfile($cacheFile);
    exit;
}
ob_start(); // Start the output buffer