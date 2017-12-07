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
        //$get = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php?msg='.urlencode($sender_name.' '. $verb.' '.$item."\n".$post_id)."&uid=".urlencode("Ud392f1479ba3a4e92d82c98ba78e9f46"));
        $update = file_get_contents('http://tpmotorcycle.com/picture/update_facebook.php?postid='.urlencode($post_id));
    }
}else{
    if($field == 'conversations'){
        $access_token = 'EAACquzrGeZCYBABhoDtgtgMMEdWUc7rbdeHT3w4jQlD8ObPPA8HL09rHsakUPnAGElRTCGhvL5jHmK68VLoRZBLwlR5mFK9XRrEg7B9orsy4S3xkXeKXREOI0ZCi6yQL29uYD6qOyaJkdX9BZC3iv4HtuqeoMZBKf440EtlV3bRTqqXuUuXHxtEsAHsVYfEZAQybYARu5aEwZDZD';
        $thread_id = $events['entry'][0]['changes'][0]['value']['thread_id'];
        $face_msg = file_get_contents('https://graph.facebook.com/'.$thread_id.'?fields=messages{message,from}&access_token='.$access_token);
        //$face = json_decode($face_msg, true);
        $msg = $face['messages']['data'][0]['message'];
        $from = $face['messages']['data'][0]['from']['name'];
        //$get = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php?msg='.urlencode($face_msg));
    }
   //$get = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php?msg='.urlencode($sender_name.' '.$verb));
}

?>
