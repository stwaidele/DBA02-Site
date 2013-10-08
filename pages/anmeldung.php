<?php
// http://aktuell.de.selfhtml.org/artikel/php/loginsystem/
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['benutzername'];
	$passwort = $_POST['passwort'];

	$hostname = $_SERVER['HTTP_HOST'];
	$path = "/neuefrage";
	$ziel = 'http://'.$hostname.($path == '/' ? '' : $path);

	// Anmeldedaten prüfen und bei Berechtigung weiterleiten
	$user->auth($username, $passwort, $ziel);
	
	// Der Rest der Datei wird nur bei Anmeldefehlern erreicht:
}
?>

<div ID="Loginbox">
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