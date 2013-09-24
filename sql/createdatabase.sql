use dba02;

drop table user;
drop table frage;
drop table antwort;
drop table geantwortet;

CREATE TABLE user (
  username VARCHAR(64) NOT NULL,
  email VARCHAR(255),
  pw VARCHAR(32) NOT NULL,
  create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`));

CREATE TABLE frage (
  fid INT NOT NULL AUTO_INCREMENT,
  txt VARCHAR(1024) NOT NULL,
  PRIMARY KEY (`fid`));

CREATE TABLE antwort (
  aid INT NOT NULL AUTO_INCREMENT,
  nr  INT NULL,
  txt VARCHAR(1024) NOT NULL,
  fid INT NOT NULL,
  PRIMARY KEY (`aid`),
  FOREIGN KEY (`fid`) REFERENCES frage(`fid`));

CREATE TABLE geantwortet (
  gid INT NOT NULL AUTO_INCREMENT,
  aid INT NOT NULL,
  zs TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`gid`),
  FOREIGN KEY (`aid`) REFERENCES antwort(`aid`));

# Zwei Admins
# Durch die Kombination von username und passwort werden selbst bei gleichem Passwort unterschiedliche Hashes generiert
insert into user (username, email, pw) values ('yfrenzel', 'frenzel.yvonne@googlemail.com', md5(concat('yfrenzel','geheim')));
insert into user (username, email, pw) values ('stwaidele', 'stefan@waidele.info', md5(concat('stwaidele','geheim')));

# Beispielfragen
insert into frage (txt) value ('Wie lautet die Antwort auf die große Frage nach dem Leben, dem Universum und einfach allem?');
insert into frage (txt) value ('Wer wird deutscher Meister?');
insert into frage (txt) value ('Welche der folgen Aussagen beunruhigt Sie am meisten?');
insert into frage (txt) value ('Wer gewinnt die Bundeskanzlerwahl?');

# nr legt die Reiehnfolge der Darstellung fest. Muss weder fortlaufend noch eindeutig sein.
# Bei gleichen nr ist die Reihenfolge undefiniert. ('WTF' oder 'Hasta la vista' können je nach Implementierung nach '42' angezeigt werden).
insert into antwort (nr, txt, fid) values ('1', 'Zweiundvierzig!', '1');
insert into antwort (nr, txt, fid) values ('2', 'WTF??!', '1');
insert into antwort (nr, txt, fid) values ('42', 'Basically...RUN!', '1');
insert into antwort (nr, txt, fid) values ('2', 'Hasta la vista, Baby.', '1');

# nr muss nicht ausgefüllt werden
insert into antwort (txt, fid) values ('FC Bayern München', '2');
insert into antwort (txt, fid) values ('Borussia Dortmund', '2');
insert into antwort (txt, fid) values ('SC Freiburg', '2');
insert into antwort (txt, fid) values ('Buchbinder Legionäre', '2');
insert into antwort (txt, fid) values ('Daniel Fridman', '2');

insert into antwort (txt, fid) values ('In den SQL-Modulen wird nichts über Datenbanken gelehrt!', '3');
insert into antwort (txt, fid) values ('ERM könnte für Enterprise Resource Planning oder auch für Entity-Relationship-Model stehen.', '3');
insert into antwort (txt, fid) values ('Zweiundvierzig.', '3');
insert into antwort (txt, fid) values ('There are only 10 kinds of people: Those who understand binary and those who do not.', '3');

insert into antwort (txt, fid) values ('Angela Merkel', '4');
insert into antwort (txt, fid) values ('Peer Steinbrück', '4');
insert into antwort (txt, fid) values ('Stefan Raab', '4');

# Da der Primärschlüssel selbst hochzählt und der Zeitstempel automatisch gesetzt wird, 
# muss beim "Beantworten" lediglich die AID angegeben werden:
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (2);
insert into geantwortet (aid) value (2);
insert into geantwortet (aid) value (2);
insert into geantwortet (aid) value (2);
insert into geantwortet (aid) value (2);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (3);
insert into geantwortet (aid) value (4);
insert into geantwortet (aid) value (4);
insert into geantwortet (aid) value (4);
insert into geantwortet (aid) value (4);
insert into geantwortet (aid) value (4);
insert into geantwortet (aid) value (4);
insert into geantwortet (aid) value (4);

insert into geantwortet (aid) value (5);
insert into geantwortet (aid) value (5);
insert into geantwortet (aid) value (6);
insert into geantwortet (aid) value (7);
insert into geantwortet (aid) value (7);
insert into geantwortet (aid) value (7);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (8);
insert into geantwortet (aid) value (9);
insert into geantwortet (aid) value (5);
insert into geantwortet (aid) value (5);
insert into geantwortet (aid) value (6);
insert into geantwortet (aid) value (7);
insert into geantwortet (aid) value (7);
insert into geantwortet (aid) value (5);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (8);
insert into geantwortet (aid) value (8);
insert into geantwortet (aid) value (5);
insert into geantwortet (aid) value (5);
insert into geantwortet (aid) value (6);
insert into geantwortet (aid) value (7);
insert into geantwortet (aid) value (7);
insert into geantwortet (aid) value (7);
insert into geantwortet (aid) value (1);
insert into geantwortet (aid) value (8);
insert into geantwortet (aid) value (9);

insert into geantwortet (aid) value (10);
insert into geantwortet (aid) value (10);
insert into geantwortet (aid) value (10);
insert into geantwortet (aid) value (11);
insert into geantwortet (aid) value (11);
insert into geantwortet (aid) value (12);
insert into geantwortet (aid) value (12);
insert into geantwortet (aid) value (13);
insert into geantwortet (aid) value (10);
insert into geantwortet (aid) value (10);
insert into geantwortet (aid) value (10);
insert into geantwortet (aid) value (11);
insert into geantwortet (aid) value (11);
insert into geantwortet (aid) value (12);
insert into geantwortet (aid) value (12);
insert into geantwortet (aid) value (13);
insert into geantwortet (aid) value (10);
insert into geantwortet (aid) value (10);
insert into geantwortet (aid) value (10);
insert into geantwortet (aid) value (11);
insert into geantwortet (aid) value (11);
insert into geantwortet (aid) value (11);
insert into geantwortet (aid) value (13);
insert into geantwortet (aid) value (13);

insert into geantwortet (aid) value (14);
insert into geantwortet (aid) value (14);
insert into geantwortet (aid) value (14);
insert into geantwortet (aid) value (14);
insert into geantwortet (aid) value (15);
insert into geantwortet (aid) value (15);
insert into geantwortet (aid) value (15);
insert into geantwortet (aid) value (16);
