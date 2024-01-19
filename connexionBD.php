<?php
define('SERVER', 'servinfo-maria');
define('USER', 'nboissay');
define('PASSWD', 'nboissay');
define('BASE', 'DBnboissay');

function connect_bd(){
	$dsn="mysql:dbname=".BASE.";host=".SERVER;
		try{
		$pdo=new PDO($dsn,USER,PASSWD);
		}
		catch(PDOException $e){
		printf("Échec de la connexion : %s\n", $e->getMessage());
		exit();
		}
	return $pdo;
}
?>