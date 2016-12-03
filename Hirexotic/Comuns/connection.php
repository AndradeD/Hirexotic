<?php
  include $_SERVER["DOCUMENT_ROOT"].'/Comuns/db.php';
  function connect($sql)
  {
  //Executa uma query pré preparada (variável $sql) e retorna a resposta (variável $result)
  //Parametros do Banco de dados estão em outro arquivo

  $conn=pg_connect($GLOBALS['connection_string']);
  if (!$conn)
    throw new Exception("Erro ao abrir o banco de dados");

  //Limpa a query de caracteres de escape e de outros que possam causar mau funcionamento da query
  //$sql=pg_escape_string($sql); Who cares?

  //Executa a query
  $result = pg_query($conn, $sql);

  if($result==false)
    throw new Exception("Erro na query: " . $sql);

  return $result;		//Retorna objeto resultado
  }
?>
