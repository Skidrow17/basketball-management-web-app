<?php

//Access: Everyone
//Purpose: shows the ranking of selected league

session_start();
require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';
require_once '../language.php';


if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
	$id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);		

	echo '<ui class="contacts">';

		$sql = "SELECT m.id,p.text_message,if(p.sender_id = :comperance,p.receiver_id,p.sender_id) as user_id,m.profile_pic,m.name,m.surname,DATE_FORMAT(p.date_time, '%d/%m/%Y %H:%i') as date_time
		FROM `message` p
		INNER JOIN (SELECT sender_id, MAX(id) as last_message_id
					FROM `message` 
					WHERE receiver_id=:id
					GROUP BY `sender_id`) t2 ON t2.sender_id = p.sender_id AND t2.last_message_id = p.id
		LEFT JOIN user m ON p.sender_id = m.id
		WHERE p.receiver_id=:id_sd AND CONCAT(m.name,' ',m.surname) like :searchVal
		ORDER BY p.date_time DESC";

		$run = $dbh->prepare($sql);
		$run->bindParam(':comperance', $id, PDO::PARAM_INT);
		$run->bindParam(':id', $id, PDO::PARAM_INT);
		$run->bindParam(':id_sd', $id, PDO::PARAM_INT);
		$run->bindParam(':searchVal',$_POST['search'],PDO::PARAM_STR);
		$run->execute();


		if ($run->rowCount() > 0) {
			while ($row = $run->fetch(PDO::FETCH_ASSOC)) {

				echo '<li class = "active" style = "display:block;" id = "contact_id" value = "'.$row['id'].'">
						<div class="d-flex bd-highlight">
							<div class="img_cont">
								<img src="'.$row['profile_pic'].'" class="rounded-circle user_img">
							</div>
							<div class="user_info">
								<span>'.$row['name'].' '.$row['surname'].'</span>
								<p>'.$row['text_message'].'</p>
							</div>
						</div>
					</li>';
			}
		}

	echo '</ui>';
}