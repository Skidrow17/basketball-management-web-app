<?php 
//Access: Authorized User
//Purpose: Modify Score , My Weekly Games , All my Games history

require_once("php/session.php");
require_once('php/language.php');
require_once("http_to_https.php");
require_once("php/useful_functions.php");
require_once('php/select_boxes.php');

?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ΕΚΑΣΔΥΜ - <?php echo $matches; ?></title>
	<?php include('head.php'); ?>
</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>
	<?php include('nav_bar.php'); ?>
	<div class='form-row'>
		<div class='col-xl-12'>
			<div class="annoucements-look element">
				<form id='hide' method="post" style="background-color:rgba(238,238,238,0.74);">

					<div class="form-row">
						<div class="col">
							<h3><?php echo $ranking; ?></h3>
						</div>
					</div>

					<div class="form-row">
						<div class="col-xl-6"><small class="form-text text-muted"><?php echo $selectCategory; ?></small>
							<div class = "col"><?php echo getAllTeam_Categories(); ?></div>
						</div>

						<div class="col-xl-6" id="group_text" style="display:none;"><small class="form-text text-muted"><?php echo $select_group; ?></small>
							<div class = "col" id = "groups" contenteditable="false"></div>
						</div>
					</div>
						
					<div style="overflow-x:auto;">
						<table id='ranking_table'>
						</table>
					</div>

				</form>
			</div>
		</div>

	</div>

	<?php include('footer.php'); ?>
		<script src="assets/js/ranking_update.js"></script>

</body>

</html>