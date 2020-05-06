<?php

//Access: Authorized User & Admin
//Purpose: updates settings like langueage and polling time

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['language']) && isset($_POST['pollingTime'])
	&& isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $language = filter_var($_POST['language'], FILTER_SANITIZE_STRING);
        $pollingTime = filter_var($_POST['pollingTime'], FILTER_SANITIZE_NUMBER_INT);
		$user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
		
		echo $language;
		echo $pollingTime;
		
        $sql = "UPDATE user SET polling_time = ?,language = ? where id = ?";
        $run = $dbh->prepare($sql);
        echo $sql;
        $run->execute([$pollingTime, $language, $user_id]);
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = $success;
            header('Location: ../login.php');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
            header('Location: ../login.php');
            die();
        }
    } else {
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
}
?>

