<?php  
//Access: Everyone
//Purpose: Password Recovery

session_start();
include 'php/useful_functions.php';
require("http_to_https.php");
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
					<li class="nav-item" role="presentation"><a class="nav-link" href="about.php" style="background-color:rgba(255,0,0,0);"><i class="fa fa-info-circle"></i> Σχετικά Με εμάς</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class='form-row'>

		<div class='col-xl-12'>
			<div class="login-dark" style="width=500px;">
				<form method="post" action="./php/update/update_password_after_recovery.php">
					<div class="illustration"><i class="icon ion-ios-locked-outline" style="color:rgb(220,110,86);"></i></div>
					<div class="form-group">
						<input class="form-control" type="password" name="password1" id="password1" placeholder="Κωδικός" required>
					</div>
					<div class="form-group">
						<input class="form-control" type="password" name="password2" id="password2" placeholder="Επαλήθευση" required>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block" name="submit" id="submit" value="<?php if(isset($_GET['code'])){echo $_GET['code'];} ?>" type="submit" disabled>Επαναφορά</button>
					</div><b><a href="#" id="progress" class="forgot"></a></b>
				</form>
			</div>
		</div>
	</div>

	<?php include('index_footer.php'); ?>
	<script src="assets/js/password_recover.js"></script>

</body>

</html>