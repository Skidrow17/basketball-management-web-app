<?php
session_start();
require_once '../connect_db.php';
require_once '../select_boxes.php';
require_once '../useful_functions.php';
require_once('../language.php');

if (isset($_POST['cid']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $sql = "Select id,name,longitude,latitude,city from court where id=:cid";
        $run = $dbh->prepare($sql);
        $run->bindParam(':cid', $_POST["cid"], PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo '  
            <div class="form-row">
                <div class="col-xl-6"><small class="form-text text-muted">';echo $name; echo'</small><input name="name" class="form-control" value="' . $row['name'] . '" type="text"></div>
                <div class="col-xl-6"><small class="form-text text-muted">';echo $city; echo'</small>';
            echo getLivingPlace($row['city']);
            echo '</div>
            </div>
			<div class="form-row">
                <div class="col"><small class="form-text text-muted">Latitude</small><input class="form-control" id="lat" name="latitude" val="40.29111003227428" value="' . $row['latitude'] . '" type="text"></div>
                <div class="col"><small class="form-text text-muted">Longitude</small><input class="form-control" id="long" name="longitude" val="21.798052734375005" value="' . $row['longitude'] . '"type="text"></div>
            </div>
			
            ';
        }
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
    }
}
?>