<?php
	// $fragetext ist ein String
	$fragetext = "Fragetext für SQLtest.php";
	// $antworten ist ein Array aus Strings (wegen gleichem "name" im HTML-Formular )
	// http://stackoverflow.com/a/1942432
	$antworten = array('SQLtest A1', 'SQLtest A2', 'SQLtest A3');
	
	//Verbindung zur DB
	$sql = new SQL;
	$sql->setNeueFrage($fragetext, $antworten);
?>
