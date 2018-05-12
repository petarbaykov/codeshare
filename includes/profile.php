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
			    	

			    	echo "<section class='profile'>
						<a href='edit_profile.php?id=$user_id' class='tools'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Редактиране</a>
						<img src='images/$user_image' class='profile-img'>";
						echo "<p>$fname $lname </p><br/>";
						echo "<span>$user_email</span><br/>
			    	";
			    	
			    	echo "<a href='$github'><i class='fa fa-github'></i></a>";
			    	echo "<a href='$facebook'><i class='fa fa-facebook'></i></a>";
			    	echo "<a href='$twitter'><i class='fa fa-twitter'></i></a>";
			    	echo "<a href='$google_plus'><i class='fa fa-google-plus'></i></a>";
			    	echo "<a href='$linkedin'><i class='fa fa-linkedin'></i></a>";
			    	echo "<a href='$site'><img src='images/www.png' class='site'></a><br/>";
			    	$codes = $DB_con->prepare("SELECT user_id from codes where user_id=:user_id");
			    	$codes->execute(array(":user_id"=>$user_id));
			    	$codes->fetchAll();
			    	$total_codes = $codes->rowCount();
			    	echo "<a href='' class='stats'><span>$total_codes</span> Кода</a>";
			    	$stm = $DB_con->prepare("SELECT id FROM follow WHERE followe=:userid");
					$stm->execute(array(":userid"=>$user_id));
					$followers = $stm->fetchAll();
					$num_followers = count($followers);
					
			    	echo "<a href='' class='stats' data-toggle='modal' data-target='#followers'>  <span>$num_followers</span> Последователи</a>";
			    	$st = $DB_con->prepare("SELECT id FROM follow WHERE follower=:userid");
					$st->execute(array(":userid"=>$user_id));
					$following = $st->fetchAll();
					$num_following = count($following);
			    	
			    	echo "<a href='' class='stats' data-toggle='modal' data-target='#following'>  <span>$num_following</span> Следвани</a>";
			    	
					echo "</section>";
				}
					?>