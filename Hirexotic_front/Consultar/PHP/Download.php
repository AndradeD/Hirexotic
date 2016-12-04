<?php
//Gera o arquivo CSV para download
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

$tipo=$_POST["Material"];
$modelo=$_POST["Modelo"];
$projeto=$_POST["Projeto"];

$sql="SELECT * FROM $tablename WHERE Tipo=\"$tipo\"";
if($modelo!='')
	$sql .=" AND `Marca/Modelo`=\"$modelo\"";
if($projeto!='')
	$sql .=" AND Projeto=\"$projeto\"";

try{
  $result=connection($sql);
  $num_fields = $result->numColumns();
  $headers = array();
  for ($i = 0; $i < $num_fields; $i++)
      $headers[] = $result->columnName($i);

  $fp = fopen('php://output', 'w');
  if ($fp && $result)
  {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="Material.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    fputcsv($fp, $headers);
    while ($row = $result->fetchArray(SQLITE3_ASSOC))
      fputcsv($fp, array_values($row));
    die;
  }
}
catch(Exception $e){
          echo $e->getMessage(), "\n";
      }
?>
