<?php  
//Access: Admin 
//Purpose: Update , Activate / Deactivate Users
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
	<title>ΕΚΑΣΔΥΜ - <?php echo $userUpdate;?></title>
	<?php include('head.php'); ?>
</head>

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
						<h3><?php echo $user1; ?></h3>
					</div>
				</div>

				<div class="form-row">
					<div class="col">
						<hr>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xl-12"><small class="form-text text-muted"><?php echo $selectUser; ?></small>
						<div class = "selectbox-design">
							<?php echo getUsers(); ?>
						</div>
					</div>
				</div>

				<div id="txtHint"></div>

			</form>
		</div>

		<?php include('footer.php'); ?>
		<script src="assets/js/user_update.js"></script>

</body>

</html>