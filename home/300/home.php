<?php
session_start();
include_once ('../../dbconfig.php');

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
?>

<!DOCTYPE html >
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="../../jquery-1.11.3-jquery.min.js"></script>
    <link rel="stylesheet" href="../../style.css" type="text/css"  />
    <script id="_waupdb">var _wau = _wau || []; _wau.push(["classic", "1e5do3v3wxd1", "pdb"]);
        (function() {var s=document.createElement("script"); s.async=true;
            s.src="//widgets.amung.us/classic.js";
            document.getElementsByTagName("head")[0].appendChild(s);
        })();</script>
    <title>Welcome Home</title>

</head>

<body style="background-size: contain; background-color: #37474f;">
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php
                        $query = "SELECT last_name ,first_name FROM `users` WHERE user_name='{$_SESSION['user']}'";
                        $result_array = mysqli_fetch_assoc(mysqli_query($conn, $query));
                        $actual_first_name= $result_array['first_name'];
                        $actual_last_name= $result_array['last_name'];

                        ?>
                        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $actual_first_name;?> <span><?php echo $actual_last_name;?>&nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="dues/index.php"><span class="glyphicon glyphicon-ok-sign"></span>Pay your dues here</a></li>
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



<script src="../../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
