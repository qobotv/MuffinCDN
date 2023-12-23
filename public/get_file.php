<?php
namespace MuffinCDN;

require_once dirname(__DIR__) . '/private/common.php';

if (isset($_GET['file'])) {
    $file = getFileAndVerifyUrl();

    if (file_exists($file)) {
        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
        header("Cache-Control: public");
        header("Content-Type: application/octet-stream");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length:".filesize($file));
        header("Content-Disposition: inline");
        readfile($file);
    } else {
        http_response_code(404);
    }
} else {
    http_response_code(404);
    echo("Missing File Parameter!");
}