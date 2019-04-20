<?php 
//Access: Admin
//Purpose: Registers a new user to the system

require_once("./php/session_admin.php");
require("http_to_https.php");
require 'php/useful_functions.php';
require 'php/select_boxes.php';
?>

<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ΕΚΑΣΔΥΜ - Δημιουργία Λογαριασμού</title>
	<?php include('head.php'); ?>
</head>



<body>
    <main class="page lanidng-page">
        <section class="portfolio-block photography"></section>
    </main>
    <div></div>
    <div></div>
    <?php include('admin_nav_bar.php'); ?>
    <div class="admin-look">
        <form method="post" action="./php/insert/insert_user.php" enctype="multipart/form-data">
         
		    <div class="form-row">
                <div class="col">
                    <h3>Φόρμα Εγγραφής Μέλους</h3>
                </div>
            </div>
			
		 <div class="form-row">
                <div class="col">
                    <hr>
                </div>
            </div>
			
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">Όνομα</small><input required name="name" class="form-control" type="text"></div>
                <div class="col"><small class="form-text text-muted">Επώνυμο</small><input required name="surname" class="form-control" type="text"></div>
            </div>
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">Όνομα χρήστη</small><input required name="username" class="form-control" type="text"></div>
                <div class="col"><small class="form-text text-muted">Κωδικός</small><input required  name="password" class="form-control" type="text"></div>
            </div>
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">Email</small><input requiredv name="email" class="form-control" type="text"></div>
                <div class="col"><small class="form-text text-muted">Αριθμός κινητού</small><input required name="phone" class="form-control" type="text"></div>
            </div>
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">Τόπος διαμονής</small><?php echo getAllCities();?></div>
                <div
                    class="col"><small class="form-text text-muted">Αξιολόγηση</small><?php echo getAllRates();?></div>
    </div>
    <div class="form-row">
        <div class="col"><small class="form-text text-muted">Δίπλωμα οδήγησης</small><?php echo getDrivingLicence(1);?></div>
        <div
            <div class="col"><small class="form-text text-muted">Ειδικότητα</small><?php echo getAllUser_categories();?></div>
    </div>
    <div class="form-row">
        <div class="col"><small class="form-text text-muted">Φωτογραφία Χρήστη</small><input required name="profile_pic" class="col-xl-12" type="file" /></div>
        <div class="col"><small class="form-text text-muted">Κατηγορίες που μπορεί να παίξει</small><?php echo getAllPlayableCategories();?></div>
    </div>
    <div class="form-row"><div class="col-xl-12"><button name="submit" class="btn btn-primary btn-lg col-xl-12" style="width:" type="submit" style="width:290px;">Υποβολή</button></div></div>
    </form>
    </div>

	
		  
	<?php include('footer.php'); ?>
    
		
    
</body>

</html>