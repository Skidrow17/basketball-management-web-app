<div class="footer-clean">

        <footer>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Developer</h3>
                        <ul>
                            <li>Silvan Sholla</li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 item">
                        <h3>Supervisors</h3>
                        <ul>
                            <li><a>Minas Dasygenis</a><br></li>
                            <li><a>Dimitris Ziouzios</a><br></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 item social"><a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="apk/Ekasdym.apk"><i class="icon ion-social-android"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a>
                        <p class="copyright">UOWM © All Rights Reserved <script>document.write(new Date().getFullYear())</script>  </p>
                    </div>
                </div>
            </div>
        </footer>
	
	<audio id="buzzer" src="assets/ringtone/message_alert.wav" type="audio/ogg"></audio>
	<script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/Fixed-navbar-starting-with-transparency.js"></script>
    <script src="assets/js/scroll-nav-diogo.js"></script>
    <script src="assets/js/scroll-nav-diogo.js"></script>
    <script src="assets/js/theme.js"></script>
	<script src="assets/js/snackbar.js"></script>
		<script src="assets/js/message_notification.js"></script>
	<script src="assets/js/datepicker.js"></script>
	<script src="assets/js/i18n/datepicker.gr.js"></script>
	<script src="assets/js/cookies.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
	


	
<?php 	

if(isset($_SESSION['server_response']))
{
	$message  = filter_var($_SESSION['server_response'], FILTER_SANITIZE_STRING);
	notification($message);
	unset($_SESSION['server_response']);
}

?>
		
		
</div>