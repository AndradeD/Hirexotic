<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';

	$sql="SELECT a.id, placa, ano_fabricacao as fabricacao, cor, combustivel, preco_minimo as pminimo, fornecedor_cnpj as cnpj, urlimagem, nome as modelo, marca, ano, numero_passageiros as npassageiros, velocidade, cilindrada, numero_portas as nportas
	 FROM $tablename_automovel a INNER JOIN $tablename_modelo m on m.id=a.modelo_id WHERE a.disponivel=TRUE;";

	try{
		$result=connect($sql);
		if(pg_num_rows($result) == -1)
      $packet=array('sucesso'=>false,'mensagem'=>'nenhum tipo cadastrado');
		else
		{
			while($row=pg_fetch_assoc($result))
			{
				foreach ($row as $key => $value)
					$value=htmlspecialchars($value);
				$packet["dado"][]= $row;
      }
		}
		echo json_encode($packet);
	}
	catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
?>
