<?php
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../labels_en.php';
session_start();
if (isset($_POST['current_page']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $page = $_POST['current_page'] * 9;
        echo'<tr>
			<tr>
			<th>';echo $name; echo'</th>
			<th>';echo $surname; echo'</th>
			<th>';echo $loginTimeStamp; echo'</th>
			<th>';echo $logoutTimeStamp; echo'</th>
			<th>';echo $safeKey; echo'</th>
			<th>';echo $loginDevice; echo'</th>
			<th>IP</th>';
        $sql = "SELECT U.name,U.surname,LH.login_date_time,LH.logout_date_time,LH.safe_key,LH.ip,LH.device_name from user U,login_history LH where U.id=LH.user_id ORDER BY LH.login_date_time desc limit :page,9";
        $run = $dbh->prepare($sql);
        $run->bindParam(':page', $page, PDO::PARAM_INT);
        $run->execute();
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['surname'] . "</td>";
            echo "<td>" . $row['login_date_time'] . "</td>";
            echo "<td>" . $row['logout_date_time'] . "</td>";
            echo "<td>" . $row['safe_key'] . "</td>";
            echo "<td>" . $row['device_name'] . "</td>";
            echo "<td>" . $row['ip'] . "</td>";
            echo "</tr>";
        }
    } else {
        session_destroy();
        echo 401;
    }
}
?>

