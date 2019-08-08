<?php

require_once 'php/connect_db.php';
require_once 'php/select_boxes.php';
require_once 'php/useful_functions.php';
require_once 'php/language.php';

if (isset($_SESSION['safe_key']) && isset($_SESSION['user_id'])) {
	if (security_check($_SESSION['safe_key'], $_SESSION['user_id']) == true && $_SESSION['profession'] === 'Admin') {
		$sql = "Select language,polling_time from user where id=:uid";
		$run = $dbh->prepare($sql);
		$run->bindParam(':uid', $_SESSION["user_id"], PDO::PARAM_INT);
		$run->execute();
		while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
			echo '<div class="col"><small class="form-text text-muted">';
			echo $selectLanguage;
			echo '</small>';

			if ($row['language'] === 'en') {
				echo '<select id="language" name="language" class="form-control" required>
						<option value="en" selected>English</option>
						<option value="gr">Ελληνικά</option>
					</select>
				</div>';
			} elseif ($row['language'] === 'gr') {
				echo '<select id="language" name="language" class="form-control" required>
						<option value="en">English</option>
						<option value="gr" selected>Ελληνικά</option>
					</select>
				</div>';
			}

			echo '<div class="col"><small class="form-text text-muted">Polling Time';
			echo $minutes;
			echo '<br></small>
					<input name="pollingTime" value = "';
			echo $row['polling_time'];
			echo '" class="form-control" type="number" required>
				</div>';
		}
	} else {
		session_destroy();
		echo 401;
	}
}