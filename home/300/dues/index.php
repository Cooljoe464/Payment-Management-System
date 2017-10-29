<?php
session_start();
include_once ('../dbconfig.php');

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="../jquery-1.11.3-jquery.min.js"></script>
    <link rel="stylesheet" href="../style.css" type="text/css"  />
    <style>
        .form-group, #id, h2, a ,label{
            color: #FFFFFF;
        }
    </style>
    <title> Computer Science dues payment </title>
</head>
<body style="background-size: contain; background-color: #37474f;">
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <?php
                        $query = "SELECT last_name ,first_name FROM `100` WHERE user_name='{$_SESSION['user']}'";
                        $result_array = mysqli_fetch_assoc(mysqli_query($con, $query));
                        $actual_first_name= $result_array['first_name'];
                        $actual_last_name= $result_array['last_name'];

                        ?>
                        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $actual_first_name;?> <span><?php echo $actual_last_name;?>&nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../home.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Home</a></li>
                        <li><a href="../profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                        <li><a href="../logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<br><br><br>
    <form >
        <?php
        $query = "SELECT user_email, user_name ,first_name, phone_number FROM `100` WHERE user_name='{$_SESSION['user']}'";
        $result_array = mysqli_fetch_assoc(mysqli_query($con, $query));
        $actual_user_email= $result_array['user_email'];
        $actual_user_name= $result_array['user_name'];
        $actual_user_phone= $result_array['phone_number'];


        ?>
        <div class="form-group panel-success">
        <script type="application/javascript" src="https://js.paystack.co/v1/inline.js"></script>
        <input title="" type="hidden" value="" name="<?php echo $actual_user_email;?>" id="email" placeholder="Input your valid Email" required>
        <input title="" type="hidden" value="" name="<?php echo $actual_user_name;?>" id="user_name" placeholder="Input your Matric number" required>
        <input title="" type="hidden" value="" name="<?php echo $actual_user_phone;?>" id="phone_number" placeholder="Input your Phone Number" required>
        <input title="" type="hidden" value="Bingham University" name="" id="school_name" placeholder="Input your Phone Number" required>
            <p id="id">Before you continue, please make sure you are able to print the reciept after the successful transaction.
            </p><p>Or save it/print it as pdf. </p>
        <button type="button" class="btn btn-success" onclick="payWithPaystack()"> Pay your Dues<b>(4000)</b></button>
        </div>
    </form>

    <script type="application/javascript" src="info.js"></script>
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>