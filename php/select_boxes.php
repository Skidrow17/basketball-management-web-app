<?php
 
//Access: Admin & Authorized User
//Purpose: containes all the selectboxes fuctions for dynamic assignemnt of selectbox values

function getStates($selected) {
	
	if($_SESSION['language'] == 'gr'){
		echo '<select name="state" class="form-control" required>';
		if ($selected == 0) {
			echo '<option value="0" selected>Ενεργός</option><option value="1">Ανενεργός</option>';
		} else {
			echo '<option value="0">Ενεργός</option><option value="1" selected>Ανενεργός</option>';
		}
		echo '</select>';
	}else{
		echo '<select name="state" class="form-control" required>';
		if ($selected == 0) {
			echo '<option value="0" selected>Active</option><option value="1">Inactive</option>';
		} else {
			echo '<option value="0">Active</option><option value="1" selected>Inactive</option>';
		}
		echo '</select>';
	}
}
function getHuman_Power_By_Game($game, $type) {
    require 'connect_db.php';
    $sql = "Select U.id,U.name,U.surname from user U, human_power HP where HP.user_id=U.id AND HP.game_id = :gid AND u.profession=:prof";
    $lid = $dbh->prepare($sql);
    $lid->bindParam(':gid', $game, PDO::PARAM_INT);
    $lid->bindParam(':prof', $type, PDO::PARAM_INT);
    $lid->execute();
    echo '<select class="form-control" required>';
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value=' . $row['id'] . '>' . $row['name'] . ' ' . $row['surname'] . '</option>';
    }
    echo '</select>';
}
function getHuman_Power_By_Game1($game) {
    require 'connect_db.php';
	include 'language.php';
    $sql = "Select U.id,U.name,U.surname from user U, human_power HP where HP.user_id=U.id AND HP.game_id = :gid";
    $lid = $dbh->prepare($sql);
    $lid->bindParam(':gid', $game, PDO::PARAM_INT);
    $lid->execute();
    echo '<select class="form-control" required>';
    echo "<option value=''>";echo $referees."/".$judges; echo "</option>";
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value=' . $row['id'] . '>' . $row['name'] . ' ' . $row['surname'] . '</option>';
    }
    echo '</select>';
}
function getAllCities() {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from city where active=0";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="city" id="city" class="form-control" required>';
    echo "<option value=''>";echo $selectCity; echo"</option>";
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value=' . $row['id'] . '>' . $row['name'] . '</option>';
    }
    echo '</select>';
}
function getAllCourts() {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from court where active=0";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="court" id="court" class="form-control" required>';
    echo "<option value=''>";echo $selectCourt; echo"</option>";
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value=' . $row['id'] . '>' . $row['name'] . '</option>';
    }
    echo '</select>';
}
function getAllRates() {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from rate";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="rate" class="form-control" required>';
    echo "<option value=''>";echo $selectRate; echo"</option>";
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value=' . $row['id'] . '>' . $row['name'] . '</option>';
    }
    echo '</select>';
}
function getAllUser_categories() {
    require 'connect_db.php';
    $sql = "SELECT id,name from user_categories where active = 0";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="user_category" class="form-control" required>';
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value=' . $row['id'] . ' selected>' . $row['name'] . '</option>';
    }
    echo '</select>';
}
function getAllTeam_categories() {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from team_categories where active = 0";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="team_category" id="team_category" class="form-control" required>';
    echo "<option value=''>";echo $selectCategory; echo "</option>";
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value=' . $row['id'] . ' >' . $row['name'] . '</option>';
    }
    echo '</select>';
}
function getAllTeam_categories2() {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from team_categories where active = 0";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="team_category2" id="team_category2" class="form-control" required>';
    echo "<option value=''>";echo $selectCategory; echo"</option>";
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value=' . $row['id'] . ' >' . $row['name'] . '</option>';
    }
    echo '</select>';
}
function getAllTeam_Group() {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from team_groups where active = 0";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="team_group" id="team_group" class="form-control" required>';
    echo "<option value=''>";echo $select_group; echo "</option>";
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value=' . $row['id'] . ' >' . $row['name'] . '</option>';
    }
    echo '</select>';
}
function getLivingPlace($selected) {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from city where active = 0";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="living_place" class="form-control" required>';
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        if ($row['id'] == $selected) echo '<option value=' . $row['id'] . ' selected>' . $row['name'] . '</option>';
        if ($row['id'] != $selected) echo '<option value=' . $row['id'] . '>' . $row['name'] . '</option>';
    }
    echo '</select>';
}
function getDrivingLicence($selected) {
    echo '<select name="driving_licence" class="form-control" required>';
	
	if($_SESSION['language']=='en'){
		if ($selected == 0) {
			echo '<option value="0" selected>Yes</option><option value="1">No</option>';
		} else {
			echo '<option value="0">Yes</option><option value="1" selected>No</option>';
		}
	}
	
	if($_SESSION['language']=='gr'){
		if ($selected == 0 && $_SESSION['language']=='gr') {
			echo '<option value="0" selected>Ναι</option><option value="1">Οχι</option>';
		} else {
			echo '<option value="0">Ναι</option><option value="1" selected>Οχι</option>';
		}
	}
    echo '</select>';
}
function getRate($selected) {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from rate WHERE active = 0";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="rate" id="rate" class="form-control" required>';
    echo "<option value=''>";echo $selectRate; echo"</option>";
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        if ($row['id'] == $selected) echo '<option value=' . $row['id'] . ' selected>' . $row['name'] . '</option>';
        if ($row['id'] != $selected) echo '<option value=' . $row['id'] . '>' . $row['name'] . '</option>';
    }
    echo '</select>';
}
function getCourt($selected) {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from court where active = 0";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="court" class="form-control" required>';
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        if ($row['id'] == $selected) echo '<option value=' . $row['id'] . ' selected>' . $row['name'] . '</option>';
        if ($row['id'] != $selected) echo '<option value=' . $row['id'] . '>' . $row['name'] . '</option>';
    }
    echo '</select>';
}
function getUserCategory($selected) {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from user_categories where active = 0";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="user_category" id="user_category" class="form-control" required>';
    echo "<option value=''>";echo $selectCategory; echo"</option>";
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        if ($row['id'] == $selected) echo '<option value=' . $row['id'] . ' selected>' . $row['name'] . '</option>';
        if ($row['id'] != $selected) echo '<option value=' . $row['id'] . '>' . $row['name'] . '</option>';
    }
    echo '</select>';
}
function getGroups($selected) {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from team_groups where active = 0";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="groups" id="groups" class="form-control" required>';
    echo "<option value=''>";echo $selectCategory; echo"</option>";
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        if ($row['id'] == $selected) echo '<option value=' . $row['id'] . ' selected>' . $row['name'] . '</option>';
        if ($row['id'] != $selected) echo '<option value=' . $row['id'] . '>' . $row['name'] . '</option>';
    }
    echo '</select>';
}
function getUsers() {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name,surname FROM user ORDER BY name";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    echo '<select name="users" id="users" onchange="showUser(this.value)" class="form-control" required>';
    echo '<option value="">';echo $selectUser; echo'</option>';
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value=' . $row['id'] . '>' . $row['name'] . ' ' . $row['surname'] . '</option>';
    }
    echo '</select>';
}
function getAllPlayableCategories() {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from team_categories where active = 0";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        echo '<input name="playable_categories[]" type="checkbox" value=' . $row['id'] . ' > ' . $row['name'] . '';
        echo "  ";
    }
}
function getTeamById($id, $cat_id) {
    require 'connect_db.php';
	include 'language.php';
    $sql = "SELECT id,name from team where category=:cid and  active = 0";
    $lid = $dbh->prepare($sql);
    $lid->bindParam(':cid', $cat_id, PDO::PARAM_INT);
    $lid->execute();
    echo "<option value=''>";echo $selectTeam; echo"</option>";
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        if ($row['id'] == $id) echo '<option value=' . $row['id'] . ' selected>' . $row['name'] . '</option>';
        if ($row['id'] != $id) echo '<option value=' . $row['id'] . '>' . $row['name'] . '</option>';
    }
}
function getPlayableCategories($user_id) {
    require 'connect_db.php';
	include 'language.php';
    $playable_categories = array();
    $sql = "SELECT team_categories_id from playable_categories where user_id=:user_id";
    $x = $dbh->prepare($sql);
    $x->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $x->execute();
    while ($row = $x->fetch(PDO::FETCH_ASSOC)) {
        array_push($playable_categories, $row['team_categories_id']);
    }
    $sql = "SELECT id,name from team_categories where active = 0 ";
    $lid = $dbh->prepare($sql);
    $lid->execute();
    while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
        if (in_array($row['id'], $playable_categories)) {
            echo '<input name="playable_categories[]" type="checkbox" value=' . $row['id'] . ' checked> ' . $row['name'] . '';
            echo "  ";
        } 
        if (!in_array($row['id'], $playable_categories)) {
            echo '<input name="playable_categories[]" type="checkbox" value=' . $row['id'] . '> ' . $row['name'] . '';
            echo "  ";
        } 
        
    }
    
}

?>
