<?php 
	include 'dbconfig.php';
	if(isset($_POST['insert_post'])){
		$post_title = $_POST['title'];
		$post_tags = $_POST['tags'];
		$content = $_POST['content'];
		$post_date = date("M d, Y  H:i");
		$user_id = $_SESSION['user_session'];
		$post_image = $_FILES['pic']['name'];
		$post_image_tmp = $_FILES['pic']['tmp_name'];
		if($post_title != '' and $post_tags != '' and $content != '' and $post_image != ''){
			move_uploaded_file($post_image_tmp, "../../images/$post_image");
			$stmt = $DB_con->prepare("INSERT into blog_posts (post_title,post_date, post_tags,post_content,user_id,post_image) VALUES (:post_title,:post_date,:post_tags,:content,:user_id,:post_image)");
			$stmt->execute(array(":post_title"=>$post_title,":post_date"=>$post_date,":post_tags"=>$post_tags,":content"=>$content,":user_id"=>$user_id,":post_image"=>$post_image));
			
		}
		echo "<script>window.open('../new_blog_post.php','_self')</script>";
	}


?>