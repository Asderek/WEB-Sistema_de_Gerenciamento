<?php

	include ('../../newconexao.php');
	$matricula = $_POST['matricula'];
	
	if ($_POST['editAssistido'])
	{
		$cpf = $_POST['cpf'];
		
		$rg = $_POST['rg'];
		$nome = $_POST['nome'];
		$dob = $_POST['dob'];
		$tela = $_POST['tela'];
		$telb = $_POST['telb'];
		$cel = $_POST['cel'];
		$email = $_POST['email'];
		$endereco = $_POST['endereco'];
		$bairro = $_POST['bairro'];
		$cep = $_POST['cep'];
		$comunidade = $_POST['comunidade'];
		
		$sqlUpdate = "UPDATE `assistidos` SET ";
		if (!empty($nome))
		{
			$sqlUpdate = $sqlUpdate."`nome`=\"$nome\"";
			$virgula = true;
			
			$sqlUpdateAtendimentos = "UPDATE `atendimentos` SET `nome` = \"$nome\" WHERE `cpf` = \"$cpf\"";
			$queryUpdateAtendimentos = $conexao->query($sqlUpdateAtendimentos);
		}
		if (!empty($rg))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`rg`=\"$rg\"";
			$virgula = true;
		}
		if (!empty($dob))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`dob`=\"$dob\"";
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
		}if (!empty($endereco))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`endereco`=\"$endereco\"";
		}if (!empty($cep))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`CEP`=\"$cep\"";
		}if (!empty($comunidade))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`comunidade`=\"$comunidade\"";
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
		$cpf = $_POST['cpf'];
		
		
		$sqlUpdate = "UPDATE `assistidos` SET ";
			$sqlUpdate = $sqlUpdate."`endereco`=\"$endereco\"";
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`CEP`=\"$cep\"";
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`renda`=\"$renda\"";
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`moradia`=\"$moradia\"";
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`ocupacao`=\"$ocupacao\"";
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`estadocivil`=\"$estadocivil\"";
		$sqlUpdate = $sqlUpdate." WHERE `cpf` = \"$cpf\"";
				
		$sqlAtendimentos = "UPDATE `atendimentos` SET ";
			$sqlAtendimentos = $sqlAtendimentos."`beneficiado`=\"$beneficiado\"";
				$sqlAtendimentos = $sqlAtendimentos.",";
			$sqlAtendimentos = $sqlAtendimentos."`parentesco`=\"$parentesco\"";
				$sqlAtendimentos = $sqlAtendimentos.",";
			$sqlAtendimentos = $sqlAtendimentos."`descricao`=\"$descricao\"";
		$sqlAtendimentos = $sqlAtendimentos." WHERE `index` = $index";
		$queryAtendimentos = $conexao->query($sqlAtendimentos);
		
	}
	else
	{
		
		print_r($_POST);
		
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
			$sqlUpdate = $sqlUpdate."`reu`=\"$reu\"";
		
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`autor`=\"$autor\"";
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`processo`=\"$processo\"";
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`local`=\"$local\"";
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`acao`=\"$acao\"";
		
		$sqlUpdate = $sqlUpdate." WHERE `index` = $index";
	}
	echo "sqlUpdate = $sqlUpdate<br>";
	$queryUpdate = $conexao->query($sqlUpdate);
	if ($queryUpdate != false)
	{
		echo "
				<form id=\"id_form\" action=\"mainAluno.php\" method=\"post\">";
		if ($_POST['editAssistido'])
		{
			echo "
				<input type=\"hidden\" name=\"mode\" value=\"verassistido$cpf\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
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