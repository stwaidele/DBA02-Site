<?php 

// Verbindung zur DB herstellen
$dbverbindung = new mydb();

//Erzeugung einer Zufallszahl zur Auswahl der Frage
$queryanzahl = "Select count(*) from frage";
$anzahl =$dbverbindung->querysingle($queryanzahl);

$zufall = mt_rand(1, $anzahl);

//Frage anhand Zufallszahl auswählen
$queryfrage = "Select txt from frage where fid=".$zufall;
$auswahl =$dbverbindung->querysingle($queryfrage);


//Gesamtanzahl der Antwortmöglichkeiten holen

$queryantwortges ="Select count(*) from antwort where fid =".$zufall;
$anzahlant =$dbverbindung->querysingle($queryantwortges);
$daten = $zufall;

?>
<!-- Antworten anzeigen -->
<div ID="frage">
	<h2>Bitte beantworten Sie folgende Frage:</h3>
		<h3><?php echo $auswahl ?></h3>
		<form role="form" action="/index.php?show=auswertung" method ="post">
		<input type="hidden" name="daten" value="<?php echo $daten; ?>" />
<?php
$queryantwortm = "Select aid, txt, nr from antwort where fid =".$zufall." order by nr asc";
$result =$dbverbindung->query($queryantwortm);

//Schleife durch Antwortmöglichkeiten

	for ($i = 1; $i <= $anzahlant; $i++) {
			
			$antwortm = $result->fetch_array();
			
			printf("<div class=\"checkbox\">");
				printf("<label>");
				printf("<input type=\"checkbox\" name=\"AID%d\" value=\"%s\">", $i, $antwortm[0]);
				echo $antwortm[1];
			printf("</label>");
			printf("</div>");
	}
?>

		 

			<button type="submit" class="btn btn-default">Antworten & sehen, was andere geantwortet haben</button>
		</form>
	</div>
<?php
$dbverbindung->close();

?>

