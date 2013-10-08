<?php 

class User {
	// private $angemeldet;
	public function getAngemeldet() { 
		return $_SESSION['angemeldet'];
	}
	public function setAngemeldet($a) { 
		$_SESSION['angemeldet'] = $a;
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
	
	public function auth($u, $p, $url=NULL) {
		$sql = new SQL();
		$pw = $sql->getPasswort($u);
		// Benutzername und Passwort werden überprüft
		// $passwort darf nicht leer sein, da sonst unbekannte Nutzer (wegen leerer Ergebnismenge der Abfrage) angemeldet wären
		if (($pw == $p) && ($pw != '')) {
			$this->setAngemeldet(TRUE);
			if ($url!=NULL) {
				$_SESSION['angemeldet'] = TRUE;
				$_SESSION['benutzer'] = $u;
				$this->weiterleiten($url);
			}
		} else {
			$this->setAngemeldet(FALSE);
		}
	}
	
	public function __construct(){
		session_start();

		if (!isset($_SESSION['angemeldet']) || !$_SESSION['angemeldet']) {
			$this->setAngemeldet(FALSE);
			echo "Wir sind nicht angemeldet";
		} else {
			$this->setAngemeldet(TRUE);
			echo "Wir sind angemeldet";
		}	
	}
}	
?>