<?php
$access_token = '8vKMiroG4T1TmRvFnAFu9VXRXp0WQJGPmyxAA4Ae5mx+NISTXeuv6B8fSiEj3Tu/IeNTVXuEHAokWIq3AayKY5GBSVCcalP/x3yh169JtnpZ2EfUg99oC2c3VcySEpyCDAuFXKSbXMip966sAUrqCAdB04t89/1O/w1cDnyilFU=';
$var = $_GET['var'];
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
//if (!is_null($events['events'])) {
	// Loop through each event
	//foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		//if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			//$gettext = $event['message']['text'];
			//$user = $event['source']['userId'];
			//$room = $event['source']['roomId'];
			//$group = $event['source']['groupId'];
			// Get replyToken
			//$replyToken = $event['replyToken'];
			//if($gettext == 'leave'){
			//	$text = 'Bye';
			//}else{
			//	$text = $gettext;}

			// Build message to reply back
			if(!is_unll($var) && $var<>''){
			$messages = [
				'type' => 'text',
				//'text' => 'userid: '.$user.' roomid: '.$room .' groupid: '.$group 
				'text' => $var
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [
				'to' => 'Ud392f1479ba3a4e92d82c98ba78e9f46',
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
			}
		//}
	//}
//}
echo "OK";
