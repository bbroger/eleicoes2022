<?php

namespace Cnx\Model; 

use \Cnx\DB\Sql; 
use \Cnx\Model;
use \Cnx\Crypto;

class Cadastro extends Model
{

    public static function listAll()
	{
		$sql = new Sql();
		return $sql->select("SELECT * FROM tbcadastro");
		
    }

    public function saveID()
	{

		$sql = new Sql();
		
		$results = $sql->select("
        INSERT INTO tbcadastro (sessionid) values (:sessionid)
        ", array(
            ":sessionid"=>$this->getsessionid()
		));
    }
    
    public function update($sessionid)
	{

		$sql = new Sql();
		
		$results = $sql->select("UPDATE tbcadastro SET nome = :nome, sobrenome = :sobrenome, cpf = :cpf, nascimento = :nascimento, deslogin = :deslogin, pass = :pass, dtcadastro = :dtcadastro, votou = :votou WHERE sessionid = :sessionid", array(
			":nome"=>$this->getnome(),
			":sobrenome"=>$this->getsobrenome(),
			":cpf"=>$this->getcpf(),
            ":nascimento"=>$this->getnascimento(),
            ":deslogin"=>$this->getdeslogin(),
            ":sessionid"=>$sessionid,
            ":pass"=>Cadastro::getPasswordHash($this->getpass()),
			":dtcadastro"=>date('d/m/Y H:i:s'),
			":votou"=>'0'
		));
    }
    
    public static function getPasswordHash($password)
	{
		return password_hash(
			$password,
			PASSWORD_DEFAULT,[
				'cost'=>10
			]
		);
	}
}