<?php
$ip = "localhost"; //Seu ip, se for o mesmo que vai rodar o site, deixe localhost ou 127.0.0.1
$login = "npj_adm"; //Seu login do mysql
$senha = "jaicheedahx4ChahGhiog"; //Sua senha do mysql, eu não tenho senha :D é tudo local
$db = "db_npj"; //Nome do banco de dados mysql

$conexao =  mysqlI_connect($ip, $login, $senha, $db); // ip, login e senha

mysqli_close($conexao);

?>