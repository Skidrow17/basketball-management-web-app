<?php

//Access: Authorized User & Admin
//Purpose: Autologout in case the user loged in from different device

session_start();
require 'useful_functions.php';
require 'language.php';

setcookie('uname', '', time() - 7000000, '/','',true,true);
setcookie('pwd', '', time() - 7000000, '/','',true,true);

$_SESSION['server_response'] = 'Logged in από άλλη συσκευή';
header('location: ../index.php');
die();