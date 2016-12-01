<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/Command_aut.php';

foreach ($_POST as $key => $value)
{
  if ($key=='Data_BI' || $key=='Data_guia')
    $_POST[$key]=implode("-",array_reverse(explode("/",$value)));

  if($value=='')
    $_POST["$key"]="";
 // elseif(!($key == 'Data_BI' || $key == 'Data_guia'))
 // $_POST["$key"]="$value";

}

$ID=$_POST['transferencia'];
$Destino=$_POST['Destino'];
$Solicitante=$_POST['Solicitante'];
$BI=$_POST['BI'];
$Data_BI=$_POST['Data_BI'];
$Guia_transf=$_POST['Guia_transf'];
$Data_guia=$_POST['Data_guia'];

$sql="UPDATE $tablename_transf SET BI=\"$BI\", Data_BI=\"$Data_BI\", Destino=\"$Destino\",
      Solicitante=\"$Solicitante\", Guia_transf=\"$Guia_transf\", Data_guia=\"$Data_guia\"
      WHERE ID=\"$ID\"";
try{
  $result=connection($sql);
  if($result->changes()!=0)
    $packet=array('sucesso'=>true,'mensagem'=>'Dados da transferencia atualizados');
  else
    $packet=array('sucesso'=>false,'mensagem'=>'Erro ao atualizar os dados da transferencia');

  echo json_encode($packet);
  $result->close();
}
catch(Exception $e){
          echo $e->getMessage(), "\n";
      }
?>
