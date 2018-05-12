	<?php 
		
		
				$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
				$stmt->execute(array(":user_id"=>$user_id));
		 		while($userRow=$stmt->fetch(PDO::FETCH_ASSOC)) {
			    	 $fname = $userRow['fname'];
			    	$lname = $userRow['lname'];
			    	$user_name = $userRow['user_name'];
			    	$user_email = $userRow['user_email'];
			    	$user_image = $userRow['avatar'];
			    	$github = $userRow['github'];
			    	$facebook = $userRow['facebook'];
			    	$twitter = $userRow['twitter'];
			    	$google_plus = $userRow['google_plus'];
			    	$linkedin = $userRow['linkedin'];
			    	$site = $userRow['site'];
			    	$bio = $userRow['bio'];
			     }

?>
	<h2>Редактиране на профил</h2>
<form action="edit_profile.php?id=<?php echo $user_id ?>" method="post" enctype="multipart/form-data">
		 		<div class="input-group button-file">
		 			<div class="text-wrap">
		 				<div class="table-holder">
		 					<span class="upload-text">
		 						<i class="fa fa-pencil"></i>
		 						Качи снимка
		 					</span>
		 				</div>
		 			</div>
  					<input type="file" name="user_image" class="form-control" >
  					<img src="images/<?php echo $user_image?>">
				</div>
		 		<div class="input-group">
		 		<label for="fname">Име</label>
  					<input type="text" class="form-control" name="fname"  aria-describedby="basic-addon1" value="<?php echo $fname; ?>">
				</div>
				<div class="input-group">
				<label for="lname">Фамилия</label>
  					<input type="text" class="form-control" name="lname"  aria-describedby="basic-addon1" value="<?php echo $lname; ?>">
				</div>
				<div class="input-group">
				<label for="email">И-мейл</label>
  					<input type="email" class="form-control" name="email"  aria-describedby="basic-addon1" value="<?php echo $user_email; ?>">
				</div>
				<div class="input-group">
				<label for="bio">За мен</label>
  					<textarea class="form-control" name="bio" ><?php echo $bio; ?></textarea>
				</div>
				
				<div class="input-group">
				
  					<input type="submit" name="change_profile" class="btn btn-success" value="Запази промените" >
				</div>
				<?php  
					if(isset($_POST['change_profile'])){
						$fname = $_POST['fname'];
						$lname = $_POST['lname'];
						$mail = $_POST['email'];
						$bio = $_POST['bio'];

						$image = $_FILES['user_image']['name'];
						$image_tmp = $_FILES['user_image']['tmp_name'];
						if($image == ""){
		 					$stmt = $DB_con->prepare("UPDATE users set avatar=:image,fname=:fname,lname=:lname, user_email=:email,bio=:bio where user_id='$user_id'");
		 					$stmt->execute(array(":image"=>$user_image,":fname"=>$fname,":lname"=>$lname,
		 					":email"=>$mail,":bio"=>$bio));
		 				}
		 				else{

		 				move_uploaded_file($image_tmp, "images/$image");
		 				$stmt = $DB_con->prepare("UPDATE users set avatar=:image,fname=:fname,lname=:lname, user_email=:email,bio=:bio where user_id='$user_id'");
		 				$stmt->execute(array(":image"=>$image,":fname"=>$fname,":lname"=>$lname,
		 					":email"=>$mail,":bio"=>$bio));
		 				
		 			}
		 				echo "<script>window.open('edit_profile.php?id=$user_id', '_self')</script>";
					}
				?>
</form>