<?php 
include($_SERVER['DOCUMENT_ROOT'].'/includes/dbconf.php'); 

class Datenbank {
	//PDO - Datenbankhandler
	protected $dbh;
	public $DEBUG = "public";
	
	public function __construct(){
		// Details zum Verbindungsaufbau sind in der INI-Datei gespeichert
		$ini = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/includes/dbconf.ini');
		
		try {
			//Verbindung zur Datenbank
			$this->dbh = new PDO("mysql:host=".$ini['DBA02_host']
							.";dbname=".$ini['DBA02_db']
							.";charset=".$ini['DBA02_charset'], 
							$ini['DBA02_user'], 
							$ini['DBA02_pass']);
		} catch (PDOException $e) {
			print "Error: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function __destruct(){
		$this->dbh = NULL;
	}
	public function close() {
		print "Warning: Ignoring call to Datenbank::close(). The database connection will be closed in the destructor.";
	}
}	


?>
