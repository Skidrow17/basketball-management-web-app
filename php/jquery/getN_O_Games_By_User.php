<?php

//Access: Admin
//Purpose: retrieves the number of matches of logged user

require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();
if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT count(*) as n_o_r 
				FROM game g,team T,human_power HP WHERE
				g.id=HP.game_id 
				AND HP.user_id=:uid AND yearweek(g.date_time,1) = yearweek(curdate(),1)
				AND g.team_id_1=T.id";
        $run = $dbh->prepare($sql);
        $run->bindParam(':uid', $user_id, PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo $row['n_o_r'];
        }
    } else {
        session_destroy();
		header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}
?>

