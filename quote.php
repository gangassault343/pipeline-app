<?php
$response = @file_get_contents("https://api.adviceslip.com/advice");

if ($response === FALSE) {
    echo "⚠️ Unable to fetch advice";
    exit;
}

$data = json_decode($response, true);

if (isset($data['slip']['advice'])) {
    echo '"' . $data['slip']['advice'] . '"';
} else {
    echo "⚠️ Invalid response";
}
?>