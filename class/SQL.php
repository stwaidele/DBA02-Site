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
}	
?>