<?php 
	include 'dbconfig.php';
	$user_id = $_SESSION['user_session'];
	$mymsg = $DB_con->prepare("SELECT *  from messages where message_from_id=:message_from_id");
	$mymsg->execute(array(":message_from_id"=>$user_id));
	while($msg_row = $mymsg->fetch(PDO::FETCH_ASSOC)){
		$msg = $msg_row['message_content'];
		echo "<p id='msg'>" . $msg . "</p>";
	}
?>