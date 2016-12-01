<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/Command_aut.php';

$sucesso=false;
$mensagem='Erro ao remover o material da transferencia';

$ID=$_POST['Id_Mat'];

$sql="INSERT INTO $tablename (Tipo,`Marca/Modelo`,`S/N`,Danfe,`Local Almox`,`Nota de Empenho`,TREM,Projeto,Identificador)
			SELECT Tipo,`Marca/Modelo`,`S/N`,Danfe,`Local Almox`,`Nota de Empenho`,TREM,Projeto,Identificador
      		FROM $tablename_matTransf t WHERE t.ID=\"$ID\"";

try{
	$result=connection($sql);
	if($result->changes()==1)
		{
	  	$sql="DELETE FROM $tablename_matTransf WHERE ID=\"$ID\"";
	  	$result=connection($sql);
  		$sucesso=true;
  		$mensagem='Material removido da transferencia';
		}
	$packet=array('sucesso'=>$sucesso,'mensagem'=>$mensagem);
	echo json_encode($packet);
}

catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}

?>
