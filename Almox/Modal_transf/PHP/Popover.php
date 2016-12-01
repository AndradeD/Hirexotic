<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

$transf_id=$_POST['transf'];
//Nome do destino da transferência
$sql="SELECT Destino FROM $tablename_transf WHERE ID=\"$transf_id\"";

try{
	$result=connection($sql);
	if($row=$result->fetchArray())
		$packet["titulo"]= array('Destino' => htmlspecialchars($row["Destino"]));
	
	//Tipo + quantidade de cada equipamento na transferência
	$sql="SELECT Tipo, COUNT(*) AS Quantidade FROM $tablename_matTransf WHERE Transf=\"$transf_id\" GROUP BY Tipo";
	$result=connection($sql);

	if($result->fetchArray())
		{
		$result->reset();
		while($row=$result->fetchArray())
			{
    		$data=htmlspecialchars($row["Tipo"]);
    		$packet["dado"][]= array('tipo'=>$data . ' : ','quantidade'=>$row["Quantidade"]);
  			}
  		}
  	else
  		$packet["dado"][]= array('tipo'=>'Sem equipamentos atrelados','quantidade'=>'');//Não deve existir uma transferencia sem equipamento

	echo json_encode($packet);
	$result->finalize();
}
catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
/*
if ($result->num_rows > 0)
{
  $row=$result->fetch_assoc();
  $packet["titulo"]= array('Destino' => htmlspecialchars($row["Destino"]));
}
$result->close();

//Tipo + quantidade de cada equipamento na transferência
$sql="SELECT `Tipo`, COUNT(*) AS Quantidade FROM $tablename_matTransf WHERE Transf='$transf_id' GROUP BY Tipo";
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';

if ($result->num_rows > 0)
  while($row=$result->fetch_assoc())
  {
    $data=htmlspecialchars($row["Tipo"]);
    $packet["dado"][]= array('tipo'=>$data . ' : ','quantidade'=>$row["Quantidade"]);
  }
else
  $packet["dado"][]= array('tipo'=>'Sem equipamentos atrelados','quantidade'=>'');//Não deve existir uma transferencia sem equipamento

echo json_encode($packet);
$result->close();*/
?>
