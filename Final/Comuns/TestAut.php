<?php
//Retorna se o usuário está autenticado junto com seu nome
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';
session_start();
$autenticado=false;
$nome="";
$tipo="";

if(isset( $_SESSION['user_id']))
{
	$id=$_SESSION['user_id'];

	$sql="SELECT usuario, tipo FROM $tablename_user WHERE session_id='$id';";

	try
	{
		$result=connect($sql);
		$row=pg_fetch_assoc($result);
		$nome=$row["usuario"];
		$tipo=$row["tipo"];
		$autenticado=true;
	}
	catch(Exception $e)
	{
		echo $e->getMessage(), "\n";
	}
}

echo json_encode(array('autenticado'=>$autenticado,'nome'=>$nome, 'tipo'=>$tipo));
?>
