<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/Command_aut.php';

//Transferências não concluidas
$sql='SELECT ID FROM "'.$tablename_transf.'" WHERE Concluido !=1';

try{
	$result=connection($sql);
	$packet["dado"][]= array("opcao" =>'Nova Transferencia',"valor"=>"");
	while($row=$result->fetchArray(SQLITE3_ASSOC))
		{
   		$data='Transferencia '. htmlspecialchars($row["ID"]);
		$packet["dado"][]= array("opcao" =>$data,"valor"=>$row["ID"]); #packet{dado[0:{opcao:, value:},1:{opcao:,value:}...]}
		}
	echo json_encode($packet);
	$result->finalize();
	}
catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}?>
