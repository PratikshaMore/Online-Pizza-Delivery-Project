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

    //{"customerID":1,"items":[{"productID":11,"quantity":60},{"productID":12,"quantity":60}]}
    $url = 'http://' . $base_url . '/orders/';

    echo 'POST orderData to ' . $url . '<br>';
    error_log('...... restclient: POST orders to ' . $url);

    
    $customerID = 1;
            
    $item1 = array('productID'=>11, 'quantity'=>$flour); 
    $item2 = array('productID'=>12, 'quantity'=>$cheese);
    $order = array('customerID'=> $customerID, 'items' => array($item1, $item2));

    $data = json_encode($order);
    try {
        $response = $httpClient->request('POST', $url, $data);
        $status = $response->getStatusCode();
    } catch (GuzzleHttp\Exception $e) {
        $status = 'POST failed, error = ' . $e;
        error_log($status);
    include '../errors/error.php';  // Note new error.php code that handles Exceptions
    }

    
