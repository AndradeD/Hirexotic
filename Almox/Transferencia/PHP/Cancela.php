<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/Command_aut.php';

$sucesso=false;
$mensagem='Erro ao realocar materiais';

$ID=$_POST['ID'];

$sql="INSERT into $tablename (Tipo,`Marca/Modelo`,`S/N`,Danfe,`Local Almox`,`Nota de Empenho`,TREM,Projeto,Identificador)
			select Tipo,`Marca/Modelo`,`S/N`,Danfe,`Local Almox`,`Nota de Empenho`,TREM, Projeto, Identificador
      FROM $tablename_matTransf t WHERE t.Transf=$ID";

try{
  $result=connection($sql);
  if($result->changes()>0)
    {
    $sql="DELETE FROM $tablename_matTransf WHERE Transf=\"$ID\"";
    $result=connection($sql);
    if($result->changes()>0)
      {
      $sql="DELETE FROM $tablename_transf WHERE ID=$ID";
      $result=connection($sql);
      if($result->changes()>0)
        {
        $mensagem="Transferencia cancelada com sucesso!";
        $sucesso=true;
        }
      }
    else
      $mensagem="Erro ao deletar os materiais";
    }
    
  $packet=array('sucesso'=>$sucesso,'mensagem'=>$mensagem);
  echo json_encode($packet);
}
catch(Exception $e){
          echo $e->getMessage(), "\n";
      }
?>
