<?php 
	include_once 'includes/dbconfig.php';
	$user_id = $_SESSION['user_session'];
	$stma = $DB_con->prepare("SELECT * FROM notifications  WHERE user_to_id=:userid ");
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
?>
	<nav id="menu">

		  <a  class="menu-link"><i class="fa fa-bars fa-3x"></i></a>

		  <ul>

		  	<li><a href="profile.php?profile_id=<?php echo $user_id; ?>" id=""><img src="images/<?php echo $userRow['avatar']; ?>"><br/><?php echo $userRow['user_name']; ?></a></li>
		  	<li><a href="profile.php?notifications"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span>   Известия   <span class="badge"><?php echo $notification_counter ?></span></a></li>
		    <li><a href="edit_profile.php?id=<?php echo $user_id; ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>   Редактиране на профила</a></li>
		    <li><a href="manage_users.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>    Управление на потребителите</a></li>
		    <li><a href="/"> Управление на кодовете</a></li>
		     <li><a href="/"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>   Управление на коментарите</a></li>
		    <li><a href="logout.php?logout=true"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>   Изход</a></li>
		  </ul>
	</nav>