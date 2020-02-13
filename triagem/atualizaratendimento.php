<?php
	include ('../../newconexao.php');

	$cpf = $_POST['cpf'];
	$index = $_POST['index'];
	$orientacao = $_POST['orientacao'];
	$endereco = $_POST['endereco'];
	$cep = $_POST['cep'];
	$renda = $_POST['renda'];
	$moradia = $_POST['moradia'];
	$ocupacao = $_POST['ocupacao'];
	$estadocivil = $_POST['estadocivil'];
	$beneficiado = $_POST['beneficiado'];
	$parentesco = $_POST['parentesco'];
	$descricao = $_POST['descricao'];
	$responsavel = $_POST['responsavel'];
	
	
	echo "index = $index<br>";
	echo "orientacao = $orientacao<br>";
	echo "endereco = $endereco<br>";
	echo "cep = $cep<br>";
	echo "renda = $renda<br>";
	echo "moradia = $moradia<br>";
	echo "ocupacao = $ocupacao<br>";
	echo "estadocivil = $estadocivil<br>";
	echo "beneficiado = $beneficiado<br>";
	echo "parentesco = $parentesco<br>";
	echo "descricao = $descricao<br>";
	echo "responsavel = $responsavel<br>";

	if ($orientacao == "on")
		$orientacao = 1;
	else
		$orientacao = 0;
	
	$sqlUpdate = "UPDATE `atendimentos` SET `orientacao`=$orientacao,`endereco`=\"$endereco\",`cep`=\"$cep\",`renda`=\"$renda\",`moradia`=\"$moradia\",`ocupacao`=\"$ocupacao\",`estadocivil`=\"$estadocivil\",`beneficiado`=\"$beneficiado\",`parentesco`=\"$parentesco\",`descricao`=\"$descricao\", `responsavel`=\"$responsavel\" WHERE `index` = $index";
	$queryUpdate = $conexao->query($sqlUpdate);
	if ($queryUpdate == false)
	{
		echo "Não Consegui atualizar<br>Volte e tente novamente, evite usar aspas \" \", acentos e caracteres especiais<br>";
		echo "<a href=\"javascript:history.go(-1)\"></a>";
	}
	else
	{
		echo "
						<form id=\"myForm\" class=\"form col-md-12 center-block\" action='consultaatendimento.php' method=\"post\">
							<input type=\"hidden\" name=\"cpf\" value=\"$cpf\">
							<input type=\"hidden\" name=\"assistencia\" value=\"$index\">
						</form>		
						<script type=\"text/javascript\">
							document.getElementById('myForm').submit();
						</script>
				";
	}
	
?>