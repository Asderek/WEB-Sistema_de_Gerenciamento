<?php

	include ("../utils/newconexao.php");
	//print_r($_POST);
	$index = $_POST['index'];
	$CPF = $_POST['cpf'];
		
	$sqlAtendimento = "SELECT * FROM `atendimentos` WHERE `index` = $index";
	$queryAtendimento = $conexao->query($sqlAtendimento);
	if ($queryAtendimento != false)
	{
		$resultAtendimento = $queryAtendimento->fetchAll(PDO::FETCH_ASSOC);
		$nome = $resultAtendimento[0]['nome'];
	}
	
	echo "<input type=\"hidden\" name=\"index_atendimento\" value=\"$index\">";
	echo "<table class=\"table table-bordered\">";
	
	echo "<tr>";
		echo "<td align=\"center\">CPF</td>";
		echo "<td align=\"center\"><input type=\"text\" value=\"$CPF\" name=\"cpf\"></td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td align=\"center\">Nome</td>";
		echo "<td align=\"center\"><input type=\"text\" value=\"$nome\" name=\"nome\"></td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td align=\"center\">Local</td>";
		echo "<td align=\"center\"><input type=\"text\" name=\"local\" placeholder=\"Local\"></td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td align=\"center\">Data</td>";
		echo "<td align=\"center\"><input type=\"date\" name=\"data\"></td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td align=\"center\">Hora</td>";
		echo "<td align=\"center\"><input type=\"time\" name=\"hora\" placeholder=\"12\" max=\"24\" min=\"0\"></td>";
	echo "</tr>";
	echo "<tr>";
		echo "<td colspan=\"2\" align=\"center\"><input type=\"submit\" formaction=\"cadastraraudiencia.php\" class=\"btn btn-primary btn-lg btn-block\"></td>";
	echo "</tr>";
	
	echo "</table>";
	
?>