<?php
session_start();
session_destroy();

$hostname = $_SERVER['HTTP_HOST'];
$path = "/";

// Weiterleitung zur Startseite
if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
	if (php_sapi_name() == 'cgi') {
		header('Status: 303 See Other');
	}
	else {
		header('HTTP/1.1 303 See Other');
	}
}

header('Location: http://'.$hostname.($path == '/' ? '' : $path));
exit;

?>