<?php

require_once 'connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['id'])){
	if (security_check($_GET['safe_key'], $_GET['id']) == true) {
		//$sql = "SELECT get_last_login_by_user(id) as last_login,id,name,surname,profile_pic,phone from user where id!=:id order by get_last_login_by_user(id) desc";
		$sql = "SELECT DATE_FORMAT(get_last_login_by_user(id), '%d/%m/%Y %H:%i') as last_login ,id,name,surname,profile_pic,phone from user where id!=:id order by name asc";

		$run = $dbh->prepare($sql);
		$run->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
		$run->execute();

		if ($run->rowCount() > 0) {
			while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
				$fetch['contacts'][] = $row;
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