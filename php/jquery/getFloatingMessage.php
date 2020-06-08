<?php

//Access: Admin
//Purpose: Floating message exposing how many referees or judges the match requires 

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['game_id']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $id = $_POST['game_id'];
        $sql = "SELECT get_current_referee_by_game(id) as rf ,
					   get_current_judge_by_game(id) as jg,required_referees,
					   required_judges
					   FROM game WHERE id = :game_id";
        $run = $dbh->prepare($sql);
        $run->bindParam(':game_id', $id, PDO::PARAM_INT);
        $run->execute();
        $current_referees = 0;
        $current_judges = 0;
        $required_referees = 0;
        $required_judges = 0;
        $flag = 0;
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            $current_referees = $row['rf'];
            $current_judges = $row['jg'];
            $required_referees = $row['required_referees'];
            $required_judges = $row['required_judges'];
        }
        if (($required_referees - $current_referees) > 1) echo $needMore;
        else echo $needOneMore;
        if ($required_referees != $current_referees) {
            echo $required_referees - $current_referees;
            if (($required_referees - $current_referees) > 1) echo $referees;
            else echo $referee;
            $flag = 1;
        }
        if ($current_judges != $required_judges) {
            if ($flag == 1) echo $and;
            echo $required_judges - $current_judges;
            if (($required_judges - $current_judges) > 1) echo $judges;
            else echo $judge;
        }
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}
?>

