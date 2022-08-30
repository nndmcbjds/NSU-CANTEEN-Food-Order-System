<?php

   //Start Session
   session_start();

   //create constant to store non Repeating values
    define('SITEURL', 'http://localhost/NSU%20FOOD%20ORDER/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','nsu food order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME ,DB_PASSWORD ) or die(mysqli_error()); //database Connection
    $db_select = mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //selecting database
?>