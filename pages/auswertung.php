<?php
// Verbindung zur DB herstellen
$sql = new SQL;

// FID aus der URL lesen
$f = $_GET["fid"];

// Fragetext und Antwortmöglichkeiten aus der Datenbank lesen
$fragetext = $sql->getFrageText($f);
$antwortmoeglichkeiten = $sql->getAntwortmoeglichkeiten($f);

////////////////////////////////////////////////
// Gegebene Antworten ermitteln und speichern //
////////////////////////////////////////////////

// Überprüfung welche Checkboxen gewählt wurden
// Schleife über Antwortmöglichkeiten
foreach ($antwortmoeglichkeiten as $awm) {
	$paramname = sprintf('AID-%s', $awm['aid']);
	if(isset($_GET[$paramname])) {
		// AID in Array speichern
		$gegebene[] = $awm['aid'];
	} 
} 

// Gegebene Antworten speichern
$sql->setGegebeneAntworten($f, $gegebene);


///////////////////////////////////////
// Auswertung erstellen und anzeigen //
///////////////////////////////////////
?>
<div>
	<h2>Auswertung</h2>
	<p>Vielen Dank für Ihre Antwort.</p>
	<h3><?php echo $fragetext ?></h3>

	<?php
	// Wie viele Antworten wurden gegeben? -> 100%
	$p_100 = $sql->getAnzahlAntworten($f);

	// Welche Antworten wurden gegeben und wie oft?
	$antworten = $sql->getAntworten($f);

	// Schleife über Antworten
	foreach ($antworten as $antwort) {
		// Ermitteln ob der Benutzer diese Antwortmöglichkeit gewählt hatte
		$paramname = sprintf('AID-%s', $antwort['aid']);
		if(isset($_GET[$paramname])) {
			$css_class = "eigeneantwort";
		} else {
			$css_class = "fremdantwort"	;	
		} 

		// Antwort & absolute Anzahl ausgeben
		printf('<p class="%s">%s <span class="abszahl">(%sx)</span></p>', $css_class, $antwort['txt'], $antwort['anz']);
		// Berechnung des prozentualen Anteils
		// ...im US-Format für die Anzeige des Balkendiagrams
		$p_US = number_format((100/$p_100)*$antwort['anz'], 2, ".", ",")."%";
		// ...im deutschen Format für die Ausgabe für den Benutzer
		$p_DE = number_format((100/$p_100)*$antwort['anz'], 2, ",", ".")."%";

		// Ausgabe des Balkens mithilfe von Bootstrap
		printf("<div class=\"progress progress-striped\">");
		printf("<div class=\"progress-bar\" role=\"progressbar\" 
		aria-valuenow=\"%s\"", $p_US);
		printf("aria-valuemin=\"0\" aria-valuemax=\"100\"
		style=\"width: %s\">",$p_US);
		printf("<span class=\"meter\">%s</span>",$p_DE);
		printf("</div>");
		printf("</div>");
	}
	printf("</div>");
	?>

	<a class="btn btn-default" href="/index.php?show=frage">Nächste Frage</a>
