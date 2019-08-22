<?php
require_once 'connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		$read = 1;
		$id = filter_var($_GET['message_id'], FILTER_SANITIZE_NUMBER_INT);

		$sql = "UPDATE message SET message_read=? WHERE id=?";
		$stmt = $dbh->prepare($sql);
		$stmt->execute([$read, $id]);
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}