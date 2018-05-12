<?php

include 'includes/dbconfig.php';
  	$action=$_POST['action'];
	$message_to_id = $_POST['user'];
 	$message_from_id = $_SESSION['user_session'];
 	$message = $_POST['message'];
 	$me = $DB_con->prepare("SELECT * from users where user_id=:user_from_id");
 	$me->execute(array(":user_from_id"=>$message_from_id));
 	while($me_row = $me->fetch(PDO::FETCH_ASSOC)){
 		$me_img = $me_row['avatar'];
 		$me_fname = $me_row['fname'];
 		$me_lname = $me_row['lname'];

 	}
 	
 	$person = $DB_con->prepare("SELECT * from users where user_id=:user_to_id");
 	$person->execute(array(":user_to_id"=>$message_to_id));
 	while($me_row = $person->fetch(PDO::FETCH_ASSOC)){
 		$img = $me_row['avatar'];
 		$fname = $me_row['fname'];
 		$lname = $me_row['lname'];
 		
 	}
 	
  	if($action=="showcomment"){
    $mymsg = $DB_con->prepare("SELECT *  from messages where message_from_id=:message_from_id and message_to_id=:message_to_id or message_from_id=:message_to_id and message_to_id=:message_from_id order by message_id ASC");
		$mymsg->execute(array(":message_from_id"=>$message_from_id,":message_to_id"=>$message_to_id));
		while($my_msg_row = $mymsg->fetch(PDO::FETCH_ASSOC)){
			$msg = $my_msg_row['message_content'];
			$user = $my_msg_row['message_from_id'];
			if($user == $_SESSION['user_session']){
				echo "<section class='chat-box ' ><img src='images/$me_img' class='chat-img'><p class='my_message' class='chat_box'>" ."<a href=''>".$me_fname." ".$me_lname."</a><br/>". $msg . "</p></section>";
			}else{
				echo "<section class='chat-box ' ><img src='images/$img' class='chat-img'><p class='user_message' class='chat_box'>" . "<a href=''>".$fname." ". $lname. "</a><br/>". $msg . "</p></section>";
			}
			
		}
		

  }
  ?>