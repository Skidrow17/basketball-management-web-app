<?php

//Access: Authorized User
//Purpose: retrieves number of the received messages of the user

require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();
if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $uid = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $sql2 = "SELECT count(*) as n_o_p FROM message M WHERE M.receiver_id=:uid AND receiver_delete=0";
        $result = $dbh->prepare($sql2);
        $result->bindParam(':uid', $uid, PDO::PARAM_STR);
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo $row['n_o_p'] / 4;
        }
    } else {
        session_destroy();
		header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}

?>

