<?php 
echo $_GET['hub_challenge']; 

$content=file_get_contents('php://input');
$events = json_decode($content, true);
$get = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php?msg='.$events['entry'][0]['time']);

?>
