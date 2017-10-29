<?php
session_start();
include_once ('../../../dbconfig.php');

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}


$query = "SELECT user_email, department, user_name ,first_name, phone_number FROM `users` WHERE user_name='{$_SESSION['user']}'";
$result_array = mysqli_fetch_assoc(mysqli_query($conn, $query));
$actual_user_email= $result_array['user_email'];
$actual_user_name= $result_array['user_name'];
$actual_user_phone= $result_array['phonenumber'];




if(!isset($_SERVER['HTTP_REFERER'])){
    // redirect them to your desired location if they are accessing
    // the page directly without any form submission or redirect
    header('location:index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Successful Transaction</title>
    <link href="../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="../../../jquery-1.11.3-jquery.min.js"></script>
    <link rel="stylesheet" href="../../../style.css" type="text/css"  />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="info.js">
        x = response.reference; document.getElementById("reference").innerHTML = x;
    </script>
    <script type='text/javascript'>
       $(function() {
         $("#printable").find('.print').on('click', function() {
            $.print("#printable");
         });
       });
    </script>

    <style>
        .size, h2, h3, a, #sch_name ,label{
            color: #FFFFFF;
        }
        .size, .table {
            width: 10%;
        }
        .sise{
            width: 50%;
        }
    </style>
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
                        <li><a href="../home.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Home</a></li>
                        <li><a href="../profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                        <li><a href="../logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br><br><br><br><br>

<div class="" ><center>
<div class="" >
    <p class="sise"><img style="background-color: #1abc9c" class="img-circle" src="image/bingham_mini.png">
    <p id="sch_name">Bingham University(Computer Science) 100level</p>

<table class="table table-responsive table-bordered ">

    <tr>
        <td><label class="control-label">Matric Number:</label></td>
        <td class="size"><?php echo $actual_user_name; ?></td>
    </tr>
    <tr>
        <td><label class="control-label">Reference:</label></td>
        <td class="size" id="reference"><?php
            $ref = $_REQUEST['ref'];
            echo $ref;?></td>
    </tr>
    <tr>
        <td><label class="control-label">Amount:</label></td>
        <td class="size">#4000</td>
    </tr>

    <tr>
        <td><label class="control-label">Email:</label></td>
        <td class="size"><?php echo $actual_user_email; ?></td>
    </tr>

    <tr>
        <td><label class="control-label">Phone Number:</label></td>
        <td class="size"><?php echo $actual_user_phone; ?></td>
    </tr>

    <tr>
        <td><label class="control-label">Department:</label></td>
        <td class="size">Computer Science</td>
    </tr>
</table>
</div>
        <p id="sch_name">Note: Please do not pay more than once. Other wise, the fee isn't refundable</p>
        <p id="sch_name"> And remember to print this copy as it will not be available once you are out of here.</p>
    </center>
</div>




<script src="../../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>