<?php

//Access: Admin
//Purpose: retrieves  number of the referes and judges assigned to specific match

require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();
if (isset($_POST['game_id']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $sql = "Select count(*) as n_o_r from human_power hp where hp.game_id=:gid";
        $run = $dbh->prepare($sql);
        $run->bindParam(':gid', $_POST['game_id'], PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo $row['n_o_r'] / 3;
        }
    } else {
        session_destroy();
		header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
    }
}
?>

