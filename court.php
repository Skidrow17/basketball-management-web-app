<?php 

//Access: Admin
//Purpose: Add basketball Court

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
	<title>ΕΚΑΣΔΥΜ - <?php echo $courtInsert; ?></title>
	<?php include('head.php'); ?>
</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>

	<?php include('admin_nav_bar.php'); ?>

		<div class="admin-look">
			<form method="post" action="php/insert/insert_court.php">
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
					<div class="col-xl-6"><small class="form-text text-muted"><?php echo $name; ?></small>
						<input name="name" class="form-control" type="text">
					</div>
					<div class="col-xl-6"><small class="form-text text-muted"><?php echo $city; ?></small>
						<div class = 'selectbox-design'>
							<?php echo getAllCities();?>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col"><small class="form-text text-muted">Latitude</small>
						<input class="form-control" id="lat" name="latitude" val="40.29111003227428" type="text">
					</div>
					<div class="col"><small class="form-text text-muted">Longitude</small>
						<input class="form-control" id="long" name="longitude" val="21.798052734375005" type="text">
					</div>
				</div>

				<div class="form-row">
					<div class="col-xl-12" style=" padding:35px; height:378px;">
						<div id="map"></div>
					</div>
					<div class="col-xl-12">
						<button class="btn btn-primary" name='submit' type="submit" onclick="return confirm('Είσται σίγουρος;')" style="width:100%;"><?php echo $addButton; ?></button>
					</div>
				</div>
			</form>
			</div>

			<?php include('footer.php'); ?>
			<script src="assets/js/map.js"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAV4X4plSnLUHGm5B069JsENYB9UPv9rcI&callback=initMap" async defer>
			</script>

</body>

</html>