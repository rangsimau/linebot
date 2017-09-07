<?php
$access_token = '/YZMxLtHT9N2GiL7e5GwGhKXsMz2KzRh/7icIPwvP4WDpZZRdqVZItf7P/I6gMd+IeNTVXuEHAokWIq3AayKY5GBSVCcalP/x3yh169Jtno517d5Ftq/rI9FGdBPsOzrg/SanRxQ30+lrN3IoPw6SAdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
$end = '•';
$start = '•';
$osposurl = 'tpmotorcycle.com';
$mainurl = 'tpmotorcycle.com';
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
		if(substr($gettext,0,1) == '$'){
			if($gettext == '$userid'){
				$text = $start.' '.$user.' '.$end;
			}elseif($gettext == '$roomid'){
				$text = $start.' '.$room.' '.$end;
			}elseif($gettext == '$groupid'){
				$text = $start.' '.$group.' '.$end;
			}elseif(substr($gettext,0,6) == '$price'){
				$bike = urlencode(substr($gettext,7));
				$text = 'http://'.$mainurl.'/tppricelist.php?search='.$bike;
			}elseif($gettext == '$accessories'){
				$text = 'http://'.$mainurl.'/accessories.php';
			}elseif($gettext == '$pricelist'){
				$text = 'http://'.$mainurl.'/tppricelist.php';
			}elseif($gettext == '$editpricelist'){
				$text = 'http://'.$mainurl.'/editpricelist.php';
			}elseif($gettext == '$admin'){
				$text = 'http://'.$osposurl.'/ospos/public';
			}elseif($gettext == '$bikestock'){
				$text = 'Bike Stock: https://www.evernote.com/pub/pokk/bikestock
R&G,CRG: https://www.evernote.com/pub/tppowersport/tppowersport
Rizoma: https://www.evernote.com/pub/tpmotorcycle/tpmotorcyclesnotebook';
			}elseif(substr($gettext,0,8) == '$payment'){
				$text = 'Customer not found, please try again';
				$customer = trim(substr($gettext,1));
				$customer = str_replace(' ','_',$customer);
				$link = 'http://'.$osposurl.'/payments/'.$customer.'.php';
				$pay = file_get_contents('http://'.$osposurl.'/payments/'.$customer.'.php');
				if($pay){
					$text = strip_tags(nl2br($pay));
					$text = $text."\n".$link;
				}
			}elseif(substr($gettext,0,10)=='$bank acct'){
				$text = strip_tags(nl2br(file_get_contents('http://'.$osposurl.'/payments/bank_acct.txt')));
			}elseif($gettext == '$instructions'){
				$text = $start.'$userid: return userid
$groupid: return groupid.
$roomid: return roomid.
$accessories: return accessories url.
$pricelist [search]: return pricelist url with search.
$editpricelist: return editpricelist url.
$admin: return admin url.
$bikestock: return bike stock url.
$payment [customer]: return overdue item list.
$bank acct: return TP bank account number.'.$end;
			}else{
				$text = 'No results, please check your spelling';
			}
		}
			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];
			// Make a 
			
			//T Request to Messaging API to reply to sender
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
	$table = urldecode($_GET['tbl']);
	$action = urldecode($_GET['act']);
	$key = urldecode($_GET['id']);
	$msg = urldecode($_GET['msg']);
	$h = urldecode($_GET['h']);
	$userid = urldecode($_GET['uid']);

	//$userid='Ud392f1479ba3a4e92d82c98ba78e9f46';
	//$groupid='C8b31f8f6b276cbc19262017f7ffe81e7';
	//$roomid= 'R3f9fba4239b99276d2bc2153eecb330a';
	//$emo = array('👌🏼','😉');
	//$indexOfEmo = rand(0, count($emo)-1);
	//$selectedemo = $emo[$indexOfEmo];
	if(strtolower($table) == 'price' ){
		//get bike name of id
		//$model = strip_tags(file_get_contents('http://tpmotorcycle.com/query/get-bike-name.php?key='.$key));
			if(strtolower($action) == "u"){
				$text = "อัพเดท [".$h."] เรียบร้อยค่ะ 😉";
			}elseif(strtolower($action) == "a"){
				$text = "เพิ่ม [".$h."] เรียบร้อยค่ะ 😉";
			}
	}
	elseif(strtolower($table) == 'sales'){
		$text = "🏃 เตรียมของพร้อมส่ง ".$h;
	}else{
		$text = $msg;
	}
			$messages = [
				'type' => 'image',
				'originalContentUrl' => 'https://tpmotorcycle.com/ospos/public/uploads/item_pics/Akrapovic-S-HDRODR1-BAVTBL-vrod-black.png'
				//'previewImageUrl' => 'https://tpmotorcycle.com/ospos/public/uploads/item_pics/Akrapovic-S-HDRODR1-BAVTBL-vrod-black.png'
				//'type' => 'text',
				//'text' => $text
				
			];
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/push';
			$data = [
				'to' => $userid,
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
