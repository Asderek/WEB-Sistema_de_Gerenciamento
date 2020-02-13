
<?php
	
	include('../utils/newconexao.php');
	include('../utils/injection.php');
	
	$matricula = $_POST['matricula'];
	$email = $_POST['email'];
	$tel = $_POST['tel'];
	
	if (injection($tel) || injection($email))
	{
		include ("../utils/email.php");
		
		$destiny = "pinheiro.lucasn@gmail.com";
		$sbj = "Tentativa de SQL Injection";
		$msg = "[aluno/modes/atualizacadastro.php] O usuario matricula: $matricula, acabou de tentar um SQL Injection ao atualizar dados.<br> Os dados são: <br>tel = $tel<br>email = $email<br>";
		
		EMAIL_SEND_SUPRESSED($destiny,$sbj,$msg);
		echo "<form id=\"id_auto\" action=\"mainAluno.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
			echo "<input type=\"hidden\" name=\"mode\" value=\"informacao\">";
			//echo "<h3> Don't think I don't know what you're trying to do.</h3>";
			echo "<button type=\"submit\">Voltar</button>";
		echo "</form>";
		return;
	}
						
	$sqlAluno = "SELECT * FROM alunos WHERE matricula = \"$matricula\"";
	$queryAluno = $conexao->query($sqlAluno);
	if ($queryAluno != false)
	{
		$resultAluno = $queryAluno->fetchAll(PDO::FETCH_ASSOC);
		$rowsAluno = count($resultAluno);
		if ($rowsAluno>0)
		{
			$sqlUpdate = "UPDATE `alunos` SET `email`=\"$email\",`telefone`= \"$tel\" WHERE `matricula` = \"$matricula\"";
			$queryUpdate = $conexao->query($sqlUpdate);
		}
	}
	
	echo "<form id=\"id_form\" action=\"mainAluno.php\" method=\"post\">";
	echo "
		<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
		<input type=\"hidden\" name=\"mode\" value=\"informacao\">
	</form>
		<script>
			document.getElementById('id_form').submit();
		</script>
	";
	
		
	
?>