<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/db.php';
	function connection($sql)
	{
	//Executa uma query pré preparada (variável $sql) e retorna a resposta (variável $result)
	//Parametros do Banco de dados estão em outro arquivo

	$conn=new SQLite3($GLOBALS["dbname"]);
	if (!$conn)
		throw new Exception("Erro ao abrir o banco de dados: " . $conn->connect_error);

//Limpa a query de caracteres de escape e de outros que possam causar mau funcionamento da query
	$sql=$conn->escapeString($sql);

//Previne seleção usando =null ou insert/update de valores =""(troca por =NULL)
   $sql=str_replace('""','NULL',$sql);
   $sql=str_replace('"NULL"','NULL',$sql);

   $partSql=explode(" WHERE ", $sql);
   if(sizeof($partSql)>1)
   	foreach($partSql as $key => $value)
   		if($key > 0 )
   			{
	   		$partSql[$key] = str_replace("=NULL"," is NULL", $partSql[$key]);
   			$partSql[$key] = str_replace("!=NULL"," is not NULL", $partSql[$key]);
			}
   $sql=implode(" WHERE ", $partSql);

//Executa a query
	$result = $conn->query($sql);

	if($result==false)
		throw new Exception("Erro na query: " . $sql);

	if($conn->changes()==0)//Operação de insert, delete e update
		return $result;    //Retorna conexão
	else 					//Operação de select
		return $conn;		//Retorna objeto resultado
	}
?>