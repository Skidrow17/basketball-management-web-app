<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_POST['game_id']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $gid = filter_var($_POST['game_id'], FILTER_SANITIZE_NUMBER_INT);
        $sql = "SELECT distinct
		home.name AS team_id_1, 
		away.name AS team_id_2,r.id,r.state,r.team_score_1,r.team_score_2,r.date_time,c.latitude,c.longitude
		FROM 
		game AS r
		JOIN team AS home 
		ON r.team_id_1 = home.id
		JOIN team AS away 
		ON r.team_id_2 = away.id , court c , human_power HP where C.id=r.court_id AND HP.game_id=r.id AND r.id=:gid";
        $run = $dbh->prepare($sql);
        $run->bindParam(':gid', $gid, PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo ' 
		<div class="form-row">
		<div class="col-sm-2"><button class="btn btn-primary btn-block" id="back3" type="button">'; echo $back; echo '</button></div></div>
		</div>		
			 <div class="form-row">
                <div class="col">
                    <hr>
                </div>
            </div>
		<div class="form-row">
        <div class="col"><small class="form-text text-muted">'; echo $matchState; echo'</small> 
				 <class = "col"><select name="state" class="mdb-select md-form">';
				 
				 if($row['state'] == 1){
					echo '<option value="1" checked>'.$period1.'</option>';
				 }else if($row['state'] == 2){
					echo '<option value="2" checked>'.$period2.'</option>';		  
				 }else if($row['state'] == 3){
					echo '<option value="3" checked>'.$period3.'</option>';		  
				 }else if($row['state'] == 4){
					echo '<option value="4" checked>'.$period4.'</option>';		  
				 }else if($row['state'] == 5){
					echo '<option value="5" checked>'.$final.'</option>';		  
				 }
				 
				 if($row['state'] != 1){
					echo '<option value="1" checked>'.$period1.'</option>';
				 }
				 if($row['state'] != 2){
					echo '<option value="2" checked>'.$period2.'</option>';		  
				 }
				 if($row['state'] != 3){
					echo '<option value="3" checked>'.$period3.'</option>';		  
				 }
				 if($row['state'] != 4){
					echo '<option value="4" checked>'.$period4.'</option>';		  
				 }
				 if($row['state'] != 5){
					echo '<option value="5" checked>'.$final.'</option>';		  
				 }
				  
				echo '</select>
			<small class="form-text text-muted">' . $row['team_id_1'] . '</small></div>
		</div>
		<div class="form-group"><input class="form-control" name="team_score_1" value=' . $row['team_score_1'] . ' type="number"></div>
		<div class="form-row">
			<div class="col"><small class="form-text text-muted"  style="color:rgb(220,64,29);">' . $row['team_id_2'] . '</small></div>
		</div>
		<div class="form-row">
			<div class="col"><input name="team_score_2" class="form-control" value=' . $row['team_score_2'] . ' type="number"></div>
		</div>
		<div class="form-group"><button class="btn btn-primary btn-block" type="submit" name="game_id" value="' . $row['id'] . '">'; echo $addButton; echo '</button>';
        }
    } else {
        session_destroy();
		header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
    }
}
?>

