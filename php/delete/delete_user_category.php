<?php
require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();
if (isset($_POST['user_id']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $id = filter_var($_POST['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "UPDATE user_categories SET active=1 where id = ?";
        $run = $dbh->prepare($sql);
        $run->execute([$id]);
        if ($run->rowCount() > 0) {
            if ($id !== "") $_SESSION['server_response'] = 'Διαγράφηκε με επιτυχία';
            else $_SESSION['server_response'] = 'Επιλέξτε Κατηγορία';
        } else {
            $_SESSION['server_response'] = 'Δεν Διαγράφηκε';
        }
    } else {
        session_destroy();
        echo 401;
    }
}
?>

