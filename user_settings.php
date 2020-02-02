<?php 
//Access: Authorized User
//Purpose: User Home page
require_once("php/session.php");
require_once('php/language.php');
require_once("http_to_https.php");
require_once('php/useful_functions.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ΕΚΑΣΔΥΜ - <?php echo $homePage; ?></title>
    <?php include('head.php'); ?>
</head>

<body>
    <main class="page lanidng-page">
        <section class="portfolio-block photography"></section>
    </main>
    <?php include('nav_bar.php'); ?>
    <div class='form-row'>

        <div class='col-xl-6'>
            <div class="annoucements-look element">
                <form method="post" action="./php/update/update_settings_db.php">

                    <div class="form-row">
                        <div class="col">
                            <h3 id='heading'><?php echo $settings; ?></h3>
                        </div>
                    </div>

                    <?php include 'php/jquery/geUserSettings.php';?>

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-primary btn-block" type="button"
                                id='password_change_request'><?php echo $password_change_request; ?></button>
                        </div>
                        <div class="col">

                            <button class="btn btn-primary btn-block" type="submit"
                                name='submit'><?php echo $addButton; ?></button>
                        </div>

                    </div>


                    <div class="form-row">
                        <div class="col">
                            <hr>
                        </div>
                    </div>

                </form>
            </div>
        </div>



        <div class='col-xl-6'>
            <div class="annoucements-look element">
                <form method="post" style="display:none;" id="showHistory">
                    <div class="form-row">
                        <div class="col">
                            <h3><?php echo $loginHistory;?></h3>
                        </div>
                    </div>

                    <div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class='page-item' style='color:rgb(220,64,29);'><a id="previous" name="previous"
                                        class='page-link' aria-label='Previous'><span aria-hidden='true'>«</span></a>
                                </li>
                                <li class='page-item' style='color:rgb(220,64,29);'><a id="min" name="previous"
                                        class='page-link' aria-label='Previous'><span aria-hidden='true'>0</span></a>
                                </li>
                                <li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link'
                                        aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
                                <li class='page-item' style='color:rgb(220,64,29);'><a id="current" name="previous"
                                        class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a>
                                </li>
                                <li class='page-item' style='color:rgb(220,64,29);'><a name="previous" class='page-link'
                                        aria-label='Previous'><span aria-hidden='true'>..</span></a></li>
                                <li class='page-item' style='color:rgb(220,64,29);'><a id="max" name="previous"
                                        class='page-link' aria-label='Previous'><span aria-hidden='true'>..</span></a>
                                </li>
                                <li class='page-item' style='color:rgb(220,64,29);'><a id="next" name="next"
                                        class='page-link' aria-label='Previous'><span aria-hidden='true'>»</span></a>
                                </li>
								
                            </ul>
                        </nav>
                    </div>

                    <div style="overflow-x:auto;">
                        <table id='here'>
                        </table>
                    </div>

                    <div class="form-row">
                    </div>
                </form>

                <form id="spinnerPanel" method="post" style="height:510px;">
                    <div class="lds-hourglass"></div>
                </form>

                <form id="noData" method="post" style="height:510px;display:none;">
                    <div>
                        <h3 style="position: relative;padding-top:30%;"><?php echo $noDataAvailable; ?></h3>
                    </div>
                </form>

            </div>
        </div>



    </div>
    </div>

    <?php include('footer.php'); ?>
	<script src="assets/js/users_login_history.js"></script>
	<script src="assets/js/password_change_logged.js"></script>


</body>

</html>