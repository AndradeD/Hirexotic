<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/Command_aut.php';

$IdField=$_POST;
$index=array("Tipo"=>"Tipo","Marca"=>"`Marca/Modelo`","Danfe"=>"Danfe","Empenho"=>"`Nota de Empenho`","BI"=>"BI","Data_BI"=>"Data_BI",
						 "Destino"=>"Destino","Guia_transf"=>"Guia_transf","Data_guia"=>"Data_guia","Data_Transf"=>"Data_transf");

try{
	foreach ($IdField as $key => $value)
		{
		$sql= "SELECT DISTINCT $index[$key] FROM $tablename_matTransf m join $tablename_transf t on m.Transf=t.ID";
		$filtro=" WHERE t.Concluido=\"1\"";
		$order=" ORDER BY $index[$key]";

		foreach($IdField as $key2 => $value2)
			if($value2!='')
					$filtro .= " AND $index[$key2]=\"$value2\"";

		$sql .=$filtro;
		$sql .=$order;

			$result=connection($sql);
			$camp=str_replace("`", "", $index);
			if ($result->fetchArray())
				{
				if ($result->fetchArray())
					$packet["Opcoes"][$key]['Todos']='';
				$result->reset();
				while($row=$result->fetchArray())
					{
					$data=htmlspecialchars($row[$camp[$key]]);
					if($data!='')
						if($camp[$key]=='Data_guia'||$camp[$key]=='Data_BI'||$camp[$key]=='Data_transf')
							$packet["Opcoes"][$key][implode("/",array_reverse(explode("-",$data)))]=$data;
						else
							$packet["Opcoes"][$key][$data]=$data;
					else
						$packet["Opcoes"][$key]["-----------"]="NULL";
					}
				}
		}
		echo json_encode($packet);
		$result->finalize();
	}
catch(Exception $e){
	echo $e->getMessage(), "\n";
}
?>
