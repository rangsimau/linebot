<?php 
echo $_GET['hub_challenge']; 

$content=file_get_contents('php://input');

$get = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php?msg='.$content[0]['field']);

?>
