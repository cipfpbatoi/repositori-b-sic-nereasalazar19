<?php
function base64UrlEncode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64UrlDecode($data) {
    return base64_decode(strtr($data, '-_', '+/'));
}

function createJWT($header, $payload, $secret) {
    $headerEncoded = base64UrlEncode(json_encode($header));
    $payloadEncoded = base64UrlEncode(json_encode($payload));

    $signature = hash_hmac('sha256', "$headerEncoded.$payloadEncoded", $secret, true);
    $signatureEncoded = base64UrlEncode($signature);

    return "$headerEncoded.$payloadEncoded.$signatureEncoded";
}

function verifyJWT($jwt, $secret) {
    list($headerEncoded, $payloadEncoded, $signatureEncoded) = explode('.', $jwt);

    $signature = base64UrlDecode($signatureEncoded);
    $expectedSignature = hash_hmac('sha256', "$headerEncoded.$payloadEncoded", $secret, true);

    if ($signature === $expectedSignature) {
        return json_decode(base64UrlDecode($payloadEncoded));
    }

    return false;
}

// Exemples d'ús
$header = ['alg' => 'HS256', 'typ' => 'JWT'];
$payload = ['email' => 'user1@example.com', 'exp' => time() + 3600];
$secret = 'your_secret_key';

$jwt = createJWT($header, $payload, $secret);
echo "JWT: " . $jwt . "<br>";

$decoded = verifyJWT($jwt, $secret);
if ($decoded) {
    echo "JWT valid: " . json_encode($decoded) . "\n";
} else {
    echo "Invalid JWT.\n";
}
?>