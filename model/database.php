<?php
    $dsn = 'mysql:host=localhost;dbname=flights';
    $username = 'root';
    //$password = ''

    try {
        $db = new PDO($dsn, $username);

    } catch (PDOException $e) {
        $error_msg = 'Database Error: ' ;
        $error_msg .= $e->getMessage();
        echo $error_msg;
        exit();
    }
?>