<?php
	
	include('../../newconexao.php');
	
	$cpf = $_POST['cpf'];
	
	$sqlRemove = "DELETE FROM `listadeespera` WHERE `CPF` = \"$cpf\"";

	$queryRemove = $conexao->query($sqlRemove);
	if ($queryRemove == false)
	{
		echo "Deu problema<br>sqlRemove = $sqlRemove<br>";
	}
	else
	{
		echo "
				<form id=\"id_form\" action=\"verlista.php\" method=\"post\">
				</form>
				<script>
					document.getElementById('id_form').submit();
				</script>
		";
	}

?>