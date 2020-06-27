<?php

//Access: Authorized User & Admin
//Purpose: retrieve sent messages

require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
$fetch = array();

 if(isset($_GET['safe_key']) && isset($_GET['id'])){
	 $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
	 $buddy = filter_var($_GET["buddy"], FILTER_SANITIZE_NUMBER_INT);		
		
 	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		update_last_seen_time($_GET['id']);
		$sql = "SELECT id,text_message,date_time,if(receiver_id = :rid, 'true', 'false') as set_me FROM message WHERE sender_id IN (:id,:buddy) and receiver_id IN (:id2,:buddy2) order by date_time asc";
		$run = $dbh->prepare($sql);
		$run->bindParam(':rid', $id, PDO::PARAM_INT);
		$run->bindParam(':id', $id, PDO::PARAM_INT);
		$run->bindParam(':buddy', $buddy, PDO::PARAM_INT);
		$run->bindParam(':id2', $id, PDO::PARAM_INT);
		$run->bindParam(':buddy2', $buddy, PDO::PARAM_INT);
		$run->execute();

		if ($run->rowCount() > 0) {
			while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
				$fetch['chat_message'][] = $row;
				$fetch['ERROR']['error_code'] = "200";
			}
		} else {
			$fetch['ERROR']['error_code'] = "204";
		}

		echo json_encode($fetch);

		$sql = "UPDATE message SET message_read = 1 WHERE receiver_id = :rid and sender_id = :sid and DATE(date_time) = CURDATE() and message_read = 0";
		$run = $dbh->prepare($sql);
		$run->bindParam(':rid', $id , PDO::PARAM_INT);
		$run->bindParam(':sid', $buddy , PDO::PARAM_INT);
		$run->execute();
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}