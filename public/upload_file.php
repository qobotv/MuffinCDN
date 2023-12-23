<?php
namespace MuffinCDN;

global $apiKey;
require_once dirname(__DIR__) . '/private/common.php';

if (!(isset($_SERVER['HTTP_AUTHORIZATION']) && ($_SERVER['HTTP_AUTHORIZATION'] == $apiKey))) {
    http_response_code(403);
    echo("Wrong or missing token!");
    die();
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded without errors
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Define the upload directory
        $uploadDir = '../dynamic/';

        // Create the upload directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Very rough. -Bluffingo 12/23/2023
        $uploadFile = $uploadDir . $_POST["folder"] . '/' . basename($_POST["name"]);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            var_dump($_POST["name"]);
            echo 'File uploaded successfully!';
            http_response_code(200);
        } else {
            http_response_code(500);
            echo 'Error uploading file.';
        }
    } else {
        http_response_code(500);
        echo 'No file uploaded or an error occurred.';
    }
} else {
    http_response_code(403);
    // If the script is called directly, output an error message
    echo 'Invalid request.';
}

