<?php
	include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connection.php';

	$sql="SELECT a.id, placa,ano_fabricacao as anofab, cor, combustivel, m.nome as modelo, f.nome as nomefornecedor, f.telefone as telfornecedor FROM aluguel a, automovel au, modelo m, fornecedor f WHERE a.homologada is NULL AND a.id_automovel=au.id AND au.modelo_id=m.id AND au.fornecedor_cnpj=f.cnpj;";

	try{
		$result=connect($sql);
		if(pg_num_rows($result) == -1)
      $packet=array('sucesso'=>false,'mensagem'=>'nenhum aluguel para homologar');
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
