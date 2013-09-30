<?php 

//Verbindung zur DB
$connection = @mysql_connect($DBA02_host, $DBA02_user, $DBA02_pass);

if ($connection == FALSE) {
	echo "Bitte entschuldigen Sie, es ist ein technischer Fehler aufgetreten. Bitte wenden Sie sich an den Support";
	exit();
}

mysql_select_db("dba02");

//Erzeugung einer Zufallszahl zur Auswahl der Frage
$result = mysql_query("Select * from frage");
$anzahl = mysql_num_rows($result);
$zufall = mt_rand(1, $anzahl);
$frage = mysql_query ("Select txt from frage where fid=".$zufall);
$auswahl = mysql_fetch_row($frage);

$abfrantw = mysql_query ("Select aid, txt from antwort where fid =".$zufall);
$anzahlant = mysql_num_rows($abfrantw);

$daten = $zufall;
?>

<div ID="frage">
	<h2>Bitte beantworten Sie folgende Frage:</h3>
		<h3><?php echo $auswahl[0] ?></h3>
		<form role="form" action="/dba02/index.php? show=auswertung" method ="post">
		<input type="hidden" name="daten" value="<?php echo $daten; ?>" />
<?php
	for ($i = 1; $i <= $anzahlant; $i++) {
			$antwortm = mysql_fetch_array($abfrantw, MYSQL_BOTH);
			//$antwortm = mysql_fetch_row($abfrantw, MYSQL_BOTH);
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
mysql_close($connection);
?>

