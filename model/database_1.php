<?php
    $dsn = 'mysql:host=localhost;dbname=security';
    $dsn = 'mysql:host=localhost;dbname=my_phone_shop';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>
