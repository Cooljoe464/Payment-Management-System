<?php
include '../../dbconfig.php';

session_start();
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
$error="";
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="../../jquery-1.11.3-jquery.min.js"></script>
<link rel="stylesheet" href="../../style.css" type="text/css"  />
<title>Your Profile</title>
    <style>
        p, tr, td, h2, h3, a ,label{
            color: #FFFFFF;
        }
        .size, .table {
            width: 10%;
        }
    </style>
</head>

<body style="background-size: contain; background-color: #37474f;">

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">ReecPay</a>
        </div>

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <?php
                  $query = "SELECT * FROM `users` WHERE user_name='{$_SESSION['user']}'";
                  $result_array = mysqli_fetch_assoc(mysqli_query($conn, $query));
                  $actual_first_name= $result_array['first_name'];
                  $actual_last_name= $result_array['last_name'];

                  ?>
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $actual_first_name;?> <span><?php echo $actual_last_name;?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="home.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Home</a></li>
                  <li><a href="edit-profile.php?edit_id=<?php echo $_SESSION['user'] ?>" title="click to edit" onclick="return confirm('sure you want to edit ?')><span class="glyphicon glyphicon-user"></span>&nbsp;Edit Profile</a></li>
                <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>


        </div><!--/.nav-collapse -->

    </nav>

	<div class="clearfix"></div>

	<div class="active">
    <div class="container-fluid glyphicon-align-center" style="margin-top:80px;">
        <?php
        $query = "SELECT * FROM `users` WHERE user_name='{$_SESSION['user']}'";
        $result_array = mysqli_fetch_assoc(mysqli_query($conn, $query));
        $actual_image_name = $result_array['avatar'];
        $actual_first_name= $result_array['first_name'];
        $actual_last_name= $result_array['last_name'];
        $actual_user_name= $result_array['user_name'];
        $actual_user_mail= $result_array['user_email'];
        $actual_user_phone= $result_array['phonenumber'];
        $actual_user_hostel= $result_array['hostel'];
        $actual_user_dateofbirth= $result_array['dateofbirth'];


        ?>

        <div class=" img-responsive "><img class="img-rounded" width="200" height="200" src="../../image/<?php echo $actual_image_name; ?>">
            <p ><?php echo $actual_first_name;?> <span><?php echo $actual_last_name;?></span></p>
            <p></p>

            </div>
        <table class="table table-bordered table-responsive">

            <tr>
                <td><label class="control-label">User Name.</label></td>
                <td class="size"><?php echo $actual_user_name ?></td>
            </tr>

            <tr>
                <td><label class="control-label">Email.</label></td>
                <td class="size"><?php echo $actual_user_mail ?></td>
            </tr>

            <tr>
                <td><label class="control-label">Phone Number.</label></td>
                <td class="size"><?php echo $actual_user_phone ?></td>
            </tr>

            <tr>
                <td><label class="control-label">First Name.</label></td>
                <td class="size"><?php echo $actual_first_name ?></td>
            </tr>

            <tr>
                <td><label class="control-label">Last Name.</label></td>
                <td class="size"><?php echo $actual_last_name ?></td>
            </tr>

            <tr>
                <td><label class="control-label">Hostel Address.</label></td>
                <td class="size"><?php echo $actual_user_hostel ?></td>
            </tr>
        </table>
    </div>
    </div>

<!--<div class="active1">
    <div class="container-fluid" style="margin-top:80px;"> <?php

        if(isset($_POST['submit-btn'])) {
            $file = $conn->real_escape_string($_POST['txt_file']);
            $query = "UPDATE `users` SET avatar='$file' WHERE user_name='{$_SESSION['user']}'";
            $result_array = mysqli_fetch_assoc(mysqli_query($conn, $query));
            $actual_image_name = $result_array['avatar'];
        }else{
            $error= "Error updating... Please try again";
        }
        ?>
        <div class="alert-info"><span><?php $error; ?></span>

            <div class="container-fluid" aria-setsize="">
                <input type="file" name="txt_file">
                <br>
                <button class="btn-default" type="submit" name="submit-btn">
                    Change Image
                </button>
            </div>
        </div>

    </div>
</div>-->


<script src="../../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>