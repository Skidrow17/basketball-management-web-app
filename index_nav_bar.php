<?php 

//Access: Admin 
//Purpose: contains the navigation bar visible from admin
require_once('php/language.php');

?>

<nav id='nav_bar' class="navbar navbar-light navbar-expand-md fixed-top navbar-transparency">
    <div class="container">
        <a class="navbar-brand" href="http://ekasdym.gr/news/" style="background-color:rgba(255,255,255,0);"><img src="assets/img/ekas.png" height="40px" width="40px" alt="logo"></a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="index.php" style="background-color:rgba(255,0,0,0);"><i class="fa fa-home"></i> <?php echo $homePage; ?></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="guest_all_matches.php" style="background-color:rgba(255,0,0,0);"><i class="fa fa-eercast"></i> <?php echo $weekly_matches; ?></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="guest_match_ranking.php" style="background-color:rgba(255,0,0,0);"><i class="fa fa-newspaper-o"></i> <?php echo $ranking; ?></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="rules_clarifications.php" style="background-color:rgba(255,0,0,0);"><i class="fa fa-newspaper-o"></i> <?php echo $rules.'/'.$clarifications; ?></a></li>
                <li class="nav-item" role="presentation"><a class="nav-link" href="about.php" style="background-color:rgba(255,0,0,0);"><i class="fa fa-info-circle"></i> <?php echo $about_us; ?></a></li>
            </ul>
        </div>
    </div>
</nav>