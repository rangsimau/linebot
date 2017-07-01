<?php
$access_token = '8vKMiroG4T1TmRvFnAFu9VXRXp0WQJGPmyxAA4Ae5mx+NISTXeuv6B8fSiEj3Tu/IeNTVXuEHAokWIq3AayKY5GBSVCcalP/x3yh169JtnpZ2EfUg99oC2c3VcySEpyCDAuFXKSbXMip966sAUrqCAdB04t89/1O/w1cDnyilFU=';
// Get POST body content
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
$end = '•';
$start = '•';
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$gettext = strtolower($event['message']['text']);
			$arr = explode(' ',trim($gettext));

			$first_word = $arr[0];
			$text = "";
			//$user = $event['source']['userId'];
			//$room = $event['source']['roomId'];
			//$group = $event['source']['groupId'];
			//$source_type = $event['source']['type'];

			// Get replyToken
			$replyToken = $event['replyToken'];
			/*
			if($gettext == 'userid'){
				$text = $start.' '.$user.' '.$end;
			}elseif($gettext == 'roomid'){
				$text = $start.' '.$room.' '.$end;
			
			}elseif($gettext == 'groupid'){
				$text = $start.' '.$group.' '.$end;
				
			}elseif($gettext == 'payment check'){
				$text = 'processing..';
			}elseif($gettext == 'yes'){
				$text = 'I love you';
			}elseif($gettext == 'no'){
				$text = 'Please tell me why';
			}elseif($gettext == 'marry'){
				$testcont = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php');
			}*/

			if($first_word == 'check'){
				$bike = substr($gettext,6);

				if(strpos(strtolower('Kawasaki Z900 2017'),$bike)){
					$text = 'Akrapôvic Slip on Carbon & Titanium  30000
Akrapovic Slip on Shỏrty 27500
+ คอ Full Stâinless 4-2-1 27500
+ การดความร้อน Heat Guard 7500

Ărrow 
Slip on Carbon-Carbon 22500
Slip on Titanium-Carbon 22500
Slip on Dark-Carbon 20500
Slip on MoTo GP 20500
- คอ Full 29500
- Heât Guard Carbon for Slip on 6500

สินค้าด้านล่างมีของเลยครับ
Akrapovic Full 
-Carbon 58000
-titanium 58000
-Limited 65500

Termignoni full 52000

Two Brother Full carbon black 47,500
Two Brother Full carbon silver 46,500

Arrow full Racetech
-Carbon+carbon 49,000
-titanium+carbon 49,000
-Dark+carbon 47,000

REMUS Full Okami 55500

HP corse Full Hydrôform 50500

Mivv Full 52500

Scorpion Gp carbon Full 57500

Austun Racing GP2R Full 78000

Race fit Black Edition & Growler Full 57500

Zard SHort Full 49000 
Zard Penta Full 47000


R&G 
FP0194BK กันล้มหน้า 2250
CR0057BK กันล้มหลัง 2250
CR0058BK กันล้มหลัง Offset 3500
CP0418BL กันล้มกลาง 3950
LP0219BK ท้ายแต่ง 5500
RAD0211 กาดหม้อน้ำ 3950

Puig ชิว Screen Sport 5850 Touring 6850
กันล้ม Prôtector 5500 
- Pro 6500
+ สี 1000 
ท้ายสั้น Tail 6500
อกดำ Belly 10500
อก Carbon Belly 11500

Ermax
ชิว Screen  4250
บังโคลนหลัง Hugger 5500
ฝาครอบเบาะ Seat 4700
อก belly 7500

Gillestooling 
เกียร์โยง Rearsets 21000
การดแฮน Hand GUard each ข้างละ 5500
มือเบรคมือคลัช Brake Lever 5500 & Clutch Lever 5500
อุดน้ำมันเครื่อง Engine Plug 3000 
กันล้ม Protector 8500
ยกสแตน Stand PSA 2500';
				}



			}
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
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
	}
}

/*else{
	$type = $_GET['t'];
	$text = $_GET['s'];
	
	$userid='Ud392f1479ba3a4e92d82c98ba78e9f46';
	$id='C8b31f8f6b276cbc19262017f7ffe81e7';
	$roomid= 'R3f9fba4239b99276d2bc2153eecb330a';
	if($type == 'user'){
		$id = $userid;
	}elseif($type=='room'){
		$id = $roomid;
	}
			$messages = [
				//'type' => 'text',
				//'text' => 'userid: '.$user.'\n roomid: '.$room .'\n groupid: '.$group 
				//'text' => $start.' '.$text.' '.$end
				
				'type' => 'template',
				'altText' => 'why',
				'template' => [
					'type' => 'confirm',
					'text' => 'sure?',
					'actions' => [
						['type'=>'message',
						 'label' => 'Yes',
						 'text' => 'yes'
						],['type' => 'message',
						  'label' => 'No',
						  'text' => 'no']
					]]
			];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [
				'to' => $id,
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
}*/
echo "OK";
