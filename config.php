<?php

function dbController(){
    session_start();
    $mysqli = new mysqli('localhost', 'root','', 'reg');
// Check connection
    if (!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_close($mysqli);
}

?>