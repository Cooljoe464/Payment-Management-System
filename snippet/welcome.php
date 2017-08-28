<?php
include('session.php');
?>


    <head>
        <title>Welcome </title>
    </head>
    <h1>Welcome <?php echo $login_session; ?></h1>
    <h2><a href = "logout.php">Sign Out</a></h2>



<?php
$mysqli = new mysqli('localhost', 'root','', 'reg');
$sql = "SELECT username FROM students";
$result =$mysqli->query($sql);

?>

<div id="">
    <span>All registered users</span>
    <?php
    while ($row = $result->fetch_assoc()){
        echo "<div class=''><span>$row[username]</span><br>";
   //     echo "<img src='$row[avatar]'></div>";
    }
    ?>
</div>
<?php
session_destroy();
?>