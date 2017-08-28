<?php
require ('students/password.php');

if ($_SERVER['REQUEST_METHOD']=='POST'){
    //two password are equal to each other
    if ($_POST['password']==$_POST['confirmpassword']){


        $firstname = $mysqli->$_POST['firstname'];
        $lastname = $mysqli->$_POST['lastname'];
        $email = $mysqli->$_POST['email'];
        $phonenumber = $mysqli->$_POST['phonenumber'];
        $username = $mysqli->$_POST['username'];
        $password = md5($_POST['password']);
        $avatar_path=$mysqli->real_escape_string('image/'.$_FILES['avatar']['name']);
        if (preg_match("!image!", $_FILES['avatar']['type'])){

            if (copy($_FILES['avatar']['tmp_name'], $avatar_path)){

                $_SESSION['username'] = $username;
                $_SESSION['avatar'] = $avatar_path;

                $sql = "INSERT INTO students (firstname, lastname, email, phonenumber, username, password, avatar)"
                    ."VALUES ('$firstname','$lastname'.'$email'.'$phonenumber'.'$username'.'$password' )";

                if ($mysqli->query($sql)=== true){
                    $_SESSION['message'] = 'Registration successful. Welcome $username';
                    header("location: index.php");
                }else{
                    $_SESSION['message']="Could not be added!";
                }
            }else{
                $_SESSION['message']= 'File upload failed';
            }
        }else{
            $_SESSION['message']="Please only upload GIF, JPEG, PNG images";
        }

    }else{
        $_SESSION['message']= "Two passwords do not match.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<!-- Website CSS style -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- Website Font style -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
		<!--<link rel="stylesheet" href="style.css">-->
		<!-- Google Fonts -->
		<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

		<title>Registration Page</title>
	</head>
	<body>
		<div class="container">
			<div class="row main">
				<div class="main-login main-center">
				<h5>REGISTER PAGE</h5>
					<form class="" method="post" action="#">

						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">FirstName</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="firstname" id="firstname"  placeholder="Enter your FirstName" required/>
								</div>
							</div>
						</div>
                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">LastName</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" name="lastname" id="lastname"  placeholder="Enter your LastName" required/>
                                </div>
                            </div>
                        </div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Your Email</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control"  name="email" id="email"  placeholder="Enter your Email" required/>
								</div>
							</div>
						</div>
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">PhoneNumber</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <input type="number" class="form-control" name="phonenumber" id="phonenumber"  placeholder="Enter your PhoneNumber" required/>
                                </div>
                            </div>
                        </div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Matric-Number</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Matric" required/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="password" class="cols-sm-2 control-label">Password</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
									<input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password" required/>
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
                                    <input type="file" name="avatar" accept="image/*" required>
                                </div>
                            </div>
                        </div>

						<div class="form-group">
                            <input type="submit" id="button" value="Register" class="btn btn-primary btn-lg btn-block login-button">

                            <hr>
                            <div class="form-group ">
                                <a href="index.html" type="button" id="button" class="btn btn-primary btn-lg btn-block login-button">Back home</a>
                            </div>

					</form>
				</div>
			</div>
		</div>

		 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	</body>
</html>