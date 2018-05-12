<?php
include_once 'includes/dbconfig.php';
if(!$user->is_loggedin())
{
	$user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC)



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
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<script type="text/javascript" src="js/global.js"></script>

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
		 		
		 	
			
		 	<div class="tab-panels">
		 		<ul class="tabs">
		 			<li rel="edit-profile" class="active-tab"><a >Редактирай профила <i class="fa fa-angle-right"></i></i></a></li>
		 			<li rel="change-password"  ><a >Промени паролата <i class="fa fa-angle-right"></i></a></li>
		 			<li rel="socials"><a >Социални данни <i class="fa fa-angle-right"></i></a></li>
		 			<li rel="notifications_settings"><a >Известия <i class="fa fa-angle-right"></i></a></li>
		 			<li ><a href="logout.php?logout=true">Изход <i class="fa fa-angle-right"></i></a></li>
		 		</ul>
		 		
		 		 <div id="edit-profile" class="panel active-panel">
			     	<?php 
			     		
			     			include 'includes/change_profile.php'; 
			     		
			     	?>
				 </div>
				  <div id="change-password" class="panel">
				  <?php
			     	
			     		include 'includes/change_password.php'; 
			     		?>
				 </div>
				  <div id="socials" class="panel ">
			     	<?php 

			     		include 'includes/change_socials.php'; 
			     	?>
				 </div>
				 <div id="notifications_settings" class="panel ">
			     	<?php 

			     		include 'includes/notifications_settings.php'; 
			     	?>
				 </div>
				 
		 	</div>
		 		<?php  
		 			if(isset($_POST['submit'])){
		 				$fname = $_POST['fname'];
		 				$lname = $_POST['lname'];
		 				$email = $_POST['email'];
		 				$bio = $_POST['bio'];
		 				
		 				$github = $_POST['github'];
		 				$facebook = $_POST['facebook'];
		 				$twitter = $_POST['twitter'];
		 				$google_plus = $_POST['google_plus'];
		 				$linkedin = $_POST['linkedin'];
		 				$site = $_POST['site'];
		 				
		 				$image = $_FILES['user_image']['name'];
		 				$image_tmp  = $_FILES['user_image']['tmp_name'];
		 				if($image == ""){
		 					$stmt = $DB_con->prepare("UPDATE users set avatar=:image,fname=:fname,lname=:lname, user_email=:email,bio=:bio,github=:github,facebook=:facebook,twitter=:twitter,google_plus=:google_plus,linkedin=:linkedin,site=:site where user_id='$user_id'");
		 				$stmt->execute(array(":image"=>$user_image,":fname"=>$fname,":lname"=>$lname,
		 					":email"=>$email,":bio"=>$bio,":github"=>$github,":facebook"=>$facebook,":twitter"=>$twitter,":google_plus"=>$google_plus,":linkedin"=>$linkedin,":site"=>$site));
		 				}else{

		 				move_uploaded_file($image_tmp, "images/$image");
		 				$stmt = $DB_con->prepare("UPDATE users set avatar=:image,fname=:fname,lname=:lname, user_email=:email,bio=:bio,github=:github,facebook=:facebook,twitter=:twitter,google_plus=:google_plus,linkedin=:linkedin,site=:site where user_id='$user_id'");
		 				$stmt->execute(array(":image"=>$image,":fname"=>$fname,":lname"=>$lname,
		 					":email"=>$email,":bio"=>$bio,":github"=>$github,":facebook"=>$facebook,":twitter"=>$twitter,":google_plus"=>$google_plus,":linkedin"=>$linkedin,":site"=>$site));
		 				
		 			}
		 			}
	 			?>
	 		</div>
	 		<?php include 'includes/footer.php' ?>
	  	</main>

	</div>
	


	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" >
	$(document).ready(function(){
			 $('#element').introLoader({
                 animation: {
                name: 'gifLoader',
                options: {
                ease: "easeInOutCirc",
                style: 'light bubble',
                delayBefore: 700,
                delayAfter: 0,
                exitTime: 300
            }
        }
            });
	});
	
</script>
	<script type="text/javascript">
		 $('.tab-panels .tabs li').on('click', function(){
        var $panel = $(this).closest('.tab-panels');
        $panel.find('.tabs li.active-tab').removeClass('active-tab');
        $(this).addClass('active-tab');
         var panelToShow = $(this).attr('rel');
         $panel.find('.panel.active-panel').show(300, showNextPanel);
         function showNextPanel(){
          $(this).removeClass('active-panel');
          $('#' + panelToShow).hide(300, function(){
              $(this).addClass('active-panel');
          });
         }
       });

	</script>
</body>
</html>
