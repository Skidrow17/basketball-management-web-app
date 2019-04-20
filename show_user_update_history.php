<?php 
//Access: Admin
//Purpose: All user update history , export to csv 

require_once("./php/session_admin.php");
require("http_to_https.php");
require 'php/useful_functions.php';
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ΕΚΑΣΔΥΜ - Ιστορικό Αναβαθμήσης Χρηστών</title>
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
        <form method="post">
            <div class="form-row">
                <div class="col">
                    <h1>Ιστορικό Αναβαθμήσης Χρηστών</h1>
                </div>
            </div>
          
		  
<div>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class='page-item' style='color:rgb(220,64,29);'><a id="previous" name="previous"  class='page-link' aria-label='Previous'><span aria-hidden='true'>«</span></a></li>
	<li class='page-item' style='color:rgb(220,64,29);'><a id="min" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>0</span></a></li>
	<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
	<li class='page-item' style='color:rgb(220,64,29);'><a id="current" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
	<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
	<li class='page-item' style='color:rgb(220,64,29);'><a id="max" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
	<li class='page-item' style='color:rgb(220,64,29);'><a id="next" name="next" class='page-link' aria-label='Previous'><span aria-hidden='true'>»</span></a></li>
  </ul>
</nav>	
</div>			
			
			
			
			
<div style="overflow-x:auto;">
  <table id='here'>
  
  
    
  </table>
</div>
	
<div class="form-row">
<div class="col"><button class="btn btn-primary" id="export" name="export" data-export="export" style="width:100%;" type="button" download>CSV Export Current Page</button></div>
<div class="col"><button class="btn btn-primary" style="width:100%;" id="export_all" value="Download PDF" type="button" download>CSV Export All Pages</button></div>
</div>

    



		 
               
</div>
</form>
	

    <?php include('footer.php'); ?>
	
	
<script src="assets/js/jquery.tabletoCSV.js"></script>
<script src="assets/js/user_update_history.js"></script>



	
    
	
</body>

</html>