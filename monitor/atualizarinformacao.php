<?php

	include ('../../newconexao.php');
	
	$matricula = $_POST['matricula'];
	
	if ($_POST['editAssistido'])
	{
		$cpf = $_POST['cpf'];
		
		$nome = $_POST['nome'];
		$tela = $_POST['tela'];
		$telb = $_POST['telb'];
		$cel = $_POST['cel'];
		$bairro = $_POST['bairro'];
		$email = $_POST['email'];
		
		$sqlUpdate = "UPDATE `assistidos` SET ";
		if (!empty($nome))
		{
			$sqlUpdate = $sqlUpdate."`nome`=\"$nome\"";
			$virgula = true;
		}
		if (!empty($tela))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`tel1`=\"$tela\"";
			$virgula = true;
		}if (!empty($telb))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`tel2`=\"$telb\"";
		}if (!empty($cel))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`cel`=\"$cel\"";
		}if (!empty($bairro))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`bairro`=\"$bairro\"";
		}if (!empty($email))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`email`=\"$email\"";
		}
		
		$sqlUpdate = $sqlUpdate." WHERE `cpf` = \"$cpf\"";
	}
	else if ($_POST['editCaso'])
	{
		echo "editInformacao<br>";
		//print_r($_POST);
		
		$endereco = $_POST['endereco'];
		$cep = $_POST['cep'];
		$renda = $_POST['renda'];
		$moradia = $_POST['moradia'];
		$ocupacao = $_POST['ocupacao'];
		$estadocivil = $_POST['estadocivil'];
		$beneficiado = $_POST['beneficiado'];
		$parentesco = $_POST['parentesco'];
		$descricao = $_POST['descricao'];
		$index = $_POST['index'];
		
		$sqlUpdate = "UPDATE `atendimentos` SET ";
		if (!empty($endereco))
		{
			$sqlUpdate = $sqlUpdate."`endereco`=\"$endereco\"";
			$virgula = true;
		}
		if (!empty($cep))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`cep`=\"$cep\"";
			$virgula = true;
		}if (!empty($renda))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`renda`=\"$renda\"";
		}if (!empty($moradia))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`moradia`=\"$moradia\"";
		}if (!empty($ocupacao))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`ocupacao`=\"$ocupacao\"";
		}if (!empty($estadocivil))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`estadocivil`=\"$estadocivil\"";
		}if (!empty($beneficiado))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`beneficiado`=\"$beneficiado\"";
		}if (!empty($parentesco))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`parentesco`=\"$parentesco\"";
		}if (!empty($descricao))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`descricao`=\"$descricao\"";
		}
		
		$sqlUpdate = $sqlUpdate." WHERE `index` = $index";
	}
	else
	{
		$reu = $_POST['editReu'];
		$autor = $_POST['editAutor'];
		$processo = $_POST['editProcesso'];
		$local = $_POST['editLocal'];
		$acao = $_POST['editAcao'];
		$index = $_POST['index'];
		
		echo "reu = $reu<br>";
		echo "autor = $autor<br>";
		echo "processo = $processo<br>";
		echo "local = $local<br>";
		echo "acao = $acao<br>";
		echo "index = $index<br>";
		$virgula = false;
		
		$sqlUpdate = "UPDATE `atendimentos` SET ";
		if (!empty($reu))
		{
			$sqlUpdate = $sqlUpdate."`reu`=\"$reu\"";
			$virgula = true;
		}
		if (!empty($autor))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`autor`=\"$autor\"";
			$virgula = true;
		}if (!empty($processo))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`processo`=\"$processo\"";
		}if (!empty($local))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`local`=\"$local\"";
		}if (!empty($acao))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`acao`=\"$acao\"";
		}
		
		$sqlUpdate = $sqlUpdate." WHERE `index` = $index";
	}
	echo "sqlUpdate = $sqlUpdate<br>";
	$queryUpdate = $conexao->query($sqlUpdate);
	if ($queryUpdate != false)
	{
		echo "
				<form id=\"id_form\" action=\"mainMonitor.php\" method=\"post\">";
		if ($_POST['editAssistido'])
		{
			echo "
				<input type=\"hidden\" name=\"mode\" value=\"consultaassistido\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
				<input type=\"hidden\" value=\"$cpf\" name=\"cpf\">
				";

		}
		else
		{
			echo "
				<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
				<input type=\"hidden\" value=\"$index\" name=\"idCaso\">
				";
		}
		echo "
				</form>
				<script>
					document.getElementById('id_form').submit();
				</script>
		";
	}
	else
	{
		echo "<h1>Não consegui atualizar os dados, volte e tente novamente.<br>Evite o uso de aspas e caracteres especiais</h1>";
		echo "<a href=\"javascript:history.go(-1)\">Voltar</a>";
	}

?>