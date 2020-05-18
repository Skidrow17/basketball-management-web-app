<?php
 
//Access: Admin & Authorized User
//Purpose: message notification that works with polling help

session_start();
require_once 'connect_db.php';
require_once 'useful_functions.php';
require_once 'language.php';

if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id']) && isset($_SESSION['polling_time'])) {
	
	if((round(microtime(true) * 1000)) > $_SESSION['polling_time'])
		$_SESSION['polling_time'] = round(microtime(true) * 1000) + 60000 * $_SESSION['polling_mins'];
	
	if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
		if (isset($_SESSION['N_O_M']) && isset($_SESSION['polling_time'])) {
			$numberOfMessagesInDB = getNumberOfMessages($_SESSION['username']);
			if ($numberOfMessagesInDB == $_SESSION['N_O_M']) {
				echo '{"code" : 1,
					  "polling_time" : '.$_SESSION['polling_time'].'
					  }';
			} elseif(( $numberOfMessagesInDB - $_SESSION['N_O_M']) == 1){
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
			}elseif(( $numberOfMessagesInDB - $_SESSION['N_O_M']) > 1){
				echo '{"code" : "'.($numberOfMessagesInDB - $_SESSION['N_O_M']).' '.$newMessages.'",
					   "polling_time" :'.$_SESSION['polling_time'].'
					 }';
				$_SESSION['N_O_M'] = $numberOfMessagesInDB;
			}
			$current_date_time = date('Y/m/d H:i:s');
			$last_login_history_id = $_SESSION['L_L_H'];
			$sql = "UPDATE login_history SET logout_date_time = :date_time WHERE id = :last_login_history_id";
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(':date_time',$current_date_time,PDO::PARAM_STR);
			$stmt->bindParam(':last_login_history_id',$last_login_history_id,PDO::PARAM_INT);
			$stmt->execute();
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
			"polling_time" : 0
		}';
}

?>

