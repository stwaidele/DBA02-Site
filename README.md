DBA02-Site
==========

Umfrage-Website für Modul DBA02

Mockups der Seiten
---------------------

Die Seitenentwürfe wurden mit Twitter Bootstrap http://getbootstrap.com erstellt.
Hierdurch wird ein modernes Layout erzielt, ohne dass der Seitenquellcode zu unübersichtlich wird.

Einzelseiten
------------

.../frage/<FID>      -> Frage mit der Frage-ID <FID> stellen
.../auswertung/<FID> -> Auswertung anzeigen
.../anmeldung        -> Login zum Adminbereich

Diese URLs werden per .htaccess in
.../index.php?show=frage&fid=<FID>
	
usw. umgewandelt.

ToDo: 
neuefrage -> Neue Frage mit Antworten eingeben
