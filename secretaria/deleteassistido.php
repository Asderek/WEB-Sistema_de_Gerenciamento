<?php

	include('../utils/newconexao.php');
	$cpf = $_POST['cpfassistido'];
	
	$sqlDeleteAtendimentos = "DELETE FROM `atendimentos` WHERE `cpf` = \"$cpf\"";
	$sqlDeleteAssistidos = "DELETE FROM `assistidos` WHERE `cpf` = \"$cpf\"";
	echo "sqlDeleteAssistidos = $sqlDeleteAssistidos<br>";
	echo "sqlDeleteAtendimentos = $sqlDeleteAtendimentos<br>";
	
	$queryDeleteAtendimentos = $conexao->query($sqlDeleteAtendimentos);
	if ($queryDeleteAtendimentos != false)
	{
		$queryDeleteAssistidos = $conexao->query($sqlDeleteAssistidos);
		if ($queryDeleteAssistidos != false)
		{
			echo "<form action=\"mainSecretaria.php\" id=\"id_auto\"></form>";
			echo "<script>document.getElementById('id_auto').submit();</script>";
		}
		else
		{
			echo "Erro ao deletar assistido<br>";
		}
	}
	else
	{
		echo "Erro ao deletar atendimentos<br>";
	}
	
?>
<a href="mainSecretaria.php">Voltar</a>