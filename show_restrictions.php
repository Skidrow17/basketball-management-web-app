<?php 
//Access: Admin
//Purpose: All restrictions , export to csv 
require_once("php/session_admin.php");
require_once('php/language.php');
require_once("http_to_https.php");
require_once('php/useful_functions.php');
 ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ΕΚΑΣΔΥΜ - <?php echo $restrictions; ?></title>
	<?php include('head.php'); ?>
</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>
	
	<?php include('admin_nav_bar.php'); ?>

		<div class="admin-look">
			<form method="post">
				<div class="form-row">
					<div class="col">
						<h1><?php echo $restrictions; ?></h1>
					</div>
				</div>

				<div>
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class='page-item' style='color:rgb(220,64,29);'><a id="previous" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>«</span></a></li>
							<li class='page-item' style='color:rgb(220,64,29);'><a id="min" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>0</span></a></li>
							<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
							<li class='page-item' style='color:rgb(220,64,29);'><a id="current" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
							<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
							<li class='page-item' style='color:rgb(220,64,29);'><a id="max" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
							<li class='page-item' style='color:rgb(220,64,29);'><a id="next" name="next" class='page-link' aria-label='Previous'><span aria-hidden='true'>»</span></a></li>
						</ul>
					</nav>
				</div>

				<div class="form-row">
					<small class="form-text text-muted"> <?php echo $from; ?>&nbsp;&nbsp;</small><br>
					<input style='border:1px solid rgb(220,110,86);' name='date' id = 'date' type='date' required>
				</div>
				<br/>

				<div style="overflow-x:auto;">
					<table id='here'>

					</table>
				</div>

				<div class="form-row">
					
					<div class="col">
						<button class="btn btn-primary" style="width:100%;" id="export_all" value="Download PDF" type="button" download><?php echo $exportCSVButton; ?></button>
					</div>
				</div>
		</div>
		</form>

		<?php include('footer.php'); ?>

			<script src="assets/js/show_restrictions.js"></script>

</body>

</html>