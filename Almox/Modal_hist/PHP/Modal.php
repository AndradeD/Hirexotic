<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

$Transf=$_POST['Transf'];

//Dados da transferência
$sql="SELECT Destino AS Destino_mod,
             Solicitante AS Solicitante_mod,
             strftime(\"%d/%m/%Y\",Data_transf) AS  Transf_mod,
             Guia_transf ||\" de \" || strftime(\"%d/%m/%Y\",Data_guia) AS Guia_mod,
             BI || \" de \" || strftime(\"%d/%m/%Y\",Data_BI) AS BI_mod
      FROM $tablename_transf
      WHERE ID=$Transf
            AND Concluido=\"1\"";

try{
      $result=connection($sql);
      while($row=$result->fetchArray())
            foreach($row as $key => $value)
                  $packet['Transferencia'][$key]=htmlspecialchars($value);

      $result->finalize();
      //Dados do material
      $sql= "SELECT Tipo, `Marca/Modelo`, `S/N`, Danfe, `Nota de Empenho`, `TREM`, Identificador
             FROM $tablename_matTransf m JOIN $tablename_transf t ON m.Transf=t.ID
             WHERE t.Concluido=\"1\" and t.ID=\"$Transf\"";

      $result=connection($sql);
      for($i=0;$row=$result->fetchArray(SQLITE3_ASSOC);$i++)
        foreach($row as $key => $value)
            $packet['Materiais'][$i][$key]=htmlspecialchars($value);

      echo json_encode($packet);
      $result->finalize();
}
catch(Exception $e){
            echo $e->getMessage(), "\n";
      }
?>
