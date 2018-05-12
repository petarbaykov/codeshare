<?php
include_once 'includes/dbconfig.php';
if(!$user->is_loggedin())
{
	$user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];

$STH = $DB_con->query('SELECT * from codes');
 
# setting the fetch mode
$STH->setFetchMode(PDO::FETCH_ASSOC);
 


?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Noto+Sans&subset=latin,cyrillic,cyrillic-ext">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css" />
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	
	<script type="text/javascript" src="js/global.js"></script>
	<link rel="stylesheet" type="text/css" href="css/global.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">
	<link rel="stylesheet" type="text/css" href="jqueryIntroLoader/dist/css/introLoader.min.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<script type="text/javascript" src='js/autocomplete.js'></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
	<style type="text/css">
		.container{
			height: 91%;
		}
	</style>

<script type="text/javascript">
               $(document).ready(function(){
               		/*$('.messages-aside').mCustomScrollbar({
               			theme:'inset-dark'
               		});
               		$('#output').mCustomScrollbar({
               			theme:'inset-dark'
               		});
 					*/
                    function showComment(){
                    	
                    	var message=$("#message").val();
 						var user = $('#user').val();
 						var delay = setTimeout(function(){
                      $.ajax({
                        type:"post",
                        url:"view_messages.php",
                        data:"action=showcomment" + "&message="+ message+"&user="+user,
                        beforeSend:function(){
                        	$('#load').show();
                        },
                        success:function(data){
                             $("#messages_output").html(data);
                         
                        }

                      });
                      },1000);
                    }
 
                    
						
 					
                    $("#button").click(function(){
 
                       
                          var message=$("#message").val();
 							var user = $('#user').val();
 							$('#form')[0].reset();
 						
 							$.ajax({
                              type:"post",
                              url:"send_messages.php",
                              data:"message="+message+"&user="+user+"&action=addmessage"
                              
 
                          });
 						$('#message').focus();
                          
 
                    });
                  	showComment()
                 

               });
       </script>
</head>
<body>
	
	<?php
		include 'includes/sidebar.php';
 	?>

	<div class="main-container main-msgs">
	 	<main id="main-msg">
	 		<?php include 'includes/nav.php' ?>
	 		<div class="container">
	 			<?php 
	 			if(isset($_GET['user'])){
	 				

	 				?>
	 		<aside class="col-md-offset-1 col-md-3 col-sm-12 col-xs-12 messages-aside">
	 					
	 							 						
	 							<?php 
	 						$aside_msgs = $DB_con->prepare("SELECT * from messages where message_from_id=:message_from_id  or  message_to_id=:message_to_id");
	 						$aside_msgs->execute(array(":message_from_id"=>$user_id,":message_to_id"=>$_GET['user']));
	 						while($aside_msg_row = $aside_msgs->fetch(PDO::FETCH_ASSOC)){
	 							$user = $aside_msg_row['message_from_id'];
	 							$user_to = $aside_msg_row['message_to_id'];
	 							
	 						$users = $DB_con->prepare("SELECT * from users where user_id=:user_id");
	 						$users->execute(array(":user_id"=>$user_to));
		 						while($user_row=$users->fetch(PDO::FETCH_ASSOC)){
		 							$img = $user_row['avatar'];
		 							//echo "<img src='images/$img'>";
		 						}
	 						}

	 						
	 					?>
	 					
	 					
	 					
	 					

	 				</aside>
		 			<section class="col-md-8 col-sm-12 col-xs-12 message-main ">
							
							<div id="output">
								<section class="messages-output" id="messages_output">
									<i class="fa fa-spinner fa-spin " id="load" ></i>
		 						</section>
							</div>
		 				
		 				<section class="messages-send">
		 					
		 						<form id="form" >
					              
					                <textarea name="message" id="message"></textarea>
					               <br/>
			<input type="text" style="display:none;" value="<?php echo $_GET['user']?>" id="user" name="user"/>
					               <input type="button" value="Изпрати" id="button"class="btn btn-primary"/>
					                
					               
					        </form>
		 					
		 				</section>
		 			</section>
		 			<?php }?>
	 		</div>
		 	

	  	</main>
	</div>

		

</body>
</html>
