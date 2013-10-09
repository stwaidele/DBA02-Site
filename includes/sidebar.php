<?php
// Verbindung zur DB herstellen
$sql = new SQL;

// Die 3 Fragen mit der höchsten FID
$neuefragen = $sql->getNeueFragen();

// Die 3 beliebtesten Fragen
$beliebtefragen = $sql->getBeliebteFragen();
?>
<div ID="popular">
	<h3>Beliebte Fragen</h3>
	<ul>
		<?php
		foreach($beliebtefragen as $beliebtefrage) {
			printf ('<li><a href="/index.php?show=frage&fid=%s">%s</a></li>', $beliebtefrage['fid'], $beliebtefrage['txt']);
		} 
		?>			
	</ul>
</div>
<div ID="new">
	<h3>Neue Fragen</h3>
	<ul>
		<?php
		foreach($neuefragen as $neuefrage) {
			printf ('<li><a href="/index.php?show=frage&fid=%s">%s</a></li>', $neuefrage['fid'], $neuefrage['txt']);
		} 
		?>			
	</ul>
</div>
<div ID="more">
	<h3>Fragen stellen</h3>
	<?php
	if (!$user->getAngemeldet()) {
		?>
		<p>Nur angemeldete Benutzer können neue Fragen stellen. <a href="/index.php?show=anmeldung">Zur Anmeldeseite...</a></p>
		<?php
	} else {?>
		<p><a href="/index.php?show=neuefrage">Stellen Sie eine neue Frage</a></p>
		<p><a href="/index.php?show=abmeldung">Abmelden</a></p>
		<?php } ?>
	</div>
