<?php	
	echo "<!-- Mode ListaAssistido -->";
	$matricula = $_POST['matricula'];
	$arrayCPF = array();
	
	$sqlProfessor = "SELECT * FROM professores WHERE `matricula` = $matricula";
	$queryProfessor = $conexao->query($sqlProfessor);
	if($queryProfessor != false)
	{
		$resultProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
		$rowsProfessor = count($resultProfessor);
	}
	
	if($rowsProfessor>0)
	{
		$nome = $resultProfessor[0]['nome'];
		
		$sqlAtendimento = "SELECT * FROM atendimentos WHERE `responsavel` = \"$nome\" ORDER BY `nome` ASC";
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
	
?>