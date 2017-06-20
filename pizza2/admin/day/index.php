<?php

require('../../util/main.php');
require('../../model/database.php');
require('../../model/day_db.php');
require('../../model/inventory_db.php');
require('../../model/initial.php');
require('../../vendor/autoload.php');
require 'web_services.php';

// Note that you don't have to put all your code in this file.
// You can use another file day_helpers.php to hold helper functions
// and call them from here.
//echo 'app_path: ' . $app_path . '<br>';
$spot = strpos($app_path, 'pizza2');
$part = substr($app_path, 0, $spot);
$base_url = $_SERVER['SERVER_NAME'] . $part . 'proj2_server/rest';
//echo 'base_url: ' . $base_url . '<br>';
// Instantiate Guzzle HTTP client
$httpClient = new \GuzzleHttp\Client();


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list';
    }
}
$current_day = get_current_day($db);
if ($action == 'list') {
    try {
        $todays_orders = get_todays_orders($db, $current_day);
        $inventory = get_inventory_values($db);
        $undeliveredOrders = get_undelivered_orders($db);
    } catch (Exception $e) {
        include('../errors/error.php');
        exit();
    }

    include('day_list.php');
} else if ($action == 'next_day') {
    try {
        finish_orders_for_day($db, $current_day);
        increment_day($db);
        $inventoryData = get_inventory_values($db);
        $flourQty = $inventoryData[0]['flour_qty'];
        $cheeseQty = $inventoryData[0]['cheese_qty'];

        $cheese = $cheeseQty;
        $flour = $flourQty;
        if ($cheeseQty < 150) {
            $orderCheese = 150 - $cheeseQty;
            $flour_unit_bags = 1;
            $flour = 0;
            while ($flour < $orderCheese) {
                $flour = 40 * $flour_unit_bags;
                $flour_unit_bags += 1;
            }
        } else {
            $flour = 0;
        }
        if ($flourQty < 150) {

            $orderFlour = 150 - $flourQty;
            $cheese_unit_containers = 1;
            $cheese = 0;
            while ($cheese < $orderFlour) {
                $cheese = 20 * $cheese_unit_containers;
                $cheese_unit_containers += 1;
            }
        } else {
            $cheese = 0;
        }

        post_day($httpClient, $base_url, $current_day + 1);
        post_order($httpClient, $base_url, $flour, $cheese);
        insert_to_undeliveredOrders($db, $flour, $cheese);
        $undelivered_orders = get_undelivered_orders($db);


        for ($j = 0; $j < count($undelivered_orders); $j++) {
            $orderID = $undelivered_orders[$j]['orderid'];
            update_inventory_values($db, $flour, $cheese);
            //delete_from_undeliveredOrders($db, $orderID);
        }
        

        echo $g;
        header("Location: .");
    } catch (Exception $e) {
        include('../../errors/error.php');
        exit();
    }
} else if ($action == 'initial_db') {
    try {
        initial_db($db);
        post_day($httpClient, $base_url, 0);
        header("Location: .");
    } catch (Exception $e) {
        include ('../errors/error.php');
        exit();
    }
}
?>