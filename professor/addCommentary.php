<?php

	print_r($_POST);
	$commentary = $_POST['professorCommentary'];
	$cpf = $_POST['cpf'];
	$matricula = $_POST['matricula'];
	
	include('../utils/professores.php');
	$nome = PROFESSORES_GETNAME($matricula);
	
	$pieces = explode(' ', $nome);
	$last_word = array_pop($pieces);
	
	$nome = substr($nome,0,strpos($nome," ")) . " " . $last_word;
	
	include ('../utils/newconexao.php');
	$sqlCommentary = "INSERT INTO `professorcommentaries`(`cpf`, `comentario`, `professor`) VALUES (\"$cpf\", \"$commentary\", \"$nome\")";
	$queryCommentary = $conexao->query($sqlCommentary);
	if ($queryCommentary != false)
	{
		echo "<form action=\"mainProfessor.php\" method=\"post\" id=\"id_auto\">
				<input type=\"hidden\" name=\"mode\" value=\"consultaassistido\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
				<input type=\"hidden\" value=\"$cpf\" name=\"cpf\">
			</form>";
			
		echo "<script>
					document.getElementById('id_auto').submit();
				</script>";
	}
	else
	{
		echo "<h3 class=\"text-center\">Erro ao Inserir comentario em $cpf<br>sqlCommentary = $sqlCommentary</h3>";
		echo "<form action=\"mainProfessor.php\" method=\"post\" id=\"id_auto\">
				<input type=\"hidden\" name=\"mode\" value=\"consultaassistido\">
				<input type=\"hidden\" value=\"$cpf\" name=\"cpf\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
				<input type=\"submit\" value=\"Voltar\">
			</form>";
			
	}
	
?>