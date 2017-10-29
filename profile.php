<?php
/**
 * Created by PhpStorm.
 * User: Joe_Pc
 * Date: 08/10/2017
 * Time: 2:30 AM
 */
include ("dbconfig.php");
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$useremail = $_SESSION['email'];

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <meta http-equiv="Content-Type" content="multipart/form-data; charset=utf-8"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="style.css">-->
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    <style>
        .form-group, h2, h3, a ,label{
            color: #FFFFFF;
        }
    </style>
    <title>Member</title>
</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Nacoss ReecPay</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <?php
                    $query = "SELECT last_name ,first_name FROM `100` WHERE user_name='{$_SESSION['user']}'";
                    $result_array = mysqli_fetch_assoc(mysqli_query($conn, $query));
                    $actual_first_name= $result_array['first_name'];
                    $actual_last_name= $result_array['last_name'];

                    ?>
                    <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $actual_first_name;?> <span><?php echo $actual_last_name;?>&nbsp;<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="member.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Home</a></li>
                    <li><a href="edit-profile.php?edit_id=<?php echo $_SESSION['user'] ?>" title="click to edit" onclick="return confirm('sure you want to edit ?')><span class="glyphicon glyphicon-user"></span>&nbsp;Edit Profile</a></li>
                    <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                </ul>
            </li>
        </ul>


    </div><!--/.nav-collapse -->

</nav>

</body>
</html>
