<?php 

//Access: Admin
//Purpose: Delete , Update , Insert Announcement


require_once("./php/session_admin.php");
require("http_to_https.php");
require 'php/useful_functions.php'; 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ΕΚΑΣΔΥΜ - Ανακοινώσεις</title>
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
        
		
		<form method="post" id='add_announcement' action="./php/insert/insert_announcement.php" style="display:none;">
            <small class="form-text text-muted" style="color:rgba(150,1,1,0.15);">Τίτλος</small>
            <div class="form-group">
			 <div><input type="text" name="title" required></input></div>
            </div>
            <div class="form-group"><class><textarea rows="7" class="form-control" name="text" id="text" style="padding:50px;background-color:rgba(220,64,29,0.3);" required></textarea></div>
			<div class='form-row'>
            <div class='col'><div class="form-group"><button id='back' class="btn btn-primary btn-block" type="button">Πίσω</button></div></div>
			<div class='col'><div class="form-group"><button class="btn btn-primary btn-block" type="submit">Ανακοίνωση</button></div></div>
			</div>
        </form>


	

        <form id='show_announcement'  method="post" style="display: none;">
            
			 <h3 style='text-align: center;'>Οι Ανακοινώσεις Μου</h3>
			 <div class='form-row'>
                <div class='col'>
                    <hr>
                </div>
            </div>
			
			<nav>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" id='previous' aria-label="Previous"><span aria-hidden="true">«</span></a></li>
					<li class='page-item' style='color:rgb(220,64,29);'><a id="min" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>0</span></a></li>
					<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
					<li class='page-item' style='color:rgb(220,64,29);'><a id="current" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
					<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
					<li class='page-item' style='color:rgb(220,64,29);'><a id="max" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
					<li class="page-item"><a class="page-link" id='next' aria-label="Next"><span aria-hidden="true">»</span></a></li>
                </ul>
            </nav>
           
                <div id='here'>
                    
					
                </div>
				
        </form>
		
		
		
		<form id='menu' method="post">
       
			<div class="form-row">
                <div class="col">
                    <h3 id='heading'>Ανακοινώσεις</h3>
                </div>
            </div>
			
			<div class="form-row">
                <div class="col">
                    <hr>
                </div>
            </div>
			
			
			<div class='form-row'>
			<div class="col"><button class="btn btn-primary btn-block" id='add' value='1' type="button" >Κάνε Ανακοίνωση</div>
			</div>	
			<div class='form-row'>
			<div class="col"><button class="btn btn-primary btn-block" id='show' value='2' type="button" >Ανακοινώσεις Μου</div>
			</div>
			<div class='form-row'>
			<div class="col"><button class="btn btn-primary btn-block" id='show_all' value='3' type="button" >Όλες οι Ανακοινώσεις</div>
			</div>
			
		</form>
		
		
		
		
		
</div>
	
  <?php include('footer.php'); ?>
  <script src="assets/js/admin_announcement.js"></script>
 
</body>

</html>