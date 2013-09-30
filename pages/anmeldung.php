<?php
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      session_start();

      $username = $_POST['benutzername'];
      $passwort = $_POST['passwort'];

      $hostname = $_SERVER['HTTP_HOST'];
//      $path = dirname($_SERVER['PHP_SELF']);
$path = "/neuefrage";

      // Benutzername und Passwort werden überprüft
      if ($username == 'stefan@waidele.info' && $passwort == 'geheim') {
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