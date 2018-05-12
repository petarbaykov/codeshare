
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans&subset=latin,cyrillic,cyrillic-ext">
	
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
				$STH = $DB_con->query('SELECT * from users');
			 
				# setting the fetch mode
				$STH->setFetchMode(PDO::FETCH_ASSOC);
		 		while($row = $STH->fetch()) {
		 			$userid = $row['user_id'];
		 			if(!$user->is_loggedin()){
		 				 $fname = $row['fname'];
			      $lname = $row['lname'];
			      $username = $row['user_name'];
			      $image = $row['avatar'];
			      echo "<a href='user_profile.php?user_id=$userid'><img src='images/$image'></a>$fname $lname <br/>@$username<br/>";
		 			}else{
		 				if($userid != $user_id){
			      $fname = $row['fname'];
			      $lname = $row['lname'];
			      $username = $row['user_name'];
			      $image = $row['avatar'];
			      echo "
			      <section class='profile-box'><a href='user_profile.php?user_id=$userid'><img src='images/$image'></a><p>$fname $lname @$username</p>";
			      
			      $st = $DB_con->prepare("SELECT id FROM follow WHERE followe=:userid AND follower=:user_id");
					$st->execute(array(":userid"=>$userid,":user_id"=>$user_id));
					$rows = $st->fetchAll();
					$num_rows = count($rows);
					if($num_rows == 1){
						echo "<a href='follow.php?follow=false&user_id=$userid' class='unfollow'>Unfollow</a>";
						
					}else{
						echo "<a href='follow.php?follow=true&user_id=$userid' class='follow'>Follow</a>";
					
					}
					echo "</section>";
				}
		 			}
		 			
			     }
					?>
				</div>
			</div>
	  	</main>
	</div>
	


	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" src="js/loading.js"></script>
</body>
</html>
