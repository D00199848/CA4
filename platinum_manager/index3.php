<img src="../images/platinum.jpg" alt=""/>

<link href="../main.css" rel="stylesheet" type="text/css"/>

<?php
require('../model/database.php');
require('../model/gig_db.php');
require('../model/vip_db.php');
require('../model/platinum_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_platinums';
    }
}

if ($action == 'list_platinums') {
    // Get the current category ID
    $band_id = filter_input(INPUT_GET, 'band_id', 
            FILTER_VALIDATE_INT);
    if ($band_id == NULL || $band_id == FALSE) {
        $band_id = 1;
    }
    
   
    $platinums = get_platinums_by_band($band_id);

    // Display the product list
    include('platinum_list.php');
} else if ($action == 'show_edit_form') {
    $platinum_id = filter_input(INPUT_POST, 'platinum_id', 
            FILTER_VALIDATE_INT);
    if ($platinum_id == NULL || $platinum_id == FALSE) {
        $error = "Missing or incorrect platinum id.";
        include('../errors/error.php');
    } else { 
        $platinum = get_platinum($platinum_id);
        include('vip_edit.php');
    }
} else if ($action == 'update_platinum') {
    $platinum_id = filter_input(INPUT_POST, 'vip_id', 
            FILTER_VALIDATE_INT);
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $seat = filter_input(INPUT_POST, 'seat');

    // Validate the inputs
    if ($platinum_id == NULL || $platinum_id == FALSE || $band_id == NULL || 
            $band_id == FALSE || $code == NULL || $name == NULL || 
            $price == NULL || $price == FALSE || $seat == NULL || $seat == FALSE) {
        $error = "Invalid platinum data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        update_gig($platinum_id, $band_id, $code, $name, $price, $seat);

        // Display the Product List page for the current category
        header("Location: index3.php?band_id=$band_id");
    }
} else if ($action == 'delete_platinum') {
    $platinum_id = filter_input(INPUT_POST, 'platinum_id', 
            FILTER_VALIDATE_INT);
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    if ($band_id == NULL || $band_id == FALSE ||
            $platinum_id == NULL || $platinum_id == FALSE) {
        $error = "Missing or incorrect platinum id or band id.";
        include('../errors/error.php');
    } else { 
        delete_vip($platinum_id);
        header("Location: index3.php?band_id=$band_id");
    }
} else if ($action == 'show_add_form') {

    include('platinum_add.php');
} else if ($action == 'add_platinum') {
   
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
     $seat = filter_input(INPUT_POST, 'seat');
//    if ($band_id == NULL || $band_id == FALSE || $code == NULL || 
          if  ($name == NULL || $price == NULL || $price == FALSE || $seat == NULL || $seat == FALSE) {
        $error = "Invalid vip data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        add_vip( $band_id, $code, $name, $price, $seat);
        header("Location: index3.php?action=list_bands");
    }

    include('band_list.php');
} else if ($action == 'add_band') {
    $name = filter_input(INPUT_POST, 'name');

    // Validate inputs
    if ($name == NULL) {
        $error = "Invalid band name. Check name and try again.";
        include('../errors/error.php');
    } else {
        add_band($name);
        header('Location: index3.php?action=list_bands');  // display the Category List page
    }
} else if ($action == 'delete_band') {
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    delete_band($band_id);
    header('Location: index3.php?action=list_bands');      // display the Category List page
}
?>