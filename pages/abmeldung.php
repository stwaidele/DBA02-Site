<?php
$hostname = $_SERVER['HTTP_HOST'];
$path = "/index.php?show=frage";
$url='http://'.$hostname.($path == '/' ? '' : $path);

$user->logoff($url);
?>