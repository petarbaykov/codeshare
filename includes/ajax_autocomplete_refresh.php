<?php
// PDO connect *********
function connect() {
    return new PDO('mysql:host=localhost;dbname=code-share', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM users WHERE user_name LIKE (:keyword) ORDER BY user_id ASC LIMIT 0, 5";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$user_id = $rs['user_id'];
	
	$names =  "<span>" . $rs['fname'] . " " . $rs['lname'] . "</span>";
	$image = "<img src='images/" . $rs['avatar'] . "'>" ;
	$country_name = "<span class='search-results'>@" .str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['user_name']) . "</span>";
	// add new option
    echo '<a href="user_profile.php?user_id=' . $user_id .'"'.'><li onclick="set_item(\''.str_replace("'", "\'", $rs['user_name']).'\')">'. $image . $names. $country_name.'</li></a>';
}
?>