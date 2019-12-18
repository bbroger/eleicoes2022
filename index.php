<?php 

/* */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/* */

session_start();
require_once("vendor/autoload.php");
require_once("templateHandler.php");
use \Slim\Slim;
use \Cnx\Page;
use \Cnx\Model;
use \Cnx\Crypto;
use \Cnx\Session;
use \Cnx\Model\Candidatos;
use \Cnx\Model\Cadastro;
use \Cnx\Model\User;
 
$app = new Slim();
$app->config('debug', true);

$app->get('/', function() {

	$candidatos = Candidatos::listAll();
	$lista = new Candidatos();

	if (!isset($_SESSION['userLogin'])) {
		$_SESSION['userLogin'] = 0;
	} 

	if (!isset($_SESSION['message'])) {
		$message = '';
	} else {
		$message = $_SESSION['message'];
	}

	$page = new Page();
	$page->setTpl("index", [
		'candidato'=>$candidatos,
		'message'=>$message
	]);
});

$app->get('/cadastre', function() {

	if (!isset($_SESSION['message'])) {
		$message = '';
	} else {
		$message = $_SESSION['message'];
	}
	
	$page = new Page();

	$page->setTpl("register", [
		'message'=>$message
	]);
});

$app->get('/login', function(){


	if (!isset($_SESSION['message'])) {
		$message = '';
	} else {
		$message = $_SESSION['message'];
	}

	$page = new Page();

	$page->setTpl("login", [
		'message'=>$message
	]);

});

$app->get('/sair', function() {

	$user = new User();
	$user->logout();
	

});

$app->get('/votar-:randcode', function($randcode) {

	if (!isset($_SESSION['message'])) {
		$message = '';
	} else {
		$message = $_SESSION['message'];
	}

	$candidatos = new Candidatos();
	$candidatos->get((int)$randcode);

	$page = new Page();

	$page->setTpl("vote", [
		'message'=>$message,
		'candidato'=>$candidatos->getValues()
	]);
});

$app->get('/politica-de-privacidade', function(){

	$page = new Page();

	$page->setTpl("privacy");

});

$app->post('/votar-:randcode', function($randcode) {

	/* Verificando o captcha */
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
		"secret"=>"6Lc_RMgUAAAAABv1yZs23lIraJj8rh1NFXJz_9fI",
		"response"=>$_POST["g-recaptcha-response"],
		"remoteip"=>$_SERVER["REMOTE_ADDR"]
	)));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$recaptcha = json_decode(curl_exec($ch), true);
	curl_close($ch);

	if ($recaptcha["success"] === true) {

		$candidatos = new Candidatos();
		$user = new User();
		$session = new Session();
		$crypto = new Crypto();
		$status = $session->checkLogin();

		echo $status;


		switch ($status) {
			case 0:

				$idCandidato = $crypto->getEncripted($randcode, 1);

				$candidatos->tryVote($randcode);
				$user->update($_SESSION['userId'], $idCandidato);
				$_SESSION['userVotou'] = 1;
				Session::afterVote();

			break;

			case 1:

				$_SESSION['message'] = "Você já votou.";
				header("Location: /eleicoes2022");

			break;

			default:

				$_SESSION['message'] = "Alguma coisa deu errado.";
				header("Location: /eleicoes2022");

			break;
		}
	}
	else {
		$_SESSION['message'] = "Por favor, faça a verificação do captcha";
		header("Location: /eleicoes2022/votar-$randcode");
		exit;
	}

		
	
});


$app->post('/login', function(){

	$user = new User();
	$crypt = new Crypto();

	//Encripta os dados do login e envia para a sessão
	$_SESSION['login'] = $crypt->getEncripted($_POST);

	header("Location: DecryptLogin.php");

});

$app->post('/cadastre', function(){


	/* Verificações de Campos */

	if ($_POST['nome'] == null ||
		$_POST['sobrenome'] == null ||	
		$_POST['cpf'] == null ||	
		$_POST['nascimento'] == null ||	
		$_POST['deslogin'] == null ||	
		$_POST['pass'] == null	
	) {
		$_SESSION['message'] = "Por favor, preencha todos os campos corretamente.";
		header("Location: /eleicoes2022/cadastre");
		exit;
	}
	if (empty($_POST['aceite'])) {
		$_SESSION['message'] = "Por favor, leia e aceite os termos de uso.";
		header("Location: /eleicoes2022/cadastre");
		exit;
	}

	/* Verificando o captcha */
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
		"secret"=>"6Lc_RMgUAAAAABv1yZs23lIraJj8rh1NFXJz_9fI",
		"response"=>$_POST["g-recaptcha-response"],
		"remoteip"=>$_SERVER["REMOTE_ADDR"]
	)));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$recaptcha = json_decode(curl_exec($ch), true);
	curl_close($ch);

	if ($recaptcha["success"] === true) {
	
		$cadastro = new Cadastro();
		$crypt = new Crypto();

		/* Pega a ID da Sessão e cria um registro com ela */
		session_regenerate_id();
		$session = array(
			"sessionid"=>session_id()
		);
		$sessionid = session_id();
		$cadastro->setData($session);
		$cadastro->saveID();

		/* Criptografando os dados da sessão e atualizando o registro */
		$update = $crypt->getEncripted($_POST);
		$cadastro->setData($update);
		$cadastro->update($sessionid);

		

		/* Destruindo a sessão atual, de forma que o usuário é obrigado a logar-se */
		session_destroy();

		/* Enviando o usuário à página de login */
		header("Location: /eleicoes2022/login");
	}
	else {
		$_SESSION['message'] = "Por favor, faça a verificação do captcha";
		header("Location: /eleicoes2022/cadastre");
		exit;
	}

	


});


$app->run();

?>