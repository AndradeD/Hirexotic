<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

$ID=$_POST['ID'];

$sql="SELECT * FROM $tablename_transf WHERE ID=\"$ID\" and Concluido=0";

try{
  $result=connection($sql);
  while($row=$result->fetchArray())
    $packet["Transf"]=array('Destino'=>htmlspecialchars($row['Destino']),
                              'Solicitante'=>htmlspecialchars($row['Solicitante']),
                              'BI'=>htmlspecialchars($row['BI']),
                              'Data_BI'=>htmlspecialchars($row['Data_BI']===NULL?"":date('d/m/Y',strtotime($row['Data_BI']))),
                              'Externo'=>htmlspecialchars($row['Externo']),
                              'Guia'=>htmlspecialchars($row['Guia_transf']),
                              'Data_guia'=>htmlspecialchars($row['Data_guia']===NULL?"":date('d/m/Y', strtotime($row['Data_guia']))),
                              );
  $result->finalize();
  
  $sql="SELECT `Tipo`, `Marca/Modelo`, `S/N`, ID FROM $tablename_matTransf WHERE Transf=\"$ID\"";
  $result=connection($sql);
  while($row=$result->fetchArray())
    $packet["Material"][]=array('Tipo'=>htmlspecialchars($row["Tipo"]),
                                'Marca'=>htmlspecialchars($row["Marca/Modelo"]),
                                'SN'=>htmlspecialchars($row["S/N"]),
                                'ID'=>htmlspecialchars($row["ID"]),
                                );

  echo json_encode($packet);
  $result->finalize();

}
catch(Exception $e){
          echo $e->getMessage(), "\n";
      }
?>
