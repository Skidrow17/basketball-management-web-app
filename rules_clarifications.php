<?php  
//Access: Everyone
//Purpose: Weekly Matches , Login Screen

session_start();
include 'php/useful_functions.php';
require 'php/language.php';
include 'php/select_boxes.php';
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
		<div class='col-xl-6'>
			<div class="annoucements-look element">
			<object data="assets/asset1.pdf" type="application/pdf" width="100%" height="100%">
			<p>Alternative text - include a link <a href="myfile.pdf">to the PDF!</a></p>
			</object>
			</div>
		</div>
		<div class='col-xl-6'>
			<div class="annoucements-look element">
			<object data="assets/asset2.pdf" type="application/pdf" width="100%" height="100%">
			<p>Alternative text - include a link <a href="myfile.pdf">to the PDF!</a></p>
			</object>
			</div>
		</div>
	</div>

	<?php include('index_footer.php'); ?>
	<script src="assets/js/ranking_update.js"></script>

</body>

</html>