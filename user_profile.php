


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans&subset=latin,cyrillic,cyrillic-ext">
	
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src='js/bootstrap.min.js'></script>
	<script type="text/javascript" src="js/global.js"></script>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" type="text/css" href="jqueryIntroLoader/dist/css/introLoader.min.css">
</head>
<body>
<?php include 'includes/loading_animation.php' ?>

<?php
		include 'includes/sidebar.php';
 	?> 


 



		 	




	

	<div class="main-container">
	 	<main>
		  	<?php include 'includes/nav.php' ?>
		 
			<div class="container">
				<div class="users">
					<?php 
						if(isset($_GET['user_id'])){
							$userid = $_GET['user_id'];
							if(!$user->is_loggedin()){
								$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
							$stmt->execute(array(":user_id"=>$userid));
										while($userRow=$stmt->fetch(PDO::FETCH_ASSOC)){
								$fname = $userRow['fname'];
			    	$lname = $userRow['lname'];
			    	$user_name = $userRow['user_name'];
			    	$user_email = $userRow['user_email'];
			    	$user_image = $userRow['avatar'];
			    	$github = $userRow['github'];
			    	$facebook = $userRow['facebook'];
			    	$twitter = $userRow['twitter'];
			    	$google_plus = $userRow['google_plus'];
			    	$linkedin = $userRow['linkedin'];
			    	$site = $userRow['site'];
			    	$user_level = $userRow['user_level'];
			    	
			    	echo "<section class='profile'>
						<img src='images/$user_image' class='profile-img'>";
						if($user_level == 1){
							echo "<p>$fname $lname <span class='label label-warning'>Екип Code Share</span>   <span class='label label-info'>Администратор</span></p><br/>";
						}else if($user_level == 2){
							echo "<p>$fname $lname <span class='label label-warning'>Екип Code Share</span>   <span class='label label-success'>Модератор</span></p><br/>";
						}

						else{
							echo "<p>$fname $lname </p><br/>";
						}
						
						echo "<span>$user_email</span><br/>
			    	";
			    	echo "<a href='$github'><i class='fa fa-github'></i></a>";
			    	echo "<a href='$facebook'><i class='fa fa-facebook'></i></a>";
			    	echo "<a href='$twitter'><i class='fa fa-twitter'></i></a>";
			    	echo "<a href='$google_plus'><i class='fa fa-google-plus'></i></a>";
			    	echo "<a href='$linkedin'><i class='fa fa-linkedin'></i></a>";
			    	echo "<a href='$site'><i class='fa fa-github'></i></a><br/>";
			    	$stm = $DB_con->prepare("SELECT id FROM follow WHERE followe=:userid");
					$stm->execute(array(":userid"=>$userid));
					$followers = $stm->fetchAll();
					$num_followers = count($followers);
			    	echo "<a href=''>$num_followers Followers</a>";
			    	$st = $DB_con->prepare("SELECT id FROM follow WHERE follower=:userid");
					$st->execute(array(":userid"=>$user_id));
					$following = $st->fetchAll();
					$num_following = count($following);
			    	
			    	echo "<a href=''>$num_following Following</a><br/>";
			    
			    	echo "</section>";
							}
							}else{


							if($userid != $user_id){
							$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
							$stmt->execute(array(":user_id"=>$userid));
							while($userRow=$stmt->fetch(PDO::FETCH_ASSOC)){
								$fname = $userRow['fname'];
			    	$lname = $userRow['lname'];
			    	$user_name = $userRow['user_name'];
			    	$user_email = $userRow['user_email'];
			    	$user_image = $userRow['avatar'];
			    	$github = $userRow['github'];
			    	$facebook = $userRow['facebook'];
			    	$twitter = $userRow['twitter'];
			    	$google_plus = $userRow['google_plus'];
			    	$linkedin = $userRow['linkedin'];
			    	$site = $userRow['site'];
			    	$user_level = $userRow['user_level'];
			    	
			    	echo "<section class='profile'>
			    	<a href='send_message.php?user=$userid' class='btn btn-primary send-message'>Send Message</a>
						<img src='images/$user_image' class='profile-img'>";
						if($user_level == 1){
							echo "<p>$fname $lname <span class='label label-warning'>Екип Code Share</span>   <span class='label label-info'>Администратор</span></p><br/>";
						}
						else if($user_level == 2){
							echo "<p>$fname $lname <span class='label label-warning'>Екип Code Share</span>   <span class='label label-success'>Модератор</span></p><br/>";
						}else{
							echo "<p>$fname $lname </p><br/>";
						}
						
						echo "<span>$user_email</span><br/>
			    	";	
			    	
			    	echo "<a href='$github'><i class='fa fa-github'></i></a>";
			    	echo "<a href='$facebook'><i class='fa fa-facebook'></i></a>";
			    	echo "<a href='$twitter'><i class='fa fa-twitter'></i></a>";
			    	echo "<a href='$google_plus'><i class='fa fa-google-plus'></i></a>";
			    	echo "<a href='$linkedin'><i class='fa fa-linkedin'></i></a>";
			    	echo "<a href='$site'><i class='fa fa-github'></i></a><br/>";
			    	echo "<a href='' class='stats'><span>0</span> Codes</a>";
			    	$stm = $DB_con->prepare("SELECT id FROM follow WHERE followe=:userid");
					$stm->execute(array(":userid"=>$userid));
					$followers = $stm->fetchAll();
					$num_followers = count($followers);
					$follows = $DB_con->prepare("UPDATE users set followers=:followers where user_id='$userid'");
					$follows -> execute(array(":followers"=>$num_followers));
			    	echo "<a href='' class='stats' data-toggle='modal' data-target='#followers'>$num_followers Followers</a>";
			    	$st = $DB_con->prepare("SELECT id FROM follow WHERE follower=:userid");
					$st->execute(array(":userid"=>$userid));
					$following = $st->fetchAll();
					$num_following = count($following);

			    	$followings = $DB_con->prepare("UPDATE users set following=:following where user_id='$user_id'");
					$followings -> execute(array(":following"=>$num_following));

			    	echo "<a href='' class='stats' data-toggle='modal' data-target='#following'>$num_following Following</a>";

					$st = $DB_con->prepare("SELECT id FROM follow WHERE followe=:userid AND follower=:user_id");
					$st->execute(array(":userid"=>$userid,":user_id"=>$user_id));
					$rows = $st->fetchAll();
					$num_rows = count($rows);
					if($num_rows == 1){
						echo "<a href='follow.php?follow=false&user_id=$userid' class='unfollow'>Следван</a>";
					}else{
						echo "<a href='follow.php?follow=true&user_id=$userid' class='follow'>Последвай</a>";
					}
			    	echo "</section>";
							}
							}
						}
						}
					?>
				
				</div>
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
					$stm->execute(array(":userid"=>$userid));
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
							echo "<img src='images/$image'>";
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
      $userid = $_GET['user_id'];
      	$stm = $DB_con->prepare("SELECT followe FROM follow WHERE follower=:userid");
					$stm->execute(array(":userid"=>$userid));
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
							echo "<img src='images/$image'>";
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
	  	</main>
	</div>
	


	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
<script type="text/javascript" src="js/loading.js"></script>
</script>
</body>
</html>
