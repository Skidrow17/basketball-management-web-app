<?php
    session_start();
    $url = 'https://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
    
    if($_SESSION['profession'] === 'Admin'){
        $_SESSION['contact_id'] = $_GET['firebase_contact'];
        header('Location:'.$url.'/chatting.php');
        die();
    }else{
        $_SESSION['contact_id'] = $_GET['firebase_contact'];
        header('Location:'.$url.'/chatting_user.php');
        die();
    }
?>