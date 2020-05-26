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
							<div class = "col selectbox-design"><?php echo getAllTeam_Categories(); ?></div>
						</div>

						<div class="col-xl-6" id="group_text" style="display:none;"><small class="form-text text-muted"><?php echo $select_group; ?></small>
							<div class = "col selectbox-design" id = "groups" contenteditable="false"></div>
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

	<?php include('index_footer.php'); ?>
	<script src="assets/js/ranking_update.js"></script>

</body>

</html>