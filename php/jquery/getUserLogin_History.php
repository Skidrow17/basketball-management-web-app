<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['current_page']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $page = $_POST['current_page'] * 7;
        echo'<tr>
			<tr>
			<th>';echo $loginTimeStamp; echo'</th>
			<th>';echo $logoutTimeStamp; echo'</th>
			<th>';echo $loginDevice; echo'</th>
			<th>IP</th>';
        $sql = "SELECT LH.login_date_time,LH.logout_date_time,LH.safe_key,LH.ip,LH.device_name from user U,login_history LH where U.id=LH.user_id AND user_id = :uid ORDER BY LH.login_date_time desc limit :page,7";
        $run = $dbh->prepare($sql);
        $run->bindParam(':page', $page, PDO::PARAM_INT);
		$run->bindParam(':uid', $_SESSION['user_id'], PDO::PARAM_INT);
        $run->execute();
		echo "<table id='here'>";
					
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['login_date_time'] . "</td>";
            echo "<td>" . $row['logout_date_time'] . "</td>";
            echo "<td>" . $row['device_name'] . "</td>";
            echo "<td>" . $row['ip'] . "</td>";
            echo "</tr>";
        }
		echo "</table>";
		
    } else {
        session_destroy();
        echo 401;
    }
}
?>

