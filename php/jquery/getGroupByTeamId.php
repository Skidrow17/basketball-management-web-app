<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if ((security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true)) {
        
        $sql = "SELECT team_group FROM team WHERE id = :tid";
        $lid = $dbh->prepare($sql);
        $lid->bindParam(':tid', $_POST["tid"], PDO::PARAM_INT);
        $lid->execute();

        while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
            echo $row['team_group'];         
        }
          
    } else {
		session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
    }
}
?>

