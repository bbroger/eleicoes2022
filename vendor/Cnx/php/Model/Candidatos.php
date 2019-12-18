<?php

namespace Cnx\Model; 

use \Cnx\DB\Sql; 
use \Cnx\Model;
use \Cnx\Session;

class Candidatos extends Model
{
    public static function listAll()
	{
		$sql = new Sql();
		return $sql->select("SELECT * FROM tbcandidatos ORDER BY id DESC");
		
    }
    
    public function getValues()
	{
		$values = parent::getValues();
		
		return $values;
	}
	
	 public function get($randcode)
	 {
	 	$sql = new Sql();
	 	$results = $sql->select("SELECT * FROM tbcandidatos WHERE randcode = :randcode", [
	 		":randcode"=>$randcode
	 	]);
	 	$this->setData($results[0]);
	 }

	public function tryVote($randcode)
	{
		$this->get($randcode);

		$result = $this->getValues();

		echo $result['votos'] + 1;
		echo "<HR>";
		var_dump($result);

		$this->checkLogin();

		$sql = new Sql();
		$sql->select("UPDATE tbcandidatos SET votos = :votos WHERE randcode = :randcode", array(
			":randcode"=>$randcode,
			":votos"=>$result['votos'] + 1
		));

	} 
	 
}