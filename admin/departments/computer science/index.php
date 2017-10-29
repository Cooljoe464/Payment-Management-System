<?php
session_start();
include_once 'dbconfig.php';

$result['success']="";
$result['error']="";
if(isset($_POST['loginbtn']))
{
    $username = $con->real_escape_string(strtoupper($_POST['user']));
    $department = $con->real_escape_string($_POST['dept']);
    $password = hash('sha256',$_POST['password']);

    $query = "SELECT * FROM admin WHERE user_email='$username' OR user_name='$username'";
    $response = $con->query($query);
    $row = mysqli_fetch_array($response);

    if($row['password'] == $password) {
        header("location: home.php");
        $result['success'] = "Successfully Logged in <br/><marquee>redirecting...</marquee><a class='btn btn-link' href=\"home.php\">Click Here to login</a>";
        $_SESSION['user'] = $row['user_name'];
    }
    else{
        $result['error']="Login Failed. You do not have Administrator's Privileges";
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../../css/bootstrap-theme.min.css" rel="stylesheet" media="screen">



    <!-- Website CSS style -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="style.css">-->
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

    <title>Nacoss Login Page</title>
</head>
<body>
<div class="container">

    <div class="row">
        <div class="Absolute-Center is-Responsive">
            <div id="logo-container"></div>

            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <form class="form-group" role="form" action="index.php" method="post" enctype="multipart/form-data">
                    <h3><label><b>Login</b></label></h3>
                    <div class="alert alert-info"><?php $result['success']; ?>&times;</div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="user" placeholder="Matric Number or E-mail ID" required />
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Your Password" required/>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="loginbtn" class="btn btn-default badge  btn-block">Login</button>
                    </div>
                    <div class="form-group text-center">
                        <a href="#">Forgot Password</a>&nbsp;|&nbsp;<a href="register.php">Sign up</a>&nbsp;|&nbsp;<a href="../../../index.php">Students</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../../../js/bootstrap.min.js"></script>
<script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
</body>
</html>