<?php	
include_once 'includes/dbconfig.php';
$id = $_SESSION['user_session'];
$follow = $_GET['follow'];
$user_id = $_GET['user_id'];
$notification = "те последва";
$time = date("M d, Y  H:i");
$about = 'following';
if($follow == "true"){
	 $stmt = $DB_con->prepare("INSERT INTO follow (followe,follower)  VALUES(:followe,:follower)");
													  
				$stmt->bindparam(":followe", $user_id);
				$stmt->bindparam(":follower", $id);
				$stmt->execute();	
	 $stmt = $DB_con->prepare("INSERT INTO notifications (user_from_id,user_to_id,notification,time,about)  VALUES(:user_from,:user_to,:notification,:time,:following)");
													  
				$stmt->bindparam(":user_from", $id);
				$stmt->bindparam(":user_to", $user_id);
				$stmt->bindparam(":notification", $notification);
				$stmt->bindparam(":time", $time);
				$stmt->bindparam(":following", $about);
				$stmt->execute();	

}else if($follow == "false"){
	$stmt = $DB_con->prepare("DELETE FROM follow WHERE followe=:user_id AND follower=:id");
													  
				$stmt->bindparam(":user_id", $user_id);
				$stmt->bindparam(":id", $id);
				$stmt->execute();
}
	echo "<script>window.open('user_profile.php?user_id=$user_id','_self')</script>";

?>