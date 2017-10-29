<?php
session_start();

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
else if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}

if(isset($_GET['logout']))
{
    session_destroy();
    unset($_SESSION['user']);
    $que =  "UPDATE `users` SET active='1'";
    mysqli_query($conn, $que);
    header("Location: index.php");
}

?>