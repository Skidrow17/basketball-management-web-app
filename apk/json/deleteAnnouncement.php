<?php

require_once 'connect_db.php';
require 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['user_id'])){

	$announcement_id = filter_var($_GET["announcement_id"], FILTER_SANITIZE_NUMBER_INT);
	$user_id = filter_var($_GET["user_id"], FILTER_SANITIZE_NUMBER_INT);

	if (security_check($_GET['safe_key'], $_GET['user_id']) == true) {
		$profession = 0;
		$sql = "SELECT profession from user where id=?";
		$run = $dbh->prepare($sql);
		$run->execute([$_GET['user_id']]);

		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
			$profession = $row['profession'];
		}

		if ($profession != 1) {
			$sql = 'delete from announcement WHERE id =:id AND user_id=:user_id';

			$run = $dbh->prepare($sql);
			$run->bindValue(':id', $announcement_id);
			$run->bindValue(':user_id', $user_id);
			$run->execute();

			if ($run->rowCount() > 0) {
				$fetch['ERROR']['error_code'] = "200";
			} else {
				$fetch['ERROR']['error_code'] = "201";
			}
			echo json_encode($fetch);
		} else {
			$sql = 'delete from announcement WHERE id =:id';

			$run = $dbh->prepare($sql);
			$run->bindValue(':id', $announcement_id);
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