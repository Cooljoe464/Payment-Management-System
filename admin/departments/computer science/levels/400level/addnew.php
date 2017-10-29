<?php
include '../../dbconfig.php';
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
?>
<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once 'dbconfig.php';
	
	if(isset($_POST['btnsave']))
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

        $avatar_path = $_FILES['avatar']['name'];;
		$tmp_dir = $_FILES['avatar']['tmp_name'];
		$imgSize = $_FILES['avatar']['size'];
		
		
		if(empty($userName)){
			$errMSG = "Please Enter Username.";
		}
		else if(empty($email)){
			$errMSG = "Please Enter Your Email.";
		}
		else if(empty($avatar_path)){
			$errMSG = "Please Select Image File.";
		}
		else
		{
			$upload_dir = '../../../students/level/100lvl/image/'; // upload directory. My problem
	
			$imgExt = strtolower(pathinfo($avatar_path,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

			// rename uploading image
			$avatar_path = rand(1000,1000000).".".$imgExt;
				
			// allow valid image file formats
			if(in_array($imgExt, $valid_extensions)){			
				// Check file size '2MB'
				if($imgSize < 2000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$avatar_path);
				}
				else{
					$errMSG = "Sorry, your file is too large.";
				}
			}
			else{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}
		}
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $DB_con->prepare('INSERT INTO `100`(date_of_birth, phone_number, hostel_address, name_of_sponsors,
 phone_number_of_sponsors, gender,
 department, first_name, last_name, user_email, user_name, user_pass, avatar)
  VALUES(:dob, :pn, :ha,:nos, :pnos, :ge,:de, :fn, :ln,:ue, :un, :up, :av)');
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
			if($stmt->execute())
			{
				$successMSG = "Successfully registered ...";
				header("refresh:5;index.php"); // redirects image view page after 5 seconds.
			}
			else
			{
				$errMSG = "Error while registering....";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

<title>Add New</title>
    <link href="../../../../css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script type="text/javascript" src="../../jquery-1.11.3-jquery.min.js"></script>

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
    <link href="../../../../../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../../../../../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $_SESSION['user']; ?>&nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../../profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                        <li><a href="../../../../logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<br>
<br>

<div class="clearfix"></div>
<div class="container">


	<div class="page-header">
    	<h1 class="h2">Add new user. <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; view all </a></h1>
    </div>
    

	<?php
	if(isset($errMSG)){
			?>
            <div class="alert alert-danger">
            	<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
	}
	else if(isset($successMSG)){
		?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
	}
	?>   

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">First Name.</label></td>
        <td><input class="form-control" type="text" name="txt_fname" placeholder="First Name" value="<?php echo $firstname; ?>" /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Last Name.</label></td>
        <td><input class="form-control" type="text" name="txt_lname" placeholder="Your Last Name" value="<?php echo $lastname; ?>" /></td>
    </tr>

    <tr>
        <td><label class="control-label">Email.</label></td>
        <td><input class="form-control" type="text" name="txt_umail" placeholder="Enter Email" value="<?php echo $email; ?>" /></td>
    </tr>
    <tr>
        <td><label class="control-label">Username.</label></td>
        <td><input class="form-control" type="text" name="user_name" placeholder="Enter Matric-Number" value="<?php echo $userName; ?>" /></td>
    </tr>

    <tr>
        <td><label class="control-label">Phone Number.</label></td>
        <td><input class="form-control" type="text" name="txt_phone" placeholder="Enter Username" value="<?php echo $phone_number; ?>" /></td>
    </tr>

    <tr>
        <td><label class="control-label">Department.</label></td>
        <td><input class="form-control" type="text" name="txt_department" placeholder="Enter Username" value="<?php echo $department; ?>" /></td>
    </tr>

    <tr>
        <td><label class="control-label">Date of Birth.</label></td>
        <td><input class="form-control" type="text" name="txt_dob" placeholder="Enter Username" value="<?php echo $date_of_birth; ?>" /></td>
    </tr>

    <tr>
        <td><label class="control-label">Hostel Address.</label></td>
        <td><input class="form-control" type="text" name="txt_hostel" placeholder="Enter Username" value="<?php echo $hostel_address; ?>" /></td>
    </tr>

    <tr>
        <td><label class="control-label">Name of sponsors.</label></td>
        <td><input class="form-control" type="text" name="txt_name_of_spon" placeholder="Enter Username" value="<?php echo $name_of_sponsors; ?>" /></td>
    </tr>

    <tr>
        <td><label class="control-label">Phone number of sponsors.</label></td>
        <td><input class="form-control" type="text" name="txt_phone_num_spon" placeholder="Enter Username" value="<?php echo $phone_number_of_sponsors; ?>" /></td>
    </tr>

    <tr>
        <td><label class="control-label">Gender.</label></td>
        <td><select class="form-control" required autofocus name="txt_gender">
                <option name="Male" value="Male">Male</option>
                <option name="Female" value="Female">Female</option>
            </select></td>
    </tr>

    <tr>
        <td><label class="control-label">Password.</label></td>
        <td><input class="form-control" type="text" name="txt_upass" placeholder="Input password" value="<?php echo $password; ?>" /></td>
    </tr>

    <tr>
        <td><label class="control-label">Profile Img.</label></td>
        <td><input class="input-group" type="file" name="avatar" accept="image/*" /></td>
    </tr>

    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
                <span class="glyphicon glyphicon-save"></span> &nbsp; save
            </button>
        </td>
    </tr>
    
    </table>
    
</form>

</div>
<!-- Latest compiled and minified JavaScript -->
<script src="../../../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>