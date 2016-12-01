<?php
//Retorna se o usuário está autenticado junto com seu nome
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
session_start();
$autenticado=false;
$nome="";

if(isset( $_SESSION['user_id']))
{
	$id=$_SESSION['user_id'];

	$sql="SELECT Usuario FROM $tablename_user WHERE Userid=\"$id\"";

	try
	{
		$result=connection($sql);
		$row=$result->fetchArray();
		$nome=$row["Usuario"];
		$autenticado=true;
	}
	catch(Exception $e)
	{
		echo $e->getMessage(), "\n";
	}
}

echo json_encode(array('autenticado'=>$autenticado,'nome'=>$nome));
?>
