<?php
require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();
if (isset($_POST['cid']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $cid = $_POST['cid'];
        $sql = "Select count(*) as n_o_r from game g,team T,human_power HP where g.id=HP.game_id AND HP.user_id=:uid AND g.team_id_1=T.id AND T.category=:cid ";
        $run = $dbh->prepare($sql);
        $run->bindParam(':cid', $cid, PDO::PARAM_INT);
        $run->bindParam(':uid', $_SESSION['user_id'], PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo $row['n_o_r'] / 4;
        }
    } else {
        session_destroy();
		echo 401;
    }
}
?>

