<?php
 
//Access: Admin & Authorized User
//Purpose: autolanguage select based on user preferance

if (isset($_SESSION['language'])) {
    if ($_SESSION['language'] == 'en') include ('labels_en.php');
    else include ('labels_gr.php');
}else{
    include ('labels_gr.php');
}
?>