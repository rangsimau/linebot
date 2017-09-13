<?php
$access_token = '/YZMxLtHT9N2GiL7e5GwGhKXsMz2KzRh/7icIPwvP4WDpZZRdqVZItf7P/I6gMd+IeNTVXuEHAokWIq3AayKY5GBSVCcalP/x3yh169Jtno517d5Ftq/rI9FGdBPsOzrg/SanRxQ30+lrN3IoPw6SAdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
$end = '•';
$start = '•';
$baseurl = 'https://tpmotorcycle.com/';

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
			$special = false;
		if(substr($gettext,0,1) == '$')
		{
			if($gettext == '$userid')
			{
				$text = $start.' '.$user.' '.$end;
			}
			elseif($gettext == '$roomid')
			{
				$text = $start.' '.$room.' '.$end;
			}
			elseif($gettext == '$groupid')
			{
				$text = $start.' '.$group.' '.$end;
			}
			elseif(substr($gettext,0,6) == '$price')
			{
				$bike = urlencode(substr($gettext,7));
				$text = $baseurl.'tppricelist.php?search='.$bike;
			}
			elseif($gettext == '$accessories')
			{
				$text = $baseurl.'accessories.php';
			}
			elseif($gettext == '$pricelist')
			{
				$text = $baseurl.'tppricelist.php';
			}
			elseif($gettext == '$admin')
			{
				$text = $baseurl.'ospos/public';
			}
			elseif($gettext == '$bikestock')
			{
				$text = 'Bike Stock: https://www.evernote.com/pub/pokk/bikestock
R&G,CRG: https://www.evernote.com/pub/tppowersport/tppowersport
Rizoma: https://www.evernote.com/pub/tpmotorcycle/tpmotorcyclesnotebook';
			}
			elseif(substr($gettext,0,8) == '$payment')
			{
				$text = 'Customer not found, please try again';
				$customer = trim(substr($gettext,1));
				$customer = str_replace(' ','_',$customer);
				$link = $baseurl.'payments/'.$customer.'.php';
				$pay = file_get_contents($baseurl.'payments/'.$customer.'.php');
				if($pay){
					$text = strip_tags(nl2br($pay));
					$text = $text."\n".$link;
				}
			}elseif(substr($gettext,0,10)=='$bank acct'){
				$text = strip_tags(nl2br(file_get_contents($baseurl.'payments/bank_acct.txt')));
			}elseif($gettext == '$instructions'){
				$text = $start.'$userid: return userid
$groupid: return groupid.
$roomid: return roomid.
$accessories: return accessories url.
$price [search]: return pricelist url with search.
$admin: return admin url.
$bikestock: return bike stock url.
$payment [customer]: return overdue item list.
$bank acct: return TP bank account number.'.$end;
			}/*
			elseif(strtolower(substr($gettext,0,3)) == strtolower('$TP'))
			{
				$sale_id = (int)str_replace(' ','',substr($gettext,3));
				include('../connect.php');
				$sql = "SELECT sales_items.line as line, first_name, paid_amount, sale_item_type,brand,name,nameth,sales_items.color as color, sales_items.mmy as mmy, quantity_purchased, quantity_shipped
				from ospos_sales_items as sales_items 
				join ospos_items as items on items.item_id = sales_items.item_id
				join ospos_sales as sales on sales_items.sale_id = sales.sale_id
				join ospos_people as people on people.person_id = sales.customer_id
				where sales_items.sale_id = ".$sale_id;

				$result = $connect->query($sql);
				$rowcnt = $result->num_rows;
				$str = array();
				$sales_items = array();
				while($row = $result->fetch_assoc()) {
					$sales_items[] = $row;
				}
				
				if($rowcnt > 0){	
					foreach($sales_items as $item)
					{
						$name = '• '.$item['brand']." ".$item['name'];
						$name = empty($item['color']) ? $name : $name. ' ['.$item['color'].'] ';
						$name = $name. ' '.$item['mmy'].' x'.number_format($item['quantity_purchased']);
						$name = $item['sale_item_type'] == 'B' ? $name." 🔙" : $name;
						$name = $item['paid_amount'] == 0.00 ? $name : $name. " 💰"; 
						if($item['quantity_shipped'] == $item['quantity_purchased'])
						{
							$sql_ship = "SELECT ship_id
							from ospos_shippings_items as shippings_items 
							where sale_id = ".$sale_id." AND line = ".$item['line'];

							$result_ship = $connect->query($sql_ship);
							$rowcnt_ship = $result_ship->num_rows;

							$row_ship = $result_ship->fetch_assoc();

							$name = $name." 🚚 (SH ".$row_ship['ship_id'].")";
						}
						
						$first_name = $item['first_name'];
						$str[] = $name;
					}
					$text = 'TP '.$sale_id." - ".$first_name."\n\n".join("\n\n",$str);
				}
				else{
					$text = "This TP ID is invalid.";
				}

				$connect->close();
				
			}
			elseif(strtolower(substr($gettext,0,3)) == strtolower('$SH'))
			{
				$ship_id = str_replace(' ','',substr($gettext,3));

				include('../connect.php');
				$sql = "SELECT people.first_name as first_name, sales_items.sale_id as sale_id, brand, name, nameth, sales_items.color as color, sales_items.mmy as mmy, quantity_purchased, shippings_items.quantity_shipped as quantity_shipped, ship_img
				from ospos_shippings as shippings
				join ospos_shippings_items as shippings_items on shippings_items.ship_id = shippings.ship_id 
				join ospos_items as items on items.item_id = shippings_items.item_id
				join ospos_sales_items as sales_items on sales_items.item_id = shippings_items.item_id AND sales_items.sale_id = shippings_items.sale_id AND sales_items.line = shippings_items.line
				join ospos_sales as sales on sales.sale_id = sales_items.sale_id
				join ospos_people as people on people.person_id = sales.customer_id
				where sales_items.sale_item_type <> 'B' AND shippings.ship_id=".(int)$ship_id;

				$result = $connect->query($sql);
				$rowcnt = $result->num_rows;
				if($rowcnt > 0){
					while($row = $result->fetch_assoc()) {
						$name = '• TP '.$row['sale_id'].': '.$row['brand']." ".$row['name'];
						$name = empty($row['color']) ? $name : $name. ' ['.$row['color'].'] ';
						$name = $name. ' '.$row['mmy'].' x'.number_format($row['quantity_purchased']);
						$str[] = $name;
						$ship_imgs = $row['ship_img'];
						$first_name = $row['first_name'];
					}
					$text = 'SH '.$ship_id.' - '.$first_name."\n\n".join("\n\n",$str);

					if(!empty($ship_imgs))
					{
						$special = true;
						
						$msg[] = ['type'=>'text','text'=>$text];
						$ship_img = explode(",",$ship_imgs);
						foreach($ship_img as $img)
						{
							$path = $baseurl."/ospos/public/uploads/shipping_pics/".$img;
							$msg[] = ['type' => 'image','originalContentUrl' => $path, 'previewImageUrl' => $path];
						}
					}
					
				}else{
					$text = "This SH ID is invalid.";
				}
				$connect->close();

				//$text = join("\n\n",$str);
				//$text = $ship_imgs[0];
				$image = "https://tpmotorcycle.com/ospos/public/uploads/shipping_pics/1.jpg";
			}
			elseif(strtolower(substr($gettext,0,7)) == strtolower('$dealer'))
			{
				$customer_id =  (int)str_replace(' ','',substr($gettext,7));
				include('../connect.php');
				$sql = "SELECT sales_items.sale_id as sale_id,sales_items.line as line, first_name, paid_amount, sale_item_type,brand,name,nameth,sales_items.color as color, sales_items.mmy as mmy, quantity_purchased, quantity_shipped
				from ospos_sales_items as sales_items 
				join ospos_items as items on items.item_id = sales_items.item_id
				join ospos_sales as sales on sales_items.sale_id = sales.sale_id
				join ospos_people as people on people.person_id = sales.customer_id
				where sales.customer_id = ".$customer_id;

				$result = $connect->query($sql);
				$rowcnt = $result->num_rows;
				$sales_items = array();
				while($row = $result->fetch_assoc()) {
					$sales_items[] = $row;
				}
				foreach($sales_items as $item){
					$name = '• TP '.$item['sale_id'].": ".$item['brand']." ".$item['name'];
					$name = empty($item['color']) ? $name : $name. ' ['.$item['color'].'] ';
					$name = $name. ' '.$item['mmy'].' x'.number_format($item['quantity_purchased']);
					$name = $item['sale_item_type'] == 'B' ? $name." 🔙" : $name;
					$name = $item['paid_amount'] == 0.00 ? $name : $name. " 💰";
					if($item['quantity_shipped'] == $item['quantity_purchased'])
						{
							$sql_ship = "SELECT ship_id
							from ospos_shippings_items as shippings_items 
							where sale_id = ".$item['sale_id']." AND line = ".$item['line'];

							$result_ship = $connect->query($sql_ship);
							$rowcnt_ship = $result_ship->num_rows;

							$row_ship = $result_ship->fetch_assoc();

							$name = $name." 🚚 (SH ".$row_ship['ship_id'].")";
						}
					$str[] = $name;
				}

				$text = join("\n\n",$str);
				

				$connect->close();

				
			}*/
			else
			{
				$text = 'No results, please check your spelling';
			}
		}
			// Build message to reply back
			if(!$special)
			{
				$messages = [
					['type' => 'text',
					'text' => $text]
				];
			}
			else
			{
				$messages = $msg;
			}
			

			// Make a 
			
			//T Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => $messages,
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
	$date = urlencode($_GET['date']);
	//$userid='Ud392f1479ba3a4e92d82c98ba78e9f46';
	//$groupid='C8b31f8f6b276cbc19262017f7ffe81e7';
	//$roomid= 'R3f9fba4239b99276d2bc2153eecb330a';
	//$emo = array('👌','😉');
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
		if($action == 'c'){
			$text = "🏃 ↬ เตรียมของพร้อมส่ง จาก Backorder";
		}
		else{
			if($date != '' && $date != null){
				$text = "🔜📦 เตรียมของพร้อมส่ง ".$h." วันที่ ".$date;
			}
			else{
				$text = "🏃 เตรียมของพร้อมส่ง ".$h;
			}
		}
		
		
	}else{
		$text = $msg;
	}
			$messages = [
				//'type' => 'image',
				//'originalContentUrl' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/da/Internet2.jpg/220px-Internet2.jpg',
				//'previewImageUrl' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/da/Internet2.jpg/220px-Internet2.jpg'
				'type' => 'text',
				'text' => $text
				
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
?>
