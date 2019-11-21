#!/usr/bin/php

<?php
/*
*/


require 'vendor/autoload.php';

use GuzzleHttp\Client;

echo "Page we're watching: ";
$page = rtrim(fgets(STDIN));
$data = 'datatest/';

$client = new Client([
        'timeout'  => 2.0,
]);

if (!file_exists($data)) {
    echo "\n*** ERROR *** ||| $data not found, created directory\n";
    mkdir($data, 0777, true);
} 

$url = $page;
$response = $client->get($url);
$body = $response->getBody();
$content = $body->getContents();
$sha = sha1($content);
if(!file_exists("$data/$sha")) {
    file_put_contents("$data/$sha", $content);
}
$body->getSize();

$scanFile1 = scandir($data);
$arr = array_slice($scanFile1, 2);

print_r($arr);