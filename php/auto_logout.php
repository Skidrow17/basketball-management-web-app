<?php
session_start();
require 'useful_functions.php';
require 'language.php';

setcookie('uname', '', [
    'expires' => time() - 7000000,
    'path' => '/',
    'secure' => true,
    'samesite' => 'None',
]);

setcookie('pwd', '', [
    'expires' => time() - 7000000,
    'path' => '/',
    'secure' => true,
    'samesite' => 'None',
]);



$_SESSION['server_response'] = 'Logged in από άλλη συσκευή';
header('location: ../index.php');
die();