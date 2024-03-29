<?php 

//Access: Admin 
//Purpose: contains the navigation bar visible from admin
require_once('php/language.php');

?>
<nav class="navbar navbar-light navbar-expand-md fixed-top navbar-transparency" id="nav_bar">
    <div class="container">
        <a class="navbar-brand" href="http://ekasdym.gr/news/"><img src="assets/img/ekas.png" height="40px" width="40px" alt="logo"></a>
        <div class="navbar-header">
            <a class="navbar-brand" href="#">ΕΚΑΣΔΥΜ</a>
        </div>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation"><a class="nav-link" href="home_admin.php" style="background-color:rgba(255,255,255,0);"><i class="fa fa-home"></i> <?php echo $homePage; ?></a></li>

                <li class="dropdown" id="nav_table" style="background-color:rgba(255,255,255,0);"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="background-color:rgba(255,255,255,0);"><i class="fa fa-table"></i> <?php echo $tabels;?></a>
                    <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="show_login_history.php"><?php echo $loginHistory; ?></a><a class="dropdown-item" role="presentation" href="show_restrictions.php"><?php echo $restriction_history; ?></a><a class="dropdown-item" role="presentation" href="show_user_update_history.php"><?php echo $userUpdateHistory; ?></a></a><a class="dropdown-item" role="presentation" href="show_user_matches_history.php"><?php echo $match_history; ?></a></div>
                </li>

                <li class="dropdown" style="background-color:rgba(255,255,255,0);"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="background-color:rgba(255,255,255,0);"><i class="fa fa-plus-square"></i> <?php echo $add; ?></a>
                    <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="match_referee.php"><?php echo $humanPowerSorting; ?></a><a class="dropdown-item" role="presentation" href="add_match.php"><?php echo $match; ?></a><a class="dropdown-item" role="presentation" href="add_general_info.php?id=1"><?php echo $city; ?></a><a class="dropdown-item" role="presentation" href="add_general_info.php?id=2"><?php echo $teamCategory; ?></a><a class="dropdown-item" role="presentation" href="add_general_info.php?id=3"><?php echo $userCategory; ?></a><a class="dropdown-item" role="presentation" href="add_general_info.php?id=7"><?php echo $rating; ?></a><a class="dropdown-item" role="presentation" href="add_general_info.php?id=6"><?php echo $group; ?></a><a class="dropdown-item" role="presentation" href="add_general_info.php?id=4"><?php echo $team; ?></a><a class="dropdown-item" role="presentation" href="register.php"><?php echo $user; ?></a><a class="dropdown-item" role="presentation" href="court.php"><?php echo $court; ?></a><a class="dropdown-item" role="presentation" href="add_general_info.php?id=5"><?php echo $androidAplication; ?></a></div>
                </li>

                <li class="dropdown" style="background-color:rgba(255,255,255,0);"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="background-color:rgba(255,255,255,0);"><i class="fa fa-edit"></i> <?php echo $modifyDelete; ?></a>
                    <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="match_referee_update.php"><?php echo $usersPerMatch; ?></a><a class="dropdown-item" role="presentation" href="ranking_update.php"><?php echo $ranking_update; ?></a><a class="dropdown-item" role="presentation" href="match_update.php"><?php echo $match1; ?></a><a class="dropdown-item" role="presentation" href="update_general_info.php?id=1"><?php echo $city1; ?></a><a class="dropdown-item" role="presentation" href="update_general_info.php?id=2"><?php echo $teamCategory1; ?></a><a class="dropdown-item" role="presentation" href="update_general_info.php?id=3"><?php echo $userCategory1; ?></a><a class="dropdown-item" role="presentation" href="update_general_info.php?id=6"><?php echo $group1; ?></a><a class="dropdown-item" role="presentation" href="update_general_info.php?id=4"><?php echo $team1; ?></a><a class="dropdown-item" role="presentation" href="update_general_info.php?id=7"><?php echo $rating1; ?></a><a class="dropdown-item" role="presentation" href="user_update.php"><?php echo $user1; ?></a><a class="dropdown-item" role="presentation" href="court_update.php"><?php echo $court1; ?></a></div>
                </li>

                <li class="dropdown" style="background-color:rgba(255,255,255,0);"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="background-color:rgba(255,255,255,0);"><i class="fa fa-user"></i> <?php if(isset($_SESSION["username"])) echo$_SESSION["username"]; ?></a>
                    <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="chatting.php"><?php echo $chats; ?></a><a class="dropdown-item" role="presentation" href="admin_announcements.php"><?php echo $announcements; ?><a class="dropdown-item" role="presentation" href="admin_settings.php"><?php echo $settings; ?></a><a class="dropdown-item" role="presentation" href="./php/logout.php"><?php echo $logout; ?></a></div>
                </li>
            </ul>
        </div>
    </div>
</nav>