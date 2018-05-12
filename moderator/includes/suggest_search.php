<?php 
	include 'dbconfig.php';
	$term = trim(strip_tags($_GET['trim']));
	$a_json = array();
	$a_json_row = array();
	if($data = $DB_con->prepare("SELECT * from users where user_name LIKE '%term%' order by  user_name")){
		$data->execute();
		while($row = $data->fetch(PDO::FETCH_ASSOC)){
			$user_name = htmlentities(stripcslashes($row['user_name']));
			$user_id = htmlentities(stripslashes($row['user_id']));
			$a_json_row['id'] = $user_id;
			$a_json_row['value'] = $user_name;
			$a_json_row['label'] = $user_name;
			array_push($a_json, $a_json_row);
		}
	}
		echo json_encode($a_json);
		flush();

?>