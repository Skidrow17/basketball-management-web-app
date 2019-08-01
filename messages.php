<?php 
//Access: Authorized User
//Purpose: Sent , Delete , Show Messages
 require_once("./php/session.php");
 require_once('./php/language_select.php');
 require_once("http_to_https.php");
 require_once("php/useful_functions.php"); 
 ?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ΕΚΑΣΔΥΜ - Μηνύματα</title>
	<?php include('head.php'); ?>
</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>

	<?php include('nav_bar.php'); ?>

		<div class='form-row'>
			<div class='col-xl-6'>
				<div class="annoucements-look">
					<form method="post" action="./php/insert/insert_message.php">
						<small class="form-text text-muted">Επιλέξτε παραλήπτη</small>
						<div class="form-group">
							<select id="receiver_id" name="receiver_id">
								<?php require_once './php/contacts.php'; ?>
							</select>

							<input type="text" id="search-data" name="searchData" placeholder="Αναζήτηση Παραλήπτη" autocomplete="off" />

							<div id="search-result"></div>
						</div>

						<div class="form-group">
							<textarea class="form-control" name="text" id="text" style="padding:50px;background-color:rgba(220,64,29,0.3);"></textarea>
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-block" name='submit' type="submit">Αποστολή</button>
						</div>
					</form>
				</div>
			</div>

			<div class='col-xl-6'>

				<div class="annoucements-look element">
					<form id='hide' method="post">

						<div class="form-row">
							<div class="col">
								<h3>Τα Μηνύματα Μου</h3>
							</div>
						</div>

						<div class="form-row">
							<div class="col">
								<hr>
							</div>
						</div>

						<div class='form-row'>
							<div class="col">
								<button class="btn btn-primary btn-block" id='incomming' value='1' type="button">Εισερχόμενα</div>
						</div>
						<div class='form-row'>
							<div class="col">
								<button class="btn btn-primary btn-block" id='outgoing' value='2' type="button">Εξερχόμενα</button>
							</div>
						</div>

					</form>

					<form method="post" id='apear' style="display: none;">

						<div class="form-row">
							<div class="col">
								<h3 id='team_category'></h3>
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
									<li class='page-item' style='color:rgb(220,64,29);'><a id="previous" name="previous" style='display:none;' class='page-link' aria-label='Previous'><span aria-hidden='true'>«</span></a></li>
									<li class='page-item' style='color:rgb(220,64,29);'><a id="min" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>0</span></a></li>
									<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
									<li class='page-item' style='color:rgb(220,64,29);'><a id="current" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>1</span></a></li>
									<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
									<li class='page-item' style='color:rgb(220,64,29);'><a id="max" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>15</span></a></li>
									<li class='page-item' style='color:rgb(220,64,29);'><a id="next" name="next" style='display:none;' class='page-link' aria-label='Previous'><span aria-hidden='true'>»</span></a></li>
								</ul>
							</nav>
						</div>

						<div style="overflow-x:auto;">
							<table id='table'>

							</table>
						</div>

						<div class="form-group">
							<button class="btn btn-primary btn-block" id='back' type="button">Πίσω</button>
						</div>
					</form>

					<form method="post" id='apear2' action="./php/insert/insert_message.php">
						<div id="here">

						</div>

						<div class="form-group">
							<button class="btn btn-primary btn-block" id='back2' type="button">Πίσω</button>
						</div>

					</form>

				</div>

			</div>

		</div>

		<?php include('footer.php'); ?>
		<script src="assets/js/messages.js"></script>
		<script src="assets/js/search.js"></script>

</body>

</html>