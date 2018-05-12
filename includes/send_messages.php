<?php
if(isset($_POST['submit']))
{
	$message = $_POST['text'];
	$message_from_id = $_SESSION['user_session'];
	$message_to_id =  $_GET['user'];
	$time_send = date("M d, Y  H:i");
	if($message != ""){
		$msg = $DB_con->prepare("INSERT INTO messages (message_from_id,message_to_id,message_content,time_send)
			values (:message_fron_id,:message_to_id,:message,:time_send)");
		$msg->execute(array(":message_from_id"=>$message_from_id,":message_to_id"=>$message_to_id,":message"=>$message,":time_send"=>$time_send));
	}

}

?>