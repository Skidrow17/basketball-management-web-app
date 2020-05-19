<?php

//Access: Admin
//Purpose: retrieves the number of matches by category

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';

if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $sql2 = "SELECT count(*) as n_o_p FROM login_history WHERE login_date_time > :date_from";
        $result = $dbh->prepare($sql2);
        $result->bindParam(':date_from',$_POST['date_from'],PDO::PARAM_STR);
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo $row['n_o_p'] / 9;
        }
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}