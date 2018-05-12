<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Известия</h1>
	<?php 
		if($user->is_loggedin()){
			$user_id = $_SESSION['user_session'];
			$stmt = $DB_con->prepare("SELECT * from notifications where user_to_id=:user_id");
			$stmt->execute(array(":user_id"=>$user_id));
			while($notifications_row = $stmt->fetch(PDO::FETCH_ASSOC)){
				$user_from_id = $notifications_row['user_from_id'];
				$notification = $notifications_row['notification'];
				$time = $notifications_row['time'];
				$about = $notifications_row['about'];
				$stm = $DB_con->prepare("SELECT user_name from users where user_id=:user_from_id");
				$stm->execute(array(":user_from_id"=>$user_from_id));
				$userRow = $stm->fetch(PDO::FETCH_ASSOC);
				$user_name = $userRow['user_name'];
				
				echo "<a href='user_profile.php?user_id=$user_from_id'>" . $user_name . "</a>" . " " . $notification . " " . $time . "<br/>";
			}
		}
		
	?>
</body>
</html>