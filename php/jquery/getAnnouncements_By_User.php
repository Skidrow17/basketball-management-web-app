<?php
require_once '../connect_db.php';
require_once '../useful_functions.php';
session_start();
if (isset($_POST['current_page']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $uid = filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT);
        $page = $_POST['current_page'];
        $sql = "SELECT U.name,U.surname,A.id,A.title,A.text,A.date_time from announcement A , user U where A.user_id=U.id AND U.id=:uid order by date_time desc limit :cp,1 ";
        $run = $dbh->prepare($sql);
        $run->bindParam(':cp', $page, PDO::PARAM_INT);
        $run->bindParam(':uid', $uid, PDO::PARAM_INT);
        $run->execute();
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo "
   
			<div style='background-color:#FFF7C8;  border: 1px solid #888; '>
			<div class='container'>
            <div style='word-wrap:break-word' class='col-xl-12' ><h3 contenteditable='true' id='u_title' >";
            echo $row['title'];
            echo "</h3></div>
                 <div style='word-wrap:break-word' class='col-xl-12'><hr><small class='form-text text-muted'>Συντάκτης : ";
            echo $row['name'];
            echo " ";
            echo $row['surname'];
            echo "</small><small class='form-text text-muted'>Ημερομηνία : ";
            echo $row['date_time'];
            echo "</small></div>
                 <div style='word-wrap:break-word' class='col-xl-12'><hr><textarea id='message' style='resize:none;' rows='7' class='form-control' style='color:rgb(0,0,0);'>";
            echo $row['text'];
            echo "</textarea></div>
			     </div>			 
			</div>";
            if ($_SESSION['profession'] === 'Admin') {
                echo " <div class='form-row'>
				 <div class='col'><div class='form-group'><button id='back1' class='btn btn-primary btn-block' type='button'>Πίσω</button></div></div>
				 <div class='col'><div class='form-group'><button id='modify' value=" . $row['id'] . " class='btn btn-primary btn-block' type='button'>Αποθήκευση Αλλαγών</button></div></div>
				 <div class='col'><div class='form-group'><button id='delete' value=" . $row['id'] . " class='btn btn-primary btn-block' type='button'>Διαγραφή</button></div></div>
				 </div>";
            } else {
                echo "<div class='form-row'>
				 <div class='col'><div class='form-group'><button id='modify' value=" . $row['id'] . " class='btn btn-primary btn-block' type='button'>Αποθήκευση Αλλαγών</button></div></div>
				 <div class='col'><div class='form-group'><button id='delete' value=" . $row['id'] . " class='btn btn-primary btn-block' type='button'>Διαγραφή</button></div></div>
			</div>";
            }
        }
    } else {
        session_destroy();
		echo 401;
    }
}
?>

