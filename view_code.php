
<?php include 'includes/dbconfig.php';
	if(isset($_GET['code'])){

	$code_id = $_GET['code'];
	$stmt = $DB_con->prepare("SELECT * FROM codes WHERE code_id=:code_id");
	$stmt->execute(array(":code_id"=>$code_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	$html = $userRow['code_html'];
	$css = $userRow['code_css'];
	$js = $userRow['code_js'];
	$id = $userRow['user_id'];
	
}
	
?>



<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans&subset=latin,cyrillic,cyrillic-ext">

	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/new_editor.css">
	
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css" />
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	
	<link rel="stylesheet" href="codemirror/lib/codemirror.css">
    <script src="codemirror/lib/codemirror.js"></script>
   
	<link rel="stylesheet" href="codemirror/theme/monokai.css">
	<script src="codemirror/lib/util/closetag.js"></script>
	<script src="codemirror/mode/javascript/javascript.js"></script>
	<script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>
	<script src="codemirror/mode/css/css.js"></script>
	<script src="codemirror/mode/xml/xml.js"></script>
	<script type="text/javascript" src="js/editor.js"></script>
	<link rel="stylesheet" type="text/css" href="jqueryIntroLoader/dist/css/introLoader.min.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.custom-scrollbar.css">
	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script type="text/javascript"></script>
</head>
<body>
	

	<div class="main-container">
	 	<main>
		  	<nav>
		  		<a href="index.php"><img src="images/logo2_03.png"></a>
		  		<?php 
		  			if(!$user->is_loggedin()){
		  		?>
		  		<div class="aside">
		  			<p>Влез или се регистрирай</p>
		  		</div>
		  		
		  		<?php
		  			}else{
		  		?>
		  		<div class="aside">
		  			<?php 
		  				$user_id = $_SESSION['user_session'];
		  				$user = $DB_con->prepare("SELECT * from users where user_id=:user_id");
		  				$user->execute(array(":user_id"=>$user_id));
		  				$user_row = $user->fetch(PDO::FETCH_ASSOC);
		  				$image = $user_row['avatar'];
		  				$user_name = $user_row['user_name']
		  			?>
		  			<p><button id='save_code' type="submit" class=""><i class="fa fa-cloud-upload"></i>  Запази</button></p>
		  			<input type="text" id="user_id" value="<?php echo $user_id?>" style="display:none">
		  			<p class="dropdown-parent"><img src="images/<?php echo $image ?>"><?php echo $user_name ?>
					<i class="fa fa-caret-down"></i>
		  			</p>
		  			<ul class="dropdown">
		  				<a href="profile.php?profile_id=<?php echo $user_id?>"><li><i class="fa fa-user"></i>Профил</li></a>
		  				<a href="edit_profile.php?id=<?php echo $user_id?>"><li><i class="fa fa-pencil-square-o"></i>Редактиране на профил</li></a>
		  				
		  				<a href=""><li><i class="fa fa-sign-out"></i>Изход</li></a>
		  			</ul>

		  		</div>
		  		<?php 
		  			}
		  		?>
		  		 
				
		  	</nav>
		  
		 	<div class="users">
				<div class="editor-area">
					<div class=" files" >
						<div class="heading">
							<h3 >Файлове</h3>
						</div>
						  <ul id="tabs">
						      	<a href="#html"><li>index.html</li></a>
						      	<a href="#css"><li>style.css</li></a>
						      	<a href="#js"><li>app.js</li></a>
					    	</ul>
					</div>
				
					<div class=" code">
						
					   <div id="html" class="panel active-panel">
					   		<div class="heading-editor">
							<h3>Редактор <span>- index.html</span></h3>
							<a href="" data-toggle="modal" data-target="#html-settings"><i class="fa fa-cog"></i></a>
						</div>
					     	<section  class="edit ">
				  <textarea class="editor html " name="html" id="code_html" ><?php echo $html?></textarea>
				     		 </section>
					    </div>
					    <div id="css" class="panel">
					    <div class="heading-editor">
							<h3>Редактор - <span>style.css</span></h3>
							<a href="" data-toggle="modal" data-target="#css-settings"><i class="fa fa-cog"></i></a>
						</div>
					      	<section  class="edit">
				      <textarea class="editor css " name="css" id="code_css"><?php echo $css?></textarea>
				     		</section>
					    </div>
					    <div id="js" class="panel ">
					    <div class="heading-editor">
							<h3>Редактор - <span>app.js</span></h3>
							<a href="" data-toggle="modal" data-target="#js-settings"><i class="fa fa-cog"></i></a>
						</div>
					       	<section  class="edit">
				    <textarea class="editor js"  name="js" id="code_js" ><?php echo $js?></textarea>
				  			</section>
					    </div>
					    
					 </div>
					<div class=" code-preview">
						<div class="heading-preview">
							<h3>Преглед</h3>
							<button class="run"><i class="fa fa-refresh"></i></button>
							<a href="" class="full-page"><i class="fa fa-desktop"></i></a>
						</div>
						  <iframe  src="code.php?code=<?php echo $code_id?>" id="preview">
					      <!DOCTYPE html>
					      <html>
					      <head>
					        <title></title>
					        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
					         
					      <body>
					      
					      </body>
					      </html>
					    </iframe>
					 
					</div>
					
				</div>
							
			</div>
				
	  	</main>

	</div>
			
	 
	 

	

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/editor.js"></script>
	<script type="text/javascript">
		
	</script>
	
</body>
</html>

