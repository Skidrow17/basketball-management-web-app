<?php
if (isset($_SESSION['language'])) {
    if ($_SESSION['language'] == 'en') include ('labels_en.php');
    else include ('labels_gr.php');
}
?>