<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';

	$nome=$_POST["Nome_text"];
	$endereco=$_POST["Endereco_PF"];
	$telefone=$_POST["Tel"];
	$cnpj=$_POST["CNPJ"];
	$usuario=$_POST["Usuario"];
	$senha=$_POST["Senha"];
	$senha_conf=$_POST["Senha_conf"];

	if($nome=="" || $endereco==""||$telefone==""||$cnpj==""||$usuario==""||$senha==""||$senha_conf=="")
	{
		$packet=array('sucesso'=>false,'mensagem'=>'Nenhum campo pode ser deixado em branco');
		echo json_encode($packet);
		die();
	}
	if($senha!=$senha_conf)
	{
		$packet=array('sucesso'=>false,'mensagem'=>'As senhas não coincidem');
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
