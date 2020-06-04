<?php

//Access: Admin
//Purpose: exposes the information of a selected user for information update purpose

session_start();
require_once '../connect_db.php';
require_once '../select_boxes.php';
require_once '../useful_functions.php';
require_once('../language.php');

if (isset($_GET['q']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $sql = "Select U.profile_pic ,U.id , U.username , U.password, U.name,U.surname,U.email,U.phone,U.driving_licence,U.living_place,U.profession,U.active,U.rate from user U where U.id=:user_id";
        $run = $dbh->prepare($sql);
        $run->bindParam(':user_id', $_GET['q'], PDO::PARAM_INT);
        $run->execute();
        while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="form-row">';
            echo '<div class="col-xl-12"><small class="form-text text-muted">';echo $accountState; echo'</small><div class = "selectbox-design">';
            echo getStates($row['active']);
            echo '</div></div>
            
			</div>
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">';echo $name; echo'</small><input class="form-control" id="name" name="name" value="' . $row['name'] . '" type="text" maxlength="15"></div>
                <div class="col"><small class="form-text text-muted">';echo $surname; echo'</small><input class="form-control" id="surname" name="surname" value="' . $row['surname'] . '" type="text" maxlength="15"></div>
            </div>
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">';echo $username; echo'</small><input class="form-control" id="username" name="username" value="' . $row['username'] . '" type="text" autocomplete="off" maxlength="15" readonly></div>
                <div class="col"><small class="form-text text-muted">';echo $password; echo'</small><input class="form-control" placeholder="Νέος Κωδικός" name="password" type="password" autocomplete="off" maxlength="15"></div>
            </div>
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">';echo $email; echo'</small><input class="form-control" name="email" value="' . $row['email'] . '" type="email"></div>
                <div class="col"><small class="form-text text-muted">';echo $phone; echo'</small><input class="form-control" name="phone" value="' . $row['phone'] . '" type="text" maxlength="15"></div>
            </div>
            <div class="form-row">
                <div class="col"><small class="form-text text-muted">';echo $livingPlace; echo'</small><div class = "selectbox-design">';
            echo getLivingPlace($row['living_place']);
            echo '</div></div>
                <div class="col"><small class="form-text text-muted">';echo $rating; echo'</small><div class = "selectbox-design">';
            echo getRate($row['rate']);
            echo '</select></div>
			</div></div>
			<div class="form-row">
				<div class="col-xl-6"><small class="form-text text-muted">';echo $drivingLicence; echo'</small><div class = "selectbox-design">';
            echo getDrivingLicence($row['driving_licence']);
            echo '</div></div>
			<div
				<div class="col-xl-6"><small class="form-text text-muted">';echo $profession; echo'</small><div class = "selectbox-design">';
            echo getUserCategory($row['profession']);
            echo '</select></div></div>
			</div>
			<div class="form-row">
				<div class="col-xl-6"><small class="form-text text-muted">';echo $profileImage; echo'</small><input  name="profile_pic" id="profile_pic" value=' . $row['profile_pic'] . ' class="col-xl-12" type="file" /></div>
				<div class="col-xl-6"><small class="form-text text-muted">';echo $playableCategories; echo'</small>';
            echo getPlayableCategories($row['id']);
            echo '</div>
			</div>
			<div class="form-row">
			<div class="col-xl-12"><button class="btn btn-primary btn-lg" name="id" value=' . $row['id'] . ' style="width:100%" type="submit">';echo $addButton; echo'</button></div>
			</div> ';
        }
    } else {
        session_destroy();
        header('HTTP/1.0 401 Unauthorized');
        echo 'HTTP/1.0 401 Unauthorized';
		die();
    }
}
?>

