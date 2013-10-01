<?php
// http://aktuell.de.selfhtml.org/artikel/php/loginsystem/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// /include/header.php öffnet die Session bereits, 
	// daher muss vor dem Anmelden die alte Session zerstört werden
	session_destroy();
	session_start();

	$username = $_POST['benutzername'];
	$passwort = $_POST['passwort'];

	$hostname = $_SERVER['HTTP_HOST'];
	//      $path = dirname($_SERVER['PHP_SELF']);
	$path = "/neuefrage";

	//Verbindung zur DB
	$connection = @mysql_connect($DBA02_host, $DBA02_user, $DBA02_pass);
	if ($connection == FALSE) {
		echo "Bitte entschuldigen Sie, es ist ein technischer Fehler aufgetreten. Bitte wenden Sie sich an den Support";
		exit();
	}
	mysql_select_db("dba02");
	mysql_set_charset("utf8");

	$abfrage = mysql_query("select pw from user where email = '".$username."';");
	$pw = mysql_fetch_row($abfrage);
	
	// Benutzername und Passwort werden überprüft
	// $passwort darf nicht leer sein, da sonst unbekannte Nutzer (wegen leerer Ergebnismenge der Abfrage) angemeldet wären
	if (($pw[0] == $passwort) && ($passwort!='')) {
		$_SESSION['angemeldet'] = true;
   
		// Weiterleitung zur geschützten Startseite
		if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
			if (php_sapi_name() == 'cgi') {
				header('Status: 303 See Other');
			}
			else {
				header('HTTP/1.1 303 See Other');
			}
		}

		header('Location: http://'.$hostname.($path == '/' ? '' : $path));
		exit;
	}
}
?>

<div ID="Loginbox">
	<h3>DEBUG:</h3>
	<?php
	echo "u: " . $username;
	echo "p: " . $passwort;
	echo "db: " . $pw[0];
	?>
	<h3>Verwaltung</h3>
	<form role="form" action="/anmeldung" method="post">
		<div class="form-group">
			<label for="benutzername">Benutzername</label>
			<input type="email" class="form-control" name="benutzername" id="benutzername" placeholder="Benutzername oder E-Mail Adresse eingeben">
		</div>
		<div class="form-group">
			<label for="passwort">Passwort</label>
			<input type="password" class="form-control" name="passwort" id="passwort" placeholder="Passwort eingeben">
		</div>
		<button type="submit" class="btn btn-default">Anmelden</button>
	</form>
</div>