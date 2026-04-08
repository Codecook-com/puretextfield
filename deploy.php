<?php
$secret = '950f2656cea6227e5b4babb1b09c404ec243df02';
$payload = file_get_contents('php://input');
$sig = 'sha256=' . hash_hmac('sha256', $payload, $secret);

if (!hash_equals($sig, $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '')) {
    http_response_code(403);
    exit('Forbidden');
}

$output = shell_exec('cd ' . escapeshellarg(__DIR__) . ' && git pull origin main 2>&1');
echo $output;
