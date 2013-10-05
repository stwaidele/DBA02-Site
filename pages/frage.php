<?php 

/*Verbindung zur DB
 $connection = @mysqli_connect("localhost", "root", "minou0104");

if ($connection == FALSE) {
	echo "Bitte entschuldigen Sie, es ist ein technischer Fehler aufgetreten. Bitte wenden Sie sich an den Support";
	exit();
} */

$conn = new mysqli($DBA02_host, $DBA02_user, $DBA02_pass, $DBA02_db);
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}



//Erzeugung einer Zufallszahl zur Auswahl der Frage

$query = "Select count(*) from frage";
$result = $conn->query($query);
//$result = mysql_query("Select * from frage");

$anzahl = $result->fetch_row();


//$anzahl = mysql_num_rows($result);
$zufall = mt_rand(1, $anzahl[0]);

$query = "Select txt from frage where fid=".$zufall;
$result = $conn->query($query);
$auswahl = $result->fetch_row();
echo $auswahl[0];
//$frage = mysql_query ("Select txt from frage where fid=".$zufall);
//$auswahl = mysql_fetch_row($frage);

//Antworten holen
$query = "Select aid, txt, nr from antwort where fid =".$zufall." order by nr asc";
$result = $conn->query($query);
//$abfrantw = mysql_query ("Select aid, txt, nr from antwort where fid =".$zufall." order by nr asc");
//$anzahlant = mysql_num_rows($abfrantw);
$anzahlant = $result ->num_rows;

$daten = $zufall;
?>

<div ID="frage">
	<h2>Bitte beantworten Sie folgende Frage:</h3>
		<h3><?php echo $auswahl[0] ?></h3>
		<form role="form" action="/index.php?show=auswertung" method ="post">
		<input type="hidden" name="daten" value="<?php echo $daten; ?>" />
<?php
	for ($i = 1; $i <= $anzahlant; $i++) {
			//$antwortm = mysql_fetch_array($abfrantw, MYSQL_BOTH);
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
$conn->close();
//mysql_close($connection);
?>

