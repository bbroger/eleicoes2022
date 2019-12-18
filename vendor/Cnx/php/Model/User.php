<?php

namespace Cnx\Model; 

use \Cnx\DB\Sql; 
use \Cnx\Model;
use \Cnx\Crypto;

class User extends Model
{

    public static function login($login, $password)
	{
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tbcadastro WHERE deslogin = :deslogin", array(
			":deslogin"=>$login
		)); 
		if (count($results) === 0)
		{
			$_SESSION['message'] = "Usuário inexistente ou senha inválida.";
			header("Location: login");
		}
		$data = $results[0];
        
		if (password_verify($password, $data["pass"]) === true)
		{
			unset($_SESSION['userData']);
			$_SESSION['userData'] = $data;
			header("Location: DecryptData.php");

			
		} else {
			$_SESSION['message'] = "Usuário inexistente ou senha inválida.";
			header("Location: login");
		}
	}

	public function logout() {
		session_destroy();
		session_start();
		session_regenerate_id();

		$_SESSION['message'] = "Você saiu do sistema. Para votar você precisa logar-se novamente.";

		header("Location: login");

	}

	public function update($iduser, $idCandidato = null)
	{
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tbcadastro WHERE id = :id", array(
			":id"=>$iduser
		)); 
		$sql->select("UPDATE tbcadastro SET votou = :votou, votou_em = :votou_em WHERE id = :id", array(
			":id"=>$iduser,
			":votou"=>'1',
			":votou_em"=>$idCandidato
		));
	}

}