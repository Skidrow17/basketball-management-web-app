<?php

//Access: Everyone
//Purpose: shows the ranking of selected league

session_start();
require_once '../../php/connect_db.php';
require_once '../../php/useful_functions.php';

	$id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);		

	echo '<ui class="contacts">';

		$sql = "SELECT get_last_login_by_user(U.id) as last_login,UC.name as profession,U.id,U.name,U.surname,U.profile_pic,U.phone from user U,user_categories UC where U.id!=:id AND UC.id = U.profession AND U.active = 0 AND CONCAT(U.name,' ',U.surname) like :searchVal order by U.name asc";
		$run = $dbh->prepare($sql);
		$run->bindParam(':id', $id, PDO::PARAM_INT);
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
								<p>'.$row['last_login'].'</p>
							</div>
						</div>
					</li>';
			}
		}

	echo '</ui>';