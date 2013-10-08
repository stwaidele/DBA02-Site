<?php
class mydb {

  protected $mysqli;
  
  // constructor
  function __construct() 
    {

	$ini_array = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/includes/dbconf.ini');
	$this->mysqli = @new mysqli($ini_array['DBA02_host'], $ini_array['DBA02_user'], $ini_array['DBA02_pass'], $ini_array['DBA02_db']);
	$this->mysqli->set_charset($ini_array['DBA02_charset']);
	// testen, ob Verbindung OK
	
    if(mysqli_connect_errno())
      {
      $this->mysqli = FALSE;
      exit();
      }
	  
    }

  // destructor
  function __destruct()
    {
    $this->close();
    }

  // explicit close
  function close()
    {
    if($this->mysqli)
      {
      $this->mysqli->close();
      $this->mysqli = FALSE;
      }
  }

  function getMysqli()
     { 
     return $this->mysqli;
     }

  // execute SELECT query, return array
	
	
	 function query($sql)
   {
    $result = $this->mysqli->query($sql);
    return $result;
	
    }
	
   function queryanzahl($sql)
   {
    $abfr = $this->mysqli->query($sql);
	$result =$abfr->num_rows;
    return $result;
	
    }
  

// this method return -1 for errors (not 0)!

  function querySingle($sql) {
    $result = $this->mysqli->query($sql);
    if($result) {
      if ($row=$result->fetch_array()) {
        $result->close();
        return $row[0];
      } else {
        // query returned no data
        return -1;
      }
    } else {
      return -1;
    }
  }

  // execute a SQL command without results (no query)

  function execute($sql){
    $result = $this->mysqli->real_query($sql);
    if($result) return TRUE;
    return FALSE;
  }

}
?>