<?php
namespace MuffinCDN;

if (!file_exists(dirname(__DIR__) . '/private/conf/config.php')) {
    die('<b>The configuration file could not be found.</b>');
}

require_once(dirname(__DIR__) . '/private/conf/config.php');

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