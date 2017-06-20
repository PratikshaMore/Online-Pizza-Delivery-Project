<?php
// Functions to do the base web services needed
// Note that all needed web services are sent from this day directory
// The functions here should throw up to their callers, just like
// the functions in model.
//
// Post day number to server
// Returns if successful, or throws if not
function post_day($httpClient, $base_url, $day) {
    error_log('post_day to server: ' . $day);
    $url = $base_url . '/day/';
    $httpClient->request('POST', $url, ['json' => $day]);
}
//  POST order and get back location (i.e., get new id), get all orders 
// in server and/or get a specific order by orderid
function post_order($httpClient, $base_url, $flour,$cheese){
    $customerID = 1;
    
    $item1 = array('productID'=>11, 'quantity'=>$flour); 
    $item2 = array('productID'=>12, 'quantity'=>$cheese);
    $order = array('customerID'=> $customerID, 'items' => array($item1, $item2));

    $data = json_encode($order);
    try {
        error_log('post_order to server: ');
        $url = $base_url . '/orders/';
    
        $response = $httpClient->request('POST', $url,['json' => $data]);
        $status = $response->getStatusCode();
       // $returnData = $response->json();
        
       // var_dump($response);
       // echo $response;
    } catch (GuzzleHttp\Exception $e) {
        $status = 'POST failed, error = ' . $e;
        error_log($status);
    include '../errors/error.php';  // Note new error.php code that handles Exceptions
    }    
}

