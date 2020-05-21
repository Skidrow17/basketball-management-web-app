<?php 
if(isset($_SERVER['HTTP_HOST'])){
    $url = "https://" . $_SERVER['HTTP_HOST'].'/';
    header('Location: '.$url.'~ece00909/EKA/index.php');
}