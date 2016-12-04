<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';

	$nome=$_POST["nome"];
	$marca=$_POST["marca"];
	$ano=$_POST["ano"];
	$npassageiros=$_POST["npassageiros"];
	$velocidade=$_POST["velocidade"];
	$cilindradas=$_POST["cilindradas"];
	$nportas=$_POST["nportas"];

	if($nome=="" || $marca==""||$ano==""||$npassageiros==""||$velocidade==""||$cilindradas==""||$nportas=="")
	{
		$packet=array('sucesso'=>false,'mensagem'=>'Nenhum campo pode ser deixado em branco');
		echo json_encode($packet);
		die();
	}
	$sql="INSERT INTO $tablename_modelo VALUES (DEFAULT, '$nome', '$marca', $ano, $npassageiros, $velocidade, $cilindradas);";

	try{
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
