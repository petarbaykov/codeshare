<?php
include_once 'includes/dbconfig.php';
if(!$user->is_loggedin())
{
	$user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
$count_query = $DB_con->prepare("SELECT NULL from users");
$count_query->execute();
$count_query->fetchAll();
$count = $count_query->rowCount();

if(isset($_GET['page'])){
	$page = preg_replace('#[^0-9]#','', $_GET['page']);

}else{
	$page = 1;
}
$per_page = 7;
$last_page = ceil($count/$per_page);

if($page < 1){
	$page = 1;
}else if($page > $last_page){
	$page = $last_page;
}

$limit =  ($page-1) * $per_page.','.$per_page;
$pagination = "";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans&subset=latin,cyrillic,cyrillic-ext">
	<link href='http://fonts.googleapis.com/css?family=Marmelad&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" type="text/css" href="../jqueryIntroLoader/dist/css/introLoader.min.css">
</head>
<body>
<?php include 'includes/loading_animation.php' ?>
	<?php include "includes/sidebar.php"; ?>

	<div class="main-container">
	 	<main>
		  	<?php include 'includes/nav.php' ?>
		 
			<div class="container">
				<h2 id="heading">Управление на потребителите</h2>
				<table class="table table-hover table-bordered">
					<thead>
						<td>Потребители/Информация</td>
						<td>Регистриран</td>
						<td>Последен вход</td>
						<td>Статус/Действия</td>
						
					</thead>
					<tr>
						<?php 
							$STH = $DB_con->query("SELECT * from users where user_level !=1 order by user_id DESC LIMIT $limit");
							$STH->setFetchMode(PDO::FETCH_ASSOC);

							if($last_page !=1){
								if($page != $last_page){
									$next = $page + 1;
									$pagination .= "<a class='pagination' href='manage_users.php?page=". $next . "'" . "><i class='fa fa-angle-right'></i></a>";
									
								}
								
								if($page != 1){
									$prev = $page - 1;
									$pagination .= "<a class='pagination' href='manage_users.php?page=". $prev . "'" . "><i class='fa fa-angle-left'></i></a>";
									
								}
								
							}
					 		while($row = $STH->fetch()) {
					 			$userid = $row['user_id'];
					 			$fname = $row['fname'];
					 			$lname = $row['lname'];
					 			$user_name = $row['user_name'];
					 			$email = $row['user_email'];
					 			$date_reg = $row['reg_date'];
					 			$last_logged_in = $row['last_logged_in'];
					 			$user_level = $row['user_level'];
					 			$confirm = $row['confirm'];
					 			$active = $row['active'];

						?>
						<td>
							<?php 
								if($user_level == 3){
									echo "<span class='manage-users'>" . $fname . " " . $lname .  " " . "(" . ($user_name) . ")" . '</span>' . " " . "<span class='label label-warning'>Потребител</span>" . "<br/>";
								}else if($user_level == 4){
									echo "<span class='manage-users'>" . $fname . " " . $lname .  " " . "(" . ($user_name) . ")" . '</span>' . " " . "<span class='label label-info'>Админ</span>" . "<br/>";
								}else{
									echo "<span class='manage-users'>". $fname . " ". $lname .  " " .  "(" . $user_name . ")" . '</span>'. " " . "<span class='label label-success'>Модератор</span>" . "<br/>";
								}
								
							?>
							<?php echo $email?>
						</td>
						<td><?php echo $date_reg ?></td>
						<td><?php echo $last_logged_in ?></td>
						<td>
							<?php 
								if($confirm  == "confirmed"){
							?>
							<div class="btn-group">
							  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Активиран <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    <li><a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>  Редактиране на потребител</a></li>
							    <li><a href="#"><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>  Блокирай потребител</a></li>
							     						 
							    <li><a href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>  Изтриване на потребител</a></li>
							    <li role="separator" class="divider"></li>	
							    <?php 
							    	if($user_level == 3){
							    		echo " <li><a href='includes/change_user_level.php?user_id=$userid&action=addmoderator'>  Направи модератор</a></li>";
							    	}else if($user_level == 2){
							    		echo " <li><a href='includes/change_user_level.php?user_id=$userid&action=delmoderator'>  Премахни модератор</a></li>";
							    	}
							    	if($user_level == 3){
							    		echo " <li><a href='includes/change_user_level.php?user_id=$userid&action=addadmin'>  Направи админ</a></li>";
							    	}else if($user_level == 4){
							    		echo " <li><a href='includes/change_user_level.php?user_id=$userid&action=deladmin'>  Премахни админ</a></li>";
							    	}
							    ?>
							  </ul>
							</div>
							<?php }else if($confirm == "unconfirmed"){ ?>
							<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Не активиран <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    <li><a href="#"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>  Редактиране на потребител</a></li>
							   <li><a href="#"><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>  Блокирай потребител</a></li>							 
							    <li><a href="#"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>  Изтриване на потребител</a></li>
							    <li role="separator" class="divider"></li>
							     <?php 
							    	if($user_level == 3){
							    		echo " <li><a href='includes/change_user_level.php?user_id=$userid&action=addmoderator'>  Направи модератор</a></li>";
							    	}else if($user_level == 2){
							    		echo " <li><a href='includes/change_user_level.php?user_id=$userid&action=delmoderator'>  Премахни модератор</a></li>";
							    	}
							    	if($user_level == 3){
							    		echo " <li><a href='includes/change_user_level.php?user_id=$userid&action=addadmin'>  Направи админ</a></li>";
							    	}else if($user_level == 4){
							    		echo " <li><a href='includes/change_user_level.php?user_id=$userid&action=deladmin'>  Премахни админ</a></li>";
							    	}
							    ?>
							  </ul>
							</div>
							<?php }?>
							
						</td>
						
					</tr>
				
					
				<?php }?>
					<?php echo $pagination ?>
				</table>
					
			</div>
			<?php include 'includes/footer.php';?>
		</main>
	</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" src="js/loading.js"></script>
</body>
</html>