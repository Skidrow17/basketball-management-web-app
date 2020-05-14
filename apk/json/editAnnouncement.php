<?php

//Access: Authorized User & Admin
//Purpose: edits the owned announcements 

require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		$id = filter_var($_GET['announcement_id'], FILTER_SANITIZE_NUMBER_INT);
		$title = filter_var($_GET['title'], FILTER_SANITIZE_STRING);
		$text = filter_var($_GET['text'], FILTER_SANITIZE_STRING);
		$user_id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);

		$sql = "UPDATE announcement SET title=:title ,text=:text WHERE id=:id AND user_id=:user_id";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':title',$title,PDO::PARAM_STR);
		$stmt->bindParam(':text',$text,PDO::PARAM_STR);
		$stmt->bindParam(':id',$id,PDO::PARAM_INT);
		$stmt->bindParam(':user_id',$user_id,PDO::PARAM_INT);
		$stmt->execute();

		if ($stmt->rowCount() > 0) {
			$fetch['ERROR']['error_code'] = "200";
		} else {
			$fetch['ERROR']['error_code'] = "201";
		}

		echo json_encode($fetch);
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}