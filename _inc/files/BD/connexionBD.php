<?php

namespace files\BD;

define('SERVER', 'localhost');
define('USER', 'nathan');
define('PASSWD', 'nathan');
define('BASE', 'phpQuiz');

use \PDO;
use \PDOException;

function connect_bd(){
	$dsn="mysql:dbname=".BASE.";host=".SERVER;
		try{
			$pdo = new PDO($dsn, USER, PASSWD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
		printf("Échec de la connexion : %s\n", $e->getMessage());
		exit();
		}
	return $pdo;
}
?>