<?php
require_once 'connect_db.php';
require_once 'useful_functions.php';
session_start();

if (isset($_SESSION['safe_key'])) {
	
	if((round(microtime(true) * 1000)) > $_SESSION['polling_time'])
		$_SESSION['polling_time'] = round(microtime(true) * 1000) + 60000 * 2;
	
	if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
		if (isset($_SESSION['N_O_M']) && isset($_SESSION['polling_time'])) {
			if (getNumberOfMessages($_SESSION['username']) == $_SESSION['N_O_M']) {
				echo '{"code" : 1,
					  "polling_time" : '.$_SESSION['polling_time'].'
					  }';
			} else {
				$sql = "SELECT U.name,U.surname,M.text_message FROM user U, message M 
						WHERE 
						U.id=M.sender_id 
						AND  
						receiver_id=:id 
						ORDER BY date_time desc LIMIT 1";
				$run = $dbh->prepare($sql);
				$run->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
				$run->execute();
				$fullMessage = '';
				while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
					$fullMessage = $row['name'];
					$fullMessage = $fullMessage." ";
					$fullMessage = $fullMessage.$row['surname'];
					$fullMessage = $fullMessage."<br>";
					$fullMessage = $fullMessage.$row['text_message'];
				}
				
				$_SESSION['N_O_M'] = getNumberOfMessages($_SESSION['username']);
				
				echo '{"code" : "'.$fullMessage.'",
					   "polling_time" :'.$_SESSION['polling_time'].'
					 }';
			}
			$sql = "UPDATE login_history SET logout_date_time=? WHERE id=?";
			$stmt = $dbh->prepare($sql);
			$stmt->execute([date('Y/m/d H:i:s'), $_SESSION['L_L_H']]);
		} else {
			echo '{"code" : 1,
				   "polling_time" :0
				  }';
		}
	} else {
	   echo '{"code" : 2,
		 "polling_time" :'.$_SESSION["polling_time"].'
		 }';
	}
} else {
   echo '{"code" : 2,
	  "polling_time" :'.$_SESSION["polling_time"].'
	 }';
}

?>

