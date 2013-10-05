<?php 

//Verbindung zur DB
$connection = @mysqli_connect($DBA02_host, $DBA02_user, $DBA02_pass, $DBA02_db);

if ($connection == FALSE) {
	echo "Bitte entschuldigen Sie, es ist ein technischer Fehler aufgetreten. Bitte wenden Sie sich an den Support";
	exit();
}

#mysqli_select_db("dba02");
$connection->set_charset("utf8");

//Erzeugung einer Zufallszahl zur Auswahl der Frage
$result = $connection->query("Select * from frage");
$anzahl = $result->num_rows;
$zufall = mt_rand(1, $anzahl);
$frage = $connection->query("Select txt from frage where fid=".$zufall);
$auswahl = $frage->fetch_row();

$abfrantw = $connection->query("Select aid, txt from antwort where fid =".$zufall);
$anzahlant = $abfrantw->num_rows;

$daten = $zufall;
?>

<div ID="frage">
	<h2>Bitte beantworten Sie folgende Frage:</h3>
		<h3><?php echo $auswahl[0] ?></h3>
		<form role="form" action="/index.php?show=auswertung" method ="post">
		<input type="hidden" name="daten" value="<?php echo $daten; ?>" />
<?php
	for ($i = 1; $i <= $anzahlant; $i++) {
			$antwortm = $abfrantw->fetch_array(MYSQL_BOTH);
			//$antwortm = mysql_fetch_row($abfrantw, MYSQL_BOTH);
			printf("<div class=\"checkbox\">");
				printf("<label>");
				printf("<input type=\"checkbox\" name=\"AID%d\" value=\"%s\">", $i, $antwortm[0]);
				echo $antwortm[1];
			printf("</label>");
			printf("</div>");
	}
?>
<h5>DEBUG: mysqli_</h5>

		 

			<button type="submit" class="btn btn-default">Antworten & sehen, was andere geantwortet haben</button>
		</form>
	</div>
<?php
$connection->close();
?>

