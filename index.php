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