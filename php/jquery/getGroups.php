<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';
require_once '../language.php';

if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if ((security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true)) {
        
        $sql = "SELECT DISTINCT G.id,G.name FROM team_categories C,team_groups G,team T WHERE C.Id = T.category AND G.Id = T.team_group AND C.id = :cid AND T.active = 0";
        $lid = $dbh->prepare($sql);
        $lid->bindParam(':cid', $_POST["cid"], PDO::PARAM_INT);
        $lid->execute();

        if ($lid->rowCount() > 1) {
            echo '<select name="group" id="group" class="form-control" required>';
            echo "<option value=''>";echo $select_group; echo"</option>";
            while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
                if($row['id'] != null){
                    echo '<option value=' . $row['id'] . ' >' . $row['name'] . '</option>';
                }
            }
            echo '</select>';
        }else if($lid->rowCount() == 1){

            while ($row = $lid->fetch(PDO::FETCH_ASSOC)) {
                if($row['id'] != 0){
                    echo '<select name="group" id="group" class="form-control" required>';
                    echo "<option value=''>";echo $select_group; echo"</option>";
                    echo '<option value=' . $row['id'] . ' >' . $row['name'] . '</option>';
                }else{
                    echo 0;
                }
            }
        }

    } else {
		session_destroy();
        echo 401;
    }
}
?>

