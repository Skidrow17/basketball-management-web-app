<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../select_boxes.php';
require_once '../language.php';

if (isset($_POST['current_page']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $page = $_POST['current_page'];
        $sql = "SELECT 
		home.name AS team_id_1, 
		away.name AS team_id_2,r.id,r.team_score_1,r.team_score_2,r.date_time,c.latitude,c.longitude
		FROM 
		game AS r
		JOIN team AS home 
		ON r.team_id_1 = home.id
		JOIN team AS away 
		ON r.team_id_2 = away.id , court c , human_power HP 
		WHERE C.id=r.court_id AND yearweek(r.date_time,1) = yearweek(curdate(),1)
		AND HP.game_id=r.id AND HP.user_id=:id order by date_time desc limit :page,1";
        $run = $dbh->prepare($sql);
        $run->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
        $run->bindParam(':page', $page, PDO::PARAM_INT);
        $run->execute();
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            $converted = date('d M Y h.i.s A', strtotime($row['date_time']));
            $reversed = date('d-m-Y H.i.s', strtotime($converted));
            echo " 				  
				  
				  <div class='form-row'>
				    <div class='col'> <li class='list-group-item' style='text-align: center;color:#000000;background-color:#ffffff;'>" . $reversed . "</div>
			    </div>
				  
				  <div class='form-row'>
                <div class='col'>
                    <hr>
                </div>
				</div>
				 
				  <div class='form-row'>
				
				   <div class='col'> <li class='list-group-item' style='color:#ffffff;background-color:#dc6e56;'>";echo $team; echo" 1 : " . $row['team_id_1'] . "</div>
				
					</div>
					
					<div class='form-row'>
				   <div class='col'> <li class='list-group-item' style='color:#ffffff;background-color:#dc6e56;'>";echo $score; echo" 1 : " . $row['team_score_1'] . "</div>
				  <div class='col'> <li class='list-group-item' style='color:#000000;background-color:#ffffff;'>";echo $score; echo" 2 : " . $row['team_score_2'] . "</div>
					</div>
					
					
					<div class='form-row'>
				  <div class='col'> <li class='list-group-item' style='color:#000000;background-color:#ffffff;'>";echo $team; echo" 2 : " . $row['team_id_2'] . "</div>
					</div>
					
			   <div class='form-row'>
                <div class='col'>
                    <hr>
                </div>
				</div>
				
				
				<div class='form-row'>
				  <div class='col'> <li class='list-group-item' style='color:#000000;background-color:#ffffff;'>";
            echo getHuman_Power_By_Game1($row['id']);
            echo "</div>
				</div>
				
				 
				
				
            </div>
					
                    ";
            echo "
				  <div class='form-row'>
				  <div class='col'><button class='btn btn-primary col' id='score' name='button' value='" . $row['id'] . "' type='button'>";echo $changeScore; echo"</button></div>
				  </div>
				  ";
        }
    } else {
        session_destroy();
		echo 401;
    }
}
?>

