<?php

$servidor="mysql:dbname=your-namedb;host=your-host";
$usuario="your-usuario";
$password="your-password";


try{
	$pdo= new PDO($servidor,$usuario,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
	echo "EXITOSA CONEXIÓN";
}catch(PDOException $e){
	echo "ERROR EN LA CONEXIÓN".$e->getMessage();
}

?>