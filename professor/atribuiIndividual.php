<?php

	
	include ("../utils/newconexao.php");
	print_r($_POST);
	$matricula = $_POST['matricula'];
	echo "<br>";
	foreach($_POST as $key=>$value)
	{
	  if (strstr($key,"checkbox") !== false)
	  {
		  $index = substr($key,0,strpos($key,"_"));
		  echo "index = $index -> ";
		  
		  $postName = $index."_horas";
		  $horaAtv = $_POST["$postName"];
		  echo "horaAtv = $horaAtv<br>";
		  
		  $sqlMatriculaAluno = "SELECT * FROM `atividades` WHERE `index` = $index";
		  $queryMatriculaAluno = $conexao->query($sqlMatriculaAluno);
		  $resultMatriculaAluno = $queryMatriculaAluno->fetchAll(PDO::FETCH_ASSOC);
		  $matriculaAluno = $resultMatriculaAluno[0]['matricula'];
		  
		  $sqlAcc = "UPDATE `atividades` SET `pendente`=0, `horas`=$horaAtv, `comentario` = \"\" WHERE `index` = $index";
			echo "sqlAcc = $sqlAcc<br>";
			$queryAcc = $conexao->query($sqlAcc);
			if ($queryAcc == false)
			{
				echo "return Acc<br>";
				return;
			}
			echo "Accept -> index = $index<br>";
			
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
			
			echo "horas = $horas<br>horasPOST = $horaAtv<br>";
			
			$newHoras = $horas + $horaAtv;
			
			$sqlAcc = "UPDATE `alunos` SET `horas`=$newHoras WHERE `matricula` = $matriculaAluno";
			$queryAcc = $conexao->query($sqlAcc);
			if ($queryAcc == false)
			{
				echo "return Acc<br>";
				return;
			}
			echo "Accept -> index = $index<br>";
			
	  }
	}
	
	$mode = "listapendencias";
	echo "
		<form id=\"id_auto\" method=\"post\" action=\"mainProfessor.php\">
			<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
			<input type=\"hidden\" name=\"mode\" value=\"$mode\">
			<input type=\"submit\" value=\"Voltar\" class=\"btn btn-primary\">
		</form>
	";

		echo "<script> document.getElementById('id_auto').submit(); </script>";
	
	

?>