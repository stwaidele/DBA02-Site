<?php 

class User {
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
		$sql = new SQL();
		$pw = $sql->getPasswort($u);
		// Benutzername und Passwort werden überprüft
		// $passwort darf nicht leer sein, da sonst unbekannte Nutzer (wegen leerer Ergebnismenge der Abfrage) angemeldet wären
		if (($pw == $p) && ($pw != '')) {
			$this->berechtigt = TRUE;
			if ($url!=NULL) {
				$_SESSION['angemeldet'] = true;
				$_SESSION['benutzer'] = $u;
				$this->weiterleiten($url);
			}
		} else {
			$this->berechtigt = FALSE;
		}
		
	}
}	
?>