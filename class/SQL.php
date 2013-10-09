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
			$this->dbh->rollback(); 
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
			$this->dbh->rollback(); 
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
			$this->dbh->rollback(); 
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
			$this->dbh->rollback(); 
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
}
?>