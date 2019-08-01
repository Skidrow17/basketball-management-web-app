<?php 
//Access: Admin
//Purpose: Delete the refere from a specific game 
require_once('./php/session_admin.php');
require_once('./php/language_select.php');
require_once('http_to_https.php');
require_once('php/useful_functions.php');
require_once('php/select_boxes.php');?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ΕΚΑΣΔΥΜ - <?php echo $usersPerMatch; ?></title>
	<?php include('head.php'); ?>
</head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>
	<div></div>
	<div></div>
	<?php include('admin_nav_bar.php'); ?>
		<div class="admin-look">
			<form method="post" action="./php/update/update_user_db.php" enctype="multipart/form-data">

				<div class="form-row">
					<div class="col">
						<h3><?php echo $usersPerMatch; ?></h3>
					</div>
				</div>

				<div class="form-row">
					<div class="col">
						<hr>
					</div>
				</div>
				<div class="form-row">
					<div class="col"><small class="form-text text-muted"><?php echo $teamCategory; ?></small>

						<?php echo getAllTeam_Categories(); ?>

					</div>

					<div class="col"><small class="form-text text-muted"><?php echo $match; ?></small>

						<select class="form-control" id="matches" name="matches">
							<option><?php echo $selectCategory; ?></option>
						</select>

					</div>

				</div>

				<div class="form-row">
					<div class="col">
						<hr>
					</div>
				</div>

				<div id='tableta' class="form-group">

					<div>
						<nav aria-label="Page navigation example">
							<ul class="pagination" style = "display:none;">
								<li class='page-item' style='color:rgb(220,64,29);'><a id="previous" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>«</span></a></li>
								<li class='page-item' style='color:rgb(220,64,29);'><a id="min" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>0</span></a></li>
								<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
								<li class='page-item' style='color:rgb(220,64,29);'><a id="current" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>0</span></a></li>
								<li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
								<li class='page-item' style='color:rgb(220,64,29);'><a id="max" name="previous" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
								<li class='page-item' style='color:rgb(220,64,29);'><a id="next" name="next" class='page-link' aria-label='Previous'><span aria-hidden='true'>»</span></a></li>
							</ul>
						</nav>
					</div>

					<div style="overflow-x:auto;">

						<table id="table">

						</table>
					</div>
				</div>

			</form>
		</div>

		<?php include('footer.php'); ?>
			<script src="assets/js/match_referee_update.js"></script>

</body>

</html>