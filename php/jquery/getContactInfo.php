<?php

//Access: Everyone
//Purpose: shows the ranking of selected league

session_start();
require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';

	$id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);		

		$sql = "SELECT U.id,U.name,U.surname,U.profile_pic,P.name as profession from user U,user_categories P where U.profession = P.id AND  U.id = :id";
		$run = $dbh->prepare($sql);
		$run->bindParam(':id', $_POST['contact_id'], PDO::PARAM_INT);
		$run->execute();

		if ($run->rowCount() > 0) {
			while ($row = $run->fetch(PDO::FETCH_ASSOC)) {

				echo ' <div class="img_cont">
							<img src="'.$row['profile_pic'].'" class="rounded-circle user_img">
						</div>
						<div class="user_info">
							<span>'.$row['name'].' '.$row['surname'].'</span>
							<p>'.$row['profession'].'</p>
						</div>';
			}
		}