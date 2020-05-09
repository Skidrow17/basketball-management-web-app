<?php

//Access: Authorized User & Admin
//Purpose: profile pic change

require_once 'connect_db.php';
require_once 'useful_functions.php';

$fetch = array();

if (isset($_GET['safe_key']) && isset($_GET['id']))
{
    $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);		
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $DefaultId = 0;
        $ImageData = $_POST['image_path'];
		$ImageName = randomString(20);
		$ImagePath = "../../assets/img/users/$ImageName.jpg";
		$AbsoluteImagePath = "assets/img/users/$ImageName.jpg";

		$sql = "UPDATE user SET profile_pic=? where id = ?";
        $run = $dbh->prepare($sql);
        $run->execute([$AbsoluteImagePath, $id]);
		
        if ($run->rowCount() > 0) 
        {
            file_put_contents($ImagePath, base64_decode($ImageData));
            $fetch['ERROR']['error_code'] = "200";
		}
    }
    else
    {
        $fetch['ERROR']['error_code'] = "201";
	}
}
else
{
    $fetch['ERROR']['error_code'] = "403";
}

echo json_encode($fetch);