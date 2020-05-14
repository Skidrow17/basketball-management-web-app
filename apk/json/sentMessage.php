<?php

//Access: Authorized User & Admin
//Purpose: sent messages between users

require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
$fetch = array();

if(isset($_GET['safe_key']) && isset($_GET['sender_id'])){
	if (security_check($_GET['safe_key'], $_GET['sender_id']) == true) {
		$sender_id = filter_var($_GET["sender_id"], FILTER_SANITIZE_NUMBER_INT);
		$receiver_id = filter_var($_GET["receiver_id"], FILTER_SANITIZE_NUMBER_INT);
		$text_message = filter_var($_GET["text_message"], FILTER_SANITIZE_STRING);

		$sql = "INSERT INTO `message`(`sender_id`, `receiver_id`, `text_message`) VALUES (:sender_id, :receiver_id, :text_message)";
		$run = $dbh->prepare($sql);
		$run->bindParam(':sender_id',$sender_id,PDO::PARAM_INT);
		$run->bindParam(':receiver_id',$receiver_id,PDO::PARAM_INT);
		$run->bindParam(':text_message',$text_message,PDO::PARAM_STR);
		$run->execute();

		if ($run->rowCount() > 0) {
			$fetch['ERROR']['error_code'] = "200";
		} else {
			$fetch['ERROR']['error_code'] = "201";
		}

		$sql = "SELECT id, name, surname, mobile_token FROM user WHERE id IN (:receiver_id, :sender_id)";
        $result = $dbh->prepare($sql);
        $result->bindParam(':receiver_id', $receiver_id, PDO::PARAM_INT);
        $result->bindParam(':sender_id', $sender_id, PDO::PARAM_INT);
        $result->execute();
        $sender_name = "";
        $receiver_token = "";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if($row["id"] == $sender_id){
                $sender_name = $row["name"]." ".$row["surname"];
            }else{
                $receiver_token = $row["mobile_token"];
            }
        }
        sentPushNotification($sender_name,$receiver_token,$text_message);
		echo json_encode($fetch);
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}