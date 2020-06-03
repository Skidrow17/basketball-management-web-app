<?php 
//Access: Admin
//Purpose: Update and delete Basketball court

require_once('php/session_admin.php');
require_once('php/language.php');
require_once('http_to_https.php');
require_once('php/useful_functions.php');
require_once('php/select_boxes.php');
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ΕΚΑΣΔΥΜ - <?php echo $ranking_update; ?></title>
	<?php include('head.php'); ?>
</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>
	<?php include('admin_nav_bar.php'); ?>
		<div class="admin-look">
			<form method="post" action="php/update/update_ranking.php" enctype="multipart/form-data">

				<div class="form-row">
					<div class="col">
						<h3><?php echo $ranking_update; ?></h3>
					</div>
				</div>

				<div class="form-row">
					<div class="col">
						<hr>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xl-6"><small class="form-text text-muted"><?php echo $selectCategory; ?></small>
						<div class = "col selectbox-design"><?php echo getAllTeam_Categories(); ?></div>
					</div>

					<div class="col-xl-6" id="group_text" style="display:none;"><small class="form-text text-muted"><?php echo $select_group; ?></small>
						<div class = "col selectbox-design" id = "groups"></div>
					</div>

					
				</div>

				<div style="overflow-x:auto;">
						<table id='ranking_table'>
						</table>
					</div>
						
					<button class="btn btn-primary" name='submit' id = 'submit' type="button" style="width:100%;display:none;"><?php echo $update; ?></button>
						
			</form>
		</div>

		<?php include('footer.php'); ?>
		<script 
			src="assets/js/ranking_update.js"></script>
		</script>

</body>

</html>