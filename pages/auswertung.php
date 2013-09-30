<?php
$fid =$_POST['daten'];

//Verbindung zur DB
$connection = @mysql_connect($DBA02_host, $DBA02_user, $DBA02_pass);
if ($connection == FALSE) {
	echo "Bitte entschuldigen Sie, es ist ein technischer Fehler aufgetreten. Bitte wenden Sie sich an den Support";
	exit();
}

mysql_select_db("dba02");

$abfrage= mysql_query("Select txt from frage where fid=".$fid);
$frage = mysql_fetch_row($abfrage);

$abfrantw = mysql_query ("Select txt, aid from antwort where fid =".$fid);
$anzahlant = mysql_num_rows($abfrantw);

for ($i=1; $i<=$anzahlant; $i++)
{
	$chckbname = "AID".$i;
	if (isset ($_POST[$chckbname]))
	{
		$chckbwert = $_POST[$chckbname];
		mysql_query("INSERT INTO geantwortet(aid)VALUES('$chckbwert')");
	}
}

$abfrggesamtant = mysql_query("SELECT * FROM antwort ,geantwortet WHERE antwort.fid =".$fid." AND antwort.aid = geantwortet.aid");

$gesamtsumme = mysql_num_rows($abfrggesamtant);
?>

<div>
	<h2>Auswertung</h2>
	<p>Vielen Dank für Ihre Antwort.</p>
	<h3><?php echo $frage[0] ?></h3>
<?php
	for ($i = 1; $i <= $anzahlant; $i++) {
			$antwortm = mysql_fetch_row($abfrantw, MYSQL_BOTH);
			echo $antwortm[0];
			$aid = $antwortm[1];
			$abfrgeinzlantw = mysql_query("SELECT * FROM antwort, geantwortet WHERE antwort.fid =".$fid." and antwort.aid = geantwortet.aid and geantwortet.aid=".$aid);
			$gesamtantm = mysql_num_rows($abfrgeinzlantw);
			$rechnung = (100/$gesamtsumme)*$gesamtantm;
			$rechnung = number_format($rechnung, 2,",",".");
			$prozent = $rechnung."%";
			$prozent= strval($prozent);
			printf("<div class=\"progress progress-striped\">");
			printf("<div class=\"progress-bar\" role=\"progressbar\" 
			aria-valuenow=\"10\"
			aria-valuemin=\"0\" aria-valuemax=\"100\"
			style=\"width: %s\">",$prozent);
			printf("<span class=\"meter\">%s</span>",$prozent);
		printf("</div>");
	printf("</div>");
}

?>
</div>
<a class="btn btn-default" href="/frage/2001">Nächste Frage</a>

