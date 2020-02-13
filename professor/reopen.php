<?php
	include ("../utils/newconexao.php");
	$matricula = $_POST['matricula'];
	$index = $_POST['reopen'];
	
	$sqlHoras = "SELECT * FROM `atividades` WHERE `index` = $index";
	$queryHoras = $conexao->query($sqlHoras);
	$resultHoras = $queryHoras->fetchAll(PDO::FETCH_ASSOC);
	$horasSub = $resultHoras[0]['horas'];
	$matriculaAluno = $resultHoras[0]['matricula'];
	
	$sqlAluno = "SELECT * FROM `alunos` WHERE `matricula` = $matriculaAluno";
	$queryAluno = $conexao->query($sqlAluno);
	$resultAluno = $queryAluno->fetchAll(PDO::FETCH_ASSOC);
	$horas = $resultAluno[0]['horas'];
	
	$newHoras = $horas - $horasSub;
	if ($newHoras <0)
		$newHoras = 0;
	
	$sqlAcc = "UPDATE `alunos` SET `horas`=$newHoras WHERE `matricula` = $matriculaAluno";
	$queryAcc = $conexao->query($sqlAcc);
	
	$mode = "listapendencias";
	if (!empty($_POST['source']))
	{
		$mode = "veratividades".$matriculaAluno;
	}
	
	$sqlReopen = "UPDATE `atividades` SET `pendente`=1 WHERE `index` = $index";
	$queryReopen = $conexao->query($sqlReopen);
	echo "
		<form id=\"id_auto\" method=\"post\" action=\"mainProfessor.php\">
			<input type=\"hidden\" name=\"mode\" value=\"$mode\">
			<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
			<input type=\"submit\" value=\"Voltar\" class=\"btn btn-primary\">
		</form>
	";
	if ($queryReopen != false)
	{
		echo "<script> document.getElementById('id_auto').submit(); </script>";
	}
	else
	{
		echo "<h3 class=\"text-center\"> Não foi possivel reabrir a atividade, contate a informatica</h3>";
	}
	
	
	
?>