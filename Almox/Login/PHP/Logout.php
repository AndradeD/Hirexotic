<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
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

	$sql="UPDATE $tablename_user SET Userid=NULL WHERE Userid=\"$id\"";

	try{
		$result=connection($sql);
		//var_dump($sql);
		//var_dump($result);
		if($result->changes()==0)
			$mensagem="Erro no logout";
		else
			{
			unset($_SESSION["user_id"]);
			$mensagem = "Logout com sucesso";
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
