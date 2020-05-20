<?php  
//Access: Everyone
//Purpose: Weekly Matches , Login Screen

session_start();
include 'php/useful_functions.php';
include 'php/language.php';
require("http_to_https.php");
if(isset($_COOKIE['uname'])&&isset($_COOKIE['pwd'])&&isset($_COOKIE['safe_key']))
header('Location: ./php/login.php');
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ΕΚΑΣΔΥΜ - Είσοδος</title>
	<?php include('head.php'); ?>
</head>

<body>
	<main class="page lanidng-page">
		<section class="portfolio-block photography"></section>
	</main>

	<?php include('index_nav_bar.php'); ?>

	<div class='form-row'>

		<div class='col-xl-12'>
			<div class="login-dark">
				<form method="post" action="./php/login.php">
					<div class="illustration"><i class="icon ion-ios-locked-outline" style="color:rgb(220,110,86);"></i></div>
					<div class="form-group">
						<input class="form-control" type="text" name="username" id="username" placeholder="Όνομα Χρήστη" required>
					</div>
					<div class="form-group">
						<input class="form-control" type="password" name="password" id="password" placeholder="Κωδικός" required>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block" type="submit">Είσοδος</button>
					</div><a href="#" id="password_recovery" class="forgot">Ξεχάσατε τον κωδικό σας;</a>
				</form>
			</div>
		</div>
	</div>

	<?php include('index_footer.php'); ?>
		<script src="assets/js/index.js"></script>

</body>

</html>