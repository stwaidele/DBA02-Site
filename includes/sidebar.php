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
			<li><a href="/frage/18">
				Wer wird Deutscher Meister?
			</a></li>
			<li><a href="/frage/23">
				Wie lautet die Antowrt auf die große Frage des Lebens, des Universums, und einfach allem?
			</a></li>
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
