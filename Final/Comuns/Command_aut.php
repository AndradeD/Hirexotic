<?php
//Verifica se o usuário está logado
//Usar para validar permissões para ações reservadas(geralmente, de modificação)
//Caso o usuário não esteja em uma sessão válida, termina o script PHP(die)
session_start();

if(isset( $_SESSION['user_id']))
{
	$id=$_SESSION['user_id'];

	$sql="SELECT count(*) as usuario FROM $tablename_user WHERE Userid=\"$id\"";
	try{
		$result=connection($sql);
		$row=$result->fetchArray();
		if($row['usuario']!= 1)
			die("Erro na autenticação");
		else
			$result->finalize();	
		}
	catch(Exception $e){
        	die($e->getMessage());
    	}
}
else
	die("Usuario não autenticado");
?>
