<?php
 
class DbOperation
{
    private $con;
 
    function __construct()
    {
        require_once dirname(__FILE__) . '/DbConnect.php';
        $db = new DbConnect();
        $this->con = $db->connect();
    }
 
	//adding a record to database 
	public function insertUser($cedula, $apellidos, $nombres, $password){
		$stmt = $this->con->prepare("INSERT INTO usuarios(Cedula, Apellidos, Nombres, Password) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $cedula, $apellidos, $nombres, md5($password));
		if($stmt->execute())
			return true; 
		return false; 
	}

	//fetching all records from the database 
	public function getUser(){
		$stmt = $this->con->prepare("SELECT Id, Nombres, Correo, Start FROM comment");
		$stmt->execute();
		$stmt->bind_result($Id, $Nombres, $Correo, $Start);
		$artists = array();
		
		while($stmt->fetch()){
			$temp = array(); 
			$temp['Id'] = $Id; 
			$temp['name'] = $Nombres; 
			$temp['comment'] = $Correo; 
			$temp['start'] = $Start; 
			array_push($artists, $temp);
		}
		return $artists; 
	}
}