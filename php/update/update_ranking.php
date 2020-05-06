<?php

//Access: Admin
//Purpose: updates points,wins,lose per league

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
	
	$successfull = false;
	foreach (json_decode(file_get_contents('php://input')) as $outerArray ) {
		if(sizeof($outerArray) == 6){
			$sql = "UPDATE team SET total_games = ?,wins = ?, loses = ?,points = ? where id = ?";
			$run = $dbh->prepare($sql);
			$run->execute([$outerArray[2], $outerArray[3], $outerArray[4], $outerArray[5], $outerArray[0]]);
			if ($run->rowCount() > 0) {
				$successfull = true;
			}
		}
	}
   
	if ($successfull) {
		echo $success;
	} else {
		echo $fail;
	}

} else {
	session_destroy();
	header('HTTP/1.0 401 Unauthorized');
	echo 'HTTP/1.0 401 Unauthorized';
}

?>

