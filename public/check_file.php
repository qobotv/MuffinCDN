<?php
namespace MuffinCDN;

require_once dirname(__DIR__) . '/private/common.php';

if (isset($_GET['file'])) {
    $file = getFileAndVerifyUrl();

    if (file_exists($file)) {
        http_response_code(200);
    } else {
        http_response_code(404);
    }
} else {
    http_response_code(404);
    echo("Missing File Parameter!");
}