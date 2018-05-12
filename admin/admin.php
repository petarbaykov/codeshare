<?php
include_once 'includes/dbconfig.php';
if(!$user->is_loggedin())
{
	$user->redirect('../index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
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
	<link rel="stylesheet" type="text/css" href="../jqueryIntroLoader/dist/css/introLoader.min.css">
</head>
<body>
<?php include 'includes/loading_animation.php' ?>
<?php include "includes/sidebar.php"; ?>

	<div class="main-container">
	 	<main>
		  		<?php include 'includes/nav.php' ?>
		 	<?php 
		 		while($row = $STH->fetch()) {
			     $code_id = $row['code_id'];
			     $html = $row['code_html'];
			     $css = $row['code_css'];
			     $js = $row['code_js'];
			     $user_id = $row['user_id'];
			     $date = $row['post_date'];
			     $url = $row['code_name'];
			     echo "
			     ";
			     }

		 	?>

	  	</main>
	</div>
	


	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="../jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" src="js/loading.js"></script>
</body>
</html>
