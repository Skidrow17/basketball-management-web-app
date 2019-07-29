<?php
require_once '../connect_db.php';
require '../useful_functions.php';
session_start();
if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $sql = "Select count(*) as n_o_r from restriction R where user_id=:uid";
        $run = $dbh->prepare($sql);
        $run->bindParam(':uid', $_SESSION['user_id'], PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo $row['n_o_r'] / 7;
        }
    } else {
        session_destroy();
		echo 401;
    }
}
?>

