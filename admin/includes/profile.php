	<?php
	$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
				$stmt->execute(array(":user_id"=>$user_id));
		 		while($userRow=$stmt->fetch(PDO::FETCH_ASSOC)) {
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
						<a href='edit_profile.php?id=$user_id' class='tools'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Редактиране</a>
						<img src='images/$user_image' class='profile-img'>";
						if($user_level == 1){
							echo "<p>$fname $lname <span class='label label-warning'>Екип Code Share</span>   <span class='label label-info'>Администратор</span></p><br/>";
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
			    	echo "<a href='$site'><img src='images/www.png' class='site'></a><br/>";
			    	echo "<a href='' class='stats'><span>0</span> Codes</a>";
			    	$stm = $DB_con->prepare("SELECT id FROM follow WHERE followe=:userid");
					$stm->execute(array(":userid"=>$user_id));
					$followers = $stm->fetchAll();
					$num_followers = count($followers);
			    	echo "<a href='' class='stats' data-toggle='modal' data-target='#followers'>  <span>$num_followers</span> Followers</a>";
			    	$st = $DB_con->prepare("SELECT id FROM follow WHERE follower=:userid");
					$st->execute(array(":userid"=>$user_id));
					$following = $st->fetchAll();
					$num_following = count($following);
			    	
			    	echo "<a href='' class='stats' data-toggle='modal' data-target='#following'>  <span>$num_following</span> Following</a>";
			    	

			    	echo "</section>";
			    	
			     }
			     ?>