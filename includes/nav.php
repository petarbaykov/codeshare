<?php 
	include 'time_ago.php';
	$users = $DB_con->prepare("SELECT avatar from users where user_id=:user_id");
	$users->execute(array(":user_id"=>$user_id));
	$users = $users->fetch(PDO::FETCH_ASSOC);
	$avatar = $users['avatar'];
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
?>
<script type="text/javascript" src="js/autocomplete.js"></script>
<nav>
		  		<a href="index.php"><img src="images/logo2_03.png"></a>
		  		 <ul class="left">
				      <li>
						<a href="new_code.php"><i class="fa fa-plus"></i>  Нов код</a>
				      </li>
				   </ul>
				   <ul class="right-nav">
				   	<li>
				      	<form>
				      		<div class="input-group">
				      			<input type="text" class="form-control" id="country_id" onkeyup="autocomplet()" aria-describedby="basic-addon2" placeholder="Търси" autocomplete="off">
				      			<button type="submit" clas="input-group-addon" id="basic-addon2"><i class="fa fa-search"></i></button>
				      			
				      			<ul id="country_list_id">
				      				
				      			</ul>
				      		</div>
				      		
				      	</form>
				      </li>
				      <li class="profile-bar notification-bar" ><a href="#"><i class="fa fa-bell"></i><span class="counter-wrapper"><span class="counter" id="counter"><?php echo $notification_counter ?></span></span></a>
							
					
							<ul class="dropdown-notification">	
								<div class="arrow-up"></div>
								<h4>Известия</h4>
								<?php 
									$stmt = $DB_con->prepare("SELECT * from notifications where user_to_id=:user_id and user_from_id !=:user_id ORDER BY notification_id DESC LIMIT 5");
									$stmt->execute(array(":user_id"=>$user_id));
									while($notifications_row = $stmt->fetch(PDO::FETCH_ASSOC)){
										$user_from_id = $notifications_row['user_from_id'];
										$notification = $notifications_row['notification'];
										$time = $notifications_row['time'];
										$about = $notifications_row['about'];
										$stm = $DB_con->prepare("SELECT * from users where user_id=:user_from_id");
										$stm->execute(array(":user_from_id"=>$user_from_id));
										$userRow = $stm->fetch(PDO::FETCH_ASSOC);
										$fname = $userRow['fname'];
										$lname = $userRow['lname'];
										$user_name = $userRow['user_name'];
										$image = $userRow['avatar'];
										$time_ago = ago($time);
								?>
								<li>
									<a href="user_profile.php?user_id=<?php echo $user_from_id ?>">
										<img src="images/<?php echo $image ?>">
										<?php echo $fname . " " . $lname . ' (@' . $user_name . ')'?>
									</a>
									<?php echo $notification ?>
									<span><?php echo $time_ago ?></span>
								</li>
								<?php
									}

								?>

								<li><a href="profile.php?notifications">Преглед на всички</a><a href="#">Настройки</a></li>
							</ul>

				      </li>
				       <li class="profile-bar " >
				       		<a href="#">
				       			<span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
				       			<span class="counter-wrapper">
				       				<span class="counter" id="counter">
				       					1
				       				</span>
				       			</span>
				       		</a>
				       </li>
				      <li class="profile-bar"><a href="profile.php?profile_id=<?php echo  $user_id?>"><img src="images/<?php echo $avatar?>"></a></li>
				   </ul>
				      
				
				 
</nav>
