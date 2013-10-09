<?php 
// Verbindung zur DB herstellen
$sql = new SQL;

// FID aus der URL lesen
$f = $_GET["fid"];

// Fragetext und Antwortmöglichkeiten aus der Datenbank lesen
$fragetext = $sql->getFrageText($f);
$antwortmoeglichkeiten = $sql->getAntwortmoeglichkeiten($f);
?>

<!-- Antworten anzeigen -->
<div ID="frage">
	<h2>Bitte beantworten Sie folgende Frage:</h3>
		<h3><?php echo $fragetext ?></h3>
		<form role="form" action="/index.php?show=auswertung" method ="get">
			<input type="hidden" name="show" value="auswertung" />
			<input type="hidden" name="fid" value="<?php echo $f; ?>" />
<?php
	//Schleife durch Antwortmöglichkeiten
	foreach ($antwortmoeglichkeiten as $awm) {
?>
        <div class="checkbox">
          <label>
			  <?php printf('<input type="checkbox" name="AID-%s">%s', $awm['aid'], $awm['txt']); ?>
          </label>
        </div> 
<?php
	} 
?>
			<button type="submit" class="btn btn-default">Antworten & sehen, was andere geantwortet haben</button>
		</form>
	</div>
