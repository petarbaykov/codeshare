<?php 
	include 'includes/dbconfig.php';
	include 'time_ago.php';
	
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans&subset=latin,cyrillic,cyrillic-ext">
	
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
	
	
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="jqueryIntroLoader/dist/css/introLoader.min.css">
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<style type="text/css">
		.main-container main{
			
			text-align: left;
  		}
	</style>
</head>
<body>
	<?php include 'includes/loading_animation.php'; ?>
	<?php include 'includes/sidebar.php';?>

	<div class="main-container">
	 	<main>
	 		<nav>
		  		<a href="index.php"><img src="images/logo2_03.png"></a>
		  		
		  		 
				 <ul class="left">
					   <li><button  class="run nav-buttons" ><i class="fa fa-play"></i>   Изпълни</button></li>  
					   <li><button  class="run nav-buttons settings" ><i class="fa fa-cog"></i>   Настройки</button></li>  
					   
				</ul>
		  	</nav>
			<?php 
				if(isset($_GET['code_id'])){
					
					$code_id = $_GET['code_id'];
					$code_details = $DB_con->prepare("SELECT * from codes where code_id=:code_id");
					$code_details->execute(array(":code_id"=>$code_id));
					$codeRow = $code_details->fetch(PDO::FETCH_ASSOC);
					$user = $codeRow['user_id'];
					$code_title = $codeRow['code_title'];
					$code_tags = $codeRow['tags'];
					$code_description = $codeRow['code_description'];
					$views_counter = $codeRow['views'];
					
					$user_details = $DB_con->prepare("SELECT * from users where user_id=:user");
					$user_details->execute(array(":user"=>$user));
					$userRow = $user_details->fetch(PDO::FETCH_ASSOC);
					$user_name = $userRow['user_name'];
					$user_email = $userRow['user_email'];
					$fname = $userRow['fname'];
					$lname = $userRow['lname'];
					$image = $userRow['avatar'];
					$tags = explode(',', $code_tags);
					$status = 'approve';
					$codes = $DB_con->prepare("SELECT code_id FROM comments WHERE code_id=:code_id and status=:approve");
				$codes->execute(array(":code_id"=>$code_id,":approve"=>$status));
				$codes->fetchAll();
				$code_counter = $codes->rowCount();
				$new_views = $views_counter + 1;
				$views = $DB_con->prepare("UPDATE codes set views=:views where code_id=:code_id");
				$views->execute(array(":views"=>$new_views ,":code_id"=>$code_id));
					
			?>
			
			<div class="code-review">
				<iframe src="code.php?code=<?php echo $code_id; ?>"></iframe>

				<div class="container">
					<section>
						<div class="code-stats">
							<p><span><?php echo $views_counter ?></span> Преглеждания</p>
							<p><span><?php echo $code_counter ?></span> Koментара</p>
							<p><span>0</span> Харесвания</p>
						</div>
						<img src="images/<?php echo $image ?>">
						<p><?php echo $code_title; ?></p>
						<?php  if($user == $user_id) { ?>
							<span><?php echo "От" . " " . "<a href='profile.php?profile_id=$user'>" . $user_name . "</a> " ?></span><br/>
						<?php } else{ ?>
							<span><?php echo "От" . " " . "<a href='user_profile.php?user_id=$user'>" . $user_name . "</a> " ?></span><br/>
						<?php } ?>
						<h2>Описание</h2>
						<span><?php echo $code_description ?></span>
						<h2>Тагове</h2>

						
							<?php 
								foreach( $tags as $tag ) {
                    				echo "<a href=''><span class='tags'>". "<span class='glyphicon glyphicon-tag' aria-hidden='true'></span>" . $tag . "<span class='dot'>" ."</span>"."</span></a>";
                				}
								
							?>
						<h2>Коментари <?php echo "(" . $code_counter . ")"?></h2>

						<div class="comments">
							<?php 
								if($code_counter == 0){
											echo "Все още няма коментари";
										}
								$comments = $DB_con->prepare("SELECT * from comments where code_id=:code_id and status='approve'");
								$comments->execute(array(":code_id"=>$code_id));
								while($commentRow = $comments->fetch(PDO::FETCH_ASSOC)){
									$comment_id = $commentRow['comment_id'];
									$user_comment_id = $commentRow['user_id'];
									$comment_content = $commentRow['comment_content'];
									$post_date = $commentRow['post_date'];
									
									
									$times = strtotime($post_date);
									$t = ago($times);
									$users = $DB_con->prepare("SELECT * from users where user_id=:user_comment_id");
									$users->execute(array(":user_comment_id"=>$user_comment_id));
									while($Users = $users->fetch(PDO::FETCH_ASSOC)){
										$image = $Users['avatar'];
										$name = $Users['user_name'];
										$first_name = $Users['fname'];
										$last_name = $Users['lname'];

							?>
							<div class="single-comment">
								<img src="images/<?php echo  $image ?>">
								<div class="user-details">

								<?php
									echo "<p>". $t . ""."<a href='includes/comment.php?comment_id=$comment_id&action=delete&code_id=$code_id' title='Изтрий'>
									<i class='fa fa-trash-o'></i></a>
									<a href='includes/comment.php?comment_id=$comment_id&action=hide&code_id=$code_id' title='Скрий'>
									<i class='fa fa-ban'></i></a></p>";
								 echo "<p>".$first_name . " " . $last_name. "</p>";
									echo "<p>" .  "@".$name. "</p>";
									
									echo "<p>". $comment_content . "</p>";
								?>
									
								</div>
							</div>
							<?php			
									}
								}
							?>
							<h2>Добави коментар</h2>
							<form action="" method="post"> 
								<div class="input-group">
									<textarea class="form-control" name="comment"></textarea>
								</div><br/>
								<div class="input-group">
									<input type="submit" value="Коментирай" name="submit_comment" class="form-control comment" >
								</div>
								
							</form>
						</div>
					</section>
					
				</div>
			</div>
			
			<?php include 'includes/footer.php';?>
			<?php	}   ?>
			
		</main>
	</div>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" src="js/loading.js"></script>

</body>
</html>
<?php 
	if(isset($_POST['submit_comment'])){
		$comment = $_POST['comment'];
		$code_id = $code_id;
		$post_date = date("M d, Y  H:i");
		$status = "approve";
		$notification = "коментира вашия код";
		$about = 'comment';
		if($comment != ""){
		$comments = $DB_con->prepare("INSERT into comments (code_id, comment_content,post_date,status,user_id) values (:code_id,:comment_content, :post_date,:status,:user_id)");
		$comments->execute(array(":code_id"=>$code_id, ":comment_content"=>$comment, ":post_date"=>$post_date,":status"=>$status,":user_id"=>$user_id));
		}
		$notifications = $DB_con->prepare("INSERT into notifications (user_from_id,user_to_id,notification,time,about) values 
			(:user_id,:user,:notification, NOW(), :about)");
		$notifications->execute(array(":user_id"=>$user_id,":user"=>$user, ":notification"=>$notification, ":about"=>$about));
	}

?>