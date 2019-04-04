<?php
function get_gigs() {
    global $db;
    $query = 'SELECT * FROM gigs
              ORDER BY gigID';
    $statement = $db->prepare($query);
    $statement->execute();
    $gigs = $statement->fetchAll();
    $statement->closeCursor();
    return $gigs;
}

function get_gigs_by_band($band_id) {
    global $db;
    $query = 'SELECT * FROM gigs
              WHERE gigs.bandID = :band_id
              ORDER BY gigID';
    $statement = $db->prepare($query);
    $statement->bindValue(":band_id", $band_id);
    $statement->execute();
    $gigs = $statement->fetchAll();
    $statement->closeCursor();
    return $gigs;
}

function get_gig($gig_id) {
    global $db;
    $query = 'SELECT * FROM gigs
              WHERE gigID = :gig_id';
    $statement = $db->prepare($query);
    $statement->bindValue(":gig_id", $gig_id);
    $statement->execute();
    $gig = $statement->fetch();
    $statement->closeCursor();
    return $gig;
}

function delete_gig($gig_id) {
    global $db;
    $query = 'DELETE FROM gigs
              WHERE gigID = :gig_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':gig_id', $gig_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_gig($band_id, $code, $name, $price, $seat) {
    global $db;
    $query = 'INSERT INTO gigs
                 (bandID, gigCode, gigName, listPrice, seat)
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

function update_gig($gig_id, $band_id, $code, $name, $price, $seat) {
    global $db;
    $query = 'UPDATE gigs
              SET bandID = :band_id,
                 gigCode = :code,
                 gigName = :name,
                  listPrice = :price,
                  seat = :seat
               WHERE gigID = :gig_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':band_id', $band_id);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':price', $price);
     $statement->bindValue(':seat', $seat);
    $statement->bindValue(':gig_id', $gig_id);
    $statement->execute();
    $statement->closeCursor();
}
?>