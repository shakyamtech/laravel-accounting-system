<?php
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

if ((strpos($uri, '/public/') === 0 || strpos($uri, '/vendor/') === 0) && file_exists(__DIR__ . $uri)) {
    $file = __DIR__ . $uri;
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    $mimes = [
        'css'  => 'text/css',
        'js'   => 'application/javascript',
        'png'  => 'image/png',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif'  => 'image/gif',
        'svg'  => 'image/svg+xml',
        'woff' => 'font/woff',
        'woff2'=> 'font/woff2',
        'ttf'  => 'font/ttf',
        'ico'  => 'image/x-icon',
    ];
    $mime = isset($mimes[$ext]) ? $mimes[$ext] : (mime_content_type($file) ?: 'text/plain');
    header('Content-Type: ' . $mime);
    readfile($file);
    exit;
}

if ($uri !== '/' && file_exists(__DIR__.$uri)) {
    return false;
}

require_once __DIR__.'/index.php';
