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
echo "<!DOCTYPE html>
					      <html>
					      <head>
					        <title></title>
					        <link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'>
					       
					         <style>$css</style>
					      <body>
					      		$html
					    
							
					      </body>
					      </html>
	
";
}


?>