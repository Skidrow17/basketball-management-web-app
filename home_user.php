<?php 
//Access: Authorized User
//Purpose: User Home page

require_once("./php/session.php");
require_once("http_to_https.php");
require_once('php/useful_functions.php');
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ΕΚΑΣΔΥΜ - Αρχική Σελίδα</title>
	<?php include('head.php'); ?>
</head>
<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>

	<div class='form-row'>
		<div class='col-xl-6'>
			<div class="login-dark">

				<?php include('nav_bar.php'); ?>

					<form name="button" method="post" action="./php/button_redirect.php">
						<div class="illustration" style="background-size: cover; background-image:url(<?php echo $_SESSION['profile_pic']; ?>);"><i class="icon ion-ios-locked-outline" style="color:rgba(220,64,29,0);"></i></div>
						<button id="button" name="button" value="1" class="btn btn-primary btn-block" type="submit">Ανακοινώσεις</button>
						<button id="button" name="button" value="2" class="btn btn-primary btn-block" type="submit">Μηνύματα</button>
						<button id="button" name="button" value="5" class="btn btn-primary btn-block" type="submit">Kωλύματα</button>
						<button id="button" name="button" value="6" class="btn btn-primary btn-block" type="submit">Αγώνες</button>
					</form>

			</div>
		</div>

		<div class='col-xl-6'>

			
			<div style="background-color:transparent;" class="annoucements-look element">
				<form id="announcementPanel" method="post" style="display:none;">
					<div class='col'>
						<h3 style='text-align: center;'>Ανακοινώσεις</h3>
					</div>

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
							<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span>..</a></li>
							<li class='page-item' style='color:rgb(220,64,29);'><a id="max" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
							<li class="page-item"><a class="page-link" id='next' aria-label="Next"><span aria-hidden="true">»</span></a></li>
						</ul>
					</nav>

					<div class="form-row">
						<div id='here' class="col" style="background-color:#FFF7C8;  border: 1px solid #888; ">

						</div>
					</div>

				</form>
				
				<form id = "spinnerPanel" method = "post" style="height:580px;">
					<div class="lds-hourglass"></div>
				</form>
				
			</div>
			</div>

		</div>
	</div>

	<?php include('footer.php'); ?>
		<script src="assets/js/announcement.js"></script>

</body>

</html>