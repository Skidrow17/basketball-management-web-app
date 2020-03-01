<?php
require_once 'connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['user_id'])){
	if (security_check($_GET['safe_key'], $_GET['user_id']) == true) {
		$user_id = filter_var($_GET["user_id"], FILTER_SANITIZE_NUMBER_INT);
		$title = filter_var($_GET["title"], FILTER_SANITIZE_STRING);
		$text = filter_var($_GET["text"], FILTER_SANITIZE_STRING);

		$sql = "INSERT INTO `announcement`(`user_id`, `title`, `text`) VALUES (:user_id,:title,:text)";
		$run = $dbh->prepare($sql);
		$run->bindParam(':user_id', $user_id, PDO::PARAM_INT);
		$run->bindParam(':title', $title, PDO::PARAM_STR);
		$run->bindParam(':text', $text, PDO::PARAM_STR);
		$run->execute();

		// $sql = "SELECT mobile_token FROM user WHERE id == :sender_id";
        // $result = $dbh->prepare($sql);
        // $result->bindParam(':sender_id', $user_id, PDO::PARAM_INT);
        // $result->execute();

        // while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //     if(strlen($row["mobile_token"]) == 152){
        //         sentPushNotification($title,$row['mobile_token'],$text);
        //     }
        // }

		if ($run->rowCount() > 0) {
			$fetch['ERROR']['error_code'] = "200";
		} else {
			$fetch['ERROR']['error_code'] = "201";
		}
		echo json_encode($fetch);
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}