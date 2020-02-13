<?php

	include('../../newconexao.php');
	include('../utils/email.php');
	
	$matricula = $_POST['matricula'];	
	$msg = $_POST['descricao'];
	
	$sbj = $_POST['subject'];
	$sbj = "[CONTATO PELO SITE]".$sbj;
	
	$sqlAlunos = "SELECT * FROM `alunos` WHERE `matricula` = \"$matricula\"";
	$queryAlunos = $conexao->query($sqlAlunos);
	if($queryAlunos != false)
	{
		$resultAlunos = $queryAlunos->fetchAll( PDO::FETCH_ASSOC );
		$email = $resultAlunos[0]['email'];
		$nome = $resultAlunos[0]['nome'];
		
		$msgPos = "Aluno: $nome\nEmail: $email\n\nMsg:";
		$msg = $msgPos.$msg;
	
	}
	
	$email = "npj@puc-rio.br";
	EMAIL_SEND_SUPRESSED($email,$sbj,$msg,true);
	
	echo "<form id=\"myform\" action=\"mainAluno.php\" method=\"post\">
			<input type=\"hidden\" name=\"matricula\" value=\"$matricula\"></input>
			<input type=\"hidden\" name=\"mode\" value=\"calendario\"></input>
		 </form>
		<script type=\"text/javascript\">
			document.getElementById('myform').submit();
		</script>
	
	";

?>