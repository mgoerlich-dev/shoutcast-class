<?php
require_once 'shoutcast.class.php';
$ip   = '127.0.0.1';
$port = '8080';
$pass = 'changemäh';

$radio = new shoutcast($ip, $port, $pass);

$shoutcastData = $radio->getShoutcastData();
$shoutcastHistory = $radio->getShoutcastHistory();

print '$shoutcastData:';
var_dump( $shoutcastData );

print '$shoutcastHistory:';
var_dump( $shoutcastHistory );
?>
