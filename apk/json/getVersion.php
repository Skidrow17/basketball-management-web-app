<?php

//Access: Everyone
//Purpose: gets android version

require_once '../../php/connect_db.php';
require '../../php/useful_functions.php';
$fetch = array();

$fetch['application_version']['av'] = getVersionOfApk();
echo json_encode($fetch);