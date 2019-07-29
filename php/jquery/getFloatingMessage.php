<?php
require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();
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
        $rf;
        $jg;
        $rr;
        $rj;
        $flag = 0;
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            $rf = $row['rf'];
            $jg = $row['jg'];
            $rr = $row['required_referees'];
            $rj = $row['required_judges'];
        }
        if (($rr - $rf) > 1) echo "Χρειάζονται ακόμα ";
        else echo "Χρειάζεται ακόμα ";
        if ($rr != $rf) {
            echo $rr - $rf;
            if (($rr - $rf) > 1) echo " διαιτητές";
            else echo " διαιτητής";
            $flag = 1;
        }
        if ($jg != $rj) {
            if ($flag == 1) echo " και ";
            echo $rj - $jg;
            if (($rj - $jg) > 1) echo " κριτές";
            else echo " κριτής";
        }
    } else {
        session_destroy();
        echo 401;
    }
}
?>

