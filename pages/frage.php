<div ID="frage">
	<h2>Bitte beantworten Sie folgende Frage:</h3>
		<h3>Welche der folgenden Aussagen verwundert Sie am meisten?</h3>
		<h4>FID = "<?php echo $_GET["fid"]; ?>"</h4>
		<form role="form" action="/auswertung/42">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="AID-1">
					In den SQL-Modulen nichts über Datenbanken gelehrt...
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="AID-2">
					ERM kann sowohl "Enterprise Resource Planning" als auch "Entity-Relationship Modell" bedeuten...
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="AID-42">
					Zweiundvierzig.
				</label>
			</div>		   
			<button type="submit" class="btn btn-default">Antworten & sehen, was andere geantwortet haben</button>
		</form>
	</div>
