<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

//Alvo da busca
$key=$_POST['Id'];
unset($_POST["Id"]);

$IdField=$_POST;
$index=array("Material"=>'Tipo',"Modelo"=>'`Marca/Modelo`',"Projeto"=>'Projeto');

//Monta query
$sql= "SELECT DISTINCT $index[$key] FROM $tablename";
$filtro=" WHERE $index[$key] IS NOT NULL";
$order=" ORDER BY $index[$key]";

foreach($IdField as $key2 => $value2)
	if($value2!='')
    $filtro .= " AND $index[$key2]=\"$value2\"";

$sql .=$filtro;
$sql .=$order;
try{
	$camp=str_replace("`", "", $index);
	$packet["Opcoes"][$key]=array();
	$result=connection($sql);
//Evita de responder em situações analogos a inicial ("Material"='' e Id="Modelo")
	if(!(empty(array_filter($IdField)) && (count($IdField)!=0)))
		if ($result)
			while($row=$result->fetchArray())
			{
				$data=htmlspecialchars($row[$camp[$key]]);
		  		$packet["Opcoes"][$key][$data]=$data;
			}

	if(count($packet["Opcoes"][$key]) != 1)
  	$packet["Opcoes"][$key]["Todos"]='';

	echo json_encode($packet);
	$result->finalize();
	}
catch(Exception $e)
    {
        echo $e->getMessage(), "\n";
    }	
?>
