<?php	
include_once 'includes/dbconfig.php';

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
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans&subset=latin,cyrillic,cyrillic-ext">
	<link href='http://fonts.googleapis.com/css?family=Marmelad&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	
	
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link rel="stylesheet" href="codemirror/lib/codemirror.css">
    <script src="codemirror/lib/codemirror.js"></script>
   
	<link rel="stylesheet" href="codemirror/theme/monokai.css">
	<script src="codemirror/lib/util/closetag.js"></script>
	<script src="codemirror/mode/javascript/javascript.js"></script>
	<script src="codemirror/mode/htmlmixed/htmlmixed.js"></script>
	<script src="codemirror/mode/css/css.js"></script>
	<script src="codemirror/mode/xml/xml.js"></script>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/editor.css">
	<link rel="stylesheet" type="text/css" href="jqueryIntroLoader/dist/css/introLoader.min.css">

	<style type="text/css">
		main{
			text-align: left;
		}
		    
	</style>
</head>
<body>
	<?php include 'includes/loading_animation.php' ?>
	<?php
		include 'includes/sidebar.php';
	?>

	


	
	<div class="main-container">
	 	<main>
		  	<nav>
		  		<a href="index.php"><img src="images/logo2_03.png"></a>
		  		 <ul class="right">
		  		 	<?php if($user->is_loggedin()){ ?>
					<li>
						<form action="" method="post" id="insert_code">
							<button type="submit" form="insert_code" value="submit" name="post_code" class="nav-buttons"><i class="fa fa-cloud-upload"></i>    Запази</button>
				    </li>
		  		 	<?php } ?>
					
		  		 		
				     
				</ul>
				 <ul class="left">
					   <li><button  class="run nav-buttons" ><i class="fa fa-play"></i>   Изпълни</button></li>  
					   <li><button  class=" nav-buttons settings" ><i class="fa fa-cog"></i>   Настройки</button></li>  
					   <li><button  class=" nav-buttons share" ><i class="fa fa-share-alt"></i>   Сподели</button></li>
					   <li><button  class=" nav-buttons like" ><i class="fa fa-heart"></i></button></li>
				</ul>
		  	</nav>
		  
		 	<div class="users">
				<div class="editor-area">
					
						
					<div class="fields">

					 	 <div class="tab-panels">
					 
						    <ul class="tabs">
						      	<li rel="html" class="active-tab"><a data-toggle="modal" data-target="#html-settings"><i class="fa fa-cog"></i></a>  index.html <i class="fa fa-times"></i></li>
						       	<li rel="css" ><a href="login.php"><i class="fa fa-cog"></i></a>  style.css <i class="fa fa-times"></i></li>
						        <li rel="js" ><a href="login.php"><i class="fa fa-cog"></i></a>  app.js <i class="fa fa-times"></i></li>
					    	</ul>

						    <div id="html" class="panel active-panel">
						     	<section  class="edit ">
					        		<textarea class="editor html " name="html" id="code_html"><?php echo $html; ?></textarea>
					     		 </section>
						    </div>
						    <div id="css" class="panel">
						      	<section  class="edit">
					          		<textarea class="editor css " name="css" id="code_css"><?php echo $css;?></textarea>
					     		</section>
						    </div>
						    <div id="js" class="panel ">
						       	<section  class="edit">
					    			<textarea class="editor js"  name="js" id="code_js" ><?php echo $js;?></textarea>
					  			</section>
						    </div>
					  	</div>
						</form>

					 </div>
					<div class="result">
					   <iframe src="code.php?code=<?php echo $code_id; ?>" id="preview">
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
			

 
	 <div class="modal fade" id="html-settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Последавтели</h4>
      </div>
      <div class="modal-body">
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
	<script type="text/javascript" src="jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" src="js/loading.js"></script>

</body>
</html>
<?php  
if(isset($_POST['post_code']))
{

	$html = $_POST['html'];
	$css = $_POST['css'];
	$js = $_POST['js'];
	
	$user->update_code($html, $css, $js,$user_id,$code_id);
	
}

?>
