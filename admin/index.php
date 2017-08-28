<?php
session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('index.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('admin.php');
	}
	else
	{
		$error = "Wrong Details !";
	}	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Website CSS style -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="style.css">-->
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

    <title>Nacoss Admin-Login Page</title>
</head>
<body>
<div class="container">
    <div class="row main">
        <div class="main-login main-center">
            <h5 class="form-group">ADMIN LOGIN PAGE</h5>
            <form class="" method="post" action="#">

                <div id="error">
                    <?php
                    if(isset($error))
                    {
                        ?>
                        <div class="alert alert-danger">
                            <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                        </div>
                        <?php
                    }

                    ?>
                </div>
                <div class="form-group">
                    <label for="username" class="cols-sm-2 control-label">Username/Email-Address</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or E mail ID" required />
                            <span id="check-e"></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="cols-sm-2 control-label">Password</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <div class="form-group">
                                <input type="password" class="form-control" name="txt_password" placeholder="Your Password" required/>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <input type="submit" id="button" value="Login" name="btn-login" class="btn btn-primary btn-default btn-lg btn-block login-button">
                    <hr><hr>
                    <div class="form-group">
                        <label>Don't have account yet ! <a href="../sign-up.php">Sign Up</a></label>
                        <hr>
                    </div>
                    <div class="form-group ">
                        <a href="../index.html" type="button" id="button" class="btn btn-primary btn-lg btn-block exit-button">HomePage</a>
                    </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
