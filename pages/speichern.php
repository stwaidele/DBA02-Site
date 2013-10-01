<?php
if ($auth_angemeldet==FALSE) {
	?>
	<p>Nur angemeldete Benutzer können neue Fragen stellen.</p>
	<p>Warum Sie zwischen Frage-Eingabe und Speicherung nicht mehr angemeldet sind? Keine Ahnung. Das sollte eigentlich nicht passieren.</p>
	<p>Wir bitten vielmals um Entschuldigung...</p>
	<p><a href="/anmeldung">Zur Anmeldeseite...</a></p>
	<?php
} else {
	$fragetext = $_REQUEST["frage"];
	$antworten = $_REQUEST["awm"];
	
//	$sql[0] = "insert into "
	print $fragetext;
	foreach ($antworten as $antwort) {
		print $antwort;
	}
	
?>
	<div ID="NewQuestion">


		<h3>Bitte geben Sie Ihre neue Frage ein:</h3>
		<form role="form" action="/speichern" method="post">
			<div class="form-group">
				<label for="frage">Fragetext</label>
				<input type="text" class="form-control" id="frage" name="frage" placeholder="Wie lautet Ihre neue Frage?">
			</div>
			<div id="answers">
				<div class="form-group">
					<label for="antwort1">1. Antwortmöglichkeit</label>
					<input type="text" class="form-control" name='awm[]'  placeholder="Antwort eingeben...">
				</div>
			</div>
			<div class="form-group">
				<button type="button" id="newanswer" class="btn btn-success btn-xs">Antwort eingeben...</button>
			</div>	
			<script>
		
			$("#newanswer").click(function() 
			{
				var na = $("<div class='form-group'>\
				<label for='antwort'>Weitere Antwortmöglichkeit</label>\
				<div class='input-group'><input type='text' class='form-control' name='awm[]'  placeholder='Antwort eingeben...'>\
				<span class='input-group-btn'><button type='button' class='delanswer btn btn-danger' aria-hidden='true'>&times;</button></span>\
				</div></div>");
				na.hide();
				na.appendTo("#answers");
				na.slideDown();	
				$(".delanswer").click(function(){
					$(this).parent().parent().parent().slideUp("normal",
					function() {$(this).remove();}
				);
			});
		});
		</script>
		<button type="submit" class="btn btn-default">Frage & Antworten speichern</button>
	</form>
</div>
<?php } ?>
