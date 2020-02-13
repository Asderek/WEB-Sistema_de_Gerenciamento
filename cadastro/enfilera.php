<?php

	include ('../../newconexao.php');

	$cpf = $_POST['cpf'];
	
	$sqlRepetido = "SELECT * FROM `listadeespera` WHERE `CPF` = \"$cpf\"";
	$queryRepetido = $conexao->query($sqlRepetido);
	if ($queryRepetido == false)
	{
		
	}else
	{
		$resultRepetido = $queryRepetido->fetchAll(PDO::FETCH_ASSOC);
		$rowsRepetido = count($resultRepetido);
		if ($rowsRepetido>0)
		{
			echo "
				<form id=\"id_form\" action=\"index.php\" method=\"post\">
				</form>
				<script>
					document.getElementById('id_form').submit();
				</script>
			";
			return;
		}
	}
	
	$sqlFila = "INSERT INTO `listadeespera`(`CPF`) VALUES (\"$cpf\")";
	$queryFila = $conexao->query($sqlFila);
	if ($queryFila==false)
	{
		echo "Não foi possivel inserir na fila o assistido<br>";
		echo "sqlFila = $sqlFila<br>";
	}
	else
	{
		echo "
				<form id=\"id_form\" action=\"index.php\" method=\"post\">
				</form>
				<script>
					document.getElementById('id_form').submit();
				</script>
		";
	}
?>