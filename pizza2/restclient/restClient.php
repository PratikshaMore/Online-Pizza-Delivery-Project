<?php 
// Client-side REST, for pizza2 project
require_once('../util/main.php');
// use Composer autoloader, so we don't have to require Guzzle PHP files
require '../vendor/autoload.php';

// Now have $app_path, path from doc root to parent directory
// $app_path is of form /cs637/user/proj2/pizza2
// We want URL say http://topcat.cs.umb.edu/cs637/user/proj2/proj2_server/rest for REST service
// So drop "pizza2" from $app_path, add /proj2_server/rest
echo 'app_path: ' . $app_path . '<br>';
$spot = strpos($app_path, 'pizza2');
$part = substr($app_path, 0, $spot);
$base_url = $_SERVER['SERVER_NAME'] . $part . 'proj2_server/rest';
echo 'base_url: ' . $base_url . '<br>';

// Instantiate Guzzle HTTP client
$httpClient = new \GuzzleHttp\Client();
