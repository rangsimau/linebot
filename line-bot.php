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
				$bike = substr($gettext,7);

				if(strpos(strtolower('Kawasaki Z900 2017'),$bike)){
					$text = 'Kawasaki Z900 2017
					Akrapôvic Slip on Carbon & Titanium  30000
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
				if(strpos(strtolower('Honda Rebel 2017'),$bike)){
					$text = 'Honda Rebel 2017 
Twobrother Full Aluminium 20000
Two brothers Full Black 25000
';
				}

				if(strpos(strtolower('CRF 250L'),$bike)){
					$text = 'CRF 250L
					Fmf Q4 slip on  19,500
Fmf powercore slip on 16,500 
Two brother slip on Aluminium 16500

Rally Rack 8500';

				}

				if(strpos(strtolower('Suzuki SV650 2016-2017'),$bike)){
					$text = 'Akrapovic Slip on Cảrbon 23500
Termignoni Slip on Steel-Carbon 19500
';}

				if(strpos(strtolower('Ducati Scramble Sixty 400'),$bike)){
						$text='Ducati Scramble Sixty 400
Zard Zuma Slip on 25500';}

				if(strpos(strtolower('Kawasaki ER6N/F 12-16'),$bike)){
					$text = 'Akrapovic full titanium 31500

Arrow full dark ปลาย stanless 33500
Arrow full dark ปลาย carbon  34500
Arrow full carbon ปลาย carbon 36500
Arrow full Titanium ปลาย Carbon 36500

Leovince full underbody  27500

Remus 
full dark titanium carbon 28500
Full titanium carbon 28500

Termignoni 
Full stanless 25500
Full carbon 27500

Two brother 
Full Carbon black 29500

Zard full 27500

Yoshimura full rs4s stanless (หัวcarbon) 29500

Mivv full 28500

Hp corse  full 27500

OverRacing full titanium 49000

GPR full titanium 27500 stainless 25500

Scorpion serket carbon 32500


Ermax 
ชิว 6n 4800 6f 5500
ท้ายสั้น 6500
ฝาครอบ 4800
บังโคลนหลัง 5500

Hyperpro Csc 17500.Rsc 19500
Street box 26500
Ohlins 26500

Gilles Tooling 18500 + passenger 9500

Marchesini 10 spokes 90000

Magical Ninja650 ปรอท 20000

Puig 
ชิว 5500
กันล้ม 6500

Mra 4700
Zero DB 4700
Zero touring 5500 

Power commander 20500

Power bronze 
ชิว 5500
การดไฟหน้า 3000

Galfer จานเบรค 22500+7500

R&G
กันล้มกลาง Kawasaki Er6n = 4,950
ท้ายแต่งKawasaki Er6n = 5,000
';}
	
				if(strpos(strtolower('Versys 650 2015-2018'),$bike)){
					$text = 'Mra VTM 2 ชั้นเล็ก 7000
Mra XCTM 2 ชั้นใหญ่ 8000
Mra ชั้นเดียว 5500
Puig 2 ชั้น 8000
Puig ชั้นเดียว 7000 

Hyperpro Rsc 20000 Csc 18500

รายการท่อ
Akrapovic full titanium 31500

Arrow full dark ปลาย stanless 33500
Arrow full dark ปลาย carbon  34500
Arrow full carbon ปลาย carbon 36500
Arrow full Titanium ปลาย Carbon 36500

Leovince full underbody  27500

Remus 
full dark titanium carbon 28500
Full titanium carbon 28500

Termignoni 
Full stanless 25500
Full carbon 27500

Two brother 
Full Carbon black 29500

Zard full 27500

Yoshimura full rs4s stanless (หัวcarbon) 29500

Mivv full 28500

Hp corse  full 27500

Over full titanium 49000

GPR full titanium 27500 stainless 25500
';}
					if(strpos(strtolower('GSXR1000 2017-2018 All new!!'),$bike)){
						$text = 'GSXR1000 2017-2018 All new!!
						Ărrow Slip GP 20000
Ărrow Slip Titanium-Carbon 23500
Ărrow Slip Carbon-Carbon 23500
Ărrow Full Competition Racetech 85000
Ărrow Full Competition MoTO GP 85000

Yoshimura Alpha Slip Titanium 35000
Yoshimura Alpha Full Titanium 95000
Yoshimura อุดกระจก 3850

MRA ชิว 4700
Puig ชิว 5500
Puig ท้ายสั้น 5500
Puig กันล้มหน้า 4500 กลาง 7500 หลัง 4500

Powerbronze
บังโคลนหน้า 12500 หลัง 12500 
บังโซ่ 7500

GBracing 15000

R&G
FP0112BK กันล้มหน้า 2250
CP0422BL กันล้มกลาง 9900
CR0061BK กันล้มหลัง 2950
RAD9019BK กาดหม้อน้ำ+Oil 7500
LP0222BK ท้ายแต่ง 4950

Braketech Front Iron 35000  SS 30000
Braketech Rear iron 14500 SS 12500
';}
					if(strpos(strtolower('Honda CBR1000RR 2017'),$bike)){$text = 'Honda CBR1000RR 2017 

Akrapôvic Slip on MotO GP 27500
Akrapôvic Slip on Cat GP 42500
- Header Stainless 37500
- Header Evolution 67500
Akrapôvic Full Evolution GP 90000
Akrapôvic Full SS GP 70000
- Brancket ขายึด Carbon 7500

Ărrow Slip + Link racetech 30000 
Ărrow Slip + Link MoTo GP 30000
Ărrow Full cơmpetition MoTo GP 85000
Ărrow Full competition Racetech 85000

Yoshimura Slip on Alpha Titanium 37500

MRA ชิว 4700 
Puig ชิว 5500

Cox 5500

Yoshimura  อุดกระจก 3850

Powerbronze
บังโคลนหน้า 12500 หลัง 12500 
บังโซ่ 7500

GBracing 15000
';}
					if(strpos(strtolower('Ducati1199/899/1299/959 panigale'),$bike)){$text = 'Ducati1199/899/1299/959 panigale
เงื่อนไข 1299=959 ไม่เหมือน 1199/899
อ่านคอมเม้น

Magical Racing 
ปรอท 18500 
ควัน 16500 
Tank end 11000

Mra 4700
Zero 4700
Puig 5500
Coxx การดหม้อน้ำ 8500 บน+ล่าง
Competition week ท้ายตรงโช้คหลัง 9500 พร้อมไฟเลี้ยว
Yoshimura อุดกระจก 3850
Woodcraft กันเครื่อง 9500
Gilles tooling vcr38 28500
- การดแฮน brake 5500 clutch 5500
GBRacing 2 ชิ้น 1199/1299  15000

Brembo จาน HP supersport 25000
Brembo จาน T drive 35000
Galfer จานหน้า 25000+7500 

Akrapovic Slip on Titanium 899/1199 105,000
Akrapovic Slip on Titanium 1299/959 115000 
Akrapovic Full Evolution Titanium 165000
- Upgrade Akrapovic Header Titanium 115000

Termignoni Full Stainless พร้อมกรอง และ ECU 135000
Termignoni Slip on (1299) --> 899,1199 Carbon 90000 
+ Upgrade Termignoni Header Titanium 85000
Termignoni Full ออกท้าย 1299/1199 100,000

Arrow S/o Titanium (899/1199)  60000 
Arrow s/o GP Titanium (899/1199) 52000 
Ărrow S/O (1299/959) Titanium 65000
Ărrow S/O (1299/959) GP Titanium 57000

Marchesini 10 ก้าน 1199/1299 95000
Marchesini 10 ก้าน 899/959 90000
+ Special Color Gold Anodized 15000 
Marchesini 7 ก้าน 105000
+ Special Color Gold Anodized 15000


Hyperpro กันสะบัด
Csc 15500
Rsc 17000
';}
					if(strpos(strtolower('Honda XADV 2017'),$bike)){$text = 'Termignoni Titanium-Carbon slip on 27500

Ărrow 
Slip on Titanium-Carbon 27500
Slip on Dark-Carbon 22500
Slip on MoTO GP 19500
Slip on MoTo Gp Black 20500
- Header 14500

Akrapôvic Slip on 29500 


Puig Screen 2 ชั้น Touring 7500
Ermax ชิว Touring 4750
';}

					if(strpos(strtolower('Ducati Scrambler 800'),$bike)){$text= 'Ducati Scrambler 800
Remus Slip on Black 24500
Akrapovic Slip on 38500
- Optional Header Titanium 28500
- Optional Heat Guard 4500
HP corse 
Evo Slip on Titanium 23500
Evo Slip ôn Black 25500
Hydroform Titanium 25500
Hydrôform Black 27500
MoToGp Titanium 23500
MoToGP Black 25500

Zard Full silver กระบอกปืน special Edition 43500 
Zard Full silver 37500
Zard Slip on Zuma 25500
Zárd Slip on Special 25500

Arrow Slip on Titanium Link pipe 32000

Screen
- Puig ชิว 5500
- Puig Rafael 8500 
- MRA 2 ชั้นเล็ก VTNB 8500
- MRA ชั้นเดียว 7000

PUIG กันล้ม 5500

RG
CP0384BK กันล้มกลาง Ducati Scrambler = 4,950
LP0177BK ท้ายแต่ง Ducati Scrambler =5,500
';}

					if(strpos(strtolower('Ducati Monster 797 2017 New!!'),$bike)){$text='Ducati Monster 797 2017 New!! เงื่อนไขดู Comment

Remus Slip on Black 24500
Akrapovic Slip on 38500
- Optional Header Titanium 28500
- Optional Heat Guard 4500
HP corse 
Evo Slip on Titanium 23500
Evo Slip ôn Black 25500
Hydroform Titanium 25500
Hydrôform Black 27500
MoTo GP Titanium 23500
MoTo GP Black 25500

Zard Full silver กระบอกปืน special Edition 43500 
Zard Full silver 37500
Zard Slip on Zuma 25500
Zard Slip on Special 25500

Arrow Slip on Titanium Link pipe 32000

Screen
MRA 2 ชั้นเล็ก VTNB 8500
MRA ชั้นเดียว 7000
Puig Rafael 8500
';}

					if(strpos(strtolower('Suzuki GSXS750 2017-2018'),$bike)){$text = 'Suzuki GSXS750 2017-2018
Akrapovic Slip On 31500
Akrapovic Slip On GP 17500
Tẻrmignoni Slip On Carbon 27500
+ Upgrade คอ Full 28500
Ărrow Full XKone 43500
Ărrow Slip Xkone 19500
Ărrow Slip Titanium-Carbon 22500
Ărrow Slip Dark-Carbon 19500 
Arrow GP SS 16500
Arrow GP SS black 17500
Yoshimura Slip Carbon Alpha 30500 
Yoshimura slip Stainless Alpha 27500

Puig ชิว Sport 4750 Touring 5750
Puig  กันล้ม Pro 6500 หน้า 4500 หลัง 4500
Puig อกดำ 8500 Carbon 9500
Puig ท้ายสั้น 5500

RG
กันล้ม หน้า 2250 กลาง 3950 
ท้ายสั้น 4500
การดหม้อน้ำ 3950

Gillestoôling
เกียรโยง 21000
กันล้มหน้า 4500 กลาง 6500 หลัง 4500
มือเบรค 4500 มือคลัช 4500
อุดน้ำมันเครื่อง 2500
การดแฮน 5500 ฝั่งละ 
Peg คนซ้อน 5500 คู่ละ
';}

					if(strpos(strtolower('R6 2017-2018 All new!!'),$bike)){$text='R6 2017-2018 All new!!
Akrapovic Slip on GP 32500 - GP Laser 47500
Akrapovic Slip shorty 26500
Akrapovic Slip Shorty Valve Servo Control 30500
Akrapovic Slip FaT Titanium 24500
Akrapovic Slip Moto GP 20000
Akrapôvic Slip Megaphone 15500
Upgrâde 
- Hêader Stainless 35000
- Header Titanium  65000

Akrapovic Full Evolution GP 85000
Akrapovic Full Racing GP 55000
Akrapovic Full Evolution Carbon 1 รู Wsbk 110000
Akrapovic Full Racing Carbon 1 รู Wsbk 75000
Akrapovic Full Evolution Titanium 1 รู Wsbk 105000
Akrapovic Full Racing Titanium 1 รู Wsbk 70000

Ărrow Slip on MotoGp 18500
Ărrow Slip on MotoGp Black 20000
Ărrow Full Competition Titanium 80000

Puig 
ชิว 5500

Mra 
ชิว 4700

ZêroGravity
ชิว 4700

Cox Racing 5500

Gilles tooling 
กันล้มหน้า 4500 กลาง 8500 หลัง 4500 ปากแตร&Spoon
การดแฮน brake 5500 clutch 5500
กันล้มแคร้ง 5500 
กันล้มเครื่องครอบ 5500
เกียร์โยง FXR 19500
ตั้งโซ่ Axb 6500
ตั้งแสตน Psa 2500 
มือเบรค 7500 พับได้ Folding
มือคลัช 7500 พับได้ Folding
มือคลัช Blue Limíted 8500 พับได้ Folding
จุกอุดน้ำมันเครื่อง 3000
ปิดตูด ปิดกระจก 3850
';}

					if(strpos(strtolower('Ninja1000/Z1000SX 2017-2018'),$bike)){$text = 'Ninja1000/Z1000SX 2017-2018

Akrapovic 
+ คอ 4-2-2 Upgrade 35500
+ heat shield carbon 9500
Z1000 slip 49500
Z1000 slip megaphone 25500
Z1000 full เดี่ยว 57500

Yoshimura. Slip 45000 

Vance&hine 19500 

QD Slip on 48500

Austin Rãcing GP2R Slip 48500

Two slip carbon 39000

Termignoni slip titanium & carbon 45000

Arrow slip Carbon-carbon 45000 
Arrow Slip Titanium-Carbon 45000
Arrow slip Werk 45000
Arrow Slip GP SS 32000
Arrow Slip GP SS black 33000
+ คอ 4-2-2 อัพเกรด 35000

Hp corse slip 39,000 

Puig 
-ท้ายสั้น Tail Tidy 5500 
-ชิว Screen 5500

power Bronze
บังโคลนหลัง 12,500
บังโคลนหน้า 12,500
บังโซ่ 7500

Ermax
บังโคนหลัง 5500
ท้ายสั้น 7500
ไฟท้ายมีไฟเลี้ยว 7500

Coxx  การดหม้อน้ำ 5500

Gilles Tooling 24500 VCR38

MRA ชิว 4700

R&g
กันล้ม หน้า =2500                                         
กันล้ม หลัง = 3500 
การดหม้อน้ำ 3950
ท้ายแต่ง 4950

ล้อ Marchesini Aluminium 95000 10 ก้าน 
สีพิเศษ Anodize ทองเงา +15000

AC สายถัก 9500 หน้าหลัง 

Galfer จานเบรค 22500+7500
Brembo T drive 35000
Brembo HP 25000
';}

				



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
