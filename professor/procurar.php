<?php
	include('../../newconexao.php');
	include('../../injection.php');
	
	$CPF = $_POST['cpf'];
	$matricula = $_POST['matricula'];
	echo "Matricula = $matricula<br>";
	echo "CPF = $CPF<br>";
	
	print_r($_POST);
	
	if(injection($CPF))
	{
		echo "My code is Sanitized";
		return;
	}

	
	$SQLSearch = "SELECT * FROM `assistidos` WHERE `cpf` = \"$CPF\"";
	$querySearch = $conexao->query($SQLSearch);
	$resultSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );
	$rowsSearch = count($resultSearch);
	
	if ($rowsSearch <= 0)
	{
		
	}
	else
	{
		$nome = $resultSearch[0]['nome'];
		$rg = $resultSearch[0]['rg'];
		$tel = $resultSearch[0]['tel'];
		$dob = $resultSearch[0]['dob'];
		$bairro = $resultSearch[0]['bairro'];
		
		
		echo "
						<form id=\"myForm\" class=\"form col-md-12 center-block\" action='consultaassistido.php' method=\"post\">
							<input type=\"hidden\" name=\"cpf\" value=\"$CPF\"></input>
							<input type=\"hidden\" name=\"nome\" value=\"$nome\"></input>
							<input type=\"hidden\" name=\"rg\" value=\"$rg\"></input>
							<input type=\"hidden\" name=\"tel\" value=\"$tel\"></input>
							<input type=\"hidden\" name=\"dob\" value=\"$dob\"></input>
							<input type=\"hidden\" name=\"bairro\" value=\"$bairro\"></input>
						</form>		
						<script type=\"text/javascript\">
							document.getElementById('myForm').submit();
						</script>
				";
	}
	
?>