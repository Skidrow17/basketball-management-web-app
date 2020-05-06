<?php 

//Access: Everyone 
//Purpose: forces the webpage to open using HTTPS

if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "") {
	$redirect = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: $redirect");
	die();
}
