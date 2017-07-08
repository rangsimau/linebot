<?php 
echo $_GET['hub_challenge']; 

$content=file_get_contents('php://input');
$events = json_decode($content, true);

foreach($events['entry'][0]['changes'] as $entry){
  $field = $entry['field'];
}
  
$get = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php?msg='.$field.urlencode($content));

?>
