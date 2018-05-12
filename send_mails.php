<?php 
	$message = "The mail message was sent";
	$headers = "From:petbaik26gmail.com";
	mail("petbaik26@gmail.com","Test",$message, $headers);
	echo "Message is sent to petbaik26gmail.com";


?>