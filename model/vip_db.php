<?php
function get_vips() {
    global $db;
    $query = 'SELECT * FROM vips
              ORDER BY vipsID';
    $statement = $db->prepare($query);
    $statement->execute();
    $vips = $statement->fetchAll();
    $statement->closeCursor();
    return $vips;
}

function get_vips_by_band($band_id) {
    global $db;
    $query = 'SELECT * FROM vips
             
              ORDER BY vipID';
    $statement = $db->prepare($query);
    $statement->bindValue(":band_id", $band_id);
    $statement->execute();
    $vips = $statement->fetchAll();
    $statement->closeCursor();
    return $vips;
}

function get_vip($vip_id) {
    global $db;
    $query = 'SELECT * FROM vips';        
    $statement = $db->prepare($query);
    $statement->bindValue(":vip_id", $vip_id);
    $statement->execute();
    $vip = $statement->fetch();
    $statement->closeCursor();
    return $vip;
}

function delete_vip($vip_id) {
    global $db;
    $query = 'DELETE FROM vips
              WHERE vipID = :vip_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':vip_id', $vip_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_vip($band_id, $code, $name, $price, $seat) {
    global $db;
    $query = 'INSERT INTO vips
                 (bandID, vipCode, vipName, listPrice, seat)
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