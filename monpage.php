#!/usr/bin/php
<?php
/*
*/

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client([
    'timeout'  => 2.0,
    'allow_redirects' => false,
]);

//Taking input
echo "Page we're watching: ";
$url = rtrim(fgets(STDIN));

//Defining variables
$data = 'datatest/';
$response = $client->get($url);
$body = $response->getBody();
$body->getSize();
$content = $body->getContents();
$siteHash = sha1($content);

if(!file_exists($data)) {
    mkdir($data, 0777, true);
}


if(!file_exists("$data/$siteHash")) {
    file_put_contents("$data/$siteHash", $content);
} elseif(file_exists("$data/$siteHash")) {
    echo "\nNo changes have been made to this page since last checked on: ". date ("F d Y H:i:s.", filemtime("$data/$siteHash"))."\n\n";
}

$scanFile1 = scandir($data);
$arr = array_slice($scanFile1, 2);

//print_r($arr);