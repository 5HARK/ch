<?php
$db = new mysqli('localhost', 'root', 'apmsetup', 'club');

if($db->connect_error){
    die('db connect error');
}

$db->set_charset('utf8');
?>