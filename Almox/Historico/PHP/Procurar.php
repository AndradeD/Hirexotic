<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

//Dados base a serem mostrados
$sql="SELECT strftime(\"%d/%m/%Y\",Data_transf) as Data_transf, Destino, COUNT(*) as N_mat, t.ID as ID_Transf FROM $tablename_transf t join $tablename_matTransf m on t.ID=m.Transf";

$index=array("Tipo"=>"Tipo","Marca"=>"`Marca/Modelo`","SN"=>"`S/N`","Danfe"=>"Danfe","Empenho"=>"`Nota de Empenho`","BI"=>"BI","Data_BI"=>"Data_BI",
						 "Destino"=>"Destino","Guia_transf"=>"Guia_transf","Data_guia"=>"Data_guia","Data_Transf"=>"Data_transf");

//Recupera a transferencia que atende os critérios
if(empty(array_filter($_POST)))
	$filtro=" WHERE Concluido=1";
else
{
	$filtro=" WHERE t.ID in (SELECT Transf FROM $tablename_transf t join $tablename_matTransf m on t.ID=m.Transf WHERE Concluido=\"1\"";
	foreach($_POST as $key => $value)
		if($value!='')
			if($key!='SN')
				$filtro .= " AND $index[$key]=\"$value\"";
			else
				$filtro .= " AND $index[$key] LIKE \"%$value%\"";
	$filtro .=')';
}

$sql .= $filtro;

$order=" GROUP BY t.ID ORDER BY Data_transf,t.ID";
$sql .=$order;

try{
	$result=connection($sql);
	while($row=$result->fetchArray())
		$packet["dado"][]= array("opcao" =>array('Data_transf'=>htmlspecialchars($row["Data_transf"]),
                  														'Destino'=>htmlspecialchars($row["Destino"]),
                  														'N_mat'=>htmlspecialchars($row["N_mat"])) ,
                  														"valor"=>$row["ID_Transf"]); #packet{dado[0:{opcao:, value:},1:{opcao:,value:}...]}
	echo json_encode($packet);
	$result->finalize();
}
catch(Exception $e){
	echo $e->getMessage(), "\n";
}
?>
