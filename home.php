<?php
include_once 'includes/dbconfig.php';
if(!$user->is_loggedin())
{
	$user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];

$STH = $DB_con->query('SELECT * from codes');
 
# setting the fetch mode
$STH->setFetchMode(PDO::FETCH_ASSOC);
 


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
	<style type="text/css">
		#country_list_id{
			display: none;
		}
	</style>
	<script type="text/javascript" src='js/autocomplete.js'></script>
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
	 		
	 			
		 		while($row = $STH->fetch()) {
			     $code_id = $row['code_id'];
			     $code_user_id=  $row['user_id'];
			     $views = $row['views'];
			    $stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
				$stmt->execute(array(":user_id"=>$code_user_id));
				$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
				$user_name = $userRow['user_name'];
				$user_image = $userRow['avatar'];
				$user_level = $userRow['user_level'];
				$codes = $DB_con->prepare("SELECT code_id FROM comments WHERE code_id=:code_id");
				$codes->execute(array(":code_id"=>$code_id));
				$codes->fetchAll();
				$code_counter = $codes->rowCount();
			     	  echo "
			     <div class='code-frame' style='position:relative;'>
				     <iframe src='code.php?code=$code_id' scrolling='no'  frameborder='0' data-src='code.php?code=$code_id'></iframe>";
				     if($code_user_id == $user_id){
				     	echo "<a href='profile.php?profile_id=$code_user_id'><img src='images/$user_image'>  $user_name</a>";
				     }else{
				    	echo " <a href='user_profile.php?user_id=$code_user_id'><img src='images/$user_image'>  $user_name</a>";
					 }
					 echo "<ul>";
					 echo "<li><a href='code_details.php?code_id=$code_id'>$code_counter  <span class='glyphicon glyphicon-comment' aria-hidden='true'></span></a></li>";
					  echo "<li><a href='code_details.php?code_id=$code_id'>0  <span class='glyphicon glyphicon-thumbs-up' aria-hidden='true'></span></a></li>";
					   echo "<li><a href='code_details.php?code_id=$code_id'>$views  <span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></li>";
					   echo "</ul>";
				    echo "<a href='view_code.php?code=$code_id' style='position:absolute; top:0; left:0; display:inline-block; z-index:5;'></a>
			     </div>";
			    	}
			   

		 	?>
	 		</div>
		 	

	  	</main>
	</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" src="js/loading.js"></script>
		<script type="text/javascript" src="js/autocomplete.js"></script>
	

</body>
</html>
