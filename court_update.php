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
	<title>ΕΚΑΣΔΥΜ - <?php echo $courtUpdate; ?></title>
	<?php include('head.php'); ?>
</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>
	<?php include('admin_nav_bar.php'); ?>
		<div class="admin-look">
			<form method="post" action="php/update/update_court_db.php" enctype="multipart/form-data">

				<div class="form-row">
					<div class="col">
						<h3><?php echo $court; ?></h3>
					</div>
				</div>

				<div class="form-row">
					<div class="col">
						<hr>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xl-12"><small class="form-text text-muted"><?php echo $court; ?></small>
							<div class = "selectbox-design">
								<?php echo getAllCourts(); ?>
							</div>
						<div id="txtHint">
						</div>

						<div id='hide' class="form-row">
							<div class="col-xl-12" style=" padding:35px; height:378px;">
								<div id="map"></div>
							</div>
							<div class="col">
								<button class="btn btn-primary" name='submit' type="submit" style="width:100%;"><?php echo $update; ?></button>
							</div>
							<div class="col">
								<button class="btn btn-primary" type="button" id='delete_court' style="width:100%;"><?php echo $delete; ?></button>
							</div>

						</div>
					</div>
				</div>
			</form>
		</div>

		<?php include('footer.php'); ?>
		<script src="assets/js/court_update.js"></script>
		<script src="assets/js/map.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAV4X4plSnLUHGm5B069JsENYB9UPv9rcI&callback=initMap" async defer>
		</script>

</body>

</html>