<?php	
	echo "<!-- Mode ListaAssistido -->";
	$matriculaResponsavel = $_POST['matriculaResponsavel'];
	$arrayCPF = array();
	
	$sqlProfessor = "SELECT * FROM professores WHERE `matricula` = $matriculaResponsavel";
	$queryProfessor = $conexao->query($sqlProfessor);
	
	$nomeProfessorPlantao = PROFESSORES_GETPROFESSORPLANTAONAME($matricula);
	if($queryProfessor != false)
	{
		$resultProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
		$rowsProfessor = count($resultProfessor);
	}
	
	if($rowsProfessor>0)
	{
		$sqlAreaProfessor = "SELECT * FROM professores WHERE `matricula` = $matriculaResponsavel";
		$queryAreaProfessor = $conexao->query($sqlAreaProfessor);
		if ($queryAreaProfessor == false)
			return;
		$resultAreaProfessor = $queryAreaProfessor->fetchAll(PDO::FETCH_ASSOC);
		$area = $resultAreaProfessor[0]['area'];
		
		if ($area != "GIMEC")
		{
			$nome = $resultProfessor[0]['nome'];
			
			$sqlAtendimento = "SELECT * FROM atendimentos WHERE `responsavel` = \"$nome\" OR `responsavel` = \"$nomeProfessorPlantao\"  ORDER BY `responsavel`,`nome` ASC";
			$queryAtendimento = $conexao->query($sqlAtendimento);
			if($queryAtendimento != false)
			{
				$resultAtendimento = $queryAtendimento->fetchAll( PDO::FETCH_ASSOC );
				$rowsAtendimento = count($resultAtendimento);
			}
			
			echo '
				<table class="table table-bordered table-hover" border="2" bordercolor=BLACK >
					<tbody>';
					
			echo '
					<tr align="center">
						<td><strong>CPF</strong></td>
						<td><strong>Nome</strong></td>
						<td><strong>Ir</strong></td>
					</tr>
			';
			for($i=0;$i<$rowsAtendimento;$i++)
			{
				$cpf = $resultAtendimento[$i]['cpf'];
				if (!in_array($cpf,$arrayCPF))
				{
					array_push($arrayCPF,$cpf);
				}
			}

			for($i=0;$i<count($arrayCPF);$i++)
			{
				$cpf = $arrayCPF[$i];
				$sqlAssistido = "SELECT * FROM assistidos WHERE `cpf` = \"$cpf\"";
				$queryAssistido = $conexao->query($sqlAssistido);
					if ($queryAssistido != false)
					{
						$resultAssistido = $queryAssistido->fetchAll( PDO::FETCH_ASSOC );
						$nome = $resultAssistido[0]['nome'];
						echo '<tr align="left">';
							echo "<td width=\"10%\">$cpf</td>";
							echo "<td width=\"50%\" >$nome</td>";
							echo "<td width=\"10%\"><button type=\"submit\" id=\"id_ButtonCadastrarPlantao\" name=\"mode\" value=\"verassistido$cpf\" class=\"button btn-primary btn-lg btn-block	\">Ver</button></td>";
						echo '</tr>';
					}			
			}
			echo '
					</tbody>
				</table>';
		}
		else
		{
			$sqlGimec = "SELECT * FROM professores WHERE area = \"GIMEC\"";
			$queryGimec = $conexao->query($sqlGimec);
			if ($queryGimec == false)
				return;
			$resultGimec = $queryGimec->fetchAll(PDO::FETCH_ASSOC);
			
			$nome = $resultGimec[0]['nome'];
			$sqlAtendimento = "SELECT * FROM atendimentos WHERE (responsavel = \"$nome\"";
			for ($i=1;$i<count($resultGimec);$i++)
			{					
				$nome = $resultGimec[$i]['nome'];
				$sqlAtendimento .= " OR responsavel = \"$nome\"";
			}
			$sqlAtendimento .= ")";
			//echo "sqlAtendimento = $sqlAtendimento<br>";
			//$sqlAtendimento = "SELECT * FROM atendimentos WHERE `responsavel` = \"$nome\"";
			$queryAtendimento = $conexao->query($sqlAtendimento);
			if($queryAtendimento != false)
			{
				$resultAtendimento = $queryAtendimento->fetchAll( PDO::FETCH_ASSOC );
				$rowsAtendimento = count($resultAtendimento);
			}
			
			echo '
				<table class="table table-bordered table-hover" border="2" bordercolor=BLACK >
					<tbody>';
					
			echo '
					<tr align="center">
						<td><strong>CPF</strong></td>
						<td><strong>Nome</strong></td>
						<td><strong>Ir</strong></td>
					</tr>
			';
			for($i=0;$i<$rowsAtendimento;$i++)
			{
				$cpf = $resultAtendimento[$i]['cpf'];
				if (!in_array($cpf,$arrayCPF))
				{
					array_push($arrayCPF,$cpf);
				}
			}

			for($i=0;$i<count($arrayCPF);$i++)
			{
				$cpf = $arrayCPF[$i];
				$sqlAssistido = "SELECT * FROM assistidos WHERE `cpf` = \"$cpf\"";
				$queryAssistido = $conexao->query($sqlAssistido);
					if ($queryAssistido != false)
					{
						$resultAssistido = $queryAssistido->fetchAll( PDO::FETCH_ASSOC );
						$nome = $resultAssistido[0]['nome'];
						echo '<tr align="left">';
							echo "<td width=\"10%\">$cpf</td>";
							echo "<td width=\"50%\" >$nome</td>";
							echo "<td width=\"10%\"><button type=\"submit\" id=\"id_ButtonCadastrarPlantao\" name=\"mode\" value=\"verassistido$cpf\" class=\"btn btn-primary btn-block\">Ver</button></td>";
						echo '</tr>';
					}			
			}
			echo '
					</tbody>
				</table>';
		}
	}
	
?>