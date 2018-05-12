<script type="text/javascript" src="js/global.js"></script>
<?php
include_once 'includes/dbconfig.php';


if(!$user->is_loggedin()){

	echo "<nav id='menu'>

	  <a  class='menu-link'><i class='fa fa-bars fa-3x'></i></a>
	  <ul>
	  	<li><a href='login.php' id='login'>Вход</a></li>
	    <li><a href='index.php'>Начало</a></li>
	    <li><a href='contacts.php'>Контакти</a></li>
	    <li><a href='register.php'>Регистрация</a></li>
	     <li><a href='blog.php'>Блог</a></li>
	  </ul>
	</nav>	";
}
 else{
 	$user_id = $_SESSION['user_session'];
 	$stma = $DB_con->prepare("SELECT * FROM notifications  WHERE user_to_id=:userid and user_from_id!=:userid");
					$stma->execute(array(":userid"=>$user_id));
					
					$notification_counter = 0;
					$notification = $stma->rowCount();
					if($notification > 1){
						while($notification = $stma->fetch(PDO::FETCH_ASSOC)){
						$a = $notification['notification'];
						$notification_counter++;
							
						}

					}
	
	$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	# setting the fetch mode
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$userRow = $stmt->fetch();
	$image = $userRow['avatar'];
	$username = $userRow['user_name'];
	echo "
	<nav id='menu'>

		  <a  class='menu-link'><i class='fa fa-bars fa-3x'></i></a>
		  <ul>
		  	
		  	<li><a href='profile.php?notifications'><img src='images/$image'><span class='badge'>$notification_counter</span></a></li>
		  	<li><a href='profile.php?profile_id=$user_id'><i class='fa fa-user'></i>    Профил</a></li>
		  	 <li><a href='profile.php?notifications'><span class='glyphicon glyphicon-bell' aria-hidden='true'></span>    Известия  <span class='badge'>$notification_counter</span></a></li>
		    <li><a href='edit_profile.php?id=$user_id'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span>   Редактиране на профила</a></li>
		   <li><a href='profile.php?comments'><span class='glyphicon glyphicon-comment' aria-hidden='true'></span>    Коментари</a></li>
		   <li><a href='blog.php'>Блог</a></li>
		    <li><a href='logout.php?logout=true'><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span>   Изход</a></li>
		  </ul>
	</nav> ";
 } 
 ?>
