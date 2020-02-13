
<?php
	
	include('../utils/newconexao.php');
	
	$matricula = $_POST['matricula'];
	$email = $_POST['email'];
	$tel = $_POST['tel'];
						
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
	
	echo "<form id=\"id_form\" action=\"mainMonitor.php\" method=\"post\">";
	echo "
		<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
		<input type=\"hidden\" name=\"mode\" value=\"informacao\">
	</form>
		<script>
			document.getElementById('id_form').submit();
		</script>
	";
	
		
	
?>