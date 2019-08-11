<?php
require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();
if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $sql2 = "SELECT count(*) as n_o_p FROM login_history WHERE user_id = :uid";
        $result = $dbh->prepare($sql2);
		$result->bindParam(':uid', $_SESSION['user_id'], PDO::PARAM_INT);
        $result->execute();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo $row['n_o_p'] / 7;
        }
    } else {
        session_destroy();
        echo 401;
    }
}
?>