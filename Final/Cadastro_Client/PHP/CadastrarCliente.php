<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';

	$nome=$_POST["Nome_text"];
	$endereco=$_POST["Endereco"];
	$telefone=$_POST["Tel"];
	$cpf=$_POST["CPF"];
	$sexo=$_POST["Sexo_user"];
	$nascimento=$_POST["Data_Nasc"];
	$usuario=$_POST["Usuario"];
	$senha=$_POST["Senha"];
	$senha_conf=$_POST["Senha_conf"];

	if($nome=="" || $endereco==""||$telefone==""||$cpf==""||$sexo==""||$nascimento==""||$usuario==""||$senha==""||$senha_conf=="")
	{
		$packet=array('sucesso'=>false,'mensagem'=>'Nenhum campo pode ser deixado em branco');
		echo json_encode($packet);
		die();
	}
	if($senha != $senha_conf)
	{
		$packet=array('sucesso'=>false,'mensagem'=>'As senhas não coincidem');
		echo json_encode($packet);
		die();
	}

	$sql="INSERT INTO $tablename_cliente VALUES ($cpf, '$nome', '$sexo', '$endereco', $telefone, '$nascimento')";

	try{
		$result=connect($sql);
		if(pg_affected_rows($result) == 0)
      $packet=array('sucesso'=>false,'mensagem'=>'Falha ao cadastrar');
		else
      $senha = sha1( $senha );
      $sql = "INSERT INTO $tablename_user VALUES ('$usuario', '$senha', 0, NULL);";
      $result = connect($sql);
      $sql = "UPDATE $tablename_cliente SET usuario='$usuario' WHERE cpf='$cpf';";
      $result = connect($sql);
      if(pg_affected_rows($result) != 0)
        $packet=array('sucesso'=>true,'mensagem'=>'Cadastrado com sucesso');
      else {
        $sql = "DELETE FROM $tablename_cliente WHERE cpf='$cpf';";
        connect($sql);
        $packet=array('sucesso'=>false,'mensagem'=>'Falha ao cadastrar');
      }
		echo json_encode($packet);
	}
	catch(Exception $e){
        	echo $e->getMessage(), "\n";
          $sql = "DELETE FROM $tablename_cliente WHERE cpf='$cpf';";
          connect($sql);
    	}
?>
