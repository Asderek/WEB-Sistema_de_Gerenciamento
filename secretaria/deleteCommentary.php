<?php

	print_r($_POST);
	$index = $_POST['commentaryId'];
	$cpf = $_POST['cpf'];

	include('../utils/newconexao.php');
	$sqlDelete = "DELETE FROM `professorcommentaries` WHERE `index` = $index";
	$queryDelete = $conexao->query($sqlDelete);
	
	if ($queryDelete != false)
	{
		echo "<form action=\"mainSecretaria.php\" method=\"post\" id=\"id_auto\">
				<input type=\"hidden\" name=\"mode\" value=\"consultaassistido\">
				<input type=\"hidden\" value=\"$cpf\" name=\"cpf\">
			</form>";
			
		echo "<script>
					document.getElementById('id_auto').submit();
				</script>";
	}
	else
	{
		echo "<h3 class=\"text-center\">Erro ao Inserir comentario em $cpf<br>sqlDelete = $sqlDelete</h3>";
		echo "<form action=\"mainSecretaria.php\" method=\"post\" id=\"id_auto\">
				<input type=\"hidden\" name=\"mode\" value=\"consultaassistido\">
				<input type=\"hidden\" value=\"$cpf\" name=\"cpf\">
				<input type=\"submit\" value=\"Voltar\">
			</form>";
			
	}
	
?>