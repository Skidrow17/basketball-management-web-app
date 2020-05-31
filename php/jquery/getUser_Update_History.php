<?php

//Access: Admin
//Purpose: retrieves all user update history

session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id']) && isset($_POST['current_page'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $page = $_POST['current_page'] * 9;
        echo "<tr>";
        echo "<th>";echo $name; echo"</th>";
        echo "<th>";echo $surname; echo"</th>";
        echo "<th>";echo $password; echo"</th>";
        echo "<th>";echo $email; echo"</th>";
        echo "<th>";echo $phone; echo"</th>";
        echo "<th>";echo $drivingLicence; echo"</th>";
        echo "<th>";echo $livingPlace; echo"</th>";
        echo "<th>";echo $profession; echo"</th>";
        echo "<th>";echo $profileImage; echo"</th>";
        echo "<th>";echo $accountState; echo"</th>";
        echo "<th>";echo $rating; echo"</th>";
        echo "<th>";echo $updateDate; echo"</th>";
        echo "</tr>";

        $sql = "SELECT H.name,H.surname,H.password,H.email,H.phone,if(H.driving_licence = 0, '".$yes."', '".$no."') as driving_licence,C.name as living_place,P.name as profession,H.profile_pic,if(H.active = 0, '".$active."', '".$inactive."') as active,R.name as rate,DATE_FORMAT(H.update_time, '%d/%m/%Y %H:%i') as update_time_diff_format
				FROM user_update_history H,rate R,city C,user_categories P
                WHERE H.rate = R.id AND C.id = H.living_place AND P.id = H.profession AND update_time > :date_from
				ORDER BY update_time desc limit :page,9";
        $run = $dbh->prepare($sql);
        $run->bindParam(':page', $page, PDO::PARAM_INT);
        $run->bindParam(':date_from',$_POST['date_from'],PDO::PARAM_STR);
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
            echo "<td>" . $row['update_time_diff_format'] . "</td>";
            echo "</tr>";
        }
        echo $_POST['date_from'];
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}
?>

