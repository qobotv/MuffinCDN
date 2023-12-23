<?php
namespace MuffinCDN;

/**
 * @return string|void
 */
function getFileAndVerifyUrl()
{
    $file = '../dynamic/' . $_GET['file'];

    $basepath = '../dynamic/';
    $realBase = realpath($basepath);

    $userpath = $basepath . $_GET['file'];
    $realUserPath = realpath($userpath);

    if ($realUserPath === false || strpos($realUserPath, $realBase) !== 0) {
        http_response_code(404);
        die();
    }
    return $file;
}