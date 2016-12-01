<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
session_start();

$sucess=false;
$mensagem='';
if(isset( $_SESSION['user_id']))
	unset($_SESSION['user_id']);

//Valida campos enviados
if($_POST['usuario']=="" || $_POST['senha']=="")
	$mensagem = 'Entre com o usuário e a senha';
elseif (strlen( $_POST['usuario']) > 20 || strlen($_POST['usuario']) < 4)
	$mensagem = 'Usuário deve ter entre 4 e 20 caracteres';
elseif (strlen( $_POST['senha']) > 20 || strlen($_POST['senha']) < 4)
	$mensagem = 'Senha deve ter entre 4 e 20 caracteres';
elseif (ctype_alnum($_POST['usuario']) != true)
	$mensagem = "Usuário somente pode conter letras e números";
elseif (ctype_alnum($_POST['senha']) != true)
	$mensagem = "Senha somente deve conter letras e números";
else
{
//Filtra caracteres
	$usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
	$senha = filter_var($_POST['senha'], FILTER_SANITIZE_STRING);

//Encripta
	$senha = sha1( $senha );
	$time=time();
	$id=md5($usuario.$senha.$time); //hash para variável da sessao

	$sql="UPDATE $tablename_user SET Userid=\"$id\" WHERE Usuario=\"$usuario\" and Senha=\"$senha\"";

try{
	$result=connection($sql);
	if(is_a($result, "SQLite3Result")) //Se retornou SQLite3Result, a query não modificou nada(pela função connection). Logo, query frustrada => informações incorretas
		{
		$mensagem="Usuário ou senha inválidos";
		$result->finalize();
		}
	else
		{
		$_SESSION["user_id"]=$id;
		$mensagem = "Login com sucesso";
		$sucess=true;
		$result->close();		
		}
	}
catch(Exception $e){
       	echo $e->getMessage(), "\n";
   	}
}
$resposta= array("mensagem"=>$mensagem,"sucesso"=>$sucess);
echo json_encode($resposta);
?>
