<?php
session_start();
require 'useful_functions.php';

setcookie('uname', '', time() - 7000000, '/');
setcookie('pwd', '', time() - 7000000, '/');
$_SESSION['server_response'] = 'Login απο άλλη συσκευή';
header('location: ../index.php');
die();