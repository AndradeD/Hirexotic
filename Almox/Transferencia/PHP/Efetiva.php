<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/Command_aut.php';

$sucesso=false;
$mensagem='Erro ao efetivar a transferencia';

$ID=$_POST['transferencia'];
$sql="SELECT Externo FROM $tablename_transf WHERE ID=\"$ID\"";

$_POST["Data_guia"]=implode("-",array_reverse(explode("/",$_POST["Data_guia"])));
$_POST["Data_BI"]=implode("-",array_reverse(explode("/",$_POST["Data_BI"])));
try{
  $result=connection($sql);

  if($row=$result->fetchArray())
    $ext=$row["Externo"]==1?true:false;

  $result->finalize();
  foreach ($_POST as $key => $value)
  {
    if($value=='' && ($key == 'Solicitante' || ($ext && ($key == Data_guia || $key==Guia_transf))))
      {
      $mensagem='Campos obrigatórios deixados em branco';
      $packet=array('sucesso'=>$sucesso,'mensagem'=>$mensagem);
      echo json_encode($packet);
      die();
      }

    if($value == '')
      $_POST["$key"]="";

  }
  $Destino=$_POST['Destino'];
  $Solicitante=$_POST['Solicitante'];
  $BI=$_POST['BI'];
  $Data_BI=$_POST['Data_BI'];
  $Guia_transf=$_POST['Guia_transf'];
  $Data_guia=$_POST['Data_guia'];

  $sql="UPDATE $tablename_transf SET BI=\"$BI\", Data_BI=\"$Data_BI\", Destino=\"$Destino\",
        Solicitante=\"$Solicitante\", Guia_transf=\"$Guia_transf\", Data_guia=\"$Data_guia\",
        Data_transf=date(\"now\"), Concluido=\"1\"
        WHERE ID=\"$ID\"";

  $result=connection($sql);
  if ($result->changes() == 1)
    {
    $sucesso=true;
     $mensagem='Transferencia efetivada com sucesso';
    }

  $packet=array('sucesso'=>$sucesso,'mensagem'=>$mensagem);
  echo json_encode($packet);
}
catch(Exception $e){
          echo $e->getMessage(), "\n";
      }
?>