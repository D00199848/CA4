<?php
require_once('model/database_1.php');
?>

<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: loginIndex.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link href="main.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>


<?php
include('view/header.php');
?>
<img src="images/tickets2.png" alt="" style="float: left"/>

<br>

<br>

<div class="container">
    <center><h2>Hottest Tickets!</h2></center>

    <center><form name="toDoList">
            <input type="text" name="ListItem"/>
        </form>

        <div id="button">Add</div>
        <br/>
        <ol></ol></center>

</div>

<?php
include('view/footer.php');
?>
