<?php 

//Access: Authorized User
//Purpose: Add Restiction

require_once("./php/session.php");
require_once('./php/language_select.php');
require_once("http_to_https.php");
require_once('php/useful_functions.php');
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ΕΚΑΣΔΥΜ - Προσθήκη Κωλυμάτος</title>
	<?php include('head.php'); ?>
</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>

	<?php include('nav_bar.php'); ?>

		<div class="form-row">
			<div class='col-xl-6'>
				<div class="annoucements-look element">
					<form method="post" id='single' action="./php/insert/insert_restriction.php" style="display:none;" autocomplete="off">
						<div class="form-row">
							<div class="col-sm-2">
								<button class="btn btn-primary btn-block" id='back' type="button">Πίσω</button>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div class="form-row">
							<div class="col"><small class="form-text text-muted">Επιλογή Ημερομηνίας</small></div>
							<div class="col">
								<div class="form-group">
									<input placeholder='Πατήστε μέσα στο πεδίο' style='border:1px solid rgb(220,110,86);' name='date' type='date' required>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="col"><small class="form-text text-muted" style="color:rgb(220,64,29);">Επιλογή ώρας έναρξης</small></div>
							<div class="col">
								<input type="time" name="time_from" id='time_from' required>
							</div>
						</div>
						<div class="form-row">
							<div class="col"><small class="form-text text-muted" style="text-align:left;">Επιλογή ώρας τερματισμού</small></div>
							<div class="col">
								<input type="time" name="time_to" id='time_to' required>
							</div>

						</div>

						<div class="form-group">
							<button class="btn btn-primary btn-block" name='submit' type="submit">Προσθήκη Κωλύματος</button>
						</div>
					</form>

					<form id='hide' method="post">

						<div class="form-row">
							<div class="col">
								<h3>Κωλυμάτα</h3>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>
						<div class='form-row'>
							<div class="col">
								<button class="btn btn-primary btn-block" id='restriction' value='1' type="button">Κώλυμα</button>
							</div>
							<div class="col">
								<button class="btn btn-primary btn-block" id='multiple_restriction' value='2' type="button">Πολλαπλά Κωλυμάτα</button>
							</div>
						</div>

					</form>

					<form method="post" id='multiple' action="./php/insert/insert_multiple_restriction.php" style="display:none;" autocomplete="off">
						<div class="form-row">
							<div class="col-sm-2">
								<button class="btn btn-primary btn-block" id='back2' type="button">Πίσω</button>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div class="form-row">

							<div class="col"><small class="form-text text-muted">Πολλαπλή επιλογή ημερομηνίας</small></div>
						</div>
						<div class="form-group">
							<input id='dates' name='dates' placeholder='Πατήστε μέσα στο πεδίο' style='border:1px solid rgb(220,110,86);' type="text" class="datepicker-here form-control" data-language='gr' data-multiple-dates="365" data-multiple-dates-separator=", " data-position='top left' onfocus="blur();" required>
						</div>

						<div class="form-group">
							<button class="btn btn-primary btn-block" name='submit' type="submit">Προσθήκη Κωλυμάτων</button>
						</div>
					</form>
					</form>

				</div>
			</div>

			<div class='col-xl-6'>
				<div class="annoucements-look element">
					<form id="announcementPanel" method="post" style="display:none;">

						<div class="form-row">
							<div class="col">
								<h3>Κωλύματα</h3>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div>
							<nav aria-label="Page navigation example">
								<ul class="pagination">
									<li class='page-item' style='color:rgb(220,64,29);'><a id="previous" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>«</span></a></li>
									<li class='page-item' style='color:rgb(220,64,29);'><a id="min" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
									<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
									<li class='page-item' style='color:rgb(220,64,29);'><a id="current" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
									<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
									<li class='page-item' style='color:rgb(220,64,29);'><a id="max" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
									<li class='page-item' style='color:rgb(220,64,29);'><a id="next" name="next" class='page-link' aria-label='Previous'><span aria-hidden='true'>»</span></a></li>
								</ul>
							</nav>
						</div>

						<div style="overflow-x:auto;">
							<table id='table'>

							</table>
						</div>

					</form>
					
					<form id = "spinnerPanel" method = "post" style="height:580px;">
						<div class="lds-hourglass"></div>
					</form>

				</div>

			</div>

		</div>

		<?php include('footer.php'); ?>
		<script src="assets/js/restrictions.js"></script>

</body>

</html>