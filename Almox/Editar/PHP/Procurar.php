<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

$sql='SELECT Tipo, "Marca/Modelo", "S/N", ID FROM "'.$tablename.'"';

$par=$_POST;

//Array relacionando ID de $_POST com nome do campo relacionado no Banco de Dados
$index=array('Tipo'=>'Tipo','Marca'=>'`Marca/Modelo`','Serie'=>'`S/N`','NF'=>'Danfe',
		'Local'=>'`Local Almox`', 'Empenho'=>'`Nota de Empenho`', 'Proj'=>'Projeto', 'Identificador'=>'Identificador');

$filtro="";

foreach($par as $key => $value)
	if($value!='')
		if($key!='Serie')
			if($filtro=='')
				$filtro .= " WHERE $index[$key]=\"$value\"";
			else
				$filtro .= " AND $index[$key]=\"$value\"";
		else //Busca número de série por expressao regular
			if($filtro=='')
				$filtro .= " WHERE $index[$key] LIKE \"%$value%\"";
			else
				$filtro .= " AND $index[$key] LIKE \"%$value%\"";


$sql .= $filtro;

$order=" ORDER BY Tipo, `Marca/Modelo`, `Local Almox`, Identificador";
$sql .=$order;

try{
	$result=connection($sql);
	while($row=$result->fetchArray())
	{
		$packet["dado"][]= array("opcao" =>array('tipo'=>htmlspecialchars($row["Tipo"]),
												'modelo'=>htmlspecialchars($row["Marca/Modelo"]),
												'sn'=>htmlspecialchars($row["S/N"])) ,
												"valor"=>$row["ID"]); #packet{dado[0:{opcao:, value:},1:{opcao:,value:}...]}
	}
	echo json_encode($packet);
	$result->finalize();
}
catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
?>
