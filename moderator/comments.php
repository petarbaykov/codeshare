<h2>Скрити коментари</h2>
<?php
	
	if(!$user->is_loggedin()){
		$user->redirect('index.php');
	}else{
		$relations=$DB_con->prepare("SELECT * from codes where user_id=:user_id");
		$relations->execute(array(":user_id"=>$user_id));
		$status = 'unapprove';
		while($relationsRow = $relations->fetch(PDO::FETCH_ASSOC)){
			
			$codes = $relationsRow['code_id'];
			 $comments = $DB_con->prepare("SELECT * from comments where code_id=:code_id and status=:status");
			 $comments->execute(array(":code_id"=>$codes,":status"=>$status));
			 while($commentsRow=$comments->fetch(PDO::FETCH_ASSOC)){
			 	$comment_id = $commentsRow['comment_id'];
			 	$comment_content = $commentsRow['comment_content'];
			 	$post_date = $commentsRow['post_date'];
			 	$user = $commentsRow['user_id'];
			 	$users = $DB_con->prepare("SELECT * from users where user_id=:user");
			 	$users->execute(array(":user"=>$user));
			 	while($userRow=$users->fetch(PDO::FETCH_ASSOC)){
			 		$first_name = $userRow['fname'];
			 		$last_name = $userRow['lname'];
			 		$user_name = $userRow['user_name'];
			 		$image = $userRow['avatar'];
			 		?>
			 		
			 		<div class="single-comment">
								<img src="images/<?php echo  $image ?>">
								<div class="user-details">

								<?php
									echo "<p>". $post_date . ""."
									<a href='includes/comment.php?comment_id=$comment_id&action=show&code_id=$codes' title='Покажи'>
									<i class='fa fa-plus'></i></a></p>";
								 echo "<p>".$first_name . " " . $last_name. "</p>";
									echo "<p>" .  "@".$user_name. "</p>";
									
									echo "<p>". $comment_content . "</p>";
								?>
									
								</div>
					</div>
			 		<?php
			 	}
			 }

			
			

		}

	}
	
 ?>