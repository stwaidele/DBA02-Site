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
	
	//Verbindung zur DB
	$connection = @mysql_connect($DBA02_host, $DBA02_user, $DBA02_pass);

	if ($connection == FALSE) {
		echo "Bitte entschuldigen Sie, es ist ein technischer Fehler aufgetreten. Bitte wenden Sie sich an den Support";
		exit();
	}
	mysql_select_db("dba02");
	mysql_set_charset("utf8");
	
	$sql[0] = sprintf("insert into frage (txt) value ('%s')", mysql_real_escape_string($fragetext));
	$result = mysql_query($sql[0]);
	if(!$result) {
		// Fehler
	} else {
		$fid = mysql_insert_id();
		$n=1;
		foreach ($antworten as $antwort) {
			$sql[$n]=sprintf("insert into antwort (txt, fid) values ('%s','%s')", mysql_real_escape_string($antwort), $fid);
			$result = mysql_query($sql[$n]);
			$n++;
		}
	}	
	// Debug
	foreach ($sql as $q) {
		print $q."<br />";
	}
	
	// Nächste Frage...
	include($_SERVER['DOCUMENT_ROOT'].'/pages/neuefrage.php'); 
}
?>
