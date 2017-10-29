
<?php
include '../../dbconfig.php';
session_start();
if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
?>

<?php

	require_once 'dbconfig.php';
	
	if(isset($_GET['delete_id']))
	{
		// select image from db to delete
		$stmt_select = $DB_con->prepare('SELECT avatar FROM `400` WHERE user_id =:uid');
		$stmt_select->execute(array(':uid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("../../../department/computersci/students/level/400lvl/image/".$imgRow['avatar']);
		// it will delete an actual record from db
		$stmt_delete = $DB_con->prepare('DELETE FROM `400` WHERE user_id =:uid');
		$stmt_delete->bindParam(':uid',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: index.php");
	}

?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
<title>Students</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
    <script type="text/javascript" src="../../jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="search.js"></script>
    <style type="text/css" media="screen">
        #container {
            min-height: 1000px;
        }
    </style>
    <style>
        .page-header, h2, h3, a ,label{
            color: #FFFFFF;
        }
    </style>
    <link rel="stylesheet" href="enlarge/css/jquery-fullsizable.css" />
    <script src="https://cdn.rawgit.com/mattbryson/TouchSwipe-Jquery-Plugin/1.6.6/jquery.touchSwipe.min.js"></script>
    <script src="enlarge/js/jquery-fullsizable.js"></script>
    <script>
        $(function() {
            $('.zoom').fullsizable({
                detach_id: 'container'
            });

            $(document).on('fullsizable:opened', function(){
                $("#jquery-fullsizable").swipe({

                });
            });
        });
    </script>
</head>

<body style="background-size: contain; background-color: #37474f;">
<br>
<br>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $_SESSION['user']; ?>&nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../../departments/computer%20science/home.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Home</a></li>
                        <li><a href="../../profile.php"><span class="glyphicon glyphicon-user"></span>&nbsp;View Profile</a></li>
                        <li><a href="../../../../logout.php?logout=true"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
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
       <ul class="nav navbar-nav navbar-right">
           <li>
           <form id="live-search" action="" class="styled" method="post">
               <fieldset>
                   <input title="Search" type="text" class="form-control" id="filter" placeholder="Search" value="" />
               </fieldset>
           </form>
           </li>
        </ul>
        <a class="btn btn-success"><span class="glyphicon glyphicon-ok-sign">Students who have paid their dues</span></a>
        <a class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete ?')" href="delete_id=<?php$stmt= $DB_con->prepare('Delete * from `400`');
        $stmt->execute();
        ?>"><span class="glyphicon glyphicon-remove-circle"></span>Delete all</a>
        <h1 class="h2">All members. / <a class="btn btn-default" href="addnew.php"> <span class="glyphicon glyphicon-plus"></span> &nbsp; add new </a></h1>

    </div>
    

<div class="row">
<?php
	
	$stmt = $DB_con->prepare('SELECT user_id, user_name, user_email, avatar FROM `400` ORDER BY user_id DESC');
	$stmt->execute();

	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			?>
			<div class="col-xs-3">
                <form action="view.php" method="get">
                    <p class="page-header" title="Click to view">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="view.php?view_id=<?php echo $row['user_id']; ?>" style="color: whitesmoke;" title="Click to view" class="btn btn-success"><?php echo $user_name; ?></a></p><br>
                </form>
                <a title="Click to zoom-in and zoom-out" class="zoom"  href="../../../department/computersci/students/level/400lvl/image/<?php echo $row['avatar']; ?>" ><img src="../../../department/computersci/students/level/400lvl/image/<?php echo $row['avatar']; ?>" class="img-rounded" width="250px" height="250px" /></a>
				<p class="page-header">
				<span>
				<a class="btn btn-info" href="editform.php?edit_id=<?php echo $row['user_id']; ?>" title="click to edit" onclick="return confirm('sure you want to edit ?')"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
				<a class="btn btn-danger" href="?delete_id=<?php echo $row['user_id']; ?>" title="click to delete" onclick="return confirm(' Are you sure you want to delete ?')"><span class="glyphicon glyphicon-trash"></span> Delete</a>
				</span>
				</p>
			</div>       
			<?php
		}//forgot to put search query
	}
	else
	{
		?>
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
            </div>
        </div>
        <?php
	}
	
?>
</div>

</div>


<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>


</body>
</html>