<?php
session_start();

if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}
include '../dbconfig.php';

$result['success']="";
$result['error']="";

error_reporting(''); // avoid notice


if(isset($_REQUEST['register'])) {

    if ($_POST['txt_upass'] == $_POST['confirm_password']) {


        $date_of_birth = $conn->real_escape_string($_POST['txt_dob']);
        $phone_number = $conn->real_escape_string($_POST['txt_phone']);
        $hostel_address = $conn->real_escape_string($_POST['txt_hostel']);
        $name_of_sponsors = $conn->real_escape_string($_POST['txt_name_of_spon']);
        $phone_number_of_sponsors = $conn->real_escape_string($_POST['txt_phone_num_spon']);
        $gender = $conn->real_escape_string($_POST['txt_gender']);
        $department = $conn->real_escape_string($_POST['txt_department']);
        $firstname = $conn->real_escape_string($_POST['txt_fname']);
        $lastname = $conn->real_escape_string($_POST['txt_lname']);
        $email = $conn->real_escape_string($_POST['txt_umail']);
        $levels = $conn->real_escape_string($_POST['levels']);
        $username = $conn->real_escape_string(strtoupper($_POST['user_name']));
        $password = hash('sha256', $_POST['txt_upass']);
        $active =$conn->real_escape_string($_POST['active']);
        $avatar_path = $conn->real_escape_string($_FILES['avatar']['name']);

        $tmp_dir = $_FILES['avatar']['tmp_name'];
        $imgSize = $_FILES['avatar']['size'];


        $upload_dir = '../image/'; // upload directory. My problem

        $imgExt = strtolower(pathinfo($avatar_path, PATHINFO_EXTENSION)); // get image extension

        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

        // rename uploading image
        $avatar_path = rand(1000, 1000000) . "." . $imgExt;

        // allow valid image file formats
        if (in_array($imgExt, $valid_extensions)) {
            // Check file size '2MB'
            if ($imgSize < 2000000) {
                move_uploaded_file($tmp_dir, $upload_dir . $avatar_path);

                $checkUName = "SELECT * FROM users WHERE user_name = $username";
                $run = mysqli_query($conn, $checkUName);

                if (mysqli_num_rows($run) > 0) {
                    echo "<script>alert('Matric Number already registered. Input a different one. Refresh the page')</script>";
                    exit();
                }

                $checkName = "SELECT * FROM users WHERE user_email = $email";
                $rum = mysqli_query($conn, $checkName);

                if (mysqli_num_rows($rum) > 0) {
                    echo "<script>alert('Email already in use. Input a different one. Refresh the page')</script>";
                    exit();
                }
                $code = hash("sha256", rand());
                $side = "INSERT INTO `users` (gender, dateofbirth, phonenumber, levels,  hostel, sponsor, sponsorphonenumber, first_name, last_name, user_email, user_name , password, avatar, code, active) 
                VALUES ('{$gender}','{$date_of_birth}','{$phone_number}','{$levels}','{$hostel_address}','{$name_of_sponsors}','{$phone_number_of_sponsors}','{$firstname}','{$lastname}','{$email}','{$username}','{$password}','{$avatar_path}','{$code}','{$active}')";

                $data = mysqli_query($conn, $side) or die(mysqli_error($conn));


                if ($data) {
                    $result['success'] = "Successfully Registered <br/>If you are not redirected, <a class='btn btn-link' href=\"../index.php\">CLick Here to login</a>";// To prevent users from accessing the page if they their network is really slow
                    header("refresh:5;../index.php");

                } else {
                    $result['error'] = "Registration Failed";
                }
            } else {
                $result['error'] = "Sorry, your image is too large.";
            }
        } else {
            $result['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        $result['error'] = "Two password do not match.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>100lvl Computer Science</title>
    <!-- Website CSS style -->
    <link href="../css/bootstrap.css" rel="stylesheet">


    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="style.css">-->
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
    <style>
        .form-group, h2, a ,label{
            color: #FFFFFF;
        }
    </style>
</head>
<body style="background-size: contain; background-color: #37474f;">

<div class="signin-form">
    <div class="container" style="background-size: contain; background-color: #37474f;">

        <form method="post" action="100.php" class="form" enctype="multipart/form-data" >
            <h2 class="form-signin-heading">Register</h2><hr />

            <div class=" alert alert-info text-center"><?= $result['error'], $result['success']?></div>
            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">FirstName</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="txt_fname" placeholder="First Name" required value=""/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">LastName</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="txt_lname" placeholder="Last Name" value=""/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="cols-sm-2 control-label">Your Email</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                        <input type="email" class="form-control" name="txt_umail" placeholder="Enter E-Mail ID" required value=""/>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="username" class="cols-sm-2 control-label">Matric-Number</label><!--Also known as the username-->
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="user_name" placeholder="Your matric number is your username" required value=""/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="cols-sm-2 control-label">PhoneNumber</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                        <input type="tel" class="form-control" name="txt_phone" placeholder="Phone Number" required value=""/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="cols-sm-2 control-label">Department</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="txt_department" placeholder="Your department" required value=""/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="cols-sm-2 control-label">DateOfBirth</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                        <input type="date" class="form-control" name="txt_dob" placeholder="Enter your date of birth" required value=""/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="cols-sm-2 control-label">Hostel Address</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="txt_hostel" placeholder="Your hostel" required value=""/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="cols-sm-2 control-label">Name Of Sponsors</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" name="txt_name_of_spon" placeholder="Name of your Sponsors" required />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="cols-sm-2 control-label">Phone Number Of Sponsors</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                        <input type="tel" class="form-control" name="txt_phone_num_spon" placeholder="Phone number of Sponsors" required  />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="cols-sm-2 control-label">Gender</label>
                <div class="cols-sm-10">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                        <select title="" class="form-control" required name="txt_gender">
                            <option name="" value="">---Choose---</option>
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
                <div class="cols-sm-10">
                    <div class="input-group">
                        <input value="1" title="" type="hidden" class="form-control" name="levels"  />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="cols-sm-10">
                    <div class="input-group">

                        <input value="0" title="" type="hidden" class="form-control" name="active"  />
                    </div>
                </div>
            </div>
            <input type="file" class="form-group" name="avatar" accept="/image/*" placeholder="Change the name of yor picture to your name" required/>

            <div class="form-group">
                <input type="submit" value="Register"  name="register" class="btn btn-block btn-success">
            </div>
            <label>have an account ! <a href="../index.php">Sign In</a></label>

            <div class="clearfix"></div><hr />

        </form>
    </div>
</div>

</body>
</html>
