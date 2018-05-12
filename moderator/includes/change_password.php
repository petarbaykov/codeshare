	<?php
	$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
				$stmt->execute(array(":user_id"=>$user_id));
		 		while($userRow=$stmt->fetch(PDO::FETCH_ASSOC)) {
			    	 $user_password = $userRow['user_pass'];
			    	  $user_password;
			     }
			     ?>
	<h2>Смяна на паролата</h2>
<form action="edit_profile.php?id=<?php echo $user_id ?>" method="post" enctype="multipart/form-data">
		 		<div class="input-group">
		 		<label for="fname">Стара парола</label>
  					<input type="password" class="form-control" name="old_pass"   >
				</div>
				<div class="input-group">
				<label for="lname">Нова парола</label>
  					<input type="password" class="form-control" name="new_pass"  >
				</div>
				<div class="input-group">
				<label for="email">Потвърди нова парола</label>
  					<input type="password" class="form-control" name="confirm_new_pass" >
				</div>
				<div class="input-group">
					<input type="submit" name="change_password" value="Смени парола" class="btn btn-success save-data">
				</div>
				<?php 
					if(isset($_POST['change_password'])){
						$old_pass = $_POST['old_pass'];
						$password = password_hash($old_pass, PASSWORD_DEFAULT);
						
						$new_pass = $_POST['new_pass'];
						$confirm_pass = $_POST['confirm_new_pass'];
						$pass = password_hash($new_pass, PASSWORD_DEFAULT);
						if($password == '' || $pass == '' || $confirm_pass == ''){
							echo "empty";
						}else{
							$match_old_pass = password_verify($old_pass,$user_password);
							$match_new_pass = password_verify($confirm_pass, $pass);
							if($match_old_pass || $match_new_pass){
								$update = $DB_con->prepare("UPDATE users set user_pass=:new_pass where user_id=:user_id");
								$update->execute(array(":new_pass"=>$pass, "user_id"=>$user_id));

							}
								
						}
					}
					

				?>
				
</form>