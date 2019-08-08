<?php

require_once 'connect_db.php';
require 'useful_functions.php';
$fetch = array();


if(isset($_GET['safe_key']) && isset($_GET['user_id'])){
	if (security_check($_GET['safe_key'], $_GET['user_id']) == true) {
		if ($_GET['type'] !== 'incomming') {
			
			$sql = "UPDATE message 
					SET sender_delete=1 
					WHERE id=:id AND sender_id=:sender_id";
					
			$run = $dbh->prepare($sql);
			$run->bindValue(':id', $_GET["message_id"]);
			$run->bindValue(':sender_id', $_GET["user_id"]);
			$run->execute();

			if ($run->rowCount() > 0) {
				$fetch['insert_message'] = "Επιτυχία";
				$fetch['ERROR']['error_code'] = "200";
			} else {
				$fetch['insert_message'] = "Αποτυχία";
				$fetch['ERROR']['error_code'] = "200";
			}
			echo json_encode($fetch);
		} else {
			
			$sql = "UPDATE message 
					SET receiver_delete=1 
					WHERE id=:id 
					AND receiver_id=:receiver_id";
					
			$run = $dbh->prepare($sql);
			$run->bindValue(':id', $_GET["message_id"]);
			$run->bindValue(':receiver_id', $_GET["user_id"]);
			$run->execute();

			if ($run->rowCount() > 0) {
				$fetch['insert_message'] = "Επιτυχία";
				$fetch['ERROR']['error_code'] = "200";
			} else {
				$fetch['insert_message'] = "Αποτυχία";
				$fetch['ERROR']['error_code'] = "200";
			}
			echo json_encode($fetch);
		}
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}