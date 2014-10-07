<?php
//$ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
$ip = $_SERVER['REMOTE_ADDR'];
//$ip = trim($ip[0]);

echo $ip;
