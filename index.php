<?php
/**
 * Created by PhpStorm.
 * User: Joe_Pc
 * Date: 07/10/2017
 * Time: 11:06 PM
 */
include ("dbconfig.php");
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['id'];
$username = $_SESSION['user_name'];
$useremail = $_SESSION['user_email'];

?>
<?php
/*if ($_REQUEST['loginbtn']) {
    $user = $conn->real_escape_string(strtoupper($_POST['user']));
    $password = hash('sha256', $_POST['password']);

    $password_hash = hash('sha256', $password);
    $query_code = "SELECT * FROM users WHERE user_name='$user' AND user_email='$user'";
    $query = mysqli_query($conn, $query_code);
    $numrows = mysqli_num_rows($query);

    $rows = mysqli_fetch_assoc($query);
    $dbid = $rows['id'];
    $dbuser = $rows['user_name'];
    $dbemail = $rows['user_email'];
    $dbpass = $rows['password'];
    $dbactive = $rows['active'];

    if ($password = $dbpass) {
        if ($dbactive == 1) {
            while ($rows = mysqli_fetch_array($query)) {
                //set session info
                $_SESSION['id'] = $dbid;
                $_SESSION['user_name'] = $dbuser;
                $_SESSION['user_email'] = $dbemail;
                if ($rows === 1) {
                    $row_array = mysqli_fetch_assoc($query);

                    if ($row_array['levels'] == 1) {
                        header("location: ../home/100/home.php"); // Redirecting To Other Page
                    } elseif ($row_array['levels'] == 2) {
                        header("location: ../home/200/home.php");
                    } elseif ($row_array['levels'] == 3) {
                        header("location: ../home/300/home.php");
                    } elseif ($row_array['levels'] == 4) {
                        header("location: ../home/400/home.php");
                    } else {
                        $error = "Username or Password is invalid";
                    }
                }
                mysqli_close($conn);
            }
        } else {
            $error = "You must activate your account to home. $form";
        }
    } else {
        $error = "You did not enter the correct password. $form";
    }
};


*/

if(isset($_REQUEST['loginbtn']))
{
    $username = $conn->real_escape_string(strtoupper($_POST['user']));
    $password = hash('sha256',$_POST['password']);


    $query = "SELECT * FROM `users` WHERE user_email='$username' OR user_name='$username'";
    $response = $conn->query($query);
    $row = mysqli_fetch_array($response);

    if($row['password'] == $password)
    {

        if ($row['levels'] == 1 && $row['user_name']==$username) {

            $error = "Successfully Logged in <br/><marquee>redirecting...</marquee><a class='btn btn-link' href=\"home/100/home.php\">Click Here to login</a>";
            $_SESSION['user'] = $row['user_name'];
            $que =  "UPDATE `users` SET active=2";
            mysqli_query($conn, $que);
            header("location: home/100/home.php"); // Redirecting To Other Page
        } elseif ($row['levels'] == 2 && $row['user_name']==$username) {

            $error = "Successfully Logged in <br/><marquee>redirecting...</marquee><a class='btn btn-link' href=\"home/200/home.php\">Click Here to login</a>";
            $_SESSION['user'] = $row['user_name'];
            $que =  "UPDATE `users` SET active=2";
            mysqli_query($conn, $que);
            header("location: home/200/home.php");
        } elseif ($row['levels'] == 3 && $row['user_name']==$username) {

            $error = "Successfully Logged in <br/><marquee>redirecting...</marquee><a class='btn btn-link' href=\"home/300/home.php\">Click Here to login</a>";
            $_SESSION['user'] = $row['user_name'];
            $que =  "UPDATE `users` SET active=2";
            mysqli_query($conn, $que);
            header("location: home/300/home.php");
        } elseif ($row['levels'] == 4 && $row['user_name']==$username) {

            $error = "Successfully Logged in <br/><marquee>redirecting...</marquee><a class='btn btn-link' href=\"home/400/home.php\">Click Here to login</a>";
            $_SESSION['user'] = $row['user_name'];
            $que =  "UPDATE `users` SET active=2";
            mysqli_query($conn, $que);
            header("location: home/400/home.php");
        }
    }
    else{
        $error="Login Failed";
    }


}


?>

<!DOCTYPE html>
<html>
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
    <style>
        .form-group, h2, h3, a ,label{
            color: #FFFFFF;
        }
    </style>
    <meta http-equiv="Content-Type" content="multipart/form-data; charset=utf-8"/>
	<title>Login</title>
</head>
<body style="background-size: contain; background-color: #37474f;" >
<?php
if ($_REQUEST['loginbtn']){
    $user=$conn->real_escape_string(strtoupper($_POST['user']));
    $password= hash('sha256',$_POST['password']);
    if ($user){
        if ($password){
            require ("dbconfig.php");

            $password_hash = hash('sha256', $password);
            $query_code= "SELECT * FROM users WHERE user_name='$user'";
            $query = mysqli_query($conn, $query_code);
            $numrows= mysqli_num_rows($query);

                $rows = mysqli_fetch_assoc($query);
                $dbid = $row['id'];
                $dbuser = $row['username'];
                $dbemail =$row['email'];
                $dbpass = $row['password'];
                $dbactive = $row['active'];

                if ($password = $dbpass){
                    if ($dbactive == 1){

                        while ($rows = mysqli_fetch_array($query)) {
                            //set session info
                            $_SESSION['id'] = $dbid;
                            $_SESSION['user_name'] = $dbuser;
                            $_SESSION['user_email'] = $dbemail;
                            if ($rows === 1) {
                                $row_array = mysqli_fetch_assoc($query);

                                if ($row_array['levels'] == 1) {
                                    header("location: ../home/100/home.php"); // Redirecting To Other Page
                                } elseif ($row_array['levels'] == 2) {
                                    header("location: ../home/200/home.php");
                                } elseif ($row_array['levels'] == 3) {
                                    header("location: ../home/300/home.php");
                                } elseif ($row_array['levels'] == 4) {
                                    header("location: ../home/400/home.php");
                                } else {
                                    $error = "Username or Password is invalid";
                                }
                            }
                            mysqli_close($conn);
                        }
                    }else{
                        echo "You must activate your account to home. $form";
                    }
                }else{
                    echo "You did not enter the correct password. $form";
                }


            mysqli_close($conn);
        }
    }

};




echo $form;

?>
<div class="container">

    <div class="row">
        <div class="Absolute-Center is-Responsive">
            <div id="logo-container"></div>

            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <form class="form-group" role="form" action="./index.php" method="post" enctype="multipart/form-data">
                    <h3><label><b>Login</b></label></h3>
                    <div class="alert alert-info"><?php $error; ?>&times;</div>
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
                        <a href="#">Forgot Password</a>&nbsp;|&nbsp;<a href=" signup.html">Sign up</a>&nbsp;|&nbsp;<a href="admin/departments/computer science/index.php">Admin</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</html>
