<?php

//Access: Authorized User & Admin
//Purpose: gives the ability to deletes message

require_once '../../php/connect_db.php';
require '../../php/useful_functions.php';
$fetch = array();


if(isset($_GET['safe_key']) && isset($_GET['user_id'])){
	if (security_check($_GET['safe_key'], $_GET['user_id']) == true) {
		update_last_seen_time($_GET['user_id']);
		$message_id = filter_var($_GET["message_id"], FILTER_SANITIZE_NUMBER_INT);
		$user_id = filter_var($_GET["user_id"], FILTER_SANITIZE_NUMBER_INT);
		if ($_GET['type'] !== 'incomming') {
			$sql = "UPDATE message 
					SET sender_delete=1 
					WHERE id=:id AND sender_id=:sender_id";
			$run = $dbh->prepare($sql);
			$run->bindValue(':id', $message_id);
			$run->bindValue(':sender_id', $user_id);
			$run->execute();

			if ($run->rowCount() > 0) {
				$fetch['ERROR']['error_code'] = "200";
			} else {
				$fetch['ERROR']['error_code'] = "201";
			}
			echo json_encode($fetch);
		} else {
			
			$sql = "UPDATE message 
					SET receiver_delete=1 
					WHERE id=:id 
					AND receiver_id=:receiver_id";
					
			$run = $dbh->prepare($sql);
			$run->bindValue(':id', $message_id);
			$run->bindValue(':receiver_id', $user_id);
			$run->execute();

			if ($run->rowCount() > 0) {
				$fetch['ERROR']['error_code'] = "200";
			} else {
				$fetch['ERROR']['error_code'] = "201";
			}
			echo json_encode($fetch);
		}
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}