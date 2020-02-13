<?php
	
	include('../../newconexao.php');
	$matricula = $_POST['matAluno'];
	if (strstr($matricula,"monitor") !== false)
	{
		$matricula = substr($matricula,strlen("monitor - "));
	}
	
	$sqlProfessor = "SELECT * FROM `alunos` WHERE `matricula`=$matricula";
	$queryProfessor = $conexao->query($sqlProfessor);
	$resultProfessor = $queryProfessor->fetchAll(PDO::FETCH_ASSOC);
	if(count($resultProfessor) >0)
	{
		echo "<form id=\"id_form\" action=\"mainAluno.php\" method=\"post\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
			  </form>
			  <script>
				document.getElementById('id_form').submit();
			  </script>
		";
	}
	else
	{
		echo "<form id=\"id_form\" action=\"index.php\" method=\"post\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
				<input type=\"hidden\" name=\"error\" value=\"matInvalida\">
			  </form>
			  <script>
				document.getElementById('id_form').submit();
			  </script>
		";
	}



?>