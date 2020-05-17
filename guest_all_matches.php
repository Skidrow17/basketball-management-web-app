<?php  
//Access: Everyone
//Purpose: Weekly Matches , Login Screen

session_start();
include 'php/useful_functions.php';
include 'php/labels_gr.php';
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

	<nav id='nav_bar' class="navbar navbar-light navbar-expand-md fixed-top navbar-transparency">
		<div class="container">
			<a class="navbar-brand" href="http://ekasdym.gr/news/" style="background-color:rgba(255,255,255,0);"><img src="assets/img/ekas.png" height="40px" width="40px" alt="logo"></a>
			<button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
			<div class="collapse navbar-collapse" id="navcol-1">
				<ul class="nav navbar-nav ml-auto">
					<li class="nav-item" role="presentation"><a class="nav-link" href="index.php" style="background-color:rgba(255,0,0,0);"><i class="fa fa-home"></i> <?php echo $homePage; ?></a></li>
					<li class="nav-item" role="presentation"><a class="nav-link" href="guest_all_matches.php" style="background-color:rgba(255,0,0,0);"><i class="fa fa-eercast"></i> <?php echo $weekly_matches; ?></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="guest_match_ranking.php" style="background-color:rgba(255,0,0,0);"><i class="fa fa-newspaper-o"></i> <?php echo $ranking; ?></a></li>
					<li class="nav-item" role="presentation"><a class="nav-link" href="about.php" style="background-color:rgba(255,0,0,0);"><i class="fa fa-info-circle"></i> <?php echo $about_us; ?></a></li>
                </ul>
			</div>
		</div>
	</nav>

	<div class='form-row'>
		<div class='col-xl-12'>
			<div class="annoucements-look element">
				<form id='hide' method="post">

					<div class="form-row">
						<div class="col">
							<h3>Εβδομαδιαίοι Αγώνες</h3>
						</div>
					</div>

					<div class="form-row">
						<div class="col">
							<hr>
						</div>
					</div>
					<div class='form-row'>
						<div class="col">
							<button class="btn btn-primary btn-block" id='men_a' value='1' type="button">A Ανδρών</button>
						</div>
					</div>

					<div class='form-row'>
						<div class="col">
							<button class="btn btn-primary btn-block" id='adult' value='4' type="button">Εφήβων</button>
						</div>
						<div class="col">
							<button class="btn btn-primary btn-block" id='men_b' value='2' type="button">B Ανδρών</button>
						</div>
						<div class="col">
							<button class="btn btn-primary btn-block" id='woman' value='3' type="button">Γυναικών</button>
						</div>
					</div>

					<div class='form-row'>
						<div class="col">
							<button class="btn btn-primary btn-block" id='girls' value='8' type="button">Κορασίδων</button>
						</div>
						<div class="col">
							<button class="btn btn-primary btn-block" id='young' value='5' type="button">Νεανίδων</button>
						</div>
						<div class="col">
							<button class="btn btn-primary btn-block" id='child' value='7' type="button">Παίδων</button>
						</div>
					</div>

				</form>

				<form method="post" id='apear' style="display: none;">

					<div class="form-row">
						<div class="col">
							<h3 id='team_category'></h3>
						</div>
					</div>

					<div class="form-row">
						<div class="col">
							<hr>
						</div>
					</div>

					<div>
						<nav aria-label="Page navigation example">
							<ul class="pagination">
								<li class='page-item' style='color:rgb(220,64,29);'><a id="previous" style='display:none;' class='page-link' aria-label='Previous'><span aria-hidden='true'>«</span></a></li>
								<li class='page-item' style='color:rgb(220,64,29);'><a id="min" class='page-link' aria-label='Previous'><span aria-hidden='true'>0</span></a></li>
								<li class='page-item' style='color:rgb(220,64,29);'><a class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
								<li class='page-item' style='color:rgb(220,64,29);'><a id="current" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
								<li class='page-item' style='color:rgb(220,64,29);'><a class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
								<li class='page-item' style='color:rgb(220,64,29);'><a id="max" class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
								<li class='page-item' style='color:rgb(220,64,29);'><a id="next" style='display:none;' class='page-link' aria-label='Previous'><span aria-hidden='true'>»</span></a></li>
							</ul>
						</nav>
					</div>

					<div style="overflow-x:auto;">
						<table id='table'>

						</table>
					</div>

					<div class="form-group">
						<button class="btn btn-primary btn-block" id='back' type="button">Πίσω</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php include('index_footer.php'); ?>
		<script src="assets/js/index.js"></script>

</body>

</html>