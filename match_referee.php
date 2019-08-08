<?php 
//Access: Admin
//Purpose: Matches the referees to current week games
require_once('php/session_admin.php');
require_once('php/language.php');
require_once('http_to_https.php');
require_once('php/useful_functions.php');
require_once('php/select_boxes.php');?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ΕΚΑΣΔΥΜ - <?php echo $humanPowerSorting; ?></title>
	<?php include('head.php'); ?>
	<link rel="stylesheet" href="assets/css/floatingText.css">
</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>
	
	<?php include('admin_nav_bar.php'); ?>

		<div class="admin-look">
			<form method="post" action="./php/insert/insert_human_power.php">
			<div id="news" style="display:none;" class="example1">
				<h3></h3>
			</div>
			<hr>
				<div class="form-row">
					<div class="col">
						<h3><?php echo $humanPowerSorting; ?></h3>
					</div>
				</div>

				<div class="form-row">
					<div class="col">
						<hr>
					</div>
				</div>
				<div id='tableta' style="display:none;" class="form-group">

					<div id="pagination_buttons" style="display:none;">
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

					<div style="overflow-x:auto;">
						<table id="table" style='display:none;'>

						</table>
					</div>
				</div>

				<div class="form-row">
					<div class="col"><small class="form-text text-muted"><?php echo $selectCategory;?></small>
						<?php echo getAllTeam_Categories(); ?>
					</div>
					<div class="col"><small class="form-text text-muted"><?php echo $selectMatch;?></small>
						<select class="form-control" id="matches" name="matches">
							<option><?php echo $selectCategory; ?></option>
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="col"><small class="form-text text-muted"><?php echo $selectRefere;?> 1</small>
						<select class="form-control" id="referee1" name="human_power[]" required>
							<option value=""><?php echo $selectMatch; ?></option>
						</select>
					</div>
					<div class="col"><small class="form-text text-muted"><?php echo $selectRefere;?> 2</small>
						<select class="form-control" id="referee2" name="human_power[]" required>
							<option value=""><?php echo $selectMatch; ?></option>
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="col"><small class="form-text text-muted"><?php echo $selectJudge;?> 1</small>
						<select class="form-control" id="judge1" name="human_power[]" required>
							<option value=""><?php echo $selectMatch; ?></option>
						</select>
					</div>
					<div class="col"><small class="form-text text-muted"><?php echo $selectJudge;?> 2</small>
						<select class="form-control" id="judge2" name="human_power[]" required>
							<option value=""><?php echo $selectMatch; ?></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<button class="btn btn-primary btn-block" onclick="return confirm('Είσται σίγουρος;')" type="submit" id="submit" name="submit" style="background-color:rgb(220,64,29);"><?php echo $addButton; ?></button>
				</div>
			</form>
		</div>

		<?php include('footer.php'); ?>
		<script src="assets/js/match_referee.js"></script>

</body>

</html>