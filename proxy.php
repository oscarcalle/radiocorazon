<?php
// proxy.php
$url = $_GET['url'];
$allowed_host = 'http://78.129.132.7:24306';
if (strpos($url, $allowed_host) === 0 && filter_var($url, FILTER_VALIDATE_URL)) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: audio/mpeg");
    header("Cache-Control: no-cache");
    header("Pragma: no-cache");

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $audio_data = curl_exec($ch);

    if (curl_errno($ch)) {
        // Handle cURL errors
        http_response_code(500);
        echo 'cURL error: ' . curl_error($ch);
    } else {
        echo $audio_data;
    }

    curl_close($ch);
} else {
    http_response_code(400);
    echo "Invalid or not allowed URL.";
}
?>
