<?php
// proxy.php seguro con validación básica
header("Content-Type: audio/mpeg");
header("Access-Control-Allow-Origin: *");

if (!isset($_GET['url'])) {
    http_response_code(400);
    exit('Missing URL');
}

$url = $_GET['url'];

// Lista de URLs de streaming permitidas
$allowed_urls = [
    'http://78.129.132.7:24306',
    'http://192.99.150.2:7070/stream'
];

// Verifica que el URL esté en la lista
if (in_array($url, $allowed_urls) && filter_var($url, FILTER_VALIDATE_URL)) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    curl_close($ch);
    echo $data;
} else {
    http_response_code(403);
    exit('Stream not allowed');
}
?>