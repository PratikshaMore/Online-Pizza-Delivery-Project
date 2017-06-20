<?php
function get_undelivered_orders($db) {
    $query = 'SELECT * FROM undelivered_orders';
    $statement = $db->prepare($query);
    $statement->execute(); 
    $undeliveredorders = $statement->fetchAll();
    $statement->closeCursor();    
    return $undeliveredorders;  
}


function delete_from_undeliveredOrders($db, $orderID) {    
        $query = 'DELETE FROM undelivered_orders WHERE orderID = :order_id LIMIT 1';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $orderID);
    $statement->execute();
    $statement->closeCursor();
}

function insert_to_undeliveredOrders($db, $flourQty, $cheeseQty) {
    $query = 'INSERT INTO undelivered_orders(flour_qty,cheese_qty) VALUES (:flour, :cheese)';
    $statement = $db->prepare($query);  
    $statement->bindValue(':flour', $flourQty);  
    $statement->bindValue(':cheese', $cheeseQty);  
    $statement->execute();    
    $statement->closeCursor();
}

function remove_delivered_orders($bd){
    $query = 'UPDATE inventory SET quantity = quantity-1';
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function get_inventory_values($db){
    $query = 'SELECT flour_qty,cheese_qty FROM inventory';
    $statement = $db->prepare($query);
    $statement->execute(); 
    $inventory = $statement->fetchAll();
    $statement->closeCursor();    
    return $inventory;
}

function set_inventory_values($db,$flourQty,$cheeseQty){
    $query = 'UPDATE inventory SET flour_qty =:flour_qty, cheese_qty=:cheese_qty';
    $statement = $db->prepare($query);
    $statement->bindValue(':flour_qty',$flourQty);
    $statement->bindValue(':cheese_qty',$cheeseQty);
    $statement->execute();
    $statement->closeCursor();        
}

function update_inventory_values($db,$flourQty,$cheeseQty){
    $query = 'UPDATE inventory SET flour_qty =flour_qty+:flour_qty, cheese_qty=cheese_qty+:cheese_qty';
    $statement = $db->prepare($query);
    $statement->bindValue(':flour_qty',$flourQty);
    $statement->bindValue(':cheese_qty',$cheeseQty);
    $statement->execute();
    $statement->closeCursor();        
}

?>