<?php

	include ('../../newconexao.php');
	include ('../utils/documentos.php');

	$CPF = $_POST['cpf'];
	$nome = $_POST['nome'];
	$rg = $_POST['rg'];
	$tel1 = $_POST['tel1'];
	$tel2 = $_POST['tel2'];
	$cel = $_POST['cel'];
	$dob = $_POST['dob'];
	$bairro = $_POST['bairro'];
	$email = $_POST['email'];
	$etnia = $_POST['etnia'];
	
	$cpfOld = $_POST['cpfOld'];
	$erro = array();
	$SQLUpdate = "UPDATE `assistidos` SET `nome`=\"$nome\",`rg`=\"$rg\",`tel1`=\"$tel1\",`tel2`=\"$tel2\",`cel`=\"$cel\",`email`=\"$email\",`dob`=\"$dob\",`bairro`=\"$bairro\", `etnia`=\"$etnia\" WHERE `cpf` = \"$cpfOld\"";
	$queryUpdate = $conexao->query($SQLUpdate);
	if ($queryUpdate != false)
	{
		echo "<h1> Assistido inserido com sucesso</h1>";
	}
	else
	{
		array_push($erro,"Não consegui updatar as informações do assistido");
		echo "sqlUpdate = $SQLUpdate<br>";
		
		echo "<h1>Não consegui inserir oops</h1>";
		return;
	}
	
	if ($cpfOld != $CPF)
	{
		$sqlCheck = "SELECT * FROM `assistidos` WHERE `cpf` = \"$CPF\"";
		$queryCheck = $conexao->query($sqlCheck);
		if ($queryCheck != false)
		{
			$resultCheck = $queryCheck->fetchAll(PDO::FETCH_ASSOC);
			if (count($resultCheck)<=0)
			{
				if (count($erro)<=0)
				{
					$SQLUpdateAssitidos = "UPDATE `assistidos` SET `cpf`=\"$CPF\" WHERE `cpf` = \"$cpfOld\"";
					$queryUpdateAssistidos = $conexao->query($SQLUpdateAssitidos);
					if ($queryUpdateAssistidos == false)
					{
						array_push($erro,"Não Consegui Atualizar a Tabela Assistidos do Cliente $cpfOld");
						echo "<h3 class=\"text-center\">Não Consegui Atualizar a Tabela Assistidos do Cliente $cpfOld</h3>";
					}
					if (count($erro) <= 0)
					{
						$SQLUpdateAtendimentos = "UPDATE `atendimentos` SET `cpf`=\"$CPF\" WHERE `cpf` = \"$cpfOld\"";
						$queryUpdateAtendimentos = $conexao->query($SQLUpdateAtendimentos);
						if ($queryUpdateAtendimentos == false)
						{
							array_push($erro,"Não Consegui Atualizar a Tabela Atendimentos do Cliente $cpfOld");
							echo "<h3 class=\"text-center\">Não Consegui Atualizar a Tabela Atendimentos do Cliente $cpfOld</h3>";
						}
					}
					
					if (count($erro) <= 0)
					{
						$pasta = DOCUMENTS_GETDOCUMENTPATH($cpfOld);
						$pasta = $pasta.'/';
						$novapasta = DOCUMENTS_GETDOCUMENTPATH($CPF);
						$novapasta = $novapasta.'/';
						if (is_dir($pasta) == 1 && count($erro) <= 0)
						{
							rename	($pasta,$novapasta);
						}
						else
						{
							array_push($erro,"O assistido nao tinha uma pasta");
						}
					}
				}
			}
			else
				array_push($erro,"Já tem alguem com esse CPF");
		}
		
		
	}
	
	if (count($erro)<=0)
	{
		echo "
					<form id=\"myForm\" class=\"form col-md-12 center-block\" action='consulta.php' method=\"post\">
						<input type=\"hidden\" name=\"cpf\" value=\"$CPF\"></input>
						<input type=\"hidden\" name=\"nome\" value=\"$nome\"></input>
						<input type=\"hidden\" name=\"rg\" value=\"$rg\"></input>
						<input type=\"hidden\" name=\"tel1\" value=\"$tel1\"></input>
						<input type=\"hidden\" name=\"tel2\" value=\"$tel2\"></input>
						<input type=\"hidden\" name=\"cel\" value=\"$cel\"></input>
						<input type=\"hidden\" name=\"dob\" value=\"$dob\"></input>
						<input type=\"hidden\" name=\"bairro\" value=\"$bairro\"></input>
						<input type=\"hidden\" name=\"email\" value=\"$email\"></input>
						<input type=\"hidden\" name=\"etnia\" value=\"$etnia\"></input>
					</form>		
					<script type=\"text/javascript\">
						document.getElementById('myForm').submit();
					</script>
			";
	}
	else
	{
		for($i=0;$i<count($erro);$i++)
		{
			$numError = $erro[$i];
			echo "<h4 class=\"class-center\">Erro numero $i -> $numError</h4>";
		}
	}
?>