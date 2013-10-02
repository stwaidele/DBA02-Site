<?php
$connection = @mysql_connect($DBA02_host, $DBA02_user, $DBA02_pass);
if ($connection == FALSE) {
	echo "Bitte entschuldigen Sie, es ist ein technischer Fehler aufgetreten. Bitte wenden Sie sich an den Support";
	exit();
}
mysql_select_db("dba02");
mysql_set_charset("utf8");

// Die 3 Fragen mit der höchsten FID
// Warum funktioniert LIMIT nicht?
$neuefragen = mysql_query("select * from frage  limit 0,3");
$anzahlneu = mysql_num_rows($result);
?>
<div ID="popular">
	<h3>Beliebte Fragen</h3>
	<ul>
		<li><a href="/frage/18">
			Wer wird Deutscher Meister?
		</a></li>
		<li><a href="/frage/23">
			Wie lautet die Antowrt auf die große Frage des Lebens, des Universums, und einfach allem?
		</a></li>
	</ul>
</div>
<div ID="new">
	<h3>Neue Fragen</h3>
	<ul>
		<?php
		for ($i = 1; $i <= $anzahlneu; $i++) {
			$neuefrage = mysql_fetch_assoc($result);
			printf ('<li><a href="/frage/%s">%s</a></li>', $neuefrage['fid'], $neuefrage['txt']);
		} 
		?>			
	</ul>
</div>
<div ID="more">
	<h3>Fragen stellen</h3>
	<?php
	if ($auth_angemeldet==FALSE) {
		?>
		<p>Nur angemeldete Benutzer können neue Fragen stellen. <a href="/anmeldung">Zur Anmeldeseite...</a></p>
		<?php
	} else {?>
		<p><a href="/neuefrage">Stellen Sie eine neue Frage</a></p>
		<p><a href="/abmeldung">Abmelden</a></p>
		<?php } ?>
	</div>
