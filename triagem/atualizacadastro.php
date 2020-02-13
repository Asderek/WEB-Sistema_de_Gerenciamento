<?php

	include('../utils/newconexao.php');

	print_r($_POST);
	$cpf = $_POST['cpf'];
	$nome = $_POST['nome'];
	$rg = $_POST['rg'];
	$tel1 = $_POST['tel1'];
	$tel2 = $_POST['tel2'];
	$cel = $_POST['cel'];
	$email = $_POST['email'];
	$dob = $_POST['dob'];
	$endereco = $_POST['endereco'];
	$bairro = $_POST['bairro'];
	$cep = $_POST['cep'];
	$comunidade = $_POST['comunidade'];
	$renda = $_POST['renda'];
	$moradia = $_POST['moradia'];
	$ocupacao = $_POST['ocupacao'];
	$estadocivil = $_POST['estadocivil'];
	$etnia = $_POST['etnia'];
	
	$sqlUpdate = "UPDATE `assistidos` SET ";
	if (true)
	{
		$sqlUpdate = $sqlUpdate."`nome`=\"$nome\"";
		$virgula = true;
		
		$sqlUpdateAtendimentos = "UPDATE `atendimentos` SET `nome` = \"$nome\" WHERE `cpf` = \"$cpf\"";
		$queryUpdateAtendimentos = $conexao->query($sqlUpdateAtendimentos);
	}
	if (true)
	{
		if ($virgula == true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`rg`=\"$rg\"";
		$virgula = true;
	}
	if (true)
	{
		if ($virgula == true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`tel1`=\"$tel1\"";
		$virgula = true;
	}if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`tel2`=\"$tel2\"";
	}if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`cel`=\"$cel\"";
	}
	if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`email`=\"$email\"";
	}	
	if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`dob`=\"$dob\"";
		$virgula = (true);
	}
	if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`endereco`=\"$endereco\"";
	}
	if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`bairro`=\"$bairro\"";
	}
	if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`CEP`=\"$cep\"";
	}
	if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`comunidade`=\"$comunidade\"";
	}
	if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`renda`=\"$renda\"";
	}
	if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`moradia`=\"$moradia\"";
	}
	if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`ocupacao`=\"$ocupacao\"";
	}
	if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`estadocivil`=\"$estadocivil\"";
	}
	if (true)
	{
		if (true)
			$sqlUpdate = $sqlUpdate.",";
		$sqlUpdate = $sqlUpdate."`etnia`=\"$etnia\"";
	}
	
	$sqlUpdate = $sqlUpdate." WHERE `cpf` = \"$cpf\"";
	$queryUpdate = $conexao->query($sqlUpdate);
	//$sqlUpdate = "UPDATE `assistidos` SET `nome`=[value-3],`rg`=[value-4],`tel1`=[value-5],`tel2`=[value-6],`cel`=[value-7],`email`=[value-8],`dob`=[value-9],`endereco`=[value-10],`CEP`=[value-11],`bairro`=[value-12],`comunidade`=[value-13],`etnia`=[value-14],`renda`=[value-15],`moradia`=[value-16],`ocupacao`=[value-17],`estadocivil`=[value-18] WHERE `cpf` = \"$cpf\"";
	
	echo "<br><br>sqlUpdate = $sqlUpdate<br><br>";
	

	echo "<form id=\"id_auto\" action=\"consulta.php\" method=\"post\">
			<input type=\"hidden\" name=\"cpf\" value=\"$cpf\">
		</form>
		<script>
			document.getElementById('id_auto').submit();
		</script>
	
	";

?>