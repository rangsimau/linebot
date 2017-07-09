<?php 
echo $_GET['hub_challenge']; 

$content=file_get_contents('php://input');
$events = json_decode($content, true);
$item = $events['entry'][0]['changes'][0]['value']['item'];
$sender_name = $events['entry'][0]['changes'][0]['value']['sender_name'];
$sender_id = $events['entry'][0]['changes'][0]['value']['sender_id'];
$verb = $events['entry'][0]['changes'][0]['value']['verb'];
if($sender_id == '236113873116564' && $verb == 'add'){
    //if($item == 'status' || $item == 'video' || $item == 'photo'){
        $get = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php?msg='.urlencode($sender_name.' '. $verb.' '.$item));
    //}
}else{
   //$get = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php?msg=else');
}

?>
