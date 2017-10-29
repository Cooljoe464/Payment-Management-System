<?php
include '../../dbconfig.php';
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
?>
<?php

	error_reporting( ~E_NOTICE );
	
	require_once 'dbconfig.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		$id = $_GET['edit_id'];
		$stmt_edit = $DB_con->prepare('SELECT date_of_birth, phone_number, hostel_address, name_of_sponsors,
 phone_number_of_sponsors, gender,
 department, first_name, last_name, user_email, user_name, user_pass, avatar FROM `200` WHERE user_id =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: index.php");
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
			$upload_dir = '../../../department/computersci/students/level/200lvl/image/'; // upload directory
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
			$stmt = $DB_con->prepare('UPDATE `200` SET date_of_birth=:dob, phone_number=:pn, hostel_address=:ha, name_of_sponsors=:nos,
 phone_number_of_sponsors:pnos, gender=:ge,
 department=:de, first_name=:fn, last_name:ln, user_email=:ue, user_name=:un, user_pass=:up, avatar:av WHERE user_id=:uid');
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
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Users</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">

<!-- custom stylesheet -->
<link rel="stylesheet" href="../../style.css">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="../../jquery-1.11.3-jquery.min.js"></script>
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


	<div class="page-header">
    	<h1 class="h2">Update profile. <a class="btn btn-default" href="index.php"> All members </a></h1>
    </div>

<div class="clearfix"></div>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
    
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
        <td>
        	<p><img src="../../../department/computersci/students/level/200lvl/image/<?php echo $edit_row['avatar']; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="user_image" accept="image/*" />
        </td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Update
        </button>
        
        <a class="btn btn-default" href="index.php"> <span class="glyphicon glyphicon-backward"></span> cancel </a>
        
        </td>
    </tr>
    
    </table>
    
</form>
</div>
</body>
</html>