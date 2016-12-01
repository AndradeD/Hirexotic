<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] .'/Comuns/connectionFunction.php';

if(!isset($_SESSION['user_id']))
	die();
else
	$nome='';
	$id=$_SESSION['user_id'];
	$sql="SELECT Usuario FROM $tablename_user WHERE Userid=\"$id\"";

try{
	$result=connection($sql);
	if($result->changes()> 0)
		$nome=$result->fetchArray()['Usuario'];
	$data=array("nome"=>$nome);
	echo json_encode($data);
}

catch(Exception $e){
        	echo $e->getMessage(), "\n";
    	}
?>
