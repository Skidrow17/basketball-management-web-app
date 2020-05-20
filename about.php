<?php 

//Access: Guest 
//Purpose: Information About Us 

session_start();
include 'php/useful_functions.php';
require 'php/language.php';
include 'php/select_boxes.php';
require("http_to_https.php");
if(isset($_COOKIE['uname'])&&isset($_COOKIE['pwd'])&&isset($_COOKIE['safe_key']))
header('Location: ./php/login.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ΕΚΑΣΔΥΜ - Σχετικά Με Εμάς</title>
    <?php include( 'head.php'); ?>
</head>

<body>
    <main class="page lanidng-page">
        <section class="portfolio-block photography"></section>
    </main>

    <?php include('index_nav_bar.php'); ?>

    <div class='form-row'>

        <div class='col-xl-4'>
            <div class="login-dark">
                <form method="post">
                    <div class="illustration"><img height="242" width="242" src="assets/img/silvan.PNG">
                    </div>
                    <hr>
                    <div>
                        <h3 style='color:black;text-align:center;'>Silvan Sholla</h3>
                    </div>
                    <div>
                        <h4 style='color:black;text-align:center;'>Developer</h4>
                    </div>
                    <div>
                        <h4 style='color:black;text-align:center;'>Uowm</h4>
                    </div>
                    <div>
                        <h5 style='color:black;text-align:center;'><a
                                href="https://www.facebook.com/silvan17">Facebook</a></h5>
                    </div>
                </form>
            </div>
        </div>

        <div class='col-xl-4'>
            <div class="login-dark" style="background-image:url(&quot;assets/css/balld.jpg&quot;);">
                <form method="post" border="1px" style="background-color:rgba(238,238,238,0.74);">
                    <div class="illustration"><img height="242" width="242" src="assets/img/mdasyg.jpg"
                            alt="Italian Trulli">
                    </div>
                    <hr>
                    <div>
                        <h3 style='color:black;text-align:center;'>Minas Dasygenis</h3>
                    </div>
                    <div>
                        <h4 style='color:black;text-align:center;'>Supervisor</h4>
                    </div>
                    <div>
                        <h4 style='color:black;text-align:center;'>Uowm</h4>
                    </div>
                    <div>
                        <h5 style='color:black;text-align:center;'><a
                                href="https://arch.icte.uowm.gr">Arch.icte.uowm</a></h5>
                    </div>
                </form>
            </div>
        </div>

        <div class='col-xl-4'>
            <div class="login-dark" style="background-image:url(&quot;assets/css/balld.jpg&quot;);">
                <form method="post">
                    <div class="illustration"><img height="242" width="242" src="assets/img/ziuzios.jpeg"
                            alt="Italian Trulli">
                    </div>
                    <hr>
                    <div>
                        <h3 style='color:black;text-align:center;'>Dimitris Ziouzios</h3>
                    </div>
                    <div>
                        <h4 style='color:black;text-align:center;'>Supervisor</h4>
                    </div>
                    <div>
                        <h4 style='color:black;text-align:center;'>Uowm</h4>
                    </div>
                    <div>
                        <h5 style='color:black;text-align:center;'><a href="http://ziouzios.blogspot.com/">Blogspot</a>
                        </h5>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include( 'index_footer.php'); ?>

</body>

</html>