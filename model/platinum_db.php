<?php
function get_platinums() {
    global $db;
    $query = 'SELECT * FROM platinums
              ORDER BY platinumsID';
    $statement = $db->prepare($query);
    $statement->execute();
    $platinums = $statement->fetchAll();
    $statement->closeCursor();
    return $platinums;
}

function get_platinums_by_band($band_id) {
    global $db;
    $query = 'SELECT * FROM platinums
              WHERE platinums.bandID = :band_id
              ORDER BY platinumID';
    $statement = $db->prepare($query);
    $statement->bindValue(":band_id", $band_id);
    $statement->execute();
    $platinums = $statement->fetchAll();
    $statement->closeCursor();
    return $platinums;
}

function get_platinum($platinum_id) {
    global $db;
    $query = 'SELECT * FROM platinums
              WHERE platinumID = :platinum_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":platinum_id", $platinum_id);
    $statement->execute();
    $platinum = $statement->fetch();
    $statement->closeCursor();
    return $platinum;
}

function delete_platinum($platinum_id) {
    global $db;
    $query = 'DELETE FROM platinums
              WHERE platinumID = :platinum_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':platinum_id', $platinum_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_platinum($band_id, $code, $name, $price, $seat) {
    global $db;
    $query = 'INSERT INTO platinums
                 (bandID, platinumCode, platinumName, listPrice, seat)
              VALUES
                 (:band_id, :code, :name, :price, :seat)';
    $statement = $db->prepare($query);
    $statement->bindValue(':band_id', $band_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':seat', $seat);
    $statement->execute();
    $statement->closeCursor();
}
?>