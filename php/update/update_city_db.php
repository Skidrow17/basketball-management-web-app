<?php
require_once '../connect_db.php';
require '../useful_functions.php';
session_start();
if (isset($_POST['city_name']) && isset($_POST['city'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $name = filter_var($_POST['city_name'], FILTER_SANITIZE_STRING);
        $id = filter_var($_POST['city'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "UPDATE city SET name=? where id = ?";
        $run = $dbh->prepare($sql);
        echo $sql;
        $run->execute([$name, $id]);
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = 'Ανανεώθηκε με επιτυχία';
            header('Location: ../../update_general_info.php?id=1');
            die();
        } else {
            $_SESSION['server_response'] = 'Δεν Ανανεώθηκε';
            header('Location: ../../update_general_info.php?id=1');
            die();
        }
    } else {
        $_SESSION['server_response'] = 'Login απο άλλη συσκευή';
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../update_general_info.php?id=1');
    die();
}
?>

