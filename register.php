<?php 
//Access: Admin
//Purpose: Registers a new user to the system
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
	<title>ΕΚΑΣΔΥΜ - Δημιουργία Λογαριασμού</title>
	<?php include('head.php'); ?>
</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>
	
	<?php include('admin_nav_bar.php'); ?>
		<div class="admin-look">
			<form method="post" action="./php/insert/insert_user.php" enctype="multipart/form-data">

				<div class="form-row">
					<div class="col">
						<h3><?php echo $user; ?></h3>
					</div>
				</div>

				<div class="form-row">
					<div class="col">
						<hr>
					</div>
				</div>

				<div class="form-row">
					<div class="col"><small class="form-text text-muted"><?php echo $name; ?></small>
						<input required name="name" class="form-control" type="text">
					</div>
					<div class="col"><small class="form-text text-muted"><?php echo $surname; ?></small>
						<input required name="surname" class="form-control" type="text">
					</div>
				</div>
				<div class="form-row">
					<div class="col"><small class="form-text text-muted"><?php echo $username; ?></small>
						<input required name="username" class="form-control" type="text">
					</div>
					<div class="col"><small class="form-text text-muted"><?php echo $password; ?></small>
						<input required name="password" class="form-control" type="text">
					</div>
				</div>
				<div class="form-row">
					<div class="col"><small class="form-text text-muted"><?php echo $email; ?></small>
						<input requiredv name="email" class="form-control" type="text">
					</div>
					<div class="col"><small class="form-text text-muted"><?php echo $phone; ?></small>
						<input required name="phone" class="form-control" type="text">
					</div>
				</div>
				<div class="form-row">
					<div class="col"><small class="form-text text-muted"><?php echo $livingPlace; ?></small>
						<?php echo getAllCities();?>
					</div>
					<div class="col"><small class="form-text text-muted"><?php echo $rating; ?></small>
						<?php echo getAllRates();?>
					</div>
				</div>
				<div class="form-row">
					<div class="col"><small class="form-text text-muted"><?php echo $drivingLicence; ?></small>
						<?php echo getDrivingLicence(1);?>
					</div>
					<div <div class="col"><small class="form-text text-muted"><?php echo $profession; ?></small>
						<?php echo getAllUser_categories();?>
					</div>
				</div>
				<div class="form-row">
					<div class="col"><small class="form-text text-muted"><?php echo $profileImage; ?></small>
						<input required name="profile_pic" class="col-xl-12" type="file" />
					</div>
					<div class="col"><small class="form-text text-muted"><?php echo $playableCategories; ?></small>
						<?php echo getAllPlayableCategories();?>
					</div>
				</div>
				<div class="form-row">
					<div class="col-xl-12">
						<button name="submit" class="btn btn-primary btn-lg col-xl-12" style="width:" type="submit" style="width:290px;"><?php echo $addButton; ?></button>
					</div>
				</div>
			</form>
		</div>

		<?php include('footer.php'); ?>

</body>

</html>