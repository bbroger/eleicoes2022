<?php

require_once("vendor/autoload.php");


/* */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/* */

use \Cnx\DB\Sql; 
use \Cnx\Model;
use \Cnx\Crypto;

class RegenerateRandcode extends Model
{
	public function regenerate() 
	{
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tbcandidatos");
	
		for ($x = 0; $x < count($result); $x++) {
			
			$rand = rand();
			
			$id = $x + 1;
			
			$sql->select("UPDATE tbcandidatos SET randcode = $rand WHERE (id = $id)");

		}
	}
}

$regen = new RegenerateRandcode();
$regen->regenerate();
/* */
echo "Oi. Você está procurando o que aqui?";
