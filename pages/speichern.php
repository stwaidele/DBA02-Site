<?php
if ($user->getAngemeldet()==FALSE) {
	?>
	<p>Nur angemeldete Benutzer können neue Fragen stellen.</p>
	<p>Warum Sie zwischen Frage-Eingabe und Speicherung nicht mehr angemeldet sind? Keine Ahnung. Das sollte eigentlich nicht passieren.</p>
	<p>Wir bitten vielmals um Entschuldigung...</p>
	<p><a href="/anmeldung">Zur Anmeldeseite...</a></p>
	<?php
} else {
	// $fragetext ist ein String
	$fragetext = $_REQUEST["frage"];
	// $antworten ist ein Array aus Strings (wegen gleichem "name" im HTML-Formular )
	// http://stackoverflow.com/a/1942432
	$antworten = $_REQUEST["awm"];
	
	//Verbindung zur DB
	$sql = new SQL;
	$sql->setNeueFrage($fragetext, $antworten);
	
	// Nächste Frage...
	include($_SERVER['DOCUMENT_ROOT'].'/pages/neuefrage.php'); 
}
?>
