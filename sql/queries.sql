# Listet alle Fragen und die dazugehörigen Antwortmöglichkeiten auf:
# (Wird nicht in der Anwendung benötigt)
select frage.txt, antwort.txt 
	from frage, antwort 
	where antwort.fid = frage.fid 
	order by frage.fid, antwort.nr;

# Der Text von Frage 1:
# (Wird für die Abfrage und die Auswertung benötigt) 
select txt from frage where fid = 1;

# Listet alle Antwortmöglichkeiten von Frage 1 auf:
# (Wird für die Abfrage benötigt)
select aid, txt 
	from antwort 
	where fid = 1 
	order by nr;

# Die Anzahl der für Frage 1 abgegebenen Antworten ( -> 100%):
# (Wird für die Auswertung benötigt)
select count(geantwortet.aid) 
	from antwort, geantwortet 
	where geantwortet.aid = antwort.aid and antwort.fid = 1;

# Die abgegebenen Antworten für Frage 1:
# (Wird für die Auswertung benötigt)
select antwort.txt, count(geantwortet.aid) 
	from antwort, geantwortet 
	where geantwortet.aid = antwort.aid and antwort.fid = 1 
	group by geantwortet.aid;