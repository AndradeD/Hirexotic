<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

$sql="SELECT Transf, Destino, count(*) as nrMat FROM $tablename_transf t join $tablename_matTransf m on t.ID=m.Transf WHERE t.Concluido=0 group by transf";
try{
	$result=connection($sql);
  	while($row=$result->fetchArray())
  		{
    	$packet["dado"][]=array('nr'=>htmlspecialchars($row['Transf']),
                            	'destino'=>htmlspecialchars($row['Destino']),
                            	'nrMat'=>htmlspecialchars($row['nrMat']),
                          		);
  		}
	echo json_encode($packet);
	$result->finalize();
}
catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
?>
