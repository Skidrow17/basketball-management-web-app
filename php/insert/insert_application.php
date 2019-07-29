<?php
require_once '../connect_db.php';
require '../useful_functions.php';
session_start();
if (isset($_POST['version'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
        $version = filter_var($_POST['version'], FILTER_SANITIZE_STRING);
        $apk_file = $_FILES['apk_file']['name'];
        $target_dir = "../../apk/";
        $target_file = $target_dir . "Ekasdym.apk";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != "apk") {
            header('Location: ../../add_general_info.php?id=5&server_response=Επιτρέποντε μονο .apk αρχεία');
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["apk_file"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["apk_file"]["name"]) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $sql = "INSERT INTO `apk_version`(`apk_name`,`version_number`) VALUES 
	(?,?)";
        $run = $dbh->prepare($sql);
        $run->execute(["Ekasdym.apk", $version]);
        if ($run->rowCount() > 0) {
            $_SESSION['server_response'] = 'Eπιτυχία';
            header('Location: ../../add_general_info.php?id=5');
            die();
        } else {
            $_SESSION['server_response'] = 'Αποτυχία';
            header('Location: ../../add_general_info.php?id=5');
            die();
        }
    } else {
        session_destroy();
        $_SESSION['server_response'] = 'Login απο άλλη συσκευή';
        header('Location: ../../index.php');
        die();
    }
} else {
    header('Location: ../../add_general_info.php?id=5');
    die();
}
?>

