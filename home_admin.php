<?php 
//Access: Admin
//Purpose: Admin Home Page


require_once("php/session_admin.php");
require("http_to_https.php");
require 'php/useful_functions.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ΕΚΑΣΔΥΜ - Αρχική Σελίδα</title>
	<?php include('head.php'); ?>
</head>


<link rel="stylesheet" href="assets/css/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

<body>
    <main class="page lanidng-page">
        <section class="portfolio-block photography"></section>
    </main>
    <div></div>
    <div></div>
	
    <?php include('admin_nav_bar.php'); ?>
	
<div class="admin-look">
    <form method="post">
            <div class="form-row">
<div class="wrapper container">
  <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <a class="dashboard-stat red" href="#">
        <div class="visual">
          <i class="fa fa-user"></i>
        </div>
        <div class="details">
          <div class="number">
            <span><?php echo getNumberOfUsers(); ?></span>
          </div>
          <div class="desc">Χρήστες</div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <a class="dashboard-stat blue" href="#">
        <div class="visual">
          <i class="fa fa-envelope-open"></i>
        </div>
        <div class="details">
          <div class="number">
            <span><?php echo getNumberOfAllMessages(); ?></span>
          </div>
          <div class="desc">Μηνύματα</div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <a class="dashboard-stat hoki" href="#">
        <div class="visual">
          <i class="fa fa-ban"></i>
        </div>
        <div class="details">
          <div class="number">
            <span><?php echo getNumberOfRestrictions(); ?></span>
          </div>
          <div class="desc">Κωλύματα</div>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
      <a class="dashboard-stat purple" href="#">
        <div class="visual">
          <i class="fa fa-comments"></i>
        </div>
        <div class="details">
          <div class="number">
            <span><?php echo getNumberOfAllMatches(); ?></span>
          </div>
          <div class="desc">Αγώνες</div>
        </div>
      </a>
    </div>
  </div>
</div>

</div>
<div class="form-row">
<div class="col">
  
    	<?php include('php/dashboard_stats.php'); ?>

</div>
</div>
    </form>
</div>
	
   	<?php include('footer.php'); ?>

</body>

</html>