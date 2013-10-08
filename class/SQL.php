<?php 
class SQL extends Datenbank {
	public function __construct(){
		parent::__construct();
	}

	public function __destruct(){
		parent::__destruct();
	}
	
	public function getPasswort($u) {
		// Passwort aus der Datenbank holen
		$stmt = $this->dbh->prepare("select pw from user where email = :u" );
		$stmt->bindParam(':u', $u);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		return $result->pw;
	}
	public function setNeueFrage($fragetext, $antworten) {
		// TODO: Transaction start / Error handling

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