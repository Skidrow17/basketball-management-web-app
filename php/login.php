<?php
require 'connect_db.php';
require 'useful_functions.php';
session_start();
$cookie_time = time() + 60 * 60 * 60;
$username = '';
$password = '';
$safe_key = '';
if ((isset($_POST['password']) && isset($_POST['username'])) || (isset($_COOKIE['uname']) && isset($_COOKIE['pwd']) && isset($_COOKIE['safe_key']))) {
    if (isset($_COOKIE['uname']) && isset($_COOKIE['pwd']) && isset($_COOKIE['safe_key'])) {
        $username = preg_replace("/[^a-zA-Z0-9]+/", "", $_COOKIE['uname']);
        $password = filter_var($_COOKIE['pwd'], FILTER_SANITIZE_STRING);
        $safe_key = preg_replace("/[^a-zA-Z0-9]+/", "", $_COOKIE['safe_key']);
		
        $sql = "SELECT U.language,U.polling_time,U.id,U.username,U.password,U.name,U.surname,U.email,U.phone,U.profile_pic,U.active,U_C.name as profession FROM user U , user_categories U_C where U.profession=U_C.id AND U.username=:username";
        $run = $dbh->prepare($sql);
        $run->bindParam(':username', $username, PDO::PARAM_STR);
        $run->execute();
        if ($run->rowCount() > 0) {
            while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
                if ((password_verify($password, $row['password']) == true)) {
                    if (security_check($safe_key, $row['id']) == true) {
						
						$_SESSION['polling_mins'] = $row['polling_time'];
						$_SESSION['polling_time'] = round(microtime(true) * 1000) + 60000 * $_SESSION['polling_mins'];
						$_SESSION['language'] = $row['language'];
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['surname'] = $row['surname'];
                        $_SESSION['profile_pic'] = $row['profile_pic'];
                        $_SESSION['safe_key'] = $safe_key;
                        $_SESSION['profession'] = $row['profession'];
                        $_SESSION['N_O_M'] = getNumberOfMessages($row['username']);
                        $_SESSION['L_L_H'] = getLastLoginHistoryId($row['id']);
                        if ($row['active'] == 0) {
                            if ($_SESSION['profession'] === 'Admin') {
                                if($_SESSION['language'] == 'gr') $_SESSION["server_response"] = 'Καλώς ήρθες ' . $row['name'] . ' ' . $row['surname'] . '';
								else $_SESSION["server_response"] = 'Welcome ' . $row['name'] . ' ' . $row['surname'] . '';
                                header('Location: ../home_admin.php');
                                die();
                            } else {
                                if($_SESSION['language'] == 'gr') $_SESSION["server_response"] = 'Καλώς ήρθες ' . $row['name'] . ' ' . $row['surname'] . '';
								else $_SESSION["server_response"] = 'Welcome ' . $row['name'] . ' ' . $row['surname'] . '';
								header('Location: ../home_user.php');
                                die();
                            }
                        } else {
                            
                            setcookie('uname', '', [
                                'expires' => time() - 7000000,
                                'path' => '/',
                                'secure' => true,
                                'samesite' => 'None',
                                'httponly' => true,
                            ]);

                            setcookie('pwd', '', [
                                'expires' => time() - 7000000,
                                'path' => '/',
                                'secure' => true,
                                'samesite' => 'None',
                                'httponly' => true,
                            ]);

                            setcookie('safe_key', '', [
                                'expires' => time() - 7000000,
                                'path' => '/',
                                'secure' => true,
                                'samesite' => 'None',
                                'httponly' => true,
                            ]);

                            if($_SESSION['language'] == 'gr') $_SESSION["server_response"] = 'Ανενεργός Λογαριασμός';
							else $_SESSION["server_response"] = 'Inactive Account';
                            header('Location: ../index.php');
                            die();
                        }
                    } else {
                
                        setcookie('uname', '', [
                            'expires' => time() - 7000000,
                            'path' => '/',
                            'secure' => true,
                            'samesite' => 'None',
                            'httponly' => true,
                        ]);

                        setcookie('pwd', '', [
                            'expires' => time() - 7000000,
                            'path' => '/',
                            'secure' => true,
                            'samesite' => 'None',
                            'httponly' => true,
                        ]);

                        setcookie('safe_key', '', [
                            'expires' => time() - 7000000,
                            'path' => '/',
                            'secure' => true,
                            'samesite' => 'None',
                            'httponly' => true,
                        ]);

					    $_SESSION["server_response"] = 'Login Απο άλλη συσκευή';
                        header('Location: ../index.php');
                        die();
                    }
                } else {

                    setcookie('uname', '', [
                        'expires' => time() - 7000000,
                        'path' => '/',
                        'secure' => true,
                        'samesite' => 'None',
                        'httponly' => true,
                    ]);

                    setcookie('pwd', '', [
                        'expires' => time() - 7000000,
                        'path' => '/',
                        'secure' => true,
                        'samesite' => 'None',
                        'httponly' => true,
                    ]);

                    setcookie('safe_key', '', [
                        'expires' => time() - 7000000,
                        'path' => '/',
                        'secure' => true,
                        'samesite' => 'None',
                        'httponly' => true,
                    ]);

                    if($_SESSION['language'] == 'gr') $_SESSION["server_response"] = 'Λάνθασμένος κωδικός';
					else $_SESSION["server_response"] = 'Wrong Password';
                    header('Location: ../index.php');
                    die();
                }
            }
        } else {
            unset($_COOKIE['uname']);
            unset($_COOKIE['pwd']);
            unset($_COOKIE['safe_key']);
            $_SESSION["server_response"] = 'Eλένξτε ξανά το username';
            header('Location: ../index.php');
            die();
        }
    }elseif(isset($_POST['username']) && isset($_POST['password'])){
        $username = preg_replace("/[^a-zA-Z0-9]+/", "", $_POST['username']);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $safe_key = randomString(15);
        $sql = "SELECT U.language,U.polling_time,U.id,U.username,U.password,U.name,U.surname,U.email,U.phone,U.profile_pic,U.active,U_C.name as profession FROM user U , user_categories U_C where U.profession=U_C.id AND U.username=:username";
        $run = $dbh->prepare($sql);
        $run->bindParam(':username', $username, PDO::PARAM_STR);
        $run->execute();
        if ($run->rowCount() > 0) {
            while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
                if ((password_verify($password, $row['password']) == true)) {
					$_SESSION['polling_mins'] = $row['polling_time'];
					$_SESSION['polling_time'] = round(microtime(true) * 1000) + 60000 * $_SESSION['polling_mins'];
					$_SESSION['language'] = $row['language'];
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['surname'] = $row['surname'];
                    $_SESSION['profile_pic'] = $row['profile_pic'];
                    $_SESSION['safe_key'] = $safe_key;
                    $_SESSION['profession'] = $row['profession'];
                    $_SESSION['N_O_M'] = getNumberOfMessages($row['username']);
                    $_SESSION['L_L_H'] = getLastLoginHistoryId($row['id']);
                    $device = "Browser";
                    $sql = "INSERT INTO login_history (user_id,safe_key,device_name,ip)VALUES (:id,:safe_key,:device_name,:ip)";
                    $res = $dbh->prepare($sql);
                    $res->bindParam(':safe_key', $safe_key, PDO::PARAM_STR);
                    $res->bindParam(':id', $row['id'], PDO::PARAM_INT);
                    $res->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                    $res->bindParam(':device_name', $device, PDO::PARAM_STR);
                    $res->execute();
                   
                    setcookie('uname', $username, [
                        'expires' => $cookie_time,
                        'path' => '/',
                        'secure' => true,
                        'samesite' => 'None',
                        'httponly' => true,
                    ]);

                    setcookie('pwd', $password, [
                        'expires' => $cookie_time,
                        'path' => '/',
                        'secure' => true,
                        'samesite' => 'None',
                        'httponly' => true,
                    ]);

                    setcookie('safe_key',$safe_key, [
                        'expires' => $cookie_time,
                        'path' => '/',
                        'secure' => true,
                        'samesite' => 'None',
                        'httponly' => true,
                    ]);

                    if ($row['active'] == 0) {
                        if ($row['profession'] === 'Admin') {
                            if($_SESSION['language'] == 'gr') $_SESSION["server_response"] = 'Καλώς ήρθες ' . $row['name'] . ' ' . $row['surname'] . '';
							else $_SESSION["server_response"] = 'Welcome ' . $row['name'] . ' ' . $row['surname'] . '';
                            header('Location: ../home_admin.php');
                            die();
                        } else {
                            if($_SESSION['language'] == 'gr') $_SESSION["server_response"] = 'Καλώς ήρθες ' . $row['name'] . ' ' . $row['surname'] . '';
							else $_SESSION["server_response"] = 'Welcome ' . $row['name'] . ' ' . $row['surname'] . '';
                            header('Location: ../home_user.php');
                            die();
                        }
                    } else {
                        if($_SESSION['language'] == 'gr') $_SESSION["server_response"] = 'Ανενεργός Λογαριασμός';
						else $_SESSION["server_response"] = 'Inactive Account';
                        header('Location: ../index.php');
                        die();
                    }
                } else {
					$_SESSION["server_response"] = 'Λάνθασμένος κωδικός';
                    header('Location: ../index.php');
                    die();
                }
            }
        } else {
			$_SESSION["server_response"] = 'Eλένξτε ξανά το username';
            header('Location: ../index.php');
            die();
        }
    } else {
        $_SESSION["server_response"] = 'Eλένξτε ξανά το username';
        header('Location: ../index.php');
        die();
    }
}else{
	echo "error";
}
?>