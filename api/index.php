<?php

// Download Aiven CA certificate for SSL MySQL connection
$caPath = '/tmp/ca.pem';
if (!file_exists($caPath)) {
    // Aiven uses the ISRG Root X1 / Let's Encrypt CA
    // We use the system CA bundle or download it
    $caContent = @file_get_contents('https://letsencrypt.org/certs/isrg-root-x1-cross-signed.pem');
    if (!$caContent) {
        // Fallback: use Mozilla's CA bundle
        $caContent = @file_get_contents('https://curl.se/ca/cacert.pem');
    }
    if ($caContent) {
        file_put_contents($caPath, $caContent);
    }
}

// Ensure views directory exists
if (!is_dir('/tmp/views')) {
    mkdir('/tmp/views', 0755, true);
}

require __DIR__ . '/../public/index.php';