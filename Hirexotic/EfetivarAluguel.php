<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';
	session_start();

	$idaluguel=$_POST["idaluguel"];
	$validado=$_POST["validado"];
	$user_id=$_SESSION["user_id"];

	if($idaluguel=="" ||$validado=="")
	{
		$packet=array('sucesso'=>false,'mensagem'=>'Nenhum campo pode ser deixado em branco');
		echo json_encode($packet);
		die();
	}

	$sql="SELECT matricula from $tablename_funcionario c, $tablename_user u WHERE c.usuario=u.usuario AND u.session_id='$user_id';";


	try{
		$result=connect($sql);

		if(pg_num_rows($result)==0)
		{
			$packet=array('sucesso'=>false,'mensagem'=>'Preciso estar logado antes');
			echo json_encode($packet);
			die();
		}
		else {
			$collun = pg_fetch_object($result);
			$matricula=$collun->matricula;
		}

		$sql="UPDATE $tablename_aluguel SET funcionario_homolog=$matricula, homologada=$validado WHERE id=$idaluguel;";
		$result=connect($sql);
		if(pg_affected_rows($result) == 0)
      $packet=array('sucesso'=>false,'mensagem'=>'Falha no servidor');
		else
      $packet=array('sucesso'=>true,'mensagem'=>'Aluguel atualizado com sucesso');

		//importante $validado ser minusculo
		if($validado=="false")
		{
		  $sql="UPDATE $tablename_automovel a SET disponivel=TRUE FROM $tablename_aluguel l WHERE l.id_automovel=a.id AND l.id=$idaluguel;";
			connect($sql);
		}
    echo json_encode($packet);
	}
	catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
?>
