<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';
	$id = $_POST["id"];

	$sql="SELECT a.id, ano_fabricacao as fabricacao, cor, combustivel, preco_minimo as pminimo, fornecedor_cnpj as cnpj, nome as modelo, marca,numero_passageiros as npassageiros, velocidade, cilindrada, numero_portas as nportas
	 FROM $tablename_automovel a INNER JOIN $tablename_modelo m on m.id=a.modelo_id WHERE a.disponivel=TRUE AND a.id=$id";

	try{
		$result=connect($sql);
		if(pg_num_rows($result) == -1)
      $packet=array('sucesso'=>false,'mensagem'=>'Erro no banco de dados');
		else
		{
			$row=pg_fetch_array($result, 0, PGSQL_ASSOC);
			foreach ($row as $key => $value)
				$value=htmlspecialchars($value);
			$packet = $row;
  	}
		echo json_encode($packet);
	}
	catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
?>
