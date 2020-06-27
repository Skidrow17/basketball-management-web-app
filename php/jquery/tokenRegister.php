<?php

//Access: Everyone
//Purpose: shows the ranking of selected league

session_start();
require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
require_once '../language.php';


if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {

	$id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
	$mobile_token = filter_var($_POST['mobile_token'], FILTER_SANITIZE_STRING);

	$sql = "UPDATE user SET mobile_token = :mobile_token where id = :id";
	$run = $dbh->prepare($sql);
	$run->bindParam(':mobile_token', $mobile_token, PDO::PARAM_STR);
	$run->bindParam(':id', $id, PDO::PARAM_INT);
	$run->execute();

	if ($run->rowCount() > 0) {
	 	echo $success;
	}else{
		echo $fail;
	}
}