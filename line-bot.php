<?php
$access_token = '8vKMiroG4T1TmRvFnAFu9VXRXp0WQJGPmyxAA4Ae5mx+NISTXeuv6B8fSiEj3Tu/IeNTVXuEHAokWIq3AayKY5GBSVCcalP/x3yh169JtnpZ2EfUg99oC2c3VcySEpyCDAuFXKSbXMip966sAUrqCAdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
$end = '•';
$start = '•';
$mainurl = 'rangsima.com';
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$gettext = strtolower($event['message']['text']);
			$text = "";
			$user = $event['source']['userId'];
			$room = $event['source']['roomId'];
			$group = $event['source']['groupId'];
			$source_type = $event['source']['type'];

			// Get replyToken
			$replyToken = $event['replyToken'];
		if(substr($gettext,0,1) == '@'){
			if($gettext == '@userid'){
				$text = $start.' '.$user.' '.$end;
			}elseif($gettext == '@roomid'){
				$text = $start.' '.$room.' '.$end;
			}elseif($gettext == '@groupid'){
				$text = $start.' '.$group.' '.$end;
			}elseif(substr($gettext,0,6) == '@price'){
				$bike = urlencode(substr($gettext,7));
				$text = 'http://tpmotorcycle.com/tppricelist.php?search='.$bike;
			}elseif($gettext == '@accessories'){
				$text = 'http://www.tpmotorcycle.com/accessories.html';
			}elseif($gettext == '@pricelist'){
				$text = 'http://www.tpmotorcycle.com/tppricelist.php';
			}elseif($gettext == '@editpricelist'){
				$text = 'http://www.tpmotorcycle.com/editpricelist.php';
			}elseif($gettext == '@pos'){
				$text = 'http://www.tpmotorcycle.com/ospos/public';
			}elseif($gettext == '@bikestock'){
				$text = 'Bike Stock: https://www.evernote.com/pub/pokk/bikestock
R&G,CRG: https://www.evernote.com/pub/tppowersport/tppowersport
Rizoma: https://www.evernote.com/pub/tpmotorcycle/tpmotorcyclesnotebook';
			}elseif(substr($gettext,0,8) == '@payment'){
				$text = '.';
				$customer = trim(substr($gettext,8));
				$customer = str_replace(' ','_',$customer);
				$link = 'http://www.'.$mainurl.'/payments/payment_'.$customer;
				$pay = file_get_contents('http://www.'.$mainurl.'/payments/payment_'.$customer.'.txt');
				$text = strip_tags(nl2br($pay));
				$text = $text."\n".$link;
			}elseif($gettext == '@instructions'){
				$text = $start.'@userid: return userid
@groupid: return groupid
@roomid: return roomid
@accessories: return accessories url
@pricelist: return pricelist url
@editpricelist: return editpricelist url
@pos: return pos url
@payment [customer]: return overdue item list
@bikestock: return bike stock url'.$end;
			}else{
				$text = 'No results, please check your spelling';
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
else{
	$table = $_GET['tbl'];
	$action = $_GET['act'];
	//$user = $_GET['user'];
	$key = $_GET['id'];

	$userid='Ud392f1479ba3a4e92d82c98ba78e9f46';
	$groupid='C8b31f8f6b276cbc19262017f7ffe81e7';
	$roomid= 'R3f9fba4239b99276d2bc2153eecb330a';

	if(strtolower($table) == 'pricelist' ){
		//get bike name of id
		$model = strip_tags(file_get_contents('https://still-thicket-82675.herokuapp.com/line-push.php'));
		$text = $start.$text.$model.$end;
		if(strtolower($action) == "u"){
			$text = $text." แก้ไขเรียบร้อยค่ะ";
		}else{
			$text = $text." เพิ่มเรียบร้อยค่ะ";
		}
	}
			$messages = [
				'type' => 'text',
				'text' => $text
				
			];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [
				'to' => $groupid,
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
echo "OK";
