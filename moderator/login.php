<?php
require_once 'includes/dbconfig.php';

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['login']))
{
	$uname = $_POST['user_email'];
	$umail = $_POST['user_email'];
	$upass = $_POST['user_pass'];
	$active = 'active';
	$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_name=:uname OR user_email=:umail  LIMIT 1");
	$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	$user_level = $userRow['user_level'];
	
	if($user_level == 3){
		if($user->login($uname,$umail,$upass))
		{
			$user->redirect('home.php');
		}
		else
		{
			$error = "Wrong Details !";
		}	
	}else if($user_level == 1){
		if($user->login($uname,$umail,$upass))
		{
			$user->redirect('admin/admin.php');
		}
		else
		{
			$error = "Wrong Details !";
		}	
	}else if($user_level == 2){
		if($user->login($uname,$umail,$upass))
		{
			$user->redirect('moderator/moderator.php');
		}
		else
		{
			$error = "Wrong Details !";
		}
	}else if($user_level == 4){
		if($user->login($uname,$umail,$upass))
		{
			$user->redirect('admin/admin.php');
		}
		else
		{
			$error = "Wrong Details !";
		}	
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
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
	  
	  		<div class="login main-wrapper">
	  		
			
			<img src="images/logo2_03.png">
			<?php
			if(isset($error))
			{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                     </div>
                     <?php
			}
			?>
			<form method="post" action="">
				<div class="input-group">
  					<label for="user_email">Потребителско име или и-мейл</label>
  					<input type="text" class="form-control" name="user_email" placeholder="Потребителско име или емейл" aria-describedby="basic-addon1">
				</div>
				<div class="input-group">
  					<label for="user_email">Парола</label>
  					<input type="password" class="form-control" name="user_pass" placeholder="Парола" aria-describedby="basic-addon1">
				</div>
				<div class="input-group">
  					
  					<input type="submit" class="form-control btn btn-primary" name="login" value="Вход" aria-describedby="basic-addon1">
				</div>
				<a href="register.php" class="butt">Нямате регистрация? | </a>
				<a href="forget_password.php">Забравена парола?</a>
			</form>
		</div>
	  
	  </main>
	</div>
		
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" src="js/loading.js"></script>
</body>
</html>