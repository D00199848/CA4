<?php
function get_bands() {
    global $db;
    $query = 'SELECT * FROM bands
              ORDER BY bandID';
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement; 
}

function get_band_name($band_id) {
    global $db;
    $query = 'SELECT * FROM bands
              WHERE bandID = :band_id';    
    $statement = $db->prepare($query);
    $statement->bindValue(':band_id', $band_id);
    $statement->execute();    
    $band = $statement->fetch();
    $statement->closeCursor();    
    $band_name = $band['bandName'];
    return $band_name;
}

function add_band($name) {
    global $db;
    $query = 'INSERT INTO bands (bandName)
              VALUES (:name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->execute();
    $statement->closeCursor();    
}

function delete_band($band_id) {
    global $db;
    $query = 'DELETE FROM bands
              WHERE bandID = :band_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':band_id', $band_id);
    $statement->execute();
    $statement->closeCursor();
}
?>