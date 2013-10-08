<?php 

class User extends Datenbank {
	private $berechtigt = FALSE;
	public function istberechtigt() { 
		return $berechtigt;
	}
	
	public function weiterleiten($url){
		if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
			if (php_sapi_name() == 'cgi') {
				header('Status: 303 See Other');
			}
			else {
				header('HTTP/1.1 303 See Other');
			}
		}
		header('Location: '.$url);
		exit;		
	}
	
	public function __construct($u, $p, $url=NULL){
		// Datenbankverbindung in der Elternklasse
		parent::__construct();
		echo "__construct -> User $DEBUG";
		// Passwort aus der Datenbank holen
		$stmt = $this->dbh->prepare("select pw from user where email = :u" );
		$stmt->bindParam(':u', $u);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);
		
		// Benutzername und Passwort werden überprüft
		// $passwort darf nicht leer sein, da sonst unbekannte Nutzer (wegen leerer Ergebnismenge der Abfrage) angemeldet wären
		if (($result->pw == $p) && ($result->pw != '')) {
			$this->berechtigt = TRUE;
			if ($url!=NULL) {
				$_SESSION['angemeldet'] = true;
				$_SESSION['benutzer'] = $u;
				$this->weiterleiten($url);
			}
		} else {
			$berechtigt = FALSE;
		}
		
	}
	public function __destruct(){
		parent::__destruct();
	}
}	
?>