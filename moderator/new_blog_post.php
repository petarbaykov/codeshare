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
	<script src="ckeditor/ckeditor.js"></script>
	 <link href="ckeditor/plugins/codesnippet/lib/highlight/styles/default.css" rel="stylesheet">
	  <link href="ckeditor/plugins/codesnippet/lib/highlight/styles/default.css" rel="stylesheet">
    <script src="ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="includes/tags/tags.css">
    
	<script>
       CKEDITOR.replace( 'post_contents' );

     </script>
     
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
	 		<div class="row">
	 		
				<div class="col-md-12 col-sm-12 col-xs-12 new-post">
					<h2>Нова статия</h2>
	 				<form action="includes/insert_blog_post.php" method="post" enctype="multipart/form-data">
	 				<div class="input-group">
	 					<label for="title">Заглавие</label>
	 					<input type="text" class="form-control" name="title" >
	 				</div>
	 			
	 				<div class="input-group">
	 					<textarea class="form-control" id="post_contents" name="content"></textarea>
	 				</div>
	 				
	 					<div class="input-group">
	 					<label for="tags">Тагове</label>
	 					<p>Въведете избраният от вас таг и натиснете Enter</p>
	 					<input type="text" class="form-control" name="tags" id="tags" >
	 				</div>
	 				<div class="input-group">
	 					<label for="pic">Изображение</label>
	 					<input type="file" class="form-control" name="pic" >
	 				</div>
	 				<input type="submit" value="Публикувай" name="insert_post" class="btn btn-success">
	 				
	 				
	 				</form>
	 				
	 				
				</div>
				
				
				
				
				
					
				
			</div>
	
	 			
	 		</div>
		 	

	  	</main>
	</div>

	<script>
       CKEDITOR.replace( 'post_contents' );
     </script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <script type="text/javascript" src="includes/tags/tags.js"></script>
	<script type="text/javascript" src="jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" src="js/loading.js"></script>
	
	<script type="text/javascript">
     	$(function(){
     		$("#tags").tags({
     			
					maxTags: 10
     		});
     	});
     </script>

</body>
</html>