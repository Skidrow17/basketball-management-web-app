<?php

//Access: Authorized User
//Purpose: import restriction on the system

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['submit'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
		
		$comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
		$match_week = date("W", strtotime($_POST['date']));
		$match_year = date("Y", strtotime($_POST['date']));
		$sql = "SELECT COUNT(*) as nor FROM human_power HP,game G WHERE G.Id = HP.game_id AND Week(G.date_time,1) = ? AND Year(G.date_time) = ?";
        $run = $dbh->prepare($sql);
        $run->execute([$match_week,$match_year]);
		$restrictions_closed = false;
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
          if($row['nor'] != 0){
			  $restrictions_closed = true;
		  }
        }
        if (strtotime($_POST["time_to"]) <= strtotime($_POST['time_from'])){
			$_SESSION['server_response'] = $wrongTime;
			header('Location: ../../add_restriction.php');
		}else if(!$restrictions_closed){
			$newDate = str_replace("/", "-", $_POST['date']);
            $sql = "INSERT INTO `restriction`(`user_id`, `date`, `time_from` , `time_to`,`comment` ) VALUES (:user_id,:date,:time_from,:time_to,:comment)";
			$run = $dbh->prepare($sql);
			$run->bindParam(':user_id', $_SESSION["user_id"], PDO::PARAM_INT);
			$run->bindParam(':date', $newDate, PDO::PARAM_STR);
			$run->bindParam(':time_from', $_POST["time_from"], PDO::PARAM_STR);
			$run->bindParam(':time_to', $_POST["time_to"], PDO::PARAM_STR);
			$run->bindParam(':comment', $comment, PDO::PARAM_STR);
			$run->execute();
			$_SESSION['server_response'] = $success;
			header('Location: ../../add_restriction.php');
			die();
		}else{
			$_SESSION['server_response'] = $restriction_lock;
			header('Location: ../../add_restriction.php');
			die();
		}
    } else {
        session_destroy();
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../add_restriction.php');
    die();
}