<img src="../images/tickets2.png" alt=""/>

<link href="../main.css" rel="stylesheet" type="text/css"/>
<link href="../jquery.css" rel="stylesheet" type="text/css"/>


<?php
require('../model/database.php');
require('../model/gig_db.php');
require('../model/band_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_gigs';
    }
}

if ($action == 'list_gigs') {
    // Get the current category ID
    $band_id = filter_input(INPUT_GET, 'band_id', 
            FILTER_VALIDATE_INT);
    if ($band_id == NULL || $band_id == FALSE) {
        $band_id = 1;
    }
    
    // Get product and category data
    $band_name = get_band_name($band_id);
    $bands = get_bands();
    $gigs = get_gigs_by_band($band_id);

    // Display the product list
    include('gig_list.php');
} else if ($action == 'show_edit_form') {
    $gig_id = filter_input(INPUT_POST, 'gig_id', 
            FILTER_VALIDATE_INT);
    if ($gig_id == NULL || $gig_id == FALSE) {
        $error = "Missing or incorrect gig id.";
        include('../errors/error.php');
    } else { 
        $gig = get_gig($gig_id);
        include('gig_edit.php');
    }
} else if ($action == 'update_gig') {
    $gig_id = filter_input(INPUT_POST, 'gig_id', 
            FILTER_VALIDATE_INT);
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $seat = filter_input(INPUT_POST, 'seat');

    // Validate the inputs
    if ($gig_id == NULL || $gig_id == FALSE || $band_id == NULL || 
            $band_id == FALSE || $code == NULL || $name == NULL || 
            $price == NULL || $price == FALSE || $seat == NULL || $seat == FALSE) {
        $error = "Invalid gig data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        update_gig($gig_id, $band_id, $code, $name, $price, $seat);

        // Display the Product List page for the current category
        header("Location: index.php?band_id=$band_id");
    }
} else if ($action == 'delete_gig') {
    $gig_id = filter_input(INPUT_POST, 'gig_id', 
            FILTER_VALIDATE_INT);
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    if ($band_id == NULL || $band_id == FALSE ||
            $gig_id == NULL || $gig_id == FALSE) {
        $error = "Missing or incorrect gig id or band id.";
        include('../errors/error.php');
    } else { 
        delete_gig($gig_id);
        header("Location: index.php?band_id=$band_id");
    }
} else if ($action == 'show_add_form') {
    $bands = get_bands();
    include('gig_add.php');
    
} else if ($action == 'add_gig') {
    $band_id = filter_input(INPUT_POST, 'band_id', 
            FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
     $seat = filter_input(INPUT_POST, 'seat');
    if ($band_id == NULL || $band_id == FALSE || $code == NULL || 
            $name == NULL || $price == NULL || $price == FALSE || $seat == NULL || $seat == FALSE) {
        $error = "Invalid gig data. Check all fields and try again.";
        include('../errors/error.php');
    } else { 
        add_gig($band_id, $code, $name, $price, $seat);
        header("Location: .?band_id=$band_id");
    }
} else if ($action == 'list_bands') {
    $bands = get_bands();
    include('band_list.php');
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

<?php
require_once('../model/database_1.php');
?>


<div class="dropdown" style="float: right">
  
  <div class="dropdown-content">
    <a href="../reset-password.php" class="btn btn-warning">Reset Password</a>
    <a href="../logout.php" class="btn btn-danger">Sign Out</a>
  </div>
</div>




  <meta charset="UTF-8">
  <title>Simple JQuery To Do List</title>
  
  
  <link rel='stylesheet' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>

    <div class="container">
		<h2>Simple To Do List</h2>
    <p><em>Click and drag to reorder, double click to cross an item off.</em></p>
       
		<form name="toDoList">
			<input type="text" name="ListItem"/>
		</form>
    
		<div id="button">Add</div>
		<br/>
		<ol></ol>
      
      
    
    </div>
	</body>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

  

    <script  src="js/js.js"></script>


<?php
include('../view/footer.php');
?>
