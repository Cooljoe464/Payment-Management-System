<?php
session_start();
include_once '../departments/computer science/dbconfig.php';

if(isset($_SESSION['user']) != ""){
    header("Location: departments/computer science/home.php");
}

$result['success']="";
$result['error']="";


     if(isset($_POST['btn-signup'])) {

         if ($_POST['txt_upass'] == $_POST['confirm_password']) {

             $gender = $con->real_escape_string($_POST['txt_gender']);
             $department = $con->real_escape_string($_POST['txt_department']);
             $firstname = $con->real_escape_string($_POST['txt_fname']);
             $lastname = $con->real_escape_string($_POST['txt_lname']);
             $phoneNumber=$con->real_escape_string($_POST['txt_phone']);
             $email = $con->real_escape_string($_POST['txt_umail']);
             $username = $con->real_escape_string($_POST['txt_uname']);
             $password = hash('sha256', $_POST['txt_upass']);


             $side = "INSERT INTO admin (gender, department, first_name, last_name, phonenumber, user_email, user_name, password) 
                VALUES ('{$gender}','{$department}','{$firstname}','{$lastname}','{$phoneNumber}','{$email}','{$username}','{$password}')";

             $data = mysqli_query($con, $side) or die(mysqli_error($con));


             if ($data) {
                 $result['success'] = "<a href='index.php'>Click Here to login</a>";// To prevent users from accessing the page if they their network is really slow
             } else {
                 $result['error'] = "Registration Failed";
             }

         } else {
             $result['error'] = "Two password do not match.";

         }
     }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nacoss 100lvl : Sign up</title>
    <!-- Website CSS style -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="style.css">-->
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
</head>
<body>

<div class="signin-form">

    <div class="container">
    	
        <form method="post" class="form-signin" >
            <h2 class="form-signin-heading">Register</h2><hr />

            <div class=" alert alert-info text-center"><?= $result['error'], $result['success']?></div>
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
                <label for="username" class="cols-sm-2 control-label">Username</label><!--Also known as the username-->
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="txt_uname" placeholder="Enter your username" required value="<?php if(isset($error)){echo $uname;}?>" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="cols-sm-2 control-label">PhoneNumber</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="txt_phone" placeholder="Phone Number" required value="<?php if(isset($error)){echo $phone;}?>" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="username" class="cols-sm-2 control-label">Gender</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                        <select title="" class="form-control" required autofocus name="txt_gender">
                            <option name="Male" value="Male">Male</option>
                            <option name="Female" value="Female">Female</option>
                        </select>
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
                        <input type="password" class="form-control" name="confirm_password" id="confirm"  placeholder="Confirm your Password" required/>
                    </div>
                </div>
            </div>
                    <div class="form-group">
                        <label for="confirm" class="cols-sm-2 control-label"></label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <input type="hidden" class="form-control" name="txt_department" value="Computer Science"/>
                            </div>
                        </div>
                    </div>

            <div class="clearfix"></div><hr />
            <div class="form-group">
            	<button type="submit" class="btn btn-primary" name="btn-signup">
                	<i class="glyphicon glyphicon-open-file"></i>&nbsp;SIGN UP
                </button>
            </div>
            <br>
            <label>have an account ! <a href="index.php">Sign In</a></label>
        </form>
    </div>
</div>


</body>
</html>