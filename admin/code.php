<?php	
include_once 'includes/dbconfig.php';
if(isset($_GET['code'])){
	$code_id = $_GET['code'];
	$stmt = $DB_con->prepare("SELECT * FROM codes WHERE code_id=:code_id");
	$stmt->execute(array(":code_id"=>$code_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
	$html = $userRow['code_html'];

$css = $userRow['code_css'];
echo "<html>
		<head>
			<style>$css</style>
		</head>
		<body>
		$html 
		</body>
		<html>
	
";
}


?>