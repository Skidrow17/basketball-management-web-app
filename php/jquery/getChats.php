<?php

//Access: Everyone
//Purpose: shows the ranking of selected league

session_start();
require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
require_once '../language.php';


if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {

	$buddy = 0;
	if(!isset($_POST['contact_id'])){
		$buddy = $_SESSION['user_id'];
	}else{
		$buddy = filter_var($_POST['contact_id'], FILTER_SANITIZE_NUMBER_INT);	
	}

	$id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);

	$sql = "SELECT id,text_message,date_time,if(receiver_id = :rid, 'true', 'false') as set_me FROM message WHERE sender_id IN (:id,:buddy) and receiver_id IN (:id2,:buddy2) order by date_time asc";
	$run = $dbh->prepare($sql);
	$run->bindParam(':rid', $id, PDO::PARAM_INT);
	$run->bindParam(':id', $id, PDO::PARAM_INT);
	$run->bindParam(':buddy', $buddy, PDO::PARAM_INT);
	$run->bindParam(':id2', $id, PDO::PARAM_INT);
	$run->bindParam(':buddy2', $buddy, PDO::PARAM_INT);
	$run->execute();

	if ($run->rowCount() > 0) {

		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
			if($row['set_me'] == 'true'){
				echo '<div class="d-flex justify-content-start mb-4">
						<div class="msg_cotainer">
							'.$row['text_message'].'
							<span class="msg_time">'.time_since($row['date_time']).'</span>
						</div>
					</div>';
			}

			if($row['set_me'] == 'false'){
				echo '<div class="d-flex justify-content-end mb-4">
						<div class="msg_cotainer_send">
							'.$row['text_message'].'
							<span class="msg_time_send" style= "text-align: left;">'.time_since($row['date_time']).'</span>
						</div>
					</div>';
			}
		}
	}

	$sql = "UPDATE message SET message_read = 1 WHERE receiver_id = :rid and sender_id = :sid and DATE(date_time) = CURDATE() and message_read = 0";
	$run = $dbh->prepare($sql);
	$run->bindParam(':rid', $id , PDO::PARAM_INT);
	$run->bindParam(':sid', $buddy , PDO::PARAM_INT);
	$run->execute();
}