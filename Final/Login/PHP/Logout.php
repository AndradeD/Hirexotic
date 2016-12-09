<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';
session_start();

$sucess=false;
$mensagem='';
if(!isset( $_SESSION['user_id']))
{
	$mensagem = 'Usuário não logado';
	$sucess=true;
}
else
{
	$id=$_SESSION['user_id'];

	$sql="UPDATE $tablename_user SET session_id=NULL WHERE session_id='$id'";

	try{
		$result=connect($sql);

		if(pg_affected_rows($result)==0)
			$mensagem="Erro no logout";
		else
			{
			unset($_SESSION["user_id"]);
			$mensagem = "Logout com sucesso";
			$sucess=true;
			}
	}
	catch(Exception $e){
       	echo $e->getMessage(), "\n";
   	}
}
$resposta= array("mensagem"=>$mensagem,"sucesso"=>$sucess);
echo json_encode($resposta);
?>
