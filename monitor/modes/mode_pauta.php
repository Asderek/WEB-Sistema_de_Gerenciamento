<?php	
	$matriculaResponsavel = $_POST['matriculaResponsavel'];
	
	$sqlProfessor = "SELECT * FROM professores WHERE `matricula` = $matriculaResponsavel";
	$queryProfessor = $conexao->query($sqlProfessor);
	if($queryProfessor != false)
	{
		$resultProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
		$rowsProfessor = count($resultProfessor);
	}
	
	if($rowsProfessor>0)
	{
		$nome = $resultProfessor[0]['nome'];
		
		$sqlAluno = "SELECT * FROM alunos WHERE `professor` = \"$nome\" ORDER BY `nome` ASC";
		$queryAluno = $conexao->query($sqlAluno);
		if($queryAluno != false)
		{
			$resultAluno = $queryAluno->fetchAll( PDO::FETCH_ASSOC );
			$rowsAluno = count($resultAluno);
		}
		
		echo '
			<table class="table table-bordered table-hover" border="2" bordercolor=BLACK >
				<tbody>';
				
		echo '
				<tr align="center">
					<td><strong>Matricula</strong></td>
					<td><strong>Nome</strong></td>
					<th align="center">G3</strong></td>
					<td><strong>L1</strong></td>
					<td><strong>Ir</strong></td>
				</tr>
		';
		for($i=0;$i<$rowsAluno;$i++)
		{
			$matriculaAluno = $resultAluno[$i]['matricula'];
			$nota = $resultAluno[$i]['l1'];
			$nome = $resultAluno[$i]['nome'];
			$atual1 = $resultAluno[$i]['atual1'];
			$horas = $resultAluno[$i]['horas'];
			
			
			if($horas < 75)
				$horas = 0;
			else if (($horas >= 75) && ($horas < 80))
				$horas = 5;
			else if (($horas >= 80) && ($horas < 85))
				$horas = 6;
			else if (($horas >= 85) && ($horas < 90))
				$horas = 7;
			else if (($horas >= 90) && ($horas < 95))
				$horas = 8;
			else if (($horas >= 95) && ($horas < 100))
				$horas = 9;
			else 
				$horas = 10;
			
			
			echo '<tr align="left">';
				echo "<td width=\"10%\">$matriculaAluno</td>";
				echo "<td width=\"50%\" >$nome</td>";
				echo "<td width=\"10%\">$horas</td>";											
				echo "<td width=\"10%\">$nota</td>";
				echo "<td width=\"10%\"><button type=\"submit\" id=\"id_ButtonCadastrarPlantao\" name=\"mode\" value=\"veraluno$matriculaAluno\" class=\"btn btn-primary btn-block\">Ver</button></td>";
			echo '</tr>';
		}
		echo '
			<table class="table table-bordered table-hover" border="2" bordercolor=BLACK >
				<tbody>';
	}
	
?>