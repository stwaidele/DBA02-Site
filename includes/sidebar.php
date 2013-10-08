<?php
// Verbindung zur DB herstellen
$dbverbindung = new mydb();

// Die 3 Fragen mit der höchsten FID
$queryneuefrage = "select * from frage order by fid desc limit 0,3";
$anzahlneu =$dbverbindung->queryanzahl($queryneuefrage);
$neuefragen = $dbverbindung->query($queryneuefrage);

// Die 3 beliebtesten Fragen
$querypopfragen = "SELECT count(fid) as c, fid, txt  FROM (select count(a.fid) as c, a.fid, g.zs, f.txt from antwort a, geantwortet g, frage f WHERE g.aid=a.aid and a.fid = f.fid GROUP BY g.zs, a.fid) AS tbl GROUP BY fid ORDER BY c DESC LIMIT 0,3;";
$anzahlpop =$dbverbindung->queryanzahl($querypopfragen);
$popfragen=$dbverbindung->query($querypopfragen);

?>
<div ID="popular">
	<h3>Beliebte Fragen</h3>
	<ul>
		<?php
		for ($i = 1; $i <= $anzahlpop; $i++) {
			
			$popfrage =$popfragen->fetch_array();
			printf ('<li><a href="/frage/%s">%s</a></li>', $popfrage[1], $popfrage[2]);
		} 
		?>			
	</ul>
</div>
<div ID="new">
	<h3>Neue Fragen</h3>
	<ul>
		<?php
		for ($i = 1; $i <= $anzahlneu; $i++) {
			
			$neuefrage = $neuefragen->fetch_array();
			printf ('<li><a href="/frage/%s">%s</a></li>', $neuefrage[0], $neuefrage[1]);
		} 
		?>			
	</ul>
</div>
<div ID="more">
	<h3>Fragen stellen</h3>
	<?php
	if (!$user->getAngemeldet()) {
		?>
		<p>Nur angemeldete Benutzer können neue Fragen stellen. <a href="/anmeldung">Zur Anmeldeseite...</a></p>
		<?php
	} else {?>
		<p><a href="/neuefrage">Stellen Sie eine neue Frage</a></p>
		<p><a href="/abmeldung">Abmelden</a></p>
		<?php } ?>
	</div>
