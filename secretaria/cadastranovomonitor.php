<?php

	include("../utils/newconexao.php");
	print_r($_POST);
	$newProfessor = $_POST['newProfessor'];
	$newMonitor = $_POST['newMonitor'];
	$newAdmissao = $_POST['newAdmissao'];
	$newArea = $_POST['newArea'];
	$newTel = $_POST['newTel'];
	$newCel = $_POST['newCel'];
	$newEmail = $_POST['newEmail'];
	$newPercent = $_POST['newPercent'];
	$newCI = $_POST['newCI'];
	$newTipo = $_POST['newTipo'];
	$newMatricula = $_POST['newMatricula'];
	
	$sqlUpdate = "INSERT INTO `historicoMonitores`(`nomeProfessor`, `nomeMonitor`,`matricula`, `admissao`, `area`, `tel`, `cel`, `email`, `percentual`, `CI_substituicao`, `tipo`) VALUES 
	(\"$newProfessor\",\"$newMonitor\",\"$newMatricula\",\"$newAdmissao\",\"$newArea\",\"$newTel\",\"$newCel\",\"$newEmail\",\"$newPercent\",\"$newCI\",\"$newTipo\")";
	$queryUpdate = $conexao->query($sqlUpdate);
	
	echo "<br>sqlUpdate = $sqlUpdate<br>";
	echo "<form action=\"mainSecretaria.php\" method=\"post\" id=\"id_auto\">
		<input type=\"hidden\" value=\"monitores\" name=\"mode\">
		<input type=\"submit\" value=\"IR\">
		</form>";
	
	if($queryUpdate != false)
	{
		echo "<script> document.getElementById('id_auto').submit(); </script>";
	}
	

?>