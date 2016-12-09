<?php
header("Content-Type: text/html; charset=UTF-8",true);
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/Command_aut.php';

session_start();

$sucess=false;
$mensagem='';
//Testa os campos colocados
if(!isset( $_SESSION['user_id']))
	$mensagem = 'Usuário não logado';
elseif($_POST['senha_antiga']==""|| $_POST['nova_senha']==""|| $_POST['nova_senha2']=="")
	$mensagem = 'Um ou mais campos em branco';
elseif($_POST['nova_senha']!=$_POST['nova_senha2'])
	$mensagem = 'A nova senha é diferente da sua confirma��o';
elseif (strlen( $_POST['nova_senha']) > 20 || strlen($_POST['nova_senha']) < 4)
	$mensagem = 'A senha deve ter de 4 a 20 caracteres';
elseif (ctype_alnum($_POST['nova_senha']) != true)
	$mensagem = "Senha somente pode conter letras e n�meros";
else
{
//Filtra caracteres
	$senha_antiga = filter_var($_POST['senha_antiga'], FILTER_SANITIZE_STRING);
	$nova_senha = filter_var($_POST['nova_senha'], FILTER_SANITIZE_STRING);

//Encripta senha
	$senha_antiga = sha1( $senha_antiga );
	$nova_senha = sha1( $nova_senha );
	$id=$_SESSION['user_id'];

	$sql="UPDATE $tablename_user SET Senha=\"$nova_senha\" WHERE Senha=\"$senha_antiga\" AND Userid=\"$id\"";

	try{
		$result=connection($sql);
		if($result->changes()==0)
			$mensagem="Erro ao alterar senha: Login ou senha antiga inválidas";
		else
			{
			$mensagem = "Senha alterada com sucesso";
			$sucess=true;
			}
		$result->close();
	}
	catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
}
$resposta= array("mensagem"=>$mensagem,"sucesso"=>$sucess);
echo json_encode($resposta);
?>
