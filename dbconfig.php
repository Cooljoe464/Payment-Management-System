<?php
/**
 * Created by PhpStorm.
 * User: Joe_Pc
 * Date: 07/10/2017
 * Time: 11:17 PM
 */

$conn = mysqli_connect("localhost","root","");
if($conn){
    echo '';
}
else{
    echo('<div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign">Database error</i> &nbsp; <?php echo $error; ?>
                     </div>');
}

if(mysqli_select_db($conn,"reec")){
    echo'';
}
else{
    echo('<div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign">Connection selection error</i> &nbsp; <?php echo $error; ?>
                     </div>');
}
?>