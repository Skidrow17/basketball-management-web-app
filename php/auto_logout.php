<?php
session_start();
require 'useful_functions.php';
require 'language.php';

setcookie('uname', '', time() - 7000000, '/',null,null,true);
setcookie('pwd', '', time() - 7000000, '/',null,null,true);
$_SESSION['server_response'] = 'Logged in από άλλη συσκευή';
header('location: ../index.php');
die();