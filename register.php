<?php

require_once 'includes/dbconfig.php';

if($user->is_loggedin()!="")
{
	$user->redirect('home.php');
}

if(isset($_POST['register']))
{
	$lname = trim($_POST['lname']);
	$fname = trim($_POST['fname']);
	$uname = trim($_POST['username']);
	$umail = trim($_POST['user_email']);
	$upass = trim($_POST['user_pass']);	
	$confirm_pass = trim($_POST['confirm_pass']);
	$reg_date = date("M d, Y  H:i");
	$confirm = "unconfirmed";
	$active = "active";
	$avatar = "default-avatar.png";
	$user_level = 3;
	if($uname=="")	{
		$error[] = "Въведете потребителско име !";	
	}
	else if($umail=="")	{
		$error[] = "Въведете е-мейл !";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = ' Моля въведете валидна електронна поща !';
	}
	else if($upass=="")	{
		$error[] = "Въведете парола !";
	}
	else if(strlen($upass) < 6){
		$error[] = "Паролата трябва да е най-малко 6 символа";	
	}
	else if($lname == ""){
		$error[] = "Въведете фамилия";
	}
	else if($fname == ""){
		$error[] = "Въведете име";
	}
	else if($upass != $confirm_pass){
		$error[] = "Паролите не съвпадат";
	}
	else
	{
		try
		{
			$stmt = $DB_con->prepare("SELECT user_name,user_email FROM users WHERE user_name=:uname OR user_email=:umail");
			$stmt->execute(array(':uname'=>$uname, ':umail'=>$umail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
				
			if($row['user_name']==$uname) {
				$error[] = "Съжалявам това потребителско име е заето !";
			}
			else if($row['user_email']==$umail) {
				$error[] = "Съжалявам този и мейл адрес е зает !";
			}
			else
			{
				if($user->register($fname,$lname,$uname,$umail,$upass,$reg_date, $confirm, $active, $avatar,$user_level))	{
					
					$user->redirect('register.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
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
	<div class="main-container mcl">
	  <main>
	  	
		<div class="login main-wrapper">
			<img src="images/logo2_03.png">
			<form method="post" action="">
			   <?php
			if(isset($error))
			{
			 	foreach($error as $error)
			 	{
					 ?>
                     <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                     </div>
                     <?php
				}
			}
			if(isset($_GET['joined']))
			{
				 ?>
                 <div class="alert alert-info">
                      <i class="glyphicon glyphicon-log-in"></i> &nbsp; Успешна регистрация. <a href='login.php'>Влезте в профила си</a> 
                 </div>
                 <?php
			}
			?>
				
				<div class="input-group">
				
  					<input type="text" class="form-control" placeholder="Име" name="fname" aria-describedby="basic-addon1">
				</div>
				<div class="input-group">
					
  					<input type="text" class="form-control" placeholder="Фамилия" name="lname" aria-describedby="basic-addon1">
				</div>

				
				<div class="input-group">
					
  					<input type="text" class="form-control" placeholder="Потребителско име" name="username" aria-describedby="basic-addon1" value="<?php if(isset($error)){echo $uname;}?>">
				</div>
				<div class="input-group">
					
  					<input type="text" class="form-control" placeholder="Е-мейл" name="user_email" aria-describedby="basic-addon1" value="<?php if(isset($error)){echo $umail;}?>">
				</div>
				<div class="input-group">
					
  					<input type="password" class="form-control" placeholder="Парола" name="user_pass" aria-describedby="basic-addon1">
				</div>
				
				<div class="input-group">
					

  					<input type="password" class="form-control" placeholder="Повтори парола" name="confirm_pass" aria-describedby="basic-addon1">
				</div>
				
				<div class="input-group">
  					<input type="submit" name="register" class="form-control btn btn-danger" value="Регистрация" aria-describedby="basic-addon1">
				</div>
				<a href="login.php" class="butt">Вече имате акунт?</a>
			</form>
		</div>
	</main>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" src="js/loading.js"></script>
</body>
</html>