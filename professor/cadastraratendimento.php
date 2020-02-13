<?php 
	include("../../newconexao.php");
	$primeiroAtendimento = array();
	$maxAlunos = array();
	$maxAtendimentos = array();
	$matricula = $_POST['matricula'];
	
	
	for($i=0;$i<3;$i++)
	{
		$blah = "primeiroAtendimento$i";
		$primeiroAtendimento[$i] = $_POST[$blah];
	}
	
	for($i=0;$i<3;$i++)
	{
		$blah = "qtdAtendimento$i";
		$maxAtendimentos[$i] = $_POST[$blah];
	}
	
	for($i=0;$i<3;$i++)
	{
		$blah = "qtdAlunos$i";
		$maxAlunos[$i] = $_POST[$blah];
	}
	
	$value = $primeiroAtendimento[0];
	$value2 = $maxAtendimentos[0];
	$value3 = $maxAlunos[0];
	$sqlUpdate = "UPDATE `horariosplantao` SET `atendimento1`=$value,`alunos1`=$value3,`assistidos1`=$value2";
	if(isset($primeiroAtendimento[1]))
	{
		$value = $primeiroAtendimento[1];
		$value2 = $maxAtendimentos[1];
		$value3 = $maxAlunos[1];
		$sqlUpdate = $sqlUpdate . ", `atendimento2`=$value,`alunos2`=$value3,`assistidos2`=$value2";
	}
	if(isset($primeiroAtendimento[2]))
	{
		$value = $primeiroAtendimento[2];
		$value2 = $maxAtendimentos[2];
		$value3 = $maxAlunos[2];
		$sqlUpdate = $sqlUpdate . ", `atendimento3`=$value,`alunos3`=$value3,`assistidos3`=$value2";
	}
	$sqlUpdate = $sqlUpdate." WHERE `matricula` = $matricula";
	echo "<br><br>sqlUpdate = $sqlUpdate<br>";
	
	$queryUpdate = $conexao->query($sqlUpdate);
	if ($queryUpdate == false)
	{
		echo "Deu pau da uma olhada<br>";
		return 0;
	}
	else
	{
		echo "<form id=\"id_Form\" action=\"mainProfessor.php\" method=\"POST\">";
			echo "<input type=\"text\" name=\"mode\" value=\"calendario\">";
			echo "<input type=\"text\" name=\"matricula\" value=\"$matricula\">";
			echo "<input type=\"hidden\" name=\"alert\" value=\"Plantão cadastrado com sucesso\">";
			
			
		echo "</form>";
		echo "<script>";
			echo "document.getElementById('id_Form').submit();";
		echo "</script>";
	}
	
?>