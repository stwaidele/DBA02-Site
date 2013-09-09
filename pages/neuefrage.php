<div ID="NewQuestion">
	<h3>Bitte geben Sie Ihre neue Frage ein:</h3>
	<form role="form">
		<div class="form-group">
			<label for="frage">Fragetext</label>
			<input type="text" class="form-control" id="frage" placeholder="Wie lautet Ihre neue Frage?">
		</div>
		<div id="answers">
			<div class="form-group">
				<label for="antwort1">1. Antwortmöglichkeit</label>
				<input type="text" class="form-control" id="antwort1" placeholder="Antwortmöglichkeit">
			</div>
		</div>
		<div class="form-group">
			<button type="button" id="newanswer" class="btn btn-success btn-xs">Weitere Antwort eingeben...</button>
		</div>	
		<script>
		$("#newanswer").click(function() 
		{
			$("<div class='form-group'>\
			<label for='antwort3'>Weitere Antwortmöglichkeit</label>\
			<input type='text' class='form-control'  placeholder='Hier muss noch eine eindeutige HTML-ID generiert werden.'>\
			</div>").appendTo("#answers");	
		})
		</script>
		<button type="submit" class="btn btn-default">Frage & Antworten speichern</button>
	</form>
</div>