<?php 

//Access: Admin 
//Purpose: Add information about teams , team categories , city and user categories

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
    <title>ΕΚΑΣΔΥΜ - Γενικές Πληροφορίες</title>
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
	
<?php if(isset($_GET['id'])){ if($_GET['id']==4) { 
echo '
<form method="post" action="./php/insert/insert_team.php">
    
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
        <div class="col-xl-12"><small class="form-text text-muted">Όνομα</small><input name="name" type="text" class="form-control" required /></div>
        <div class="col-xl-12"><small class="form-text text-muted">Επιλογή Κατηγορίας</small>'; echo getAllTeam_Categories(); echo '</div>
        <div class="col-xl-12"><button class="btn btn-primary" type="submit" name="submit" style="width:100%">Προσθήκη</button></div>
</div>
</form>
';
}elseif($_GET['id']==3){

echo '
<form method="post"  action="./php/insert/insert_user_category.php">
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
        <div class="col"><small class="form-text text-muted">Όνομα</small><input name="name" type="text" class="form-control" required /></div>
		
    <div class="col"><button class="btn btn-primary"  type="submit" name="submit"  style="width:100%">Προσθήκη</button></div>
    </div>
</form>
';
}elseif($_GET['id']==1){
echo'
<form method="post"  action="./php/insert/insert_city.php" >
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
        <div class="col"><small class="form-text text-muted">Όνομα</small><input name="name"  type="text" class="form-control" required /></div>
        <div class="col"><button class="btn btn-primary" name="submit" type="submit" style="width:100%">Προσθήκη</button></div>
    </div>
</form>

';
}elseif($_GET['id']==5){
echo'
<form method="post"  action="./php/insert/insert_application.php" enctype="multipart/form-data">
          <div class="form-row">
                <div class="col">
                    <h3>Εφαρμογή Android</h3>
                </div>
            </div>
			
		 <div class="form-row">
                <div class="col">
                    <hr>
                </div>
         </div>
    <div class="form-row">
        <div class="col"><small class="form-text text-muted">Έκδοση</small><input name="version"  type="text" class="form-control" required /></div>
	</div>
		 <div class="form-row">
		 <div class="col"><small class="form-text text-muted">Apk Αρχείο</small><input required name="apk_file" class="col" type="file" /></div>
		 </div>
		  <div class="form-row">
        <div class="col"><button class="btn btn-primary" name="submit" type="submit" style="width:100%">Προσθήκη</button></div>
    </div>
	
	
</form>
';
}elseif($_GET['id']==2){
echo '
<form method="post"  action="php/insert/insert_team_category.php">
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
        <div class="col"><small class="form-text text-muted">Όνομα</small><input name="name"  type="text" class="form-control" required /></div>
        <div class="col"><button class="btn btn-primary" name="submit" type="submit" style="width:100%">Προσθήκη</button></div>
    </div>
</form>

';
}}?>


</div>	
<?php include('footer.php'); ?>
    
		
    
</body>

</html>