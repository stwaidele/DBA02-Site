<?php 

class User {
	//
	// Designpattern: Singleton
	// http://www.phpbar.de/w/Singleton
	static private $instance = null;
	static public function getInstance($a = NULL) {
		if (null === self::$instance) {
			self::$instance = new self;
		}

		echo "DEBUG: $a";	
		// Sessionverwaltung
		$angemeldet=$a;

		return self::$instance;
	}

	private function __construct(){}
	private function __clone(){}
	// Ende: Designpattern Singleton
	//

	private $angemeldet = NULL;
	public function getAngemeldet() { 
		return $this->angemeldet;
	}
	public function setAngemeldet($b) {
		$this->angemeldet = $b;
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

	public function auth($u, $p, $url=NULL){
		$sql = new SQL();
		// Passwort aus der Datenbank holen
		$pw = $sql->getPasswort($u);
		
		// Benutzername und Passwort werden überprüft
		// $passwort darf nicht leer sein, da sonst unbekannte Nutzer (wegen leerer Ergebnismenge der Abfrage) angemeldet wären
		if (($pw == $p) && ($pw != '')) {
			$this->angemeldet = TRUE;
			$_SESSION['angemeldet'] = true;
			$_SESSION['benutzer'] = $u;
			if ($url!=NULL) {
				$this->weiterleiten($url);
			}
		} else {
			$angemeldet = FALSE;
		}	
	}
}	
?>