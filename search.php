<?php

//MySQL username.
$dbUser = 'root';
 
//MySQL password.
$dbPassword = '';
 
//MySQL host / server.
$dbServer = 'localhost';
 
//The MySQL database your table is located in.
$dbName = 'wp_ca3_long_grainne';
 
//Connect to MySQL database using PDO.
$pdo = new PDO("mysql:host=$dbServer;dbname=$dbName", $dbUser, $dbPassword);
 
//Get the name that is being searched for.
$gigName = isset($_GET['gigName']) ? trim($_GET['gigName']) : '';
 
//The simple SQL query that we will be running.
$sql = "SELECT `gigID`, `bandID`, `gigCode`, `gigName`, `listPrice`, `seat`  FROM `gigs` WHERE `gigName` LIKE :gigName";
 
//Add % for wildcard search!
$gigName = "%$gigName%";
 
//Prepare our SELECT statement.
$statement = $pdo->prepare($sql);
 
//Bind the $name variable to our :name parameter.
$statement->bindValue(':gigName', $gigName);
 
//Execute the SQL statement.
$statement->execute();
 
//Fetch our result as an associative array.
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
 
//Echo the $results array in a JSON format so that we can
//easily handle the results with JavaScript / JQuery
echo json_encode($results);
