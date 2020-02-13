<?php

	echo "<form id=\"id_auto\" action=\"main.php\" method=\"post\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
		";

	$matricula = $_POST['matricula'];
	$sqlAluno = "SELECT * FROM alunos WHERE matricula = $matricula";
	$queryAluno = $conexao->query($sqlAluno);
	$resultAluno	 = $queryAluno->fetchAll(PDO::FETCH_ASSOC);
	$disciplina = $resultAluno[0]['disciplina'];
	$turma = $resultAluno[0]['turma'];
	$sqlSwitchBoard = "SELECT * FROM `switchboard` WHERE (`nome` LIKE \"%simulado%\" OR `nome` LIKE \"%aluno%\") AND `status` = 1";
	$querySwitchBoard = $conexao->query($sqlSwitchBoard);
	$resultSwitchBoard = $querySwitchBoard->fetchAll(PDO::FETCH_ASSOC);
	for($i=0;$i<count($resultSwitchBoard);$i++)
	{
		$nome = $resultSwitchBoard[$i]['nome'];
		$index = $resultSwitchBoard[$i]['index'];
		echo "
		<hr>
			<div class=\"w3-cell-row\">
			  <div class=\"w3-cell w3-container\">
				<h4 class=\"text-center\">
					<button type=\"submit\" name=\"mode\" value=\"switch_$index\" class=\"btn btn-primary btn-lg btn-block\">$nome</button>
				</h4>
			  </div>
			</div>  
		</hr>
		";
	}
	
	/*$sqlSwitchBoard = "SELECT * FROM `professoresmonitoria` WHERE `status` = 1";
	$querySwitchBoard = $conexao->query($sqlSwitchBoard);
	$resultSwitchBoard = $querySwitchBoard->fetchAll(PDO::FETCH_ASSOC);
	if(count($resultSwitchBoard)>0)
	{
		echo "
		<hr>
			<div class=\"w3-cell-row\">
			  <div class=\"w3-cell w3-container\">
				<h4 class=\"text-center\">
					<button type=\"submit\" name=\"mode\" value=\"monitoria\" class=\"btn btn-primary btn-lg btn-block\">Monitoria</button>
				</h4>
			  </div>
			</div>  
		</hr>
		";
	}*/
	
	$arrayVisitas = array();
	$sqlSwitchBoard = "SELECT * FROM `visitasAlunos` WHERE `Matricula` = $matricula";
	$querySwitchBoard = $conexao->query($sqlSwitchBoard);
	$resultSwitchBoard = $querySwitchBoard->fetchAll(PDO::FETCH_ASSOC);
	for($i=0;$i<count($resultSwitchBoard);$i++)
	{
		$index = $resultSwitchBoard[$i]['VisitaID'];
		array_push($arrayVisitas,$index);
		$sqlNomeVisita = "SELECT nome FROM visitasAbertas WHERE ID = $index";
		$queryNomeVisita = $conexao->query($sqlNomeVisita);
		$resultNomeVisita = $queryNomeVisita->fetchAll(PDO::FETCH_ASSOC);
		$nome = $resultNomeVisita[0]['nome'];
		echo "
		<hr>
			<div class=\"w3-cell-row\">
			  <div class=\"w3-cell w3-container\">
				<h4 class=\"text-center\">
					<button type=\"submit\" name=\"mode\" value=\"evento_$index\" class=\"btn btn-primary btn-lg btn-block\">$nome</button>
				</h4>
			  </div>
			</div>  
		</hr>
		";
	}
	
	$letra = substr($turma,-1);
	$turma0 = $letra."00";
	$turmaT = $letra."--";
	$sqlSwitchBoard = "SELECT * FROM `visitasAbertas` WHERE `disciplina` = \"$disciplina\" AND `vagas` NOT LIKE \"%$turma0%\" AND `vagas` NOT LIKE \"%$turmaT%\" AND `aberta` = 1";
	$querySwitchBoard = $conexao->query($sqlSwitchBoard);
	$resultSwitchBoard = $querySwitchBoard->fetchAll(PDO::FETCH_ASSOC);
	for($i=0;$i<count($resultSwitchBoard);$i++)
	{
		$nome = $resultSwitchBoard[$i]['nome'];
		$index = $resultSwitchBoard[$i]['ID'];
		if (!in_array($index,$arrayVisitas))
		{
			echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\">
					<h4 class=\"text-center\">
						<button type=\"submit\" name=\"mode\" value=\"evento_$index\" class=\"btn btn-primary btn-lg btn-block\">$nome</button>
					</h4>
				  </div>
				</div>  
			</hr>
			";
		}
	}
	
	echo "</form>";
?>


