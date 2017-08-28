<?php
session_start();
require_once('class.user.php');
$user = new USER();

if($user->is_loggedin()!="")
{
	$user->redirect('index.php');
}

if(isset($_POST['btn-signup']))
{
	$uname = strip_tags($_POST['txt_uname']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);
	$fname = strip_tags($_POST['txt_fname']);
	$lname = strip_tags($_POST['txt_lname']);
	$department = strip_tags($_POST['txt_department']);
	$level = strip_tags($_POST['txt_level']);
	$phone = strip_tags($_POST['txt_phone']);
	$gender = strip_tags($_POST['txt_gender']);
	
	if($uname=="")	{
		$error[] = "provide a username";
	}
	else if ($fname == "") {
		$error[] = "provide first name";
	}
	else if($umail=="")	{
		$error[] = "provide your email address!";
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address or username !';
	}
	else if($upass=="")	{
		$error[] = "provide password !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Password must be atleast 6 characters";	
	}
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT user_id, user_email FROM admin WHERE user_id=:uname OR user_email=:umail");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['user_name']==$uname) {
				$error[] = "sorry username already taken !";
			}
			else if($row['user_email']==$umail) {
				$error[] = "sorry email id already taken !";
			}
			else
			{
				if($user->register($uname,$umail,$upass,$fname,$lname,$dob,$department,$level,$phone)){
					$user->redirect('sign-up.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
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

    <title>Admin Reg Page</title>
</head>
<body>
<div class="container">
    <div class="row main">
        <div class="main-login main-center">
            <h5>Register As ADMIN</h5>

            <div class="form-group ">
                <label>have an account ! <a class="btn-link" href="../students/index.php">Sign In</a></label>
            </div>
            <hr>
            <form class="" method="post" action="#">

                <?php
                if(isset($error))
                {
                    foreach($error as $error)
                    {
                        ?>
                        <div class="alert alert-danger">
                            <i class="glyphicon glyphicon-warning-sign form-control-feedback"></i> &nbsp; <?php echo $error; ?>
                        </div>
                        <?php
                    }
                }
                else if(isset($_GET['joined']))
                {
                    ?>
                    <div class="alert alert-info">
                        <i class="glyphicon glyphicon-log-in form-control-feedback"></i> &nbsp; Successfully registered <a href='index.php'>login</a> here
                    </div>
                    <?php
                }
                ?>
                <div class="form-group">
                    <label for="name" class="cols-sm-2 control-label">FirstName</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="txt_fname" placeholder="First Name" required value="<?php if(isset($error)){echo $fname;}?>" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="cols-sm-2 control-label">LastName</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="txt_lname" placeholder="Last Name" value="<?php if(isset($error)){echo $lname;}?>" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="cols-sm-2 control-label">Your Email</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" required value="<?php if(isset($error)){echo $umail;}?>" />
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="username" class="cols-sm-2 control-label">UserName</label><!--Also known as the username-->
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="txt_uname" placeholder="Enter Matric-Number/ Also your username" required value="<?php if(isset($error)){echo $uname;}?>" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="cols-sm-2 control-label">PhoneNumber</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="txt_phone" placeholder="Phone" required value="<?php if(isset($error)){echo $phone;}?>" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="cols-sm-2 control-label">Password</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="txt_upass" placeholder="Enter Password" required />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="confirmpassword" id="confirm"  placeholder="Confirm your Password" required/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm" class="cols-sm-2 control-label">Choose your Image</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="file" name="avatar" accept="image/*" required value="<?php if(isset($error)){echo $$avatar;}?>" >

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" id="button" name="btn-signup" value="Register" class="btn btn-primary btn-lg btn-block login-button">

                    <hr>
                    <div class="form-group ">
                        <label>have an account ! <a href="index.php">Sign In</a></label>
                    </div>

            </form>
            <div class="form-group ">
                <a href="../index.html" type="button" id="button" class="btn btn-primary btn-lg btn-block exit-button">HomePage</a>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>
</body>
</html>

</body>
</html>