drop database dba02;
create database dba02 character set "utf8";
	
use dba02;

drop table user;
drop table frage;
drop table antwort;
drop table geantwortet;

CREATE TABLE user (
  email VARCHAR(255) NOT NULL,
  pw CHAR(32) NOT NULL,
  create_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`email`));

CREATE TABLE frage (
  fid INT NOT NULL AUTO_INCREMENT,
  txt VARCHAR(1024) NOT NULL,
  CONSTRAINT pk_frage PRIMARY KEY (`fid`));

CREATE TABLE antwort (
  fid INT NOT NULL, 
  aid INT NOT NULL AUTO_INCREMENT,
  nr  INT NULL,
  txt VARCHAR(1024) NOT NULL,
  CONSTRAINT pk_antwort PRIMARY KEY (fid, aid),
  CONSTRAINT fk_antwort_frage_fid FOREIGN KEY (fid) REFERENCES frage(fid) ON UPDATE CASCADE ON DELETE CASCADE );

CREATE TABLE geantwortet (
  fid INT NOT NULL,
  aid INT NOT NULL,
  gid INT NOT NULL AUTO_INCREMENT,
  zs TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT pk_geantwortet PRIMARY KEY (fid, aid, gid),
  CONSTRAINT fk_geantwortet_antwort_aid FOREIGN KEY (fid, aid) REFERENCES antwort(fid, aid) ON UPDATE CASCADE ON DELETE CASCADE );


# Zwei Admins
insert into user (email, pw) values ('frenzel.yvonne@googlemail.com', 'geheim');
insert into user (email, pw) values ('stefan@waidele.info', 'geheim');

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
insert into antwort (txt, fid) values ('Zweiundvierzig.', '3');
insert into antwort (txt, fid) values ('There are only 10 kinds of people: Those who understand binary and those who do not.', '3');

insert into antwort (txt, fid) values ('Angela Merkel', '4');
insert into antwort (txt, fid) values ('Peer Steinbrück', '4');
insert into antwort (txt, fid) values ('Stefan Raab', '4');
