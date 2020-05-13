<?php

//Access: Authorized User & Admin
//Purpose: get received message polling function 

require_once '../../php/connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

if(isset($_GET['safety_key']) && isset($_GET['id'])){
	$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);		
	if (security_check($_GET['safety_key'], $_GET['id']) == true) {
		
		$sql = "SELECT get_number_of_received_messages_by_user(receiver_id) as number_of_messages,
				U.name,U.surname,M.text_message 
				FROM user U, message M 
				WHERE U.id=M.sender_id AND  
				receiver_id=:id 
				ORDER BY date_time desc LIMIT 1";
				
		$run = $dbh->prepare($sql);
		$run->bindParam(':id', $id, PDO::PARAM_INT);
		$run->execute();
		
		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
			$fetch['Received_Messages'][] = $row;
		}

		$sql  = "UPDATE login_history 
				 SET logout_date_time=? 
				 WHERE user_id=? order by id desc Limit 1";
				 
		$stmt = $dbh->prepare($sql);
		$stmt->execute([date('Y/m/d H:i:s'), $id]);

		
		$sql = "SELECT get_number_of_announcements() as number_of_announcements,
				A.title,A.text,U.name,U.surname 
				FROM announcement A,user U WHERE U.id=A.user_id 
				ORDER BY date_time DESC LIMIT 1";
				
		$run = $dbh->prepare($sql);
		$run->execute();

		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
			$fetch['Last_Announcement'][] = $row;
		}
		
		$fetch['ERROR']['error_code'] = "200";
		
		echo json_encode($fetch);
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}