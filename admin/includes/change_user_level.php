<?php  
	include 'dbconfig.php';

	if(isset($_GET['user_id']) && $_GET['action']){
		$action = $_GET['action'];
		$user_id = $_GET['user_id'];
		if($action == "addmoderator"){
			 $stmt = $DB_con->prepare("UPDATE  users set user_level = 2 where user_id=:user_id");
														  
					$stmt->bindparam(":user_id", $user_id);
					$stmt->execute();
		}else if($action == "delmoderator"){
				 $stmt = $DB_con->prepare("UPDATE  users set user_level = 3 where user_id=:user_id");
														  
					$stmt->bindparam(":user_id", $user_id);
					$stmt->execute();
		}

		if($action == "addadmin"){
			 $stmt = $DB_con->prepare("UPDATE  users set user_level = 4 where user_id=:user_id");
														  
					$stmt->bindparam(":user_id", $user_id);
					$stmt->execute();
		}else if($action == "deladmin"){
				 $stmt = $DB_con->prepare("UPDATE  users set user_level = 3 where user_id=:user_id");
														  
					$stmt->bindparam(":user_id", $user_id);
					$stmt->execute();
		}

	}
	
	echo "<script>window.open('../manage_users.php', '_self')</script>";

?>