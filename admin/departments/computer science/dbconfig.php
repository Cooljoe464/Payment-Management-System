<?php
$con = mysqli_connect("localhost","root","");
if($con){
    echo '';
}
else{
    echo('<div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign">Database error</i> &nbsp; <?php echo $error; ?>
                     </div>');
}

if(mysqli_select_db($con,"reec")){
    echo'';
}
else{
    echo('<div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign">Connection selection error</i> &nbsp; <?php echo $error; ?>
                     </div>');
}
