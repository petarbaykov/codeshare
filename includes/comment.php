<?php 
	include 'dbconfig.php';
	if(isset($_GET['comment_id']) || ($_GET['action']) || ($_GET['code_id'])){
		$comment_id = $_GET['comment_id'];
		$action = $_GET['action'];
		$code_id = $_GET['code_id'];
		$hide = 'unapprove';
		$show = 'approve';
		if($action == "delete"){
			$delete_comment = $DB_con->prepare("DELETE from comments where comment_id=:comment_id");
			$delete_comment->execute(array(":comment_id"=>$comment_id));
		}
		if($action == "hide"){
			$hide_comment = $DB_con->prepare("UPDATE comments set status=:hide where comment_id=:comment_id");
			$hide_comment->execute(array(":hide"=>$hide,":comment_id"=>$comment_id));
		}
		if($action == "show"){
			$show_comment = $DB_con->prepare("UPDATE comments set status=:show where comment_id=:comment_id");
			$show_comment->execute(array(":show"=>$show,":comment_id"=>$comment_id));
		}
		echo "<script>window.open('../code_details.php?code_id=$code_id','_self')</script>";
	}


?>