<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

	$sql= "SELECT DISTINCT Projeto FROM $tablename";
	try{
		$result=connection($sql);
		$packet["dado"][]=array("opcao"=>'Sem Projeto',"valor"=>""); #packet{dado[0:{opcao:, value:}]}
		while($row=$result->fetchArray())
		{
			$data=htmlspecialchars($row['Projeto']);
			if($data!='')
				$packet["dado"][]= array("opcao" =>$data ,"valor"=>$data); #packet{dado[0:{opcao:, value:},1:{opcao:,value:}...]}
		}
		echo json_encode($packet);
		$result->finalize();
	}
	catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
?>
