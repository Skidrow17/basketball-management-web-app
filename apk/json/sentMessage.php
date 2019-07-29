<?php

require_once 'connect_db.php';
require 'useful_functions.php';
$fetch = array();

if (security_check($_GET['safe_key'], $_GET['sender_id']) == true) {
	$sender_id = filter_var($_GET["sender_id"], FILTER_SANITIZE_NUMBER_INT);
	$receiver_id = filter_var($_GET["receiver_id"], FILTER_SANITIZE_NUMBER_INT);
	$text_message = filter_var($_GET["text_message"], FILTER_SANITIZE_STRING);

	$sql = "INSERT INTO `message`(`sender_id`, `receiver_id`, `text_message`) VALUES (?,?,?)";
	$run = $dbh->prepare($sql);
	$run->execute([$sender_id, $receiver_id, $text_message]);

	if ($run->rowCount() > 0) {
		$fetch['insert_message'] = "Επιτυχία";
		$fetch['ERROR']['error_code'] = "200";
	} else {
		$fetch['insert_message'] = "Αποτυχία";
		$fetch['ERROR']['error_code'] = "200";
	}

	echo json_encode($fetch);
} else {
	$fetch['ERROR']['error_code'] = "403";
	echo json_encode($fetch);
}

