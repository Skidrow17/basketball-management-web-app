<?php

//Access: Authorized User & Admin
//Purpose: retrieve sent messages

require_once 'connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);		
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		$sql = "SELECT M.id,U.name,U.surname,M.text_message,U.profile_pic,DATE_FORMAT(M.date_time, '%d/%m/%Y %H:%i') as date_time,M.message_read FROM user U, message M where U.id=M.receiver_id AND sender_delete=0 AND sender_id=:id order by M.date_time desc";
		$run = $dbh->prepare($sql);
		$run->bindParam(':id', $id, PDO::PARAM_INT);
		$run->execute();

		if ($run->rowCount() > 0) {
			while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
				$fetch['Sent_Messages'][] = $row;
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