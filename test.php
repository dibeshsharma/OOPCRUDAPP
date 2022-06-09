<?php

$results = [];
$results['mode'] = "undefined";
$results['status'] = "error";
$results['message']  = "Mode is not defined.";

var_dump($results);
$results = json_encode($results); 
var_dump($results);
$results = json_decode($results);
var_dump($results);
echo $results->mode;

$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";    
$basename = basename($actual_link);
$pathinfo =   pathinfo($actual_link, PATHINFO_FILENAME);

echo $pathinfo;
echo "<br/>";
echo $basename;
$path = parse_url($actual_link, PHP_URL_PATH);
$pathFragments = explode('/', $path);
$end = end($pathFragments);
echo $path;
var_dump($pathFragments);
echo $end;
?>