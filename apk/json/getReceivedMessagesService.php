<?php

require_once 'connect_db.php';
require_once 'useful_functions.php';
$fetch = array();

if(isset($_GET['safety_key']) && isset($_GET['id'])){
	if (security_check($_GET['safety_key'], $_GET['id']) == true) {
		$sql2 = "SELECT count(*) FROM message where receiver_id=:id ";
		$result = $dbh->prepare($sql2);
		$result->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
		$result->execute();
		$number_of_rows = $result->fetchColumn();

		$sql = "SELECT U.name,U.surname,M.text_message 
				FROM user U, message M 
				WHERE U.id=M.sender_id AND  
				receiver_id=:id 
				ORDER BY date_time desc LIMIT 1";
				
		$run = $dbh->prepare($sql);
		$run->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
		$run->execute();

		$sql3 = "UPDATE login_history 
				 SET logout_date_time=? 
				 WHERE user_id=? order by id desc Limit 1";
				 
		$stmt = $dbh->prepare($sql3);
		$stmt->execute([date('Y/m/d H:i:s'), $_GET['id']]);

		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
			$fetch['Received_Messages'][] = $row;
			$fetch['Number_of_messages']['n_o_m'] = $number_of_rows;
			$fetch['ERROR']['error_code'] = "200";
		}

		$sql = "SELECT A.title,A.text,U.name,U.surname 
				FROM announcement A,user U WHERE U.id=A.user_id 
				ORDER BY date_time DESC LIMIT 1";
				
		$run = $dbh->prepare($sql);
		$run->execute();

		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
			$fetch['Last_Announcement'][] = $row;
			$fetch['Number_of_annoucements']['n_o_a'] = getNumberOfAnnouncements();
		}

		echo json_encode($fetch);
	} else {
		$fetch['ERROR']['error_code'] = "403";
		echo json_encode($fetch);
	}
}