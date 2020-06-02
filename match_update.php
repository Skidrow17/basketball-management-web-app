<?php 
//Access: Admin
//Purpose: Updates the match details
require_once('php/session_admin.php');
require_once('php/language.php');
require_once('http_to_https.php');
require_once('php/useful_functions.php');
require_once('php/select_boxes.php');
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ΕΚΑΣΔΥΜ - <?php echo $matchUpdate; ?></title>
        <?php include('head.php'); ?>
    </head>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <body>
        <main class="page lanidng-page">
            <section class="portfolio-block photography"></section>
        </main>
       
        <?php include('admin_nav_bar.php'); ?>
            <div class="admin-look">
                <form method="post" action="./php/update/update_match_db.php" enctype="multipart/form-data">

                    <div class="form-row">
                        <div class="col">
                            <h3><?php echo $match; ?></h3>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <hr>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col"><small class="form-text text-muted"><?php echo $teamCategory; ?></small>
                            <div class = "selectbox-design">
                                <?php echo getAllTeam_Categories(); ?>
                            </div>
                        </div>

                        <div class="col"><small class="form-text text-muted"><?php echo $match; ?></small>
                            <div class = "selectbox-design">
                                <select class="form-control" id="matches" name="matches">
                                    <option><?php echo $selectCategory; ?></option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col">
                            <hr>
                        </div>
                    </div>

                    <div id='tableta'>
                    
                    </div>

            </div>

            </form>
            </div>

            <?php include('footer.php'); ?>
                <script src="assets/js/match_update.js"></script>

    </body>

    </html>