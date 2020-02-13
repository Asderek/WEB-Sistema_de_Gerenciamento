<?php

	include("../utils/newconexao.php");
	$horasGlobal = $_POST['horasGlobal'];
	$matricula = $_POST['matricula'];

	print_r($_POST);

	foreach($_POST as $key => $value) 
	{
		if (strstr($key,"checkbox") !== false)
		{
			$index = substr($key,0,strpos($key,"_"));
			echo "index = $index<br>";
			
			$sqlAcc = "UPDATE `atividades` SET `pendente`=0, `horas`=$horasGlobal WHERE `index` = $index";
			echo "sqlAcc = $sqlAcc<br>";
			$queryAcc = $conexao->query($sqlAcc);
			if ($queryAcc == false)
			{
				echo "return Acc<br>";
				return;
			}
			
			$sqlGetAtvMatricula = "SELECT * FROM `atividades` WHERE `index` = $index";
			$queryGetAtvMatricula = $conexao->query($sqlGetAtvMatricula);
			if ($queryGetAtvMatricula == false)
				continue;
			
			$resultGetAtvMatricula = $queryGetAtvMatricula->fetchAll(PDO::FETCH_ASSOC);
			$matriculaAluno = $resultGetAtvMatricula[0]['matricula'];
			
			$sqlInfo = "SELECT * FROM `alunos` WHERE `matricula` = $matriculaAluno";
			$queryInfo = $conexao->query($sqlInfo);
			if ($queryInfo == false)
			{
				echo "return SELECT Acc<br>";
				return;
			}
			else
			{
				echo "query = true<br>";
			}
			$resultInfo = $queryInfo->fetchAll( PDO::FETCH_ASSOC );
			$horas = $resultInfo[0]['horas'];
			
			$newHoras = $horas + $horasGlobal;
			
			$sqlAcc = "UPDATE `alunos` SET `horas`=$newHoras WHERE `matricula` = $matriculaAluno";
			$queryAcc = $conexao->query($sqlAcc);
			if ($queryAcc == false)
			{
				echo "return Acc<br>";
				return;
			}
			
		}
	}
	
	echo "
			<form id=\"myForm\" class=\"form col-md-12 center-block\" action='mainProfessor.php' method=\"post\">
				<input type=\"hidden\" name=\"mode\" value=\"listapendencias\"></input>
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\"></input>
			</form>	
	";
				
	if (true)
	{
		echo "	
			<script type=\"text/javascript\">
				document.getElementById('myForm').submit();
			</script>";
	}

?>