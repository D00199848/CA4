<img src="../images/tickets2.png" alt=""/>

<link href="../main.css" rel="stylesheet" type="text/css"/>


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

<div class="container">
    <center><h2>Hottest Tickets!</h2></center>

    <center><form name="toDoList">
            <input type="text" name="ListItem"/>
        </form>

        <div id="button">Add</div>
        <br/>
        <ol></ol></center>

</div>

<!--<div class="container2">
     
       <div id="load-products"></div>  products will be load here 
    
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="assets/swal2/sweetalert2.min.js"></script>


<script>
 $(document).ready(function(){
  
  readProducts(); /* it will load products when document loads */
  
  $(document).on('click', '#delete_band', function(e){
   
   var bandId = $(this).data('id');
   SwalDelete(bandId);
   e.preventDefault();
  });
  
 });
 
 function SwalDelete(bandId){
  
  swal({
   title: 'Are you sure?',
   text: "You won't be able to revert this!",
   type: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Yes, delete it!',
   showLoaderOnConfirm: true,
     
   preConfirm: function() {
     return new Promise(function(resolve) {
          
        $.ajax({
        url: 'delete.php',
        type: 'POST',
           data: 'delete='+bandId,
           dataType: 'json'
        })
        .done(function(response){
         swal('Deleted!', response.message, response.status);
     readProducts();
        })
        .fail(function(){
         swal('Oops...', 'Something went wrong with ajax !', 'error');
        });
     });
      },
   allowOutsideClick: false     
  }); 
  
 }
 
 function readProducts(){
  $('#load-products').load('read.php'); 
 }
 
</script>-->

<!-- Text input to enter the employee's name -->
    <input type="text" id="gig_name"><br>
    <!-- Our search button -->
    <input type="button" id="search_button" value="Search">
    <!-- This div will contain a list of all employee names that match our search term -->
    <div id="search_results" style="padding:5px;"></div>
 
<!-- JQuery library -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
    //Add a JQuery click listener to our search button.
    $('#search_button').click(function(){
        //If the search button is clicked,
        //get the employee name that is being search for
        //from the search_box.
        var employee_name = $('#gig_name').val().trim();
 
        //Carry out a GET Ajax request using JQuery
        $.ajax({
            //The URL of the PHP file that searches MySQL.
            url: 'search.php',
            data: {
                name: employee_name
            },
            success: function(returnData){
                //Set the inner HTML of our search_results div to blank to
                //remove any previous search results.
                $('#search_results').html('');
                //Parse the JSON that we got back from search.php
                var results = JSON.parse(returnData);
                //Loop through our employee array and append their
                //names to our search results div.
                $.each(results, function(key, value){
                    //The name of the employee will be present
                    //in the "name" property.
                    $('#search_results').append(value.name + '<br>');
                });
                //If no employees match the name that was searched for, display a
                //message saying that no results were found.
                if(results.length == 0){
                    $('#search_results').html('No gigs with that name were found!');
                }
            }
        });
    });
</script>




<?php
include('../view/footer.php');
?>
