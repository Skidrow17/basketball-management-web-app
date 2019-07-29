<?php
require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();
if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id']) && isset($_POST['current_page'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $page = $_POST['current_page'] * 9;
        echo "<tr>";
        echo "<th>Όνομα</th>";
        echo "<th>Επίθετο</th>";
        echo "<th>Κωδικός</th>";
        echo "<th>Εmail</th>";
        echo "<th>Κινητό</th>";
        echo "<th>Διπλωμα Οδηγησης</th>";
        echo "<th>Τοπος Κατηκίας</th>";
        echo "<th>Ιδιοτητα</th>";
        echo "<th>Εικόνα Προφιλ</th>";
        echo "<th>Κατασταση Λογαριασμού</th>";
        echo "<th>Αξιολόγιση</th>";
        echo "<th>Χρονος Αναβάθμησης</th>";
        echo "</tr>";
        $sql = "SELECT name,surname,password,email,phone,driving_licence,living_place,profession,profile_pic,active,rate,update_time 
				FROM user_update_history 
				ORDER BY update_time desc limit :page,9";
        $run = $dbh->prepare($sql);
        $run->bindParam(':page', $page, PDO::PARAM_INT);
        $run->execute();
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['surname'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['driving_licence'] . "</td>";
            echo "<td>" . $row['living_place'] . "</td>";
            echo "<td>" . $row['profession'] . "</td>";
            echo "<td>" . $row['profile_pic'] . "</td>";
            echo "<td>" . $row['active'] . "</td>";
            echo "<td>" . $row['rate'] . "</td>";
            echo "<td>" . $row['update_time'] . "</td>";
            echo "</tr>";
        }
    } else {
        session_destroy();
        echo 401;
    }
}
?>

