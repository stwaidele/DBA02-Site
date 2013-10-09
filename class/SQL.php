<?php 
class SQL extends Datenbank {
	public function __construct(){
		parent::__construct();
	}

	public function __destruct(){
		parent::__destruct();
	}
	
	public function getAnzahlFragen() {
		# Die Anzahl der zur Verfügung stehenden Fragen
		# (Wird für die Auswahl einer zufälligen Frage benötigt) 
		# (-> wird im Moment gar nicht benötigt)
		try {
			$stmt = $this->dbh->prepare("select count(*) as anz from frage");
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result->anz;			
		} catch(PDOExecption $e) { 
			print "Error!: " . $e->getMessage() . "</br>"; 
		}
	}

	public function getAnzahlAntworten($f) {
		# Die Anzahl der für Frage $f gegebenen Antworten
		# (Wird für die Auswertung benötigt -> 100%) 
		try {
			$stmt = $this->dbh->prepare("select count(*) as anz from antwort, geantwortet where geantwortet.aid = antwort.aid and antwort.fid = :f and geantwortet.fid = :f");
			$stmt->bindParam(':f', $f);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result->anz;			
		} catch(PDOExecption $e) { 
			print "Error!: " . $e->getMessage() . "</br>"; 
		}
	}

	public function getAntworten($f) {
		# Listet alle für Frage f gegebenen Antworten auf:
		# (Wird für die Auswertung / Anzeige benötigt)
		try {			
			$stmt = $this->dbh->prepare("select antwort.aid, antwort.txt, count(*) as anz from antwort, geantwortet where geantwortet.aid = antwort.aid  and antwort.fid = :f and geantwortet.fid = :f  group by geantwortet.aid" );
			$stmt->bindParam(':f', $f);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_BOTH);
			return $result;
		}
		catch(PDOExecption $e) { 
			print "Error!: " . $e->getMessage() . "</br>"; 
		} 		
	}
	
	public function getFrageText($f) {
		# Der Text von Frage f:
		# (Wird für die Abfrage und die Auswertung benötigt) 
		try {
			$stmt = $this->dbh->prepare("select txt from frage where fid = :f");
			$stmt->bindParam(':f', $f);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result->txt;			
		} catch(PDOExecption $e) { 
			print "Error!: " . $e->getMessage() . "</br>"; 
		} 	
	}

	public function getAntwortmoeglichkeiten($f) {
		# Listet alle Antwortmöglichkeiten von Frage f auf:
		# (Wird für die Abfrage benötigt)
		try {			
			$stmt = $this->dbh->prepare("select aid,txt from antwort where fid = :f order by nr" );
			$stmt->bindParam(':f', $f);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_BOTH);
			return $result;
		}
		catch(PDOExecption $e) { 
			print "Error!: " . $e->getMessage() . "</br>"; 
		} 		
	}
	
	public function getPasswort($u) {
		try {
			// Passwort aus der Datenbank holen
			$stmt = $this->dbh->prepare("select pw from user where email = :u" );
			$stmt->bindParam(':u', $u);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);
			return $result->pw;
		} catch(PDOExecption $e) { 
			print "Error!: " . $e->getMessage() . "</br>"; 
		} 
	}
	
	public function setNeueFrage($fragetext, $antworten) {
		try {
			// Fragetext und alle Antworten werden in einer Transaktion gespeichert
			// -> Entweder alle oder gar nichts
			// -> Schutz vor inkonsistenten FIDs
			$this->dbh->beginTransaction();
			
			// Frage speichern
			$stmt = $this->dbh->prepare("insert into frage (txt) value (:f)" );
			$stmt->bindParam(':f', $fragetext);
			$stmt->execute();

			// FID der neuen Frage
			$fid = $this->dbh->lastInsertId();

			// Antworten speichern
			$stmt = $this->dbh->prepare("insert into antwort (txt, fid) values (:t,:f)" );
			$stmt->bindParam(':t', $antwort);
			$stmt->bindParam(':f', $fid);
			foreach ($antworten as $antwort) {
				$stmt->execute();
			}	
			$this->dbh->commit();
		} catch(PDOExecption $e) { 
			$this->dbh->rollback(); 
			print "Error!: " . $e->getMessage() . "</br>"; 
		} 
	}	

	public function setGegebeneAntworten($f, $gegebene) {
		try {
			// Alle gegebenen Antworten werden in einer Transaktion gespeichert
			// -> Entweder alle oder gar nichts
			$this->dbh->beginTransaction();
			
			// Antworten speichern
			$stmt = $this->dbh->prepare("insert into geantwortet (aid, fid) values (:a, :f)" );
			$stmt->bindParam(':f', $f);
			$stmt->bindParam(':a', $a);
			foreach ($gegebene as $a) {
				$stmt->execute();
			}
			$this->dbh->commit();
		} catch(PDOExecption $e) { 
			$this->dbh->rollback(); 
			print "Error!: " . $e->getMessage() . "</br>"; 
		} 		
	}
	
	public function getNeueFragen() {
		# Die drei neusten Fragen, d.h. mit der höchsten FID
		# (Wird für Sidebar benötigt)
		try {			
			$stmt = $this->dbh->prepare("select * from frage order by fid desc limit 0,3");
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_BOTH);
			return $result;
		}
		catch(PDOExecption $e) { 
			print "Error!: " . $e->getMessage() . "</br>"; 
		} 		
	}

	public function getBeliebteFragen() {
		# Die drei beliebtesten Fragen, d.h. mit den Antworten
		# der meisten Benutzer
		# (Wird für Sidebar benötigt)
		try {			
			$stmt = $this->dbh->prepare("select count(*) c, fid, txt from (select distinct g.zs, g.fid, f.txt from geantwortet g, frage f where g.fid=f.fid) as ttbl group by fid order by c desc limit 0,3");
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_BOTH);
			return $result;
		}
		catch(PDOExecption $e) { 
			print "Error!: " . $e->getMessage() . "</br>"; 
		} 		
	}

}
?>