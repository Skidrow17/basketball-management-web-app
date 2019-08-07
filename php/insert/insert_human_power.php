<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['submit']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
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
            $_SESSION['server_response'] = $success;
            header('Location: ../../match_referee.php');
            die();
        } else {
            $_SESSION['server_response'] = $fail;
            header('Location: ../../match_referee.php');
            die();
        }
    } else {
        session_destroy();
        $_SESSION['server_response'] = $loggedInFromAnotherDevice;
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../match_referee.php');
    die();
}
?>

