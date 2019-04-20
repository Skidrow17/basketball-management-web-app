<?php 
//Access: Admin
//Purpose: Update, Delete information about teams , team categories , city and user categories

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
    <title>ΕΚΑΣΔΥΜ - Ανανέωση Γενικών Πληροφοριών</title>
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
	
<?php if(isset($_GET['id'])){ if($_GET['id']==1) { 
echo'
<form method="post" action="./php/update/update_city_db.php">
    
		    <div class="form-row">
                <div class="col">
                    <h3>Πόλη</h3>
                </div>
            </div>
			
		 <div class="form-row">
                <div class="col">
                    <hr>
                </div>
            </div>
    <div class="form-row">
        <div class="col"><small class="form-text text-muted">Επιλογή Πόλης</small>';echo getAllCities();echo '</div>
        <div class="col"><small class="form-text text-muted">Όνομα</small><input name="city_name" id="city_name" class="form-control" type="text"></div>
	</div>
	<div class="form-row">
        <div class="col"><button class="btn btn-primary" type="submit" style="width:100%">Ανανέωση</button></div>
		<div class="col"><button class="btn btn-primary" type="button" id="delete_city" style="width:100%">Διαγραφή</button></div>
    </div>
</form>
';
}elseif($_GET['id']==2){

echo'
<form method="post" action="./php/update/update_team_category_db.php">
    
		    <div class="form-row">
                <div class="col">
                    <h3>Κατηγορία Ομάδας</h3>
                </div>
            </div>
			
		 <div class="form-row">
                <div class="col">
                    <hr>
                </div>
            </div>
    <div class="form-row">
        <div class="col"><small class="form-text text-muted">Επιλογή Κατηγορίας</small>';echo getAllTeam_categories(); echo'</div>
        <div class="col"><small class="form-text text-muted">Όνομα</small><input name="team_category_name" id="team_category_name" class="form-control" type="text"></div>
	</div>
    <div class="form-row">
        <div class="col"><button class="btn btn-primary" type="submit" style="width:100%">Ανανέωση</button></div>
		<div class="col"><button class="btn btn-primary" type="button" id="delete_category" style="width:100%">Διαγραφή</button></div>
    </div>
</form>
';
}elseif($_GET['id']==3){
echo'
<form method="post" action="./php/update/update_user_category_db.php">
    
		    <div class="form-row">
                <div class="col">
                    <h3>Κατηγορία Χρήστη</h3>
                </div>
            </div>
			
		 <div class="form-row">
                <div class="col">
                    <hr>
                </div>
            </div>
    <div class="form-row">
        <div class="col"><small class="form-text text-muted">Επιλογή Κατηγορίας</small>';echo getUserCategory(0);echo'</div>
        <div class="col"><small class="form-text text-muted">Όνομα</small><input name="user_category_name" id="user_category_name" class="form-control" type="text"></div>
	</div>
    <div class="form-row">
        <div class="col"><button class="btn btn-primary" type="submit" style="width:100%">Ανανέωση</button></div>
		<div class="col"><button class="btn btn-primary" type="button" id="delete_user_category" style="width:100%">Διαγραφή</button></div>
    </div>
</form>

';
}elseif($_GET['id']==4){
	echo'
<form method="post" action="./php/update/update_team_db.php">
    
		    <div class="form-row">
                <div class="col">
                    <h3>Ομάδα</h3>
                </div>
            </div>
			
		 <div class="form-row">
                <div class="col">
                    <hr>
                </div>
            </div>
    <div class="form-row">
        <div class="col"><small class="form-text text-muted">Επιλογή Κατηγορίας</small>'; echo getAllTeam_categories(); echo'</div>
		<div class="col"><small class="form-text text-muted">Επιλογή Ομάδας</small><select class="form-control" id="teams" name="teams"><option>Επιλέξτε Κατηγορία</option></select></div>
	</div>
	
	<div class="form-row">
        <div class="col"><small class="form-text text-muted">Όνομα</small><input name="team_name" id="team_name" class="form-control" type="text"></div>
		<div class="col"><small class="form-text text-muted">Επιλογή Κατηγορίας</small>';echo getAllTeam_categories2();echo'</div>
	</div>
	
    <div class="form-row">
        <div class="col"><button class="btn btn-primary" type="submit" style="width:100%">Ανανέωση</button></div>
		<div class="col"><button class="btn btn-primary" id="delete_team"  type="button" style="width:100%">Διαγραφή</button></div>
    </div>
</form>
echo';

}}?>



</div>

	

	
	
		  
	<?php include('footer.php'); ?>
    <script src="assets/js/update_general_info.js"></script>
	<script src="assets/js/delete_general_info.js"></script>
		
    
</body>

</html>