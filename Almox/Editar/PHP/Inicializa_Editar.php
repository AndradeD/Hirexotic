<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

$IdField=$_POST;
//Array relacionando ID de $_POST com nome do campo relacionado no Banco de Dados
$index=array('Tipo'=>'Tipo','Marca'=>'Marca/Modelo','NF'=>'Danfe','Empenho'=>'Nota de Empenho','Local'=>'Local Almox', 'Proj'=>'Projeto');

//Para cada campo enviado, monta uma query com o elemento pesquisado+filtros+ordenador
$filtro="";
foreach($IdField as $key2 => $value2)
	if($value2!='')
		if($filtro=="")
			$filtro .= " WHERE \"$index[$key2]\"=\"$value2\"";
		else
			$filtro .= " AND \"$index[$key2]\"=\"$value2\"";

try{
	foreach ($IdField as $key => $value)
	{
		$sql="SELECT DISTINCT \"$index[$key]\" FROM $tablename";
		$order=" ORDER BY \"$index[$key]\"";

		$sql .=$filtro;
		$sql .=$order;
		$result=connection($sql);
		$packet["Opcoes"]["$key"]=array();
		if ($row=$result->fetchArray()[0] != NULL)
			{
			if($result->fetchArray())
				$packet["Opcoes"]["$key"]['Todos']='';
			$result->reset();
			while($row=$result->fetchArray())
				{
				$data=htmlspecialchars($row[$index[$key]]);
				if($data!='')
					$packet["Opcoes"]["$key"][$data]=$data;
				}
			
			}
		else
			$packet["Opcoes"]["$key"]['Todos']='';
	}
	echo json_encode($packet);
	$result->finalize();
	}
catch(Exception $e){
   	echo $e->getMessage(), "\n";
   	}
?>
