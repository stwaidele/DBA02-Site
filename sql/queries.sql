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
	
# Die drei neusten Fragen
# d.h. mit der höchsten FID
# (für Sidebar)
select * from frage order by fid desc limit 0,3;

# Die drei beliebtesten Fragen
# d.h. mit den meisten eindeutigen Zeitstempeln bei den gegebenen Antworten
# (für Sidebar)
SELECT count(fid) as c, fid, txt  
	select count(a.fid) as c, a.fid, g.zs, f.txt 
		from antwort a, geantwortet g, frage f 
		WHERE g.aid=a.aid and a.fid = f.fid 
		GROUP BY g.zs, a.fid) AS tbl 
	GROUP BY fid ORDER BY c DESC LIMIT 0,3;

