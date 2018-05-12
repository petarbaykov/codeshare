<?php 
	include 'dbconfig.php';
	

		$html = $_POST['html'];
		$css = $_POST['css'];
		$js = $_POST['js'];
		$user_id = $_POST['user_id'];
		$post_date = date("M d, Y  H:i");
		$f = $DB_con->prepare("INSERT into codes (code_html,code_css,code_js,user_id,post_date) values (:code_html,:code_css,:code_js,:user_id,:post_date)");
		$f->execute(array(":code_html"=>$html,":code_css"=>$css,":code_js"=>$js,":user_id"=>$user_id,":post_date"=>$post_date));

	
?>