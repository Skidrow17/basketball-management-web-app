
<?php

//Access: Authorized User & Admin
//Purpose: helper to login to the database

$host = '/zstorage/home/ictest00909/mysql/run/mysql.sock';
$dbname = 'eok';
$user = 'root';
$pass = '';
// connect to database or return error
try
{
 $dbh = new PDO("mysql:unix_socket=$host;dbname=$dbname;charset=utf8", $user,$pass);
 $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
 $dbh->query('set character_set_client=utf8');
 $dbh->query('set character_set_connection=utf8');
 $dbh->query('set character_set_results=utf8');
 $dbh->query('set character_set_server=utf8');
 }
catch(PDOException $e)
{
//die('Connection error:' . $pe->getmessage()); 
die('Connection error:' . $e->getmessage()); 
}


?>

