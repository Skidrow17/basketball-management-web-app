<?php

require_once 'connect_db.php';
require_once 'select_boxes.php';
require_once 'useful_functions.php';
session_start();

if(security_check($_SESSION['safe_key'],$_SESSION['user_id'])==true)
{
	$sql="Select U.profile_pic ,U.id , U.username , U.password, U.name,U.surname,U.email,U.phone,U.driving_licence,U.living_place,U.profession,U.active,U.rate from user U where U.id=:user_id";
	$run =$dbh->prepare($sql);
	$run->bindParam(':user_id', $_GET['q'], PDO::PARAM_INT);       
	$run ->execute();
	
	
	
	while($row=$run->fetch(PDO::FETCH_ASSOC)){
	

	        echo '<div class="form-row">';
	        echo '<div class="col-xl-12"><small class="form-text text-muted">Κατάσταση</small>';
			echo getStates($row['active']);
			echo '</div>
            
			</div>
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">Όνομα</small><input class="form-control" name="name" value="'.$row['name'].'" type="text"></div>
                <div class="col"><small class="form-text text-muted">Επώνυμο</small><input class="form-control" name="surname" value="'.$row['surname'].'" type="text"></div>
            </div>
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">Όνομα χρήστη</small><input class="form-control" name="username" value="'.$row['username'].'" type="text" autocomplete="off"></div>
                <div class="col"><small class="form-text text-muted">Κωδικός</small><input class="form-control" placeholder="Νέος Κωδικός" name="password" type="password" autocomplete="off"></div>
            </div>
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">Email</small><input class="form-control" name="email" value="'.$row['email'].'" type="email"></div>
                <div class="col"><small class="form-text text-muted">Αριθμός κινητού</small><input class="form-control" name="phone" value="'.$row['phone'].'" type="text"></div>
            </div>
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">Τόπος διαμονής</small>';
				echo getLivingPlace($row['living_place']);
				echo'</div>
                <div class="col"><small class="form-text text-muted">Αξιολόγηση</small>';
				echo getRate($row['rate']);
				echo '</select></div>
    </div>
    <div class="form-row">
        <div class="col-xl-6"><small class="form-text text-muted">Δίπλωμα οδήγησης</small>';
		
		echo getDrivingLicence($row['driving_licence']);
		
		echo '</div>
        <div
            <div class="col-xl-6"><small class="form-text text-muted">Ειδικότητα</small>';
			
			echo getUserCategory($row['profession']);
			
	

			echo '</select></div>
    </div>
    <div class="form-row">
        <div class="col-xl-6"><small class="form-text text-muted">Φωτογραφία Χρήστη</small><input  name="profile_pic" id="profile_pic" value='. $row['profile_pic'] .' class="col-xl-12" type="file" /></div>
        <div class="col-xl-6"><small class="form-text text-muted">Κατηγορίες που μπορεί να παίξει</small>';
		
		echo getPlayableCategories($row['id']);
		
		echo '</div>
    </div>
    <div class="form-row">
	<div class="col-xl-12"><button class="btn btn-primary btn-lg" name="id" value=' . $row['id'] . ' style="width:100%" type="submit">Ανανέωση</button></div>
	</div> ';
	
	
	
	}

}


?>

