<?php
$connection = @mysql_connect($DBA02_host, $DBA02_user, $DBA02_pass);
if ($connection == FALSE) {
	echo "Bitte entschuldigen Sie, es ist ein technischer Fehler aufgetreten. Bitte wenden Sie sich an den Support";
	exit();
}
mysql_select_db("dba02");
mysql_set_charset("utf8");

// Die 3 Fragen mit der höchsten FID
$neuefragen = mysql_query("select * from frage order by fid desc limit 0,3");
$anzahlneu = mysql_num_rows($neuefragen);

// Die 3 beliebtesten Fragen
$popfragen = mysql_query("SELECT count(fid) as c, fid, txt  FROM (select count(a.fid) as c, a.fid, g.zs, f.txt from antwort a, geantwortet g, frage f WHERE g.aid=a.aid and a.fid = f.fid GROUP BY g.zs, a.fid) AS tbl GROUP BY fid ORDER BY c DESC LIMIT 0,3;");
$anzahlpop = mysql_num_rows($neuefragen);

?>
<div ID="popular">
	<h3>Beliebte Fragen</h3>
	<ul>
		<?php
		for ($i = 1; $i <= $anzahlpop; $i++) {
			$popfrage = mysql_fetch_assoc($popfragen);
			printf ('<li><a href="/frage/%s">%s</a></li>', $popfrage['fid'], $popfrage['txt']);
		} 
		?>			
	</ul>
</div>
<div ID="new">
	<h3>Neue Fragen</h3>
	<ul>
		<?php
		for ($i = 1; $i <= $anzahlneu; $i++) {
			$neuefrage = mysql_fetch_assoc($neuefragen);
			printf ('<li><a href="/frage/%s">%s</a></li>', $neuefrage['fid'], $neuefrage['txt']);
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
