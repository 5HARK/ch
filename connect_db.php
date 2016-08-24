<?php
$db = new mysqli('localhost', 'club_board', 'clubgame', 'club');

if($db->connect_error){
    die('db connect error');
}

$db->set_charset('utf8');
?>