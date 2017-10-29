
<?php
/**
 * Created by PhpStorm.
 * User: Joe_Pc
 * Date: 25/09/2017
 * Time: 11:53 AM
 */

include '../../dbconfig.php';

session_start();
if(!isset($_SESSION['user']))
{
    header("Location: ../../index.php");
}
?>
<?php
if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
{
    $user_name = $_GET['edit_id'];
    $stmt_edit = "SELECT * FROM `users` WHERE user_name ='$user_name'";
    $edit_row = mysqli_fetch_assoc(mysqli_query($conn, $stmt_edit));

}
else
{
    header("Location: ../../index.php");
}



if(isset($_POST['btn_save_updates']))
{
    $date_of_birth = htmlentities($_POST['txt_dob']);
    $phone_number = htmlentities($_POST['txt_phone']);
    $hostel_address = htmlentities($_POST['txt_hostel']);
    $name_of_sponsors = htmlentities($_POST['txt_name_of_spon']);
    $phone_number_of_sponsors = htmlentities($_POST['txt_phone_num_spon']);
    $gender = htmlentities($_POST['txt_gender']);
    $department = htmlentities($_POST['txt_department']);
    $firstname = htmlentities($_POST['txt_fname']);
    $lastname = htmlentities($_POST['txt_lname']);
    $email = htmlentities($_POST['txt_umail']);
    $userName = htmlentities($_POST['user_name']);
    $password = hash('sha256', $_POST['txt_upass']);
    $avatar = $_FILES['avatar']['name'];
    $tmp_dir = $_FILES['avatar']['tmp_name'];
    $imgSize = $_FILES['avatar']['size'];

    if($avatar)
    {
        $upload_dir = 'image/'; // upload directory
        $imgExt = strtolower(pathinfo($avatar,PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        $userpic = rand(1000,1000000).".".$imgExt;
        if(in_array($imgExt, $valid_extensions))
        {
            if($imgSize < 5000000)
            {
                unlink($upload_dir.$edit_row['avatar']);
                move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            }
            else
            {
                $errMSG = "Sorry, your file is too large it should be less then 5MB";
            }
        }
        else
        {
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    }
    else
    {
        // if no image selected the old image remain as it is.
        $userpic = $edit_row['avatar']; // old image from database
    }


    // if no error occured, continue ....
    if(!isset($errMSG))
    {
        $stmt = $DB_con->prepare("UPDATE `100` SET date_of_birth='$date_of_birth', phone_number='$phone_number', hostel_address='$hostel_address', name_of_sponsors='$name_of_sponsors',
 phone_number_of_sponsors='$phone_number_of_sponsors', gender='$gender',
 department='$department', first_name='$firstname', last_name='$lastname', user_email='$email', user_name=$userName, user_pass=:up, avatar:av WHERE user_id=:uid");
        $stmt->bindParam(':dob',$date_of_birth);
        $stmt->bindParam(':pn',$phone_number);
        $stmt->bindParam(':ha',$hostel_address);
        $stmt->bindParam(':nos',$name_of_sponsors);
        $stmt->bindParam(':pnos',$phone_number_of_sponsors);
        $stmt->bindParam(':ge',$gender);
        $stmt->bindParam(':de',$department);
        $stmt->bindParam(':fn',$firstname);
        $stmt->bindParam(':ln',$lastname);
        $stmt->bindParam(':ue',$email);
        $stmt->bindParam(':un',$userName);
        $stmt->bindParam(':up',$password);
        $stmt->bindParam(':av',$avatar_path);
        $stmt->bindParam(':uid',$id);

        if($stmt->execute()){
            ?>
            <script>
                alert('Successfully Updated ...');
                window.location.href='index.php';
            </script>
            <?php
        }
        else{
            $errMSG = "Sorry Data Could Not Updated !";
        }

    }


}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="jquery-1.11.3-jquery.min.js"></script>
    <link rel="stylesheet" href="style.css" type="text/css"  />
    <title>Edit-Profile</title>
    <style>
        p, tr, td, h2, h3, a ,label{
            color: #FFFFFF;
        }
        .size, .table {
            width: 10%;
        }
    </style>
</head>
<body>


<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Nacoss ReecPay</a>
        </div>

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
                    <li><a href="home.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Home</a></li>
                    <li><a href="profile.php"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp;Profile</a></li>
                    <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                </ul>
            </li>
        </ul>


    </div><!--/.nav-collapse -->

</nav>



<p class="btn btn-success">Coming soon</p>


</body>
<script src="../../bootstrap/js/bootstrap.min.js"></script>

</html>