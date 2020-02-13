<?php

	echo "<form id=\"id_auto\" action=\"main.php\" method=\"post\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
		";

	$matricula = $_POST['matricula'];
	$sqlAluno = "SELECT * FROM alunos WHERE matricula = $matricula";
	$queryAluno = $conexao->query($sqlAluno);
	$resultAluno	 = $queryAluno->fetchAll(PDO::FETCH_ASSOC);
	$status = $resultAluno[0]['status'];
	
	if($status == 1)
	{
		echo "
		<hr>
			<div class=\"w3-cell-row\">
			  <div class=\"w3-cell w3-container\">
				<h4 class=\"text-center\">
					Aluna(o) já está matricula(o) no Simulado
				</h4>
			  </div>
			</div>  
		</hr>
		";
	}
	else
	{
		echo "
		<hr>
			<div class=\"w3-cell-row\">
			  <div class=\"w3-cell w3-container\">
				<h4 class=\"text-center\">
					Aluno ainda não se cadastrou no simulado.<br><br>
					<button type=\"submit\" class=\"btn btn-primary btn-lg btn-block\" formaction=\"inscricaosimulado.php\">Inscrever-se</button>
				</h4>
			  </div>
			</div>  
		</hr>
		";
	}
	
	
	echo "</form>";
	
?>


