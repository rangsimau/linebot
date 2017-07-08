<?php 
echo $_GET['hub_challenge']; 

$get = file_get_contents('https://still-thicket-82675.herokuapp.com/line-bot.php?msg=post');

?>
