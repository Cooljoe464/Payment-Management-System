<?php
/**
 * Created by PhpStorm.
 * User: Joe_Pc
 * Date: 07/10/2017
 * Time: 11:47 PM
 */

error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="multipart/form-data; charset=utf-8"/>
        <title>Member</title>
    </head>
    <body>
<?php

if ($userid && $username && $useremail){
    session_destroy();
    echo "You have been succesfully logged out.<a href='member.php'></a>";
}else {
    echo "Please Login to access this page";
    header("Location: index.php");
}
 ?>
    </body>
</html>
