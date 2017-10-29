<?php
include('dbconfig.php');
	session_start();
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>Welcome</title>
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
          <a class="navbar-brand" href="http://nacoss.reecpay.com.ng">Nacoss RegPay</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="#"><a href="#active">Tab X</a></li>
            <li><a href="#">Tab 1</a></li>
            <li><a href="#">Tab 2</a></li>
          </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $_SESSION['user']; ?>&nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="home.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Home</a></li>
                        <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                    </ul>
                </li>
            </ul>


        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<div class="clearfix"></div>

	<div class="active">
    <div class="container-fluid" style="margin-top:80px;">


    </div>
    </div>

<div class="active1">
    <div class="container-fluid" style="margin-top:80px;">

    </div>
</div>


<script src="../../../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>