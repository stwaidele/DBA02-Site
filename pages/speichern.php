<?php
if ($auth_angemeldet==FALSE) {
	?>
	<p>Nur angemeldete Benutzer können neue Fragen stellen.</p>
	<p>Warum Sie zwischen Frage-Eingabe und Speicherung nicht mehr angemeldet sind? Keine Ahnung. Das sollte eigentlich nicht passieren.</p>
	<p>Wir bitten vielmals um Entschuldigung...</p>
	<p><a href="/anmeldung">Zur Anmeldeseite...</a></p>
	<?php
} else {
	// $fragetext ist ein String
	$fragetext = $_REQUEST["frage"];
	// $antworten ist ein Array aus Strings (wegen gleicher "name" im HTML-Formular )
	// http://stackoverflow.com/a/1942432
	$antworten = $_REQUEST["awm"];
	
//	$sql[0] = "insert into "
	print $fragetext;
	foreach ($antworten as $antwort) {
		print $antwort;
	}
	
	// Nächste Frage...
	include($_SERVER['DOCUMENT_ROOT'].'/pages/neuefrage.php'); 
}
?>
