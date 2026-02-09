<?php

/**
 * Laravel Router Script for PHP Built-in Server
 * This file routes requests properly when using `php -S`
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// If the request is for an actual file, serve it directly
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

// Otherwise, route through Laravel
require_once __DIR__.'/public/index.php';
