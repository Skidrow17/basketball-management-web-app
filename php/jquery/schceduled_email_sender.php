<?php

require_once __DIR__.'/../useful_functions.php';
require_once __DIR__.'/../connect_db.php';
require_once __DIR__.'/../language.php';

$sql = "SELECT DISTINCT(U.email) as emails_with_messages_today FROM message M,User U WHERE Date(date_time) = CURDATE() AND U.Id = M.receiver_id AND message_read = 0 AND receiver_delete = 0";
$run = $dbh->prepare($sql);
$run->execute();
while ($row = $run->fetch(PDO::FETCH_ASSOC)) {
    sleep(2);
    unread_messages_send($row['emails_with_messages_today']);
}