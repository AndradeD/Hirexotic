<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

$tipo=$_POST["Material"];
$modelo=$_POST["Modelo"];
$projeto=$_POST["Projeto"];

//Monta Query
$sql="SELECT * FROM $tablename";

if($tipo!='')
	$sql .= " WHERE Tipo=\"$tipo\"";
if($modelo!='')
	$sql .=" AND `Marca/Modelo`=\"$modelo\"";
if($projeto!='')
	$sql .=" AND Projeto=\"$projeto\"";

	$sql .=" ORDER BY `Marca/Modelo`, Identificador, `Local Almox`, Danfe, `Nota de Empenho`";

try
{
 $result=connection($sql);
 while($row = $result->fetchArray())
	$packet[]=array('Tipo'=>$row["Tipo"],
                 	'Marca'=>$row["Marca/Modelo"],
                    'SN'=>$row["S/N"],
                    'Danfe'=>$row["Danfe"],
                    'Local'=>$row["Local Almox"],
                    'Empenho'=>$row["Nota de Empenho"],
                    'Trem'=>$row["TREM"],
                    'Projeto'=>$row["Projeto"],
                    'Id'=>$row["Identificador"]
                    );


echo json_encode($packet);
$result->finalize();
}
catch(Exception $e)
    {
        echo $e->getMessage(), "\n";
    }
?>
