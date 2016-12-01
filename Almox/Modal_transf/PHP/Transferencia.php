<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/Command_aut.php';

$sucesso=false;
$mensagem="Erro ao adicionar os materiais";

//recupera destino válido. Se for uma nova transferência, cria ela antes.
if($_POST['transferencia']=='')
{
	if((!isset($_POST['Destino']) || $_POST['Destino']==''))
	{
		$sucesso=false;
		$mensagem='Campos obrigatórios em branco';
		$packet=array('sucesso'=>$sucesso,'mensagem'=>$mensagem);
		echo json_encode($packet);
		die();
	}

	$varsql=array();
	$valsql=array();
	foreach ($_POST as $key => $value)
	//Somente dados da transferência
		if($value!="" && $key!='itens')
		{
			array_push($varsql,'"'.$key.'"');
			if($key=='Data_guia'||$key=='Data_BI')
			//Data no formato do SQLite3
				array_push($valsql,'"'.implode("-",array_reverse(explode("/",$value))).'"');
			else
				array_push($valsql,'"'.$value.'"');
		}
//$varsql contem nome dos campos no banco de dado no formato (`Campo1`,`Campo2`,...)
	$varsql=implode(',',$varsql);
//$valsql contem valor a ser inserido no banco de dados no formato ('Valor1','Valor2',...)
	$valsql=implode(',',$valsql);

	$sql="INSERT INTO $tablename_transf ($varsql) VALUES ($valsql)";
	try{
		$result=connection($sql);
		if($result->changes()==1)
			$transferencia=$result->lastInsertRowID();//Recupera id inserido
		}
	catch(Exception $e){
       	echo $e->getMessage(), "\n";
   		}
}
else
	$transferencia= $_POST['transferencia'];

$item= $_POST['itens'];
foreach ($item as $key => $value)
	$item[$key]=$value;

//$item contem chave primária dos itens(na tabela Almox) no formato (PK1,PK2,PK3,...)
$item=implode(',',$item);

$sql ="INSERT into $tablename_matTransf (Tipo,`Marca/Modelo`,`S/N`,Danfe,`Local Almox`,`Nota de Empenho`,TREM,Projeto,Identificador,Transf)
			select Tipo,`Marca/Modelo`,`S/N`,Danfe,`Local Almox`,`Nota de Empenho`,TREM,Projeto,Identificador, f.ID
			from $tablename a join $tablename_transf f
			where a.id in ( $item ) and f.id= $transferencia";

try{
	$result=connection($sql);
	if($result->changes()>0)
		{
		$sql="DELETE FROM $tablename WHERE id IN (" .$item.")";
		$result=connection($sql);
		$sucesso=true;
		$mensagem= $result->changes() .' Material(is) adicionado(s) a transferencia ' .$transferencia;
		$result->close();
		}
}
catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}

$packet=array('sucesso'=>$sucesso,'mensagem'=>$mensagem);
echo json_encode($packet);
?>
