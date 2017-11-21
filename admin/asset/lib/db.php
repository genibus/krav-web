<?php
$dsn = "mysql:host=localhost;dbname=portfolio";
$user = 'root';
$password = '';

try
{
	$db = new PDO($dsn, $user, $password, 
		array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
			)
		);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}
catch(PDOException $e)
{
	echo '<p> Connexion à la base de donnée impossible' . $e->getMessage() . '</p>';
	exit;
}
$msg = '';