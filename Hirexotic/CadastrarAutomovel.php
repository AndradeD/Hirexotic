<?php
	/////////////////////////////////////////////////////////
	//TODO:implementar lógica para armazenar nome da imagem//
	/////////////////////////////////////////////////////////

	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';
	session_start();

	$placa=$_POST["placa"];
	$anofab=$_POST["anofab"];
	$cor=$_POST["cor"];
	$combustivel=$_POST["combustivel"];
	$precomin=$_POST["precomin"];
	$modelo=$_POST["modelo"];
	$user_id=$_SESSION["user_id"];
	$URLImagem="somepath";///alterar!

	if($placa==""||$anofab==""||$cor==""||$combustivel==""||$precomin==""||$modelo=="")
	{
		$packet=array('sucesso'=>false,'mensagem'=>'Nenhum campo pode ser deixado em branco');
		echo json_encode($packet);
		die();
	}
	try{
		$sql= "SELECT cnpj, tipo FROM $tablename_fornecedor f, $tablename_user u WHERE f.usuario=u.usuario AND session_id='$user_id';";
		$result=connect($sql);

		if(pg_num_rows($result)==0)
		{
			$packet=array('sucesso'=>false,'mensagem'=>'Precisa estar logado para cadastrar');
			echo json_encode($packet);
			die();
		}
		else {
			$collun = pg_fetch_object($result);
			$cnpj=$collun->cnpj;
		}

		$sql="INSERT INTO $tablename_automovel VALUES (DEFAULT, '$placa', $anofab, '$cor', '$combustivel', $precomin, $modelo, $cnpj, TRUE, '$URLImagem');";
		$result=connect($sql);
		if(pg_affected_rows($result) == 0)
      $packet=array('sucesso'=>false,'mensagem'=>'Falha ao cadastrar');
		else
        $packet=array('sucesso'=>true,'mensagem'=>'Cadastrado com sucesso');
		echo json_encode($packet);
	}
	catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
?>
