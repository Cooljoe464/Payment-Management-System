<?php
/**
 * Created by PhpStorm.
 * User: Joe_Pc
 * Date: 08/10/2017
 * Time: 3:08 AM
 */

include ("dbconfig.php");
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$useremail = $_SESSION['email'];

?>


<!DOCTYPE html>
<html>
<head>
	<title>Activate</title>
</head>
<body>
<?php
$getuser = $_GET['user'];
$getcode = $_GET['code'];

$form = "<form action='./activate.php' method='post'>
<table>
<tr>
<td><input type='hidden' name='user' value='$getuser' /></td>
</tr>
<tr>
<td><input type='hidden' name='code' value='$getcode' /></td>
<tr>
<td><input type='button' name='avtivatebtn'value='Activate' /></td>
</tr>
</table>


</form>";

if (isset($_REQUEST['activatebtn'])){
    $getuser = $_POST['user'];
    $getcode = $_POST['code'];

    if ($getuser){
        if ($getcode){
            require ("dbconfig.php");
            $sel_query= "SELECT * FROM users WHERE user_name='$getuser'";
            $query = mysqli_query($conn, $sel_query);
            $numrows = mysqli_num_rows($query);
            if ($numrows==1){
                $row = mysqli_fetch_assoc($query);
                $dbcode = $row['code'];
                $dbactive = $row['active'];

                if ($dbactive == 0){
                    if ($dbactive == $getcode){
                        mysqli_query($conn, "UPDATE users SET active='1' WHERE user_name='$getuser'");
                        $query = mysqli_query($conn, "SELECT * FROM users WHERE  user_name='$getuser' AND active='1'");
                        $numrows = mysqli_num_rows($query);
                        if ($numrows==1){
                            $errormsg = "Your account has be activated. You may now home <a href='index.php'>Here.</a>";
                            $getuser="";
                            $getcode="";
                        }else{
                            $errormsg ="An error has occured. You account was not activated";
                        }
                    }
                }
            }
        }
    }

}else{
    $errormsg="";
}

echo $form;
?>

</body>
</html>