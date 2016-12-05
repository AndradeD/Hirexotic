<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';

	$sql="SELECT id, nome from $tablename_modelo;";

	try{
		$result=connect($sql);
		if(pg_num_rows($result) == -1)
      $packet=array('sucesso'=>false,'mensagem'=>'nenhum tipo cadastrado');
		else
		{
			while($row=pg_fetch_object($result))
			{
				$data=htmlspecialchars($row->nome);
				$packet["dado"][]= array("opcao" =>$data ,"valor"=>$row->id);
      }
		}
		echo json_encode($packet);
	}
	catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
?>
