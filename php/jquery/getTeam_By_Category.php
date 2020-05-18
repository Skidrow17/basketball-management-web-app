<?php

//Access: Authorized User & Admin
//Purpose: retrieves teams by category

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['cid']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
	if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $sql = "Select id,name from team where category=:cid and active = 0";
        $run = $dbh->prepare($sql);
        $run->bindParam(':cid', $_POST['cid'], PDO::PARAM_INT);
        $run->execute();
        echo "<option selected value=''>";echo $selectTeam; echo"</option>";
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
    } else {
        session_destroy();
		header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}
?>

