<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

$tipo=$_POST["Material"];
if(isset($_POST["Modelo"]))
	$modelo=$_POST["Modelo"];
if(isset($_POST["Projeto"]))
	$projeto=$_POST["Projeto"];

//Query base com os filtros selecionados
$sqlbase="SELECT count(*) as Quantidade FROM $tablename WHERE Tipo=\"$tipo\"";
if(isset($_POST['Modelo'])&&$_POST['Modelo']!='')
	$sqlbase .=" AND `Marca/Modelo`=\"$modelo\"";
if(isset($_POST['Projeto'])&&$_POST['Projeto']!='')
	$sqlbase .=" AND Projeto=\"$projeto\"";

//Reservado
try{
	$filtro=" AND Projeto IS NOT NULL";
	$sql= $sqlbase . $filtro;
	$result=connection($sql);
	$reservado=$result->fetchArray()["Quantidade"];

//Utilizado
	$filtro=" AND `Local Almox`=\"XXXXXXX\"";//Trocar para valor adequado('' ou outro)
	$sql= $sqlbase . $filtro;
	$result=connection($sql);
	$utilizado=$result->fetchArray()["Quantidade"];

//Disponivel
	$filtro=" AND Projeto IS NULL AND `Local Almox`<>\"XXXXXXX\"";
	$sql= $sqlbase . $filtro;
	$result=connection($sql);
	$disponivel=$result->fetchArray()["Quantidade"];
	
//Locais
	$sqlbase="SELECT DISTINCT `Local Almox` FROM $tablename WHERE Tipo=\"$tipo\"";
	if(isset($_POST['Modelo'])&&$_POST['Modelo']!='')
		$sqlbase .=" AND `Marca/Modelo`=\"$modelo\"";
	if(isset($_POST['Projeto'])&&$_POST['Projeto']!='')
		$sqlbase .=" AND Projeto=\"$projeto\"";
	$filtro=" AND Projeto IS NULL AND `Local Almox` IS NOT NULL";
	$sql= $sqlbase . $filtro;

	$result=connection($sql);
	$packet[]=array("opcao"=>'Disponivel',"valor"=>$disponivel); #packet{dado[0:{opcao:, value:}]}
	$packet[]=array("opcao"=>'Utilizado',"valor"=>$utilizado);
	$packet[]=array("opcao"=>'Reservado',"valor"=>$reservado);

	if ($result->fetchArray()){
		$result->reset();
  		while($row = $result->fetchArray())
			$packet[]=array("opcao"=>'Local',"valor"=>$row["Local Almox"].'   ');
	}
	else
		$packet[]=array("opcao"=>'Local',"valor"=>"Nenhum objeto desse tipo guardado");

	echo json_encode($packet);
	$result->finalize();
	}
catch(Exception $e)
    {
        echo $e->getMessage(), "\n";
    }
?>
