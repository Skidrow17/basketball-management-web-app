
<nav class="navbar navbar-light navbar-expand-md fixed-top navbar-transparency" id="nav_bar">
    <div class="container"><a class="navbar-brand" href="http://ekasdym.gr/news/"><img src="assets/img/ekas.png" height="40px" width="40px" alt="logo"></a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                    class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="home_admin.php" style="background-color:rgba(255,255,255,0);"><i class="fa fa-home"></i> Αρχική</a></li>
						
						<li class="dropdown" id="nav_table"  style="background-color:rgba(255,255,255,0);"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="background-color:rgba(255,255,255,0);"><i class="fa fa-table"></i> Πίνακες</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="show_login_history.php">Ιστορικό Συνδέσεων</a><a class="dropdown-item" role="presentation" href="show_restrictions.php">Κωλύματα</a><a class="dropdown-item" role="presentation" href="show_user_update_history.php">Ιστορικο Αναβάθμησης χρήστη</a></div>
                        </li>
						
						<li class="dropdown" style="background-color:rgba(255,255,255,0);"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="background-color:rgba(255,255,255,0);"><i class="fa fa-plus-square"></i> Προσθήκη</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="match_referee.php">Ταξινόμηση Διαιτητών</a><a class="dropdown-item" role="presentation" href="add_match.php">Αγώνας</a><a class="dropdown-item" role="presentation" href="add_general_info.php?id=1">Πόλη</a><a class="dropdown-item" role="presentation" href="add_general_info.php?id=2">Κατηγορία Ομάδας</a><a class="dropdown-item" role="presentation" href="add_general_info.php?id=3">Κατηγορία Χρήστη</a><a class="dropdown-item" role="presentation" href="add_general_info.php?id=4">Ομάδα</a><a class="dropdown-item" role="presentation" href="register.php">Χρήστη</a><a class="dropdown-item" role="presentation" href="court.php">Γήπεδο</a><a class="dropdown-item" role="presentation" href="add_general_info.php?id=5">Εφαρμογή Android</a></div>
                        </li>
						
						<li class="dropdown" style="background-color:rgba(255,255,255,0);"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="background-color:rgba(255,255,255,0);"><i class="fa fa-edit"></i> Επε/σία-Δια/φή</a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="match_referee_update.php">Διαιτητές Αγώνα</a><a class="dropdown-item" role="presentation" href="match_update.php">Αγώνας</a><a class="dropdown-item" role="presentation" href="update_general_info.php?id=1">Πόλη</a><a class="dropdown-item" role="presentation" href="update_general_info.php?id=2">Κατηγορία Ομάδας</a><a class="dropdown-item" role="presentation" href="update_general_info.php?id=3">Κατηγορία Χρήστη</a><a class="dropdown-item" role="presentation" href="update_general_info.php?id=4">Ομάδα</a><a class="dropdown-item" role="presentation" href="user_update.php">Χρήστη</a><a class="dropdown-item" role="presentation" href="court_update.php">Γήπεδο</a></div>
                        </li>   
						                       
					   <li class="dropdown" style="background-color:rgba(255,255,255,0);"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#" style="background-color:rgba(255,255,255,0);"><i class="fa fa-user"></i> <?php echo $_SESSION["username"]; ?></a>
                            <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="admin_messages.php">Μηνύματα</a><a class="dropdown-item" role="presentation" href="admin_announcements.php">Ανακοινώσεις</a><a class="dropdown-item" role="presentation" href="./php/logout.php">Αποσύνδεση</a></div>
                        </li>
                    </ul>
            </div>
    </div>
</nav>
