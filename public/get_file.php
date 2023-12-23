<?php
if (isset($_GET['file'])) {
    $file = '../dynamic/' . $_GET['file'];

    $basepath = '../dynamic/';
    $realBase = realpath($basepath);

    $userpath = $basepath . $_GET['file'];
    $realUserPath = realpath($userpath);

    if ($realUserPath === false || strpos($realUserPath, $realBase) !== 0) {
        http_response_code(404);
        die();
    }

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