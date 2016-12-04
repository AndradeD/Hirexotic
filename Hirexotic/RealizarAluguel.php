<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';
	session_start();

	$idautomovel=$_POST["idautomovel"];
	$datainicio=$_POST["datainicio"];
	$datafim=$_POST["datafim"];
	$pagamento=$_POST["pagamento"];
	$valor=$_POST["valor"];
	$user_id=$_SESSION["user_id"];

	if($idautomovel=="" || $datainicio==""||$datafim==""||$pagamento==""||$valor=="")
	{
		$packet=array('sucesso'=>false,'mensagem'=>'Nenhum campo pode ser deixado em branco');
		echo json_encode($packet);
		die();
	}

	$sql="SELECT cpf from $tablename_cliente c, $tablename_user u WHERE c.usuario=u.usuario AND u.session_id='$user_id';";


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
			$cpf=$collun->cpf;
		}

		$sql="INSERT INTO $tablename_aluguel VALUES (DEFAULT, $idautomovel, $cpf, '$datainicio', '$datafim', '$pagamento', $valor, NULL, NULL)";
		$result=connect($sql);
		if(pg_affected_rows($result) == 0)
      $packet=array('sucesso'=>false,'mensagem'=>'Falha no servidor');
		else
		{
			$sql="UPDATE $tablename_automovel SET disponivel=FALSE WHERE id=$idautomovel;";
			connect($sql);
			if(pg_affected_rows($result) == 0)
			{
	      $packet=array('sucesso'=>false,'mensagem'=>'Falha no servidor');
				$sql="DELETE FROM $tablename_aluguel WHERE id_automovel=$idautomovel;";
				connect($sql);
			}
			else
        $packet=array('sucesso'=>true,'mensagem'=>'Aluguel realizado com sucesso');
		}
		echo json_encode($packet);
	}
	catch(Exception $e){
			$sql="DELETE FROM $tablename_aluguel WHERE id_automovel=$idautomovel;";
			connect($sql);
    	echo $e->getMessage(), "\n";
    	}
?>
