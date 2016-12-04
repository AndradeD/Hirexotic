<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/Command_aut.php';

	$tipo=$_POST["tipo"];
	$modelo=$_POST["marca"];
	$sn=$_POST["serie"];
	$nf=$_POST["nf"];
	$local=$_POST["local"];
	$empenho=$_POST["empenho"];
	$trem=$_POST["trem"];
	$projeto=$_POST["proj"];
	$id=$_POST["id"];

	if($local=="" || $modelo==""||$tipo=="")
	{
		$packet=array('sucesso'=>false,'mensagem'=>'Campos com * não podem ser deixados em branco');
		echo json_encode($packet);
		die();
	}
	$sql="INSERT INTO $tablename (Tipo, `Marca/Modelo`, `S/N`, Danfe, `Local Almox`, `Nota de Empenho`, TREM, Projeto, Identificador) VALUES (\"$tipo\", \"$modelo\", \"$sn\", \"$nf\", \"$local\", \"$empenho\", \"$trem\", \"$projeto\", \"$id\")";
	
	try{
		$result=connection($sql);
		if($result->changes()==1)
			$packet=array('sucesso'=>true,'mensagem'=>'Cadastrado com sucesso');
		else
			$packet=array('sucesso'=>false,'mensagem'=>'Falha ao cadastrar');
		echo json_encode($packet);
		$result->close();
	}
	catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
?>
