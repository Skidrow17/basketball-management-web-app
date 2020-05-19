<?php

//Access: Admin
//Purpose: retrieves All restrictions of all users

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['current_page']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $page = $_POST['current_page'] * 9;
        echo "<tr>";
        echo "<th>";echo $name; echo"</th>";
        echo "<th>";echo $surname;echo "</th>";
        echo "<th>";echo $from;echo "</th>";
        echo "<th>";echo $to;echo "</th>";
        echo "<th>";echo $date;echo "</th>";
        echo "<th>";echo $importingDate;echo "</th>";
        echo "<th>";echo $importingTime;echo "</th>";
        echo "</tr>";
        $sql = "SELECT U.name,U.surname,R.time_from,R.time_to,DATE_FORMAT(R.date, '%d/%m/%Y %H:%i') as date,R.register_timestamp from user U,restriction R where U.id=R.user_id and register_timestamp > :date_from ORDER BY R.register_timestamp desc limit :page,9";
        $run = $dbh->prepare($sql);
        $run->bindParam(':date_from',$_POST['date_from'],PDO::PARAM_STR);
        $run->bindParam(':page', $page, PDO::PARAM_INT);
        $run->execute();
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['surname'] . "</td>";
            echo "<td>" . $row['time_from'] . "</td>";
            echo "<td>" . $row['time_to'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            $splitTimeStamp = explode(" ", $row['register_timestamp']);
            $date = $splitTimeStamp[0];
            $time = $splitTimeStamp[1];
            echo "<td>" . $date . "</td>";
            echo "<td>" . $time . "</td>";
            echo "</tr>";
        }
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}
?>

