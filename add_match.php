<?php 

//Access: Admin
//Purpose: Add Match

require_once('./php/session_admin.php');
require_once('http_to_https.php');
require_once('php/useful_functions.php');
require_once('php/select_boxes.php');
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ΕΚΑΣΔΥΜ - Προσθήκη Αγώνα</title>
	<?php include('head.php'); ?>
</head>

<body>

	<?php include('admin_nav_bar.php'); ?>

	<div class="form-group"></div>
	<div class="admin-look" style="height:1052px;">
		<form method="post" action="./php/insert/insert_match.php">
			<div class="form-row">
				<div class="col">
					<h3>Αγώνας</h3>
				</div>
			</div>

			<div class="form-row">
				<div class="col">
					<hr>
				</div>
			</div>
			<div class="form-row">
				<div class="col"><small class="form-text text-muted">Κατηγορία Ομάδων</small>
					<?php echo getAllTeam_Categories(); ?>
				</div>
			</div>
			<div class="form-row">
				<div class="col"><small class="form-text text-muted">Ομάδα 1</small>
					<select id='team1' name='team1' class="form-control" required>
						<option value="-1" selected="">Επιλέξτε Κατηγορία</option>
					</select>
				</div>
				<div class="col"><small class="form-text text-muted">Ομάδα 2</small>
					<select id='team2' name='team2' class="form-control" required>
						<option value="-1" selected="">Επιλέξτε Κατηγορία</option>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="col"><small class="form-text text-muted">Ημερομηνία&nbsp;</small>
					<input name='date' class="form-control" type="date" required>
				</div>
				<div class="col"><small class="form-text text-muted">Ώρα</small>
					<input name='time' class="form-control" type="time" required>
				</div>
			</div>
			<div class="form-row">
				<div class="col"><small class="form-text text-muted">Πλήθος Διαιτητών</small>
					<input name='referee_num' class="form-control" min="1" max="4" type="number" required>
				</div>
				<div class="col"><small class="form-text text-muted">Πλήθος Κρητών<br></small>
					<input name='judge_num' class="form-control" min="1" max="4" type="number" required>
				</div>
			</div>
			<div class="form-row">
				<div class="col"><small class="form-text text-muted">Γήπεδο</small>
					<?php getAllCourts();?>
				</div>
				<div class="col"><small class="form-text text-muted">Επιπεδο Παιχνιδιού</small>
					<?php getAllRates();?>
				</div>
			</div>
			<button class="btn btn-primary btn-block" type="submit" name='submit' style="background-color:rgb(220,64,29);">Προσθήκη</button>
		</form>
	</div>

	<?php include('footer.php'); ?>
	<script src="assets/js/add_match.js"></script>

</body>

</html>