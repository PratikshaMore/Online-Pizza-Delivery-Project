<?php

function get_server_current_day($db) {
    $query = 'SELECT * FROM systemDay';    
    $statement = $db->prepare($query);
    $statement->execute();    
    $currentday = $statement->fetch();
    $statement->closeCursor();    
    $current_day = $currentday['dayNumber'];
    return $current_day;
}

function increment_server_day($db){
    
    $query = 'UPDATE systemDay SET dayNumber=dayNumber + 1';    
    $statement = $db->prepare($query);
    $statement->execute();    
    $statement->closeCursor();    
}

function set_server_current_day($db, $day) {
    $query = 'UPDATE systemDay SET dayNumber=:day';    
    $statement = $db->prepare($query);
    $statement->bindValue(':day',$day);
    $statement->execute();
    $statement->closeCursor();
}


?>

