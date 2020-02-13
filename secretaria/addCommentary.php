<?php

	print_r($_POST);
	$commentary = $_POST['professorCommentary'];
	$cpf = $_POST['cpf'];
	
	include ('../utils/newconexao.php');
	$sqlCommentary = "INSERT INTO `professorcommentaries`(`cpf`, `comentario`, `professor`) VALUES (\"$cpf\", \"$commentary\", \"Secretaria\")";
	$queryCommentary = $conexao->query($sqlCommentary);
	if ($queryCommentary != false)
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
		echo "<h3 class=\"text-center\">Erro ao Inserir comentario em $cpf<br>sqlCommentary = $sqlCommentary</h3>";
		echo "<form action=\"mainSecretaria.php\" method=\"post\" id=\"id_auto\">
				<input type=\"hidden\" name=\"mode\" value=\"consultaassistido\">
				<input type=\"hidden\" value=\"$cpf\" name=\"cpf\">
				<input type=\"submit\" value=\"Voltar\">
			</form>";
			
	}
	
?>