<?php

$fid =$_POST['daten'];

// Verbindung zur DB herstellen

include_once 'mydb.php';
$dbverbindung = new mydb();

//Frage aus DB holen
$queryfrage = "Select txt from frage where fid=".$fid;
$frage =$dbverbindung->querysingle($queryfrage);

//Gesamtanzahl der Antwortmöglichkeiten holen

$queryantwortges ="Select count(*) from antwort where fid =".$fid;
$anzahlant =$dbverbindung->querysingle($queryantwortges);


//Überprüfung welche Checkboxen gewählt wurden

$gecheckt =0;
for ($i=1; $i<=$anzahlant; $i++)
{
	$chckbname = "AID".$i;
	if (isset ($_POST[$chckbname]))
	{
		$chckbwert = $_POST[$chckbname];
		$insertquery = "INSERT INTO geantwortet(aid, fid)VALUES('$chckbwert', $fid)";
		$execute = $dbverbindung->query($insertquery);
		$gecheckt++;
	}
}

	//Wenn keine Antwort gewählt wurde
	if($gecheckt==0)
	{
	printf("<h2>Es wurde keine Antwort ausgewählt!</h2>");
	printf("<a class=\"btn btn-default\" href=\"/frage\">Zurück zur Frageseite</a>");
	exit();
	
	
	}
	
	//Gesamtsumme der gegebenen Antworten ermitteln für spätere Berechnung
	$querygesamt = "SELECT count(*) FROM antwort ,geantwortet WHERE antwort.fid =".$fid." AND antwort.aid = geantwortet.aid";
	$gesamtsumme =$dbverbindung->querysingle($querygesamt);


?>

<div>
	<h2>Auswertung</h2>
	<p>Vielen Dank für Ihre Antwort.</p>
	<h3><?php echo $frage ?></h3>
<?php
//Antwortmöglichkeiten aus DB holen
$queryeinzel ="Select txt, aid, nr from antwort where fid =".$fid." order by nr asc";
$einzel =$dbverbindung->query($queryeinzel);

	for ($i = 1; $i <= $anzahlant; $i++) {
	
			
			$antwortm = $einzel->fetch_row();
			echo $antwortm[0];
					
			$aid = $antwortm[1];
			
			//Anzahl der Antworten auf 1 Frage bezogen
			$queryauswertung = "SELECT count(*) FROM antwort, geantwortet WHERE antwort.fid =".$fid." and antwort.aid = geantwortet.aid and geantwortet.aid=".$aid;
			$gesamtantm= $dbverbindung->querysingle($queryauswertung);
			
			
			// US-Zahlenformat für Bootstrap
			$rechnungUS = (100/$gesamtsumme)*$gesamtantm;
			$rechnungUS = number_format($rechnungUS, 2,".",",");
			$prozentUS = $rechnungUS."%";
			$prozentUS= strval($prozentUS);

			// Deutsches Zahlenformat für den User
			$rechnung = (100/$gesamtsumme)*$gesamtantm;
			$rechnung = number_format($rechnung, 2,",",".");
			$prozent = $rechnung."%";
			$prozent= strval($prozent);
			printf("<div class=\"progress progress-striped\">");
			printf("<div class=\"progress-bar\" role=\"progressbar\" 
			aria-valuenow=\"%s\"", $prozentUS);
			printf("aria-valuemin=\"0\" aria-valuemax=\"100\"
			style=\"width: %s\">",$prozentUS);
			printf("<span class=\"meter\">%s</span>",$prozent);
		printf("</div>");
	printf("</div>");
}
$dbverbindung->close();
?>
</div>
<a class="btn btn-default" href="/frage">Nächste Frage</a>


