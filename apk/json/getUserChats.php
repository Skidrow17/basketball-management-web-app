<?php

//Access: Authorized User & Admin
//Purpose: retrieves received messages

require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
 	$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);		
 	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		update_last_seen_time($_GET['id']);

		$sql = "SELECT p.text_message,if(p.sender_id = :comperance,p.receiver_id,p.sender_id) as user_id,m.profile_pic,m.name,m.surname,DATE_FORMAT(p.date_time, '%d/%m/%Y %H:%i') as date_time
				FROM `message` p
				INNER JOIN (SELECT sender_id, MAX(id) as last_message_id
							FROM `message` 
							WHERE receiver_id=:id
							GROUP BY `sender_id`) t2 ON t2.sender_id = p.sender_id AND t2.last_message_id = p.id
				LEFT JOIN user m ON p.sender_id = m.id
				WHERE p.receiver_id=:id_sd
				ORDER BY p.date_time DESC";

		$run = $dbh->prepare($sql);
		$run->bindParam(':comperance', $id, PDO::PARAM_INT);
		$run->bindParam(':id', $id, PDO::PARAM_INT);
		$run->bindParam(':id_sd', $id, PDO::PARAM_INT);
		$run->execute();

		if ($run->rowCount() > 0) {
			while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
				$fetch['Open_Chats'][] = $row;
				$fetch['ERROR']['error_code'] = "200";
			}
		} else {
			$fetch['ERROR']['error_code'] = "204";
		}
		echo json_encode($fetch);
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}