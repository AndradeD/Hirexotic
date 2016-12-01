<?php
//Devolve dados do equipamento selecionado
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
$id=$_POST["ID"];

$sql="SELECT * FROM $tablename WHERE ID=\"$id\"";

try{
	$result=connection($sql);
	$row=$result->fetchArray();
	echo json_encode($row);

$result->finalize();
}
catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
?>
