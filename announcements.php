<?php 
//Access: Authorized User
//Purpose: Delete , Update , Insert Announcement

require_once("php/session.php");
require_once('php/language.php');
require_once("http_to_https.php");
require_once("php/useful_functions.php"); 
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ΕΚΑΣΔΥΜ - <?php echo $announcements; ?></title>
	<?php include('head.php'); ?>
</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>
	<div></div>
	<div></div>

	<?php include('nav_bar.php'); ?>

		<div class='form-row'>
			<div class='col-xl-6'>
				<div class="annoucements-look">
					<form method="post" action="./php/insert/insert_announcement.php" style="background-color:rgba(238,238,238,0.74);margin:0px;">
						<small class="form-text text-muted" style="color:rgba(150,1,1,0.15);"><?php echo $title; ?></small>
						<div class="form-group">
							<div>
								<input type="text" name="title" required></input>
							</div>
						</div>
						<div class="form-group">
								<textarea rows="7" class="form-control" name="text" id="text" style="padding:50px;background-color:rgba(220,64,29,0.3);" required></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-block" type="submit"><?php echo $addButton; ?></button>
						</div>
					</form>
				</div>
			</div>

			<div class='col-xl-6'>

				<div class="annoucements-look element">
					<form method="post" id = "announcementPanel" style="display:none;">

						<h3 style='text-align: center;'><?php echo $myAnnouncements; ?></h3>
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
					
					<form id = "spinnerPanel" method = "post" style="height:590px;">
						<div class="lds-hourglass"></div>
					</form>

					<form id = "noData" method = "post" style="height:590px;display:none;">
						<div>
							<h3 style="position: relative;padding-top:30%;"><?php echo $noDataAvailable; ?></h3>
						</div>
					</form>
				
				
				</div>

			</div>

		</div>

		<?php include('footer.php'); ?>
		<script src="assets/js/user_announcement.js"></script>

</body>

</html>