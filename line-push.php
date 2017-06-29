	<?php
	$access_token = '8vKMiroG4T1TmRvFnAFu9VXRXp0WQJGPmyxAA4Ae5mx+NISTXeuv6B8fSiEj3Tu/IeNTVXuEHAokWIq3AayKY5GBSVCcalP/x3yh169JtnpZ2EfUg99oC2c3VcySEpyCDAuFXKSbXMip966sAUrqCAdB04t89/1O/w1cDnyilFU=';
	$userid = 'Ud392f1479ba3a4e92d82c98ba78e9f46';
	$groupid = 'C8b31f8f6b276cbc19262017f7ffe81e7';
	echo '1';

	$type = $_GET['t'];
	$text = $_GET['s'];
	echo '2';
	$end = '•';
	$start = '•';
	if($type == 'user'){
		$to = $userid;
	}else($type == 'group'){
		$to = $groupid;
	}
	echo '3';
			// Build message to reply back
			$messages = [
				'type' => 'text',
				//'text' => 'userid: '.$user.'\n roomid: '.$room .'\n groupid: '.$group 
				'text' => $start.$text.$end
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

echo "OK";
