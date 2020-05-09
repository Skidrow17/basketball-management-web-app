<?php 
//Access: Admin
//Purpose: Settings

require_once("php/session_admin.php");
require_once('php/language.php');
require_once("http_to_https.php");
require_once("php/useful_functions.php"); 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ΕΚΑΣΔΥΜ - <?php echo $settings; ?></title>
    <?php include('head.php'); ?>
</head>

<body>
    <main class="page lanidng-page">
        <section class="portfolio-block photography"></section>
    </main>

    <?php include('admin_nav_bar.php'); ?>

    <div class="admin-look">
        <form method="post" action="./php/update/update_settings_db.php">

            <div class="form-row">
                <div class="col">
                    <h3 id='heading'><?php echo $settings; ?></h3>
                </div>
            </div>

            <?php include 'php/jquery/geUserSettings.php';?>

            <div class="row">
                <div class="col">
                    <button class="btn btn-primary btn-block" type="button" id='password_change_request'
                        style="background-color:rgb(220,64,29);"><?php echo $password_change_request; ?></button>
                </div>
                <div class="col">

                    <button class="btn btn-primary btn-block" type="submit" name='submit'
                        style="background-color:rgb(220,64,29);"><?php echo $addButton; ?></button>
                </div>
            </div>
    </div>

    <div class="form-row">
        <div class="col">
            <hr>
        </div>
    </div>

    <?php include('footer.php'); ?>
    <script src="assets/js/password_change_logged.js"></script>


</body>

</html>