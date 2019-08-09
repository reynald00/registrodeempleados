<?php



try{
	$pdo= new PDO($servidor,$usuario,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
	
}catch(PDOException $e){
	echo "ERROR EN LA CONEXIÓN".$e->getMessage();
}

?> 
