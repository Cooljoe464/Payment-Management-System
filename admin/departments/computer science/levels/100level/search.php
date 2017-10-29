<?php
require_once 'dbconfig.php';
/**
 * Created by PhpStorm.
 * User: Joe_Pc
 * Date: 28/09/2017
 * Time: 4:53 PM
 */
try{
    if(isset($_REQUEST['query'])){
        // create prepared statement
        $sql = "SELECT * FROM `100` WHERE user_name LIKE :query";
        $stmt = $DB_con->prepare($sql);
        $query = $_REQUEST['query'] . '%';
        // bind parameters to statement
        $stmt->bindParam(':query', $query);
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                echo "<table class=\"table table-bordered text-center table-responsive\">";
                echo "<tr><td>" . $row['user_name'] . "</td></tr>";
                echo "</table>";

            }
        } else{
            echo "<p>No matches found</p>";
        }
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

        // Close statement
        unset($stmt);
?>

<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
    <title>View</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
    <script type="text/javascript" src="../../jquery-1.11.3-jquery.min.js"></script>
</head>
</html>
