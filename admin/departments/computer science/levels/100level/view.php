<?php
include '../../dbconfig.php';
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
?>
  <?php
    require_once 'dbconfig.php';
    /**
     * Created by PhpStorm.
     * User: Joe_Pc
     * Date: 23/09/2017
     * Time: 10:32 PM
     */


    if(isset($_GET['view_id']) && !empty($_GET['view_id']))
    {
    $id = $_GET['view_id'];
	$stmt = $DB_con->prepare('SELECT * FROM `users` ORDER BY id =:uid DESC');
        $stmt->execute(array(':uid'=>$id));
        $edit_row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($edit_row);
    }
    else
    {
    header("Location: index.php");
    }
    ?>

    <!DOCTYPE html >
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
        <title>View</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <script type="text/javascript" src="../../jquery-1.11.3-jquery.min.js"></script>
        <style>
            .size, h2, h3, a ,label{
                color: #FFFFFF;
            }
        </style>
    </head>
    <body style="background-size: contain; background-color: #37474f;">
    <br>
    <br>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $_SESSION['user']; ?>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="../../home.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Home</a></li>
                            <li><a href="../../profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                            <li><a href="../../logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="clearfix"></div>
    <div class="container">

        <h3>Details of <b><?php echo $edit_row['first_name']."&nbsp;".$edit_row['last_name'];?></b>    </h3>

    <table class="table table-bordered table-responsive">

        <tr>
            <td><label class="control-label">User Name.</label></td>
            <td class="size"><?php echo $edit_row['user_name']; ?></td>
        </tr>

        <tr>
            <td><label class="control-label">Email.</label></td>
            <td class="size"><?php echo $edit_row['user_email']; ?></td>
        </tr>

        <tr>
            <td><label class="control-label">Phone Number.</label></td>
            <td class="size"><?php echo $edit_row['phonenumber']; ?></td>
        </tr>

        <tr>
            <td><label class="control-label">Date of Birth.</label></td>
            <td class="size"><?php echo $edit_row['dateofbirth']; ?></td>
        </tr>

        <tr>
            <td><label class="control-label">Hostel Address.</label></td>
            <td class="size"><?php echo $edit_row['hostel']; ?></td>
        </tr>
        <tr>
            <td><label class="control-label">Gender.</label></td>
            <td class="size"><?php echo $edit_row['gender']; ?></td>
        </tr>
    </table>

        <a href="index.php" class=" btn btn-success"> Go back</a>




    <!-- Latest compiled and minified JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

    </body>
    </html>

