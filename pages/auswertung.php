<?php
$fid =$_POST['daten'];

//Verbindung zur DB
/*$connection = @mysql_connect("localhost", "root", "minou0104");
if ($connection == FALSE) {
	echo "Bitte entschuldigen Sie, es ist ein technischer Fehler aufgetreten. Bitte wenden Sie sich an den Support";
	exit();
}
mysql_select_db("dba02");
mysql_set_charset("utf8");
*/
$conn = new mysqli($DBA02_host, $DBA02_user, $DBA02_pass, $DBA02_db);
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}

//$abfrage= mysql_query("Select txt from frage where fid=".$fid);
//$frage = mysql_fetch_row($abfrage);

$query = "Select txt from frage where fid=".$fid;
$result = $conn->query($query);
$frage = $result->fetch_row();




//$abfrantw = mysql_query ("Select txt, aid, nr from antwort where fid =".$fid." order by nr asc");
//$anzahlant = mysql_num_rows($abfrantw);
$query = "Select txt, aid, nr from antwort where fid =".$fid." order by nr asc";
$result = $conn->query($query);
$anzahlant = $result->num_rows;


for ($i=1; $i<=$anzahlant; $i++)
{
	$chckbname = "AID".$i;
	if (isset ($_POST[$chckbname]))
	{
		$chckbwert = $_POST[$chckbname];
		$query = "INSERT INTO geantwortet(aid)VALUES('$chckbwert')";
		$result = $conn->query($query);
		//mysql_query("INSERT INTO geantwortet(aid)VALUES('$chckbwert')");
	}
}

	$query = "SELECT * FROM antwort ,geantwortet WHERE antwort.fid =".$fid." AND antwort.aid = geantwortet.aid";
	$result = $conn->query($query);
	$gesamtsumme =$result->num_rows;
//$abfrggesamtant = mysql_query("SELECT * FROM antwort ,geantwortet WHERE antwort.fid =".$fid." AND antwort.aid = geantwortet.aid");

//$gesamtsumme = mysql_num_rows($abfrggesamtant);
?>

<div>
	<h2>Auswertung</h2>
	<p>Vielen Dank für Ihre Antwort.</p>
	<h3><?php echo $frage[0] ?></h3>
<?php
$query = "Select txt, aid, nr from antwort where fid =".$fid." order by nr asc";
$result1 = $conn->query($query);
	for ($i = 1; $i <= $anzahlant; $i++) {
	
			
			$antwortm = $result1->fetch_row();
			//$antwortm = mysql_fetch_row($abfrantw, MYSQL_BOTH);
			echo $antwortm[0];
			
			$aid = $antwortm[1];
			//$abfrgeinzlantw = mysql_query("SELECT * FROM antwort, geantwortet WHERE antwort.fid =".$fid." and antwort.aid = geantwortet.aid and geantwortet.aid=".$aid);
			//$gesamtantm = mysql_num_rows($abfrgeinzlantw);
			$query = "SELECT * FROM antwort, geantwortet WHERE antwort.fid =".$fid." and antwort.aid = geantwortet.aid and geantwortet.aid=".$aid;
			$result = $conn->query($query);
			$gesamtantm= $result->num_rows;
			
			
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

?>
</div>
<a class="btn btn-default" href="/frage/2001">Nächste Frage</a>

