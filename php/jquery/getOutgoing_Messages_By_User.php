<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
include 'language.php';

if (isset($_POST['current_page']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
	 if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $page = $_POST['current_page'] * 4;
       echo '  <tr>
				  <th>';echo $name; echo '</th>
				  <th>';echo $surname; echo '</th>
				  <th>';echo $date; echo '</th>
				  <th>';echo $message; echo '</th>
				  <th>';echo $state; echo '</th>
				  <th>';echo $delete; echo '</th>
				  ';
        $sql = "SELECT M.id as message_id,M.message_read,U.name,U.surname,M.text_message,U.profile_pic,U.active,U.password,U.id,M.date_time FROM user U, message M where U.id=M.receiver_id AND sender_id=:id AND sender_delete=0 ORDER BY date_time desc limit :page,4";
        $run = $dbh->prepare($sql);
        $run->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
        $run->bindParam(':page', $page, PDO::PARAM_INT);
        $run->execute();
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
           echo'<tr>
				<td>' . $row['name'] . '</td>
				<td>' . $row['surname'] . '</td>
				<td>' . $row['date_time'] . '</td>
				<td>' . substr($row['text_message'], 0, 21) . '...' . '</td>
				';
            if ($row['message_read'] == 1) {
                echo '<td><button value=' . $row['message_id'] . ' id="delete_btn" type="button" class="btn" ><i class="fa fa-envelope-open"></i></button></td>';
            } else {
                echo '<td><button value=' . $row['message_id'] . ' id="delete_btn" type="button" class="btn" ><i class="fa fa-envelope"></i></button></td>';
            }
            echo '<td><button value=' . $row['message_id'] . ' id="message_delete" type="button" class="btn" ><i class="fa fa-trash"></i></i></button></td>';
            echo '</tr>';
        }
    } else {
        session_destroy();
		echo 401;
    }
}
?>

