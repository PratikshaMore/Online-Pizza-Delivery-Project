<?php
require('../../util/main.php');
require('../../model/database.php');
require('../../model/inventory_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_inventory';
    }
}
//echo("TEST");
if ($action == 'list_inventory') {
    try {
        $inventory = get_inventory_values($db);
        $undeliveredOrders = get_undelivered_orders($db);
//        var_dump($inventory);
    include('inventory_list.php');
    } catch (Exception $e) {
        include ('../../errors/error.php');
        exit();
    }
}
?>