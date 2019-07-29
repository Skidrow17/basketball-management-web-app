<nav class="navbar navbar-light navbar-expand-md fixed-top navbar-transparency" id="nav_bar">
    <div class="container">
        <a class="navbar-brand" href="http://ekasdym.gr/news/"><img src="assets/img/ekas.png" height="40px" width="40px" alt="logo"></a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item" role="presentation">
                    <a class="nav-link" href="home_user.php"></i><i class="fa fa-home"></i> Αρχική </a>
                </li>
                <li class="dropdown" style="background-color:rgba(255,255,255,0);"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="background-color:rgba(255,255,255,0);"><i class="fa fa-user"></i> <?php echo $_SESSION["username"]; ?></a>
                    <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="announcements.php">Ανακοινώσεις</a><a class="dropdown-item" role="presentation" href="messages.php">Μηνύματα</a><a class="dropdown-item" role="presentation" href="add_restriction.php">Κωλύματα</a><a class="dropdown-item" role="presentation" href="match.php">Αγώνες</a><a class="dropdown-item" role="presentation" href="./php/logout.php">Αποσύνδεση</a></div>
                </li>
            </ul>
        </div>
    </div>
</nav>