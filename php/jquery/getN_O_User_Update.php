<?php

//Access: Admin
//Purpose: retrieves number of user update records for all user

require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();
if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $sql2 = "SELECT count(*) as n_o_p FROM user_update_history";
        $result = $dbh->prepare($sql2);
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo $row['n_o_p'] / 9;
        }
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
    }
}
?>

