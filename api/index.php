<?php

// Download CA certificate for SSL MySQL connection (Aiven)
$caPath = '/tmp/ca.pem';
if (!file_exists($caPath)) {
    // Try multiple CA sources for Aiven MySQL SSL
    $caSources = [
        'https://dl.cacerts.digicert.com/DigiCertGlobalRootCA.crt.pem',
        'https://curl.se/ca/cacert.pem',
    ];
    
    $caContent = false;
    foreach ($caSources as $url) {
        $caContent = @file_get_contents($url);
        if ($caContent) break;
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