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
        http_response_code(200);
    } else {
        http_response_code(404);
    }
} else {
    http_response_code(404);
    echo("Missing File Parameter!");
}