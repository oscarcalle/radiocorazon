<?php
// proxy.php
header("Content-Type: audio/mpeg");
$url = $_GET['url'];
// Allow only the specific stream URL to be proxied
$allowed_url = 'http://192.99.150.2:7070/stream';
if ($url === $allowed_url && filter_var($url, FILTER_VALIDATE_URL)) {
    readfile($url);
}
?>
