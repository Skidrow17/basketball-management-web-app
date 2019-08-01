<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';

if (isset($_POST['current_page']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if ((security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true)) {
        $page = $_POST['current_page'];
        $sql = "SELECT U.name,U.surname,A.title,A.text,A.date_time 
				FROM announcement A , user U 
				WHERE A.user_id=U.id ORDER BY date_time DESC limit :cp,1 ";
        $run = $dbh->prepare($sql);
        $run->bindParam(':cp', $page, PDO::PARAM_INT);
        $run->execute();
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='container'>
                 <div style='word-wrap:break-word' class='col-xl-12'><h3 style='font-stretch: expanded;resize:none;font-family: 'Impact', Charcoal, sans-serif;' class='text-center text-secondary'>";
            echo $row['title'];
            echo "</h3></div>
                 <div style='word-wrap:break-word' class='col-xl-12'><hr><small class='form-text text-muted'>Συντάκτης : ";
            echo $row['name'];
            echo " ";
            echo $row['surname'];
            echo "</small><small class='form-text text-muted'>Ημερομηνία : ";
            echo $row['date_time'];
            echo "</small></div>
                 <div style='word-wrap:break-word' class='col-xl-12'><hr><textarea style='resize:none;' rows='10' class='form-control' style='color:rgb(0,0,0);'readonly> ";
            echo $row['text'];
            echo "</textarea></div>
			     </div>";
        }
    } else {
		session_destroy();
        echo 401;
    }
}
?>

