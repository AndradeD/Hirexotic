<?php
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/Command_aut.php';

$sucesso=true;
//Array com os valores postados
$par=array("Tipo"=>$_POST["Tipo"], "Marca"=>$_POST["Marca"], "Serie"=>$_POST["Serie"] ,
		"NF"=>$_POST["NF"],	"Local"=>$_POST["Local"], "Empenho"=>$_POST["Empenho"], "Trem"=> $_POST["Trem"],
		"Projeto"=>$_POST["Projeto"], "Identificador"=>$_POST["Identificador"], "ID"=>$_POST["ID"]);

$sql= "UPDATE $tablename SET Tipo=\"$par[Tipo]\", `Marca/Modelo`=\"$par[Marca]\", `S/N`=\"$par[Serie]\", Danfe=\"$par[NF]\",
		`Local Almox`=\"$par[Local]\", `Nota de Empenho`=\"$par[Empenho]\", TREM=\"$par[Trem]\",
				Projeto=\"$par[Projeto]\", Identificador=\"$par[Identificador]\" WHERE ID=\"$par[ID]\"";

try{
	$result=connection($sql);
	if($result->changes()==1)
		$packet["dado"][]= array("opcao" =>array('tipo'=>htmlspecialchars($par["Tipo"]),
													 'modelo'=>htmlspecialchars($par["Marca"]),
													 'sn'=>htmlspecialchars($par["Serie"])),
														"Id"=>$par["ID"]); #packet{dado[0:{opcao:, value:},1:{opcao:,value:}...]}
	else
		$sucesso=false;

	$packet['sucesso']=$sucesso;
	echo json_encode($packet);
	}
catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
?>
