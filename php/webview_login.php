<?php
require 'connect_db.php';
require 'useful_functions.php';
session_start();
 
if (isset($_POST['password']) && isset($_POST['username']) && isset($_POST['safe_key'])) {
	$cookie_time = time() + 60 * 60 * 60;
    $username = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['username']);
    $password = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['password']);
    $safe_key = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['safe_key']);
    
	$sql = "SELECT U.language,U.polling_time,U.id,U.username,U.password,U.name,U.surname,U.email,U.phone,U.profile_pic,U.active,U_C.name as profession 
			FROM user U , user_categories U_C 
			WHERE U.profession = U_C.id 
			AND U.username=:username";
    
	$run = $dbh->prepare($sql);
    $run->bindParam(':username', $username, PDO::PARAM_STR);
    $run->execute();
    if ($run->rowCount() > 0) {
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            if ((preg_replace('/[^\p{L}\p{N}\s]/u', '', $row['password']) === preg_replace('/[^\p{L}\p{N}\s]/u', '', $password))) {
				$_SESSION['polling_mins'] = $row['polling_time'];
				$_SESSION['polling_time'] = round(microtime(true) * 1000) + 60000 * $_SESSION['polling_mins'];
				$_SESSION['language'] = $row['language'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['surname'] = $row['surname'];
                $_SESSION['profile_pic'] = $row['profile_pic'];
                $_SESSION['safe_key'] = $safe_key;
                $_SESSION['profession'] = $row['profession'];
                $_SESSION['N_O_M'] = getNumberOfMessages($row['username']);
                $_SESSION['L_L_H'] = getLastLoginHistoryId($row['id']);
				setcookie("uname", $_POST['username'], $cookie_time, '/');
                setcookie("pwd", $_POST['password'], $cookie_time, '/');
                setcookie("safe_key", $_POST['safe_key'], $cookie_time, '/');
                header('Location: ../home_admin.php');
            }
        }
    }
}
?>
