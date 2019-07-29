<?php
require_once '../connect_db.php';
require '../useful_functions.php';
session_start();
if (isset($_POST['submit'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $counter = 0;
        $id = filter_var($_POST['matches'], FILTER_SANITIZE_NUMBER_INT);
        $human_power = $_POST['human_power'];
        if (!empty($human_power)) {
            for ($i = 0;$i < count($human_power);$i++) {
                $sql = "INSERT INTO `human_power`(`game_id`, `user_id`) VALUES (?,?)";
                $r = $dbh->prepare($sql);
                $r->execute([$id, $human_power[$i]]);
                if ($r->rowCount() > 0) $counter = $counter + 1;
            }
        }
        if ($counter > 0) {
            $_SESSION['server_response'] = 'Eπιτυχία';
            header('Location: ../../match_referee.php');
            die();
        } else {
            $_SESSION['server_response'] = 'Αποτυχία';
            header('Location: ../../match_referee.php');
            die();
        }
    } else {
        session_destroy();
        $_SESSION['server_response'] = 'Login απο άλλη συσκευή';
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../match_referee.php');
    die();
}
?>

