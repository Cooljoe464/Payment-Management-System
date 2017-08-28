<?php
/**
 * Created by PhpStorm.
 * User: Joe_Pc
 * Date: 13/08/2017
 * Time: 9:19 AM
 */
session_start();
include('class.user.php');
//define page title
$title = 'Admin Page';


$user = new USER();

if($user->is_loggedin()!="")
{
    $user->redirect('../index.html');
}

?>

<div class="container">

    <div class="row">

        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

            <h2>Admin page - Welcome <?php echo $_SESSION['user_name']; ?></h2>
            <p><a href='../logout.php'>Logout</a></p>
            <hr>
        </div>
    </div>

<?php


$sql = "SELECT * FROM users";
$sqldata = mysqli_query($mysqli, $sql) or die('error getting database.');
echo "<table>";
echo "<tr><th>S/N</th><th>PHOTO</th><th>MATRIC-NUMBER</th><th>EMAIL-ADDRESS</th>
<th>FIRST-NAME</th><th>LAST-NAME</th><th>LEVEL</th><th>PHONE-NUMBER</th><th>HOSTEL-ADDRESS</th>
<th>NAME-OF-SPONSORS</th><th>SPONSOR-PHONE-NUMBER</th><th>GENDER</th><th>DEPARTMENT</th><th>DATE</th>";

while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
    echo "</tr><td>";
    echo $row['user_id'];
    echo "<td><td>";
    echo $row['avatar'];
    echo "</td><td>";
    echo $row['user_name'];
    echo "</td><td>";
    echo $row['user_email'];
    echo "</td><td>";
    echo $row['first_name'];
    echo "</td><td>";
    echo $row['last_name'];
    echo "</td><td>";
    echo $row['level'];
    echo "</td><td>";
    echo $row['phone_number'];
    echo "</td><td>";
    echo $row['hostel_address'];
    echo "</td><td>";
    echo $row['name_of_sponsors'];
    echo "</td><td>";
    echo $row['phone_number_of_sponsors'];
    echo "</td><td>";
    echo $row['gender'];
    echo "</td><td>";
    echo $row['department'];
    echo "</td><td>";
    echo $row['joining_date'];
    echo"</td></tr>";

}
