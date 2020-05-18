<?php

//Access: Authorized User & Admin
//Purpose: set messages as read

require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		update_last_seen_time($_GET['id']);
		$read = 1;
		$id = filter_var($_GET['message_id'], FILTER_SANITIZE_NUMBER_INT);
		$sql = "UPDATE message SET message_read=:message_read WHERE id=:id";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':message_read',$read,PDO::PARAM_INT);
		$stmt->bindParam(':id',$id,PDO::PARAM_INT);
		$stmt->execute();
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}