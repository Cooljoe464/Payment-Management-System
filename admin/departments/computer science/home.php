<?php
session_start();
include('dbconfig.php');
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
?>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>Welcome  <?php echo $_SESSION['user']; ?></title>

</head>

<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
<ul class="nav navbar-nav navbar-right">
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $_SESSION['user']; ?>&nbsp;<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
            <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
        </ul>
    </li>
</ul>
        </div>
    </div>
</nav>
<!--<h3>
   <a href="home.php"><span class="glyphicon glyphicon-home"></span> home</a> &nbsp;
 </h3>-->
        <hr />
<br>
<div class="clearfix"></div>

<div class="container">
    <div class="row main">
        <div class="main-login main-center">
            <h5 class="form-group">Welcome</h5>
            <h5 class="form-group">Choose your level to log-in :</h5>
            <div class="form-group">
                <div class="cols-sm-10">
                    <p><a class="bg-danger" href="levels/100level/index.php">100lvl</a></p>
                    <p><a class="bg-danger" href="levels/200level/index.php">200lvl</a></p>
                    <p><a class="bg-primary" href="levels/300level/index.php">300lvl</a></p>
                    <p><a class="bg-info" href="levels/400level/index.php">400lvl</a></p>
                </div>
            </div>


<script src="../../../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>