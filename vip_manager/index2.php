<img src="../images/vip2.png" alt=""/>

<link href="../main.css" rel="stylesheet" type="text/css"/>

<?php
require('../model/database.php');
require('../model/gig_db.php');

require('../model/vip_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_vips';
    }
}

if ($action == 'list_vips') {
    // Get the current category ID
    $band_id = filter_input(INPUT_GET, 'band_id', 
            FILTER_VALIDATE_INT);
    if ($band_id == NULL || $band_id == FALSE) {
        $band_id = 1;
    }
    
//   = get_band_name($band_id);
//    $bands = get_bands();
    $vips = get_vips_by_band($band_id);

    // Display the product list
    include('vip_list.php');
} else if ($action == 'show_edit_form') {
    $vip_id = filter_input(INPUT_POST, 'vip_id', 
            FILTER_VALIDATE_INT);
    if ($vip_id == NULL || $vip_id == FALSE) {
        $error = "Missing or incorrect vip id.";
        include('../errors/error.php');
    } else { 
        $vip = get_vip($vip_id);
        include('vip_edit.php');
    }
} else if ($action == 'update_vip') {
    $vip_id = filter_input(INPUT_POST, 'vip_id', 
            FILTER_VALIDATE_INT);
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $seat = filter_input(INPUT_POST, 'seat');

    // Validate the inputs
    if ($vip_id == NULL || $vip_id == FALSE || $band_id == NULL || 
            $band_id == FALSE || $code == NULL || $name == NULL || 
            $price == NULL || $price == FALSE || $seat == NULL || $seat == FALSE) {
        $error = "Invalid gig data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        update_gig($vip_id, $band_id, $code, $name, $price, $seat);

        // Display the Product List page for the current category
        header("Location: index2.php?band_id=$band_id");
    }
} else if ($action == 'delete_vip') {
    $vip_id = filter_input(INPUT_POST, 'vip_id', 
            FILTER_VALIDATE_INT);
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    if ($band_id == NULL || $band_id == FALSE ||
            $vip_id == NULL || $vip_id == FALSE) {
        $error = "Missing or incorrect vip id or band id.";
        include('../errors/error.php');
    } else { 
        delete_vip($vip_id);
        header("Location: index2.php?band_id=$band_id");
    }
} else if ($action == 'show_add_form') {


    include('vip_add.php');
} else if ($action == 'add_vip') {
      $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
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
        header("Location: index2.php?band_id=list_bands");
    }

   
} else if ($action == 'add_band') {
    $name = filter_input(INPUT_POST, 'name');

    // Validate inputs
    if ($name == NULL) {
        $error = "Invalid band name. Check name and try again.";
        include('../errors/error.php');
    } else {
        add_band($name);
        header('Location: .?action=list_bands');  // display the Category List page
    }
} else if ($action == 'delete_band') {
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    delete_band($band_id);
    header('Location: .?action=list_bands');      // display the Category List page
}
?>