<?php

// Get the requested URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Check if the requested file exists (e.g., static files like CSS, JS, images)
if (file_exists(__DIR__ . $requestUri)) {
  return false; // Serve the file directly
}

// Apply the rewrite rule: Redirect `*.php` to `index.php?modul=$1`
if (preg_match('/^(.*)\.php$/', $requestUri, $matches)) {
  $_GET['modul'] = ltrim($matches[1], '/'); // Extract the module name
  require __DIR__ . '/index.php';
  exit;
}

// Handle 404 for anything else
http_response_code(404);
echo "404 Not Found";
