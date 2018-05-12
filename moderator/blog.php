<?php
include_once 'includes/dbconfig.php';
if(!$user->is_loggedin())
{
	$user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];

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
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="jqueryIntroLoader/dist/css/introLoader.min.css">
	
	
</head>
<body>
	<?php include 'includes/loading_animation.php' ?>
	<?php
		include 'includes/sidebar.php';
 	?>

	<div class="main-container">
	 	<main>
	 		<?php include 'includes/nav.php' ?>
	 		<div class="container">
	 			<?php
	 				$posts = $DB_con->prepare("SELECT * from blog_posts");
	 				$posts->execute();
	 				

	 				while($post_row = $posts->fetch(PDO::FETCH_ASSOC)){
	 					$post_id = $post_row['post_id'];
	 					$post_title = $post_row['post_title'];
	 					$post_date =  $post_row['post_date'];
	 					$post_tags = $post_row['post_tags'];
	 					$post_content = $post_row['post_content'];
	 					$post_user = $post_row['user_id'];
	 					$post_image = $post_row['post_image'];
	 					$tags = explode(',',$post_tags);
	 					$user = $DB_con->prepare("SELECT * from users where user_id=:user_id");
	 					$user->execute(array(":user_id"=>$post_user));
	 					$user_row = $user->fetch(PDO::FETCH_ASSOC);
	 					$user_image = $user_row['avatar'];
	 					$fname = $user_row['fname'];
	 					$lname = $user_row['lname'];
	 					$name = $fname . " " . $lname;
	 			?>
	 			<article>
	 				<div class="row blog-posts">
	 						<h2 class="col-md-8 col-sm-7 col-xs-12">
								<a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?>
								</a>
							</h2>
	 						<div class="article-image col-md-4 col-sm-5 col-xs-12">
	 							<a href="post.php?post_id=<?php echo $post_id ?>">
									<img src="../images/<?php echo $post_image?>">
	 							</a>
	 						</div>
							<span class="content"><?php echo substr($post_content,0,400);?></span> 
							<div class="post-date-row col-md-8 col-sm-7 col-xs-12">
				            <div class="user-date-wrap">
				                <span class="date-wrap table-holder">
				                    <span class="icon-holder cell">
				                        <i class="fa fa-calendar"></i>
				                    </span>
				                    <span class="post-date cell"><?php echo $post_date?></span>
				                </span>
				                <span class="user-wrap">
				                    <span class="user-avatar">
				                        <a href="">
				                            <img src="../images/<?php echo $user_image?>" alt="avatar">
				                        </a>
				                    </span>
				                    <span class="cell">
				                    	<?php if($user_id == $post_user){?>
				                        	<a class="user-name" href="profile.php?profile_id=<?php echo $post_user ?>"><?php echo $name; ?></a>
				                        <?php }else{?>
				                        	<a class="user-name" href="user_profile.php?user_id=<?php echo $post_user ?>"><?php echo $name; ?></a>
				                        <?php } ?>
				                    </span>
				                </span>
				            </div>

				            <a href="post.php?post_id=<?php echo $post_id;?>" class="primary-btn primary-orange-btn read-more">Прочети още        <i class="fa fa-caret-right"></i></a>

				                <div class="row">
				                    <div class="col-md-8 col-sm-12 col-xs-12 tags-wrapper">
				                        <h3 class="sidebar-title">Тагове</h3>
				                        <ul class="list-tags">
				                            <?php foreach ($tags as $tag ) {
				                            	?>
				                            	<li><a href=""><span class='tags'><span class='glyphicon glyphicon-tag' aria-hidden='true'></span><?php echo $tag?><span class='dot'></span></span></a></li>
				                            	
				                            	<?php
				                            } ?>
				   							
				                        </ul>
				                    </div>
				                </div>
				        </div>
	 				</div>
	 			</article>
	 					
	 			<?php
	 				}

	 			 ?>

	 		</div>
		 	
		<?php include 'includes/footer.php';?>
	  	</main>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" src="js/loading.js"></script>

	

</body>
</html>