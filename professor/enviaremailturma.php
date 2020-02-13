<?php

	include('../../newconexao.php');
	include('../../email.php');
	include('../../professores.php');
	
	$matricula = $_POST['matricula'];
	$turma=$_POST['turma'];
	$msg = $_POST['descricao'];
	
	$sbj = $_POST['subject'];
	
	
	$nome = PROFESSORES_GETNAME($matricula);
	
	$msgPos = "De: $nome\n\n";
	$msg = $msgPos.$msg;
	
	echo "turma = $turma<br>";
	
	$sqlAlunos = "SELECT * FROM `alunos` WHERE `turma` = \"$turma\" AND `professor` = \"$nome\"";
	$queryAlunos = $conexao->query($sqlAlunos);
	if($queryAlunos != false)
	{
		$resultAlunos = $queryAlunos->fetchAll( PDO::FETCH_ASSOC );
		$rowsAlunos = count($resultAlunos);
		for($i=0;$i<$rowsAlunos;$i++)
		{
			$email = $resultAlunos[$i]['email'];
			EMAIL_SEND($email,$sbj,$msg);
		}
	}
	
	$email = "npj@puc-rio.br";
	EMAIL_SEND($email,$sbj,$msg);
	
	echo "<form id=\"myform\" action=\"mainProfessor.php\" method=\"post\">
			<input type=\"hidden\" name=\"matricula\" value=\"$matricula\"></input>
			<input type=\"hidden\" name=\"mode\" value=\"calendario\"></input>
		 </form>
		<script type=\"text/javascript\">
			document.getElementById('myform').submit();
		</script>
	
	";

?>