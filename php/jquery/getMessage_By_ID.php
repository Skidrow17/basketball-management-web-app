<?php
session_start();
require_once '../connect_db.php';
require_once '../useful_functions.php';

if (isset($_POST['message_id']) && isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
    if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true) {
        $mid = filter_var($_POST['message_id'], FILTER_SANITIZE_NUMBER_INT);
        $read = 1;
        if ($_POST['s_o_r'] == 1) {
            $sql = "select U.name , U.surname ,M.text_message from message M ,user U where U.id=M.sender_id AND M.id=:mid";
            $sql1 = "UPDATE message SET message_read=:read WHERE id=:id";
            $dbh->prepare($sql1)->execute([$read, $mid]);
        } else $sql = "select U.name , U.surname ,M.text_message from message M ,user U where U.id=M.receiver_id AND M.id=:mid";
        $run = $dbh->prepare($sql);
        $run->bindParam(':mid', $mid, PDO::PARAM_INT);
        $run->execute();
        if ($_POST['s_o_r'] == 1) {
            while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
                echo '<small class="form-text text-muted" style="color:rgba(150,1,1,0.15);">';
                echo $row['name'];
                echo " ";
                echo $row['surname'];
                echo '</small>
            <div class="form-group">
           
            </div>
            <div class="form-group"><textarea class="form-control" name="text" id="text" style="padding:50px;background-color:rgba(220,64,29,0.3);">';
                echo $row['text_message'];
                echo '</textarea></div> ';
            }
        } else {
            while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
                echo '<small class="form-text text-muted" style="color:rgba(150,1,1,0.15);">';
                echo $row['name'];
                echo " ";
                echo $row['surname'];
                echo '</small>
            <div class="form-group">
           
            </div>
            <div class="form-group"><textarea class="form-control" name="text" id="text" style="padding:50px;background-color:rgba(220,64,29,0.3);">';
                echo $row['text_message'];
                echo '</textarea></div> ';
            }
        }
    } else {
        session_destroy();
		echo 401;
    }
}
?>

