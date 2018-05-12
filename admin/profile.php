<?php
include_once 'includes/dbconfig.php';
if(!$user->is_loggedin())
{
	$user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans&subset=latin,cyrillic,cyrillic-ext">
	<link href='http://fonts.googleapis.com/css?family=Marmelad&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" type="text/css" href="../jqueryIntroLoader/dist/css/introLoader.min.css">
</head>
<body>
<?php include 'includes/loading_animation.php' ?>
	<?php include "includes/sidebar.php"; ?>

	<div class="main-container">
	 	<main>
		  	<?php include 'includes/nav.php' ?>
		 
			<div class="container">
			<?php 
			

					if(isset($_GET['profile_id'])){
							
							include 'includes/profile.php';
						}
			    	if(isset($_GET['notifications'])){
							$notification_counter = 0;
							include 'notifications.php';
					} 	 	
			    	

		 	

		 	?>
		 	
			</div>
		

<!-- Modal -->


	  	</main>
	</div>
	

<div class="modal fade" id="followers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Последавтели</h4>
      </div>
      <div class="modal-body">
      <?php 
      	$stm = $DB_con->prepare("SELECT follower FROM follow WHERE followe=:userid");
					$stm->execute(array(":userid"=>$user_id));
					while($followers = $stm->fetch(PDO::FETCH_ASSOC)){
						$id = $followers['follower'];
						$st = $DB_con->prepare("SELECT * FROM users WHERE user_id=:userid");
						$st->execute(array(":userid"=>$id));
						while($users = $st->fetch(PDO::FETCH_ASSOC)){
							$userid = $users['user_id'];
							$fname = $users['fname'];
							$lname = $users['lname'];
							$user_name = $users['user_name'];
							$image = $users['avatar'];
							echo "<section class='modal-users'>";
							$st = $DB_con->prepare("SELECT id FROM follow WHERE followe=:userid AND follower=:user_id");
						$st->execute(array(":userid"=>$userid,":user_id"=>$user_id));
						$rows = $st->fetchAll();
						$num_rows = count($rows);
						if($userid != $user_id){
						if($num_rows == 1){
							echo "<a href='follow.php?follow=false&user_id=$userid' class='followship unfollow'>Unfollow</a>";
						}else{
							echo "<a href='follow.php?follow=true&user_id=$userid' class='followship follow'>Follow</a>";
						}
					}
							echo "<img src='../images/$image'>";
							echo "<p>$fname $lname</p>";
							echo "<p>@$user_name</p>";
							echo "</section>";
						}
		}
					

      ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="following" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Следвани</h4>
      </div>
      <div class="modal-body">
      <?php 
      	$stm = $DB_con->prepare("SELECT followe FROM follow WHERE follower=:userid");
					$stm->execute(array(":userid"=>$user_id));
					while($following = $stm->fetch(PDO::FETCH_ASSOC)){
						$id = $following['followe'];
						$st = $DB_con->prepare("SELECT * FROM users WHERE user_id=:userid");
						$st->execute(array(":userid"=>$id));
						while($users = $st->fetch(PDO::FETCH_ASSOC)){
							$userid = $users['user_id'];
							$fname = $users['fname'];
							$lname = $users['lname'];
							$user_name = $users['user_name'];
							$image = $users['avatar'];
							echo "<section class='modal-users'>";
							$st = $DB_con->prepare("SELECT id FROM follow WHERE followe=:userid AND follower=:user_id");
						$st->execute(array(":userid"=>$userid,":user_id"=>$user_id));
						$rows = $st->fetchAll();
						$num_rows = count($rows);
						if($userid != $user_id){
						if($num_rows == 1){
							echo "<a href='follow.php?follow=false&user_id=$userid' class='followship unfollow'>Unfollow</a>";
						}else{
							echo "<a href='follow.php?follow=true&user_id=$userid' class='followship follow'>Follow</a>";
						}
					}
							echo "<img src='../images/$image'>";
							echo "<p>$fname $lname</p>";
							echo "<p>@$user_name</p>";
							echo "</section>";
						}
		}
					

      ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>

	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" src="js/loading.js"></script>

</body>
</html>
