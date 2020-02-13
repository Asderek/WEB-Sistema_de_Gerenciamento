<?php

	include("../utils/newconexao.php");
	
	$aluno = $_POST['aluno'];
	$professor = $_POST['matricula'];
	$ano = date('Y');
	$mes = date('n');
	
	$dataFechamento = $ano."/".$mes;
	
	$sqlInsert = "INSERT INTO `fechamento`(`professor`, `aluno`, `dataFechamento`) VALUES (\"$professor\",\"$aluno\",\"$dataFechamento\")";
	$queryInsert = $conexao->query($sqlInsert);
	
	echo "
			<form action=\"mainProfessor.php\" method=\"post\" id=\"id_auto\">
				<input type=\"hidden\" name=\"matricula\" value=\"$professor\">
				<input type=\"hidden\" name=\"mode\" value=\"pauta\">
				<input type=\"submit\" name=\"asd\" value=\"Voltar\">
			</form>
	";
	
	if($queryInsert != false)
	{
		echo "<script> document.getElementById('id_auto').submit();</script>";
	}
	else
	{
		echo "<h2>Não consegui inserir nome no fechamento, contate a secretaria</h2>";
	}

?>