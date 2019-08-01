<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';


$stmt = $dbh->prepare("SELECT * FROM `user` WHERE CONCAT(name,' ',surname) like :searchVal");
$val = $_POST['search'];
$stmt->bindParam(':searchVal', $val, PDO::PARAM_STR);
$stmt->execute();
$Count = $stmt->rowCount(); 
$result = "";
if ($Count > 0) {
	while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$result = $result . '<button class="search-result" id="srch_button" width="100%" value="' . $data['id'] . '" type="button" class="search-result">' . $data['name'] . ' ' . $data['surname'] . '</button>';
	}
} else {
	$result = $result . '<div value="-1" type="button" class="search-result">Προσπάθησε Ξανά</div>';
}

echo $result;