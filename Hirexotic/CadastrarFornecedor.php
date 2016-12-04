<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';

	$nome=$_POST["nome"];
	$endereco=$_POST["endereco"];
	$telefone=$_POST["telefone"];
	$cnpj=$_POST["cnpj"];
	$usuario=$_POST["usuario"];
	$senha=$_POST["senha"];

	if($nome=="" || $endereco==""||$telefone==""||$cnpj==""||$usuario==""||$senha=="")
	{
		$packet=array('sucesso'=>false,'mensagem'=>'Nenhum campo pode ser deixado em branco');
		echo json_encode($packet);
		die();
	}
	$sql="INSERT INTO $tablename_fornecedor VALUES ($cnpj, '$nome', '$endereco', $telefone)";

	try{
		$result=connect($sql);
		if(pg_affected_rows($result) == 0)
      $packet=array('sucesso'=>false,'mensagem'=>'Falha ao cadastrar');
		else
      $senha = sha1( $senha );
      $sql = "INSERT INTO $tablename_user VALUES ('$usuario', '$senha', 1, NULL);";
      $result = connect($sql);
      $sql = "UPDATE $tablename_fornecedor SET usuario='$usuario' WHERE cnpj='$cnpj';";
      $result = connect($sql);
      if(pg_affected_rows($result) != 0)
        $packet=array('sucesso'=>true,'mensagem'=>'Cadastrado com sucesso');
      else {
        $packet=array('sucesso'=>false,'mensagem'=>'Falha ao cadastrar');
      }
		echo json_encode($packet);
	}
	catch(Exception $e){
        	echo $e->getMessage(), "\n";
					$sql = "DELETE FROM $tablename_fornecedor WHERE cnpj='$cnpj';";
	        connect($sql);
    	}
?>
