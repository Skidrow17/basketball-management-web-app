<?php 

//Access: Authorized User 
//Purpose: contains the nav bar 
require_once('php/language.php');

?>
<nav class="navbar navbar-light navbar-expand-md fixed-top navbar-transparency" id="nav_bar">
    <div class="container">
        <a class="navbar-brand" href="http://ekasdym.gr/news/"><img src="assets/img/ekas.png" height="40px" width="40px" alt="logo"></a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="home_user.php"></i><i class="fa fa-home"></i> <?php echo $homePage; ?> </a>
                </li>
                <li class="dropdown" style="background-color:rgba(255,255,255,0);"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="background-color:rgba(255,255,255,0);"><i class="fa fa-user"></i> <?php if(isset($_SESSION["username"]))echo $_SESSION["username"]; ?></a>
                    <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="announcements.php"><?php echo $announcements; ?></a><a class="dropdown-item" role="presentation" href="messages.php"><?php echo $messages; ?></a><a class="dropdown-item" role="presentation" href="add_restriction.php"><?php echo $restrictions; ?></a><a class="dropdown-item" role="presentation" href="match.php"><?php echo $matches; ?></a><a class="dropdown-item" role="presentation" href="weekly_matches.php"><?php echo $weekly_matches.'/'.$ranking; ?></a><a class="dropdown-item" role="presentation" href="user_settings.php"><?php echo $settings; ?></a><a class="dropdown-item" role="presentation" href="./php/logout.php"><?php echo $logout; ?></a></div>
                </li>
            </ul>
        </div>
    </div>
</nav>