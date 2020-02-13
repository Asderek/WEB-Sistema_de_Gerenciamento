<?php

define('MYSQL_HOST','localhost'); 										//Seu ip, se for o mesmo que vai rodar o site, deixe localhost ou 127.0.0.1
define('MYSQL_USER','npj_adm'); 										//Seu login do mysql
define('MYSQL_PASSWORD','jaicheedahx4ChahGhiog');						//Sua senha do mysql, eu não tenho senha :D é tudo local
define('MYSQL_DB_NAME','db_npj');										//Nome do banco de dados mysql

try
{
	$conexao = new PDO('mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB_NAME,MYSQL_USER,MYSQL_PASSWORD);
}
catch ( PDOException $e )
{
    echo 'Erro ao conectar com o MySQL: ' . $e->getMessage();
}
$conexao -> exec("SET NAMES 'utf8';");

?>
