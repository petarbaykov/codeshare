
<?php include 'includes/dbconfig.php' ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans&subset=latin,cyrillic,cyrillic-ext">
	
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	
	
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	
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
	<link rel="stylesheet" type="text/css" href="css/jquery.custom-scrollbar.css">
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
					   <li><button  type="button" class=" nav-buttons settings" data-toggle="modal" data-target="#settings"><i class="fa fa-cog"></i>   Настройки</button></li>  
					   <li><button class="nav-buttons collaborate" onclick="TogetherJS(this); return false;">Start TogetherJS</button></li>
				</ul>
		  	</nav>
		  
		 	<div class="users">
				<div class="editor-area">
					
						
					<div class="fields">

					 	 <div class="tab-panels">
					 
						    <ul class="tabs">
						      	<li rel="html" class="active-tab"><a data-toggle="modal" data-target="#html-settings"><i class="fa fa-cog"></i></a>  index.html <i class="fa fa-times"></i></li>
						       	<li rel="css" ><a  data-toggle="modal" data-target="#css-settings"><i class="fa fa-cog"></i></a>  style.css <i class="fa fa-times"></i></li>
						        <li rel="js" ><a  data-toggle="modal" data-target="#js-settings"><i class="fa fa-cog"></i></a>  app.js <i class="fa fa-times"></i></li>
					    	</ul>

						    <div id="html" class="panel active-panel">
						     	<section  class="edit ">
					        		<textarea class="editor html " name="html" id="code_html" ><!-- HTMl goes here --></textarea>
					     		 </section>
						    </div>
						    <div id="css" class="panel">
						      	<section  class="edit">
					          		<textarea class="editor css " name="css" id="code_css"></textarea>
					     		</section>
						    </div>
						    <div id="js" class="panel ">
						       	<section  class="edit">
					    			<textarea class="editor js"  name="js" id="code_js" ></textarea>
					  			</section>
						    </div>
					  	</div>
						</form>

					 </div>
					<div class="result">
					   <iframe src="" id="preview">
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
      
      <div class="modal-body">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     
    </div>
  </div>
</div>

	 <div class="modal fade" id="css-settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			
		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     
    </div>
  </div>
</div>

	 <div class="modal fade" id="js-settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			
		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     
    </div>
  </div>
</div>

 <div class="modal fade" id="settings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<form action="" method="post">

				<div class="input-group">
					<label for="code_title">Заглавие</label>
					<input type="text" class="form-control" name="code_title">

				</div>
				<div class="input-group">
					<label for="code_description">Описание</label>
					<textarea name="code_description" class="form-control"></textarea>
				</div>
				<div class="input-group">
					<label for="code_tags">Тагове</label>
					<input type="text" class="form-control" name="code_tags">
				</div>
				<input type="submit" class="save-submit" value="Запази и затвори" name="save_submit">
			</form>
		
      </div>
     
    </div>
  </div>
</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/global.js"></script>
	<script type="text/javascript" src="jqueryIntroLoader/dist/jquery.introLoader.pack.min.js"></script>
	<script type="text/javascript" src="js/loading.js"></script>
	<script src="https://togetherjs.com/togetherjs-min.js"></script>
	<script type="text/javascript" src="js/jquery.custom-scrollbar.js"></script>
	
</body>
</html>
<?php  
if(isset($_POST['post_code']))
{
	$codes = $DB_con->prepare("SELECT code_id from codes order by code_id DESC LIMIT 1");
	$codes->execute();
	$datas = $codes->fetch(PDO::FETCH_ASSOC);
	$code_id = $datas['code_id'] + 1;
	
	$html = $_POST['html'];
	$css = $_POST['css'];
	$js = $_POST['js'];
	$code_name = $user->generateRandomString();
	$user->post_code($html, $css, $js,$user_id,$code_name);
	echo "<script>window.open('view_code.php?code=$code_id', '_self')</script>";
}
if(isset($_POST['save_submit'])){
	$codes = $DB_con->prepare("SELECT code_id from codes order by code_id DESC LIMIT 1");
	$codes->execute();
	$datas = $codes->fetch(PDO::FETCH_ASSOC);
	$code_id = $datas['code_id'] + 1;

	$code_title = $_POST['code_title'];
	$code_description = $_POST['code_description'];
	$code_tags = $_POST['code_tags'];

	$insert_details = $DB_con->prepare("INSERT into codes (code_title, tags, code_description) values (:code_title,:code_tags,:code_description) where code_id=:code_id");
	$insert_details->execute(array(":code_title"=>$code_title,":code_tags"=>$code_tags,":code_description"=>$code_description,":code_id"=>$code_id));

}

?>
