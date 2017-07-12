<?php 
echo $_GET['hub_challenge']; 

$content=file_get_contents('php://input');
$events = json_decode($content, true);
$item = $events['entry'][0]['changes'][0]['value']['item'];
$field = $events['entry'][0]['changes'][0]['field'];
$sender_name = $events['entry'][0]['changes'][0]['value']['sender_name'];
$sender_id = $events['entry'][0]['changes'][0]['value']['sender_id'];
$verb = $events['entry'][0]['changes'][0]['value']['verb'];
$message = $events['entry'][0]['changes'][0]['value']['message'];
$post_id = $events['entry'][0]['changes'][0]['value']['post_id'];
if($sender_id == '236113873116564' && $verb == 'add'){
    if($item == 'status' || $item == 'video' || $item == 'photo'){
        $get = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php?msg='.urlencode($sender_name.' '. $verb.' '.$item."\n".$post_id));
        $update = file_get_contents('http://tpmotorcycle.com/picture/update_facebook.php?postid='.urlencode($post_id));
    }
}else{
    if($field == 'conversations'){
        $get = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php?msg='.urlencode($content));
    }
   //$get = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php?msg='.urlencode($sender_name.' '.$verb));
}

?>
