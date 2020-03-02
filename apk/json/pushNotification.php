<?php 

define( 'API_ACCESS_KEY', 'AAAApMEIeNU:APA91bEfkVs_--4jAPOVgmaoB3FL6mz1EDLyMki3ftV3mpazrF4PNsnC1UWL25jWHos0rydUNxO48ro9lFNRWYO0MMizo3yZxiriiDj69GbIzBdCv2NYMzQdPZ5Jyx_6jL3mK_6UIFG8' );
// set only for one for safety
$registrationId = 'cnHrMS5k6Qs:APA91bH_5iQ4QC_tLUnUBsuMjL8HPD_hiEnrccgB-nZYSs-HTc0T0XHZGwS9owq5soHkcon4rGJ9Jr0HiQHM1H-NZYr4Pyr0QHZfhE5lV0he5NS9dmVkgfJAVJksHj6qapeAZqWrw77R';
//$registrationId = '/topics/allDevices';
// prep the bundle
$msg = array
(
	'message' 	=> 'here is a message. message',
	'title'		=> 'This is a title. title',
	'subtitle'	=> 'This is a subtitle. subtitle',
	'tickerText'=> 'Ticker text here...Ticker text here...Ticker text here',
	'vibrate'	=> 1,
	'sound'		=> 1,
	'largeIcon'	=> 'large_icon',
	'smallIcon'	=> 'small_icon'
);

$fields = array
(
	'to' 	=> $registrationId,
	'data'	=> $msg
);
 
$headers = array
(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, true );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );
