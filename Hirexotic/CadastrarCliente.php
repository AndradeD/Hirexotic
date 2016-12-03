<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';

	$nome=$_POST["nome"];
	$endereco=$_POST["endereco"];
	$telefone=$_POST["telefone"];
	$cpf=$_POST["cpf"];
	$sexo=$_POST["sexo"];
	$nascimento=$_POST["nascimento"];
	$usuario=$_POST["usuario"];
	$senha=$_POST["senha"];

	if($nome=="" || $endereco==""||$telefone==""||$cpf==""||$sexo==""||$nascimento==""||$usuario==""||$senha=="")
	{
		$packet=array('sucesso'=>false,'mensagem'=>'Nenhum campo pode ser deixado em branco');
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
