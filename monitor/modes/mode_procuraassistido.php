<?php
	include ('../../newconexao.php');
	$nomeAssistido = $_POST['nomeAssistido'];
	
	$matriculaResponsavel = $_POST['matriculaResponsavel'];
	$matricula = $_POST['matricula'];
	$nomeProfessorMonitoria = PROFESSORES_GETNAME($matriculaResponsavel);
	$nomeProfessorPlantao = PROFESSORES_GETPROFESSORPLANTAONAME($matricula);
	
	$sqlSearch = "SELECT * FROM `atendimentos` WHERE   (`nome` LIKE \"%$nomeAssistido%\" OR `autor`  LIKE \"%$nomeAssistido%\" OR `beneficiado` LIKE \"%$nomeAssistido%\" OR `reu` LIKE \"%$nomeAssistido%\") AND (`responsavel` = \"$nomeProfessorPlantao\" OR `responsavel` = \"$nomeProfessorMonitoria\") ORDER BY `responsavel`,`nome`  ASC";
	$nomes = array();
	
	//echo "sqlSearch = $sqlSearch<br>";
	$querySearch = $conexao->query($sqlSearch);
	$resultSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );
	$rowsSearch = count($resultSearch);
	//echo "rowsSearch = $rowsSearch<br>";
	
	if ($rowsSearch <= 0)
	{
		echo "<h3>Nenhum ";
			echo "Assistido, Autor ou Beneficiado ";
			echo "ou Réu ";
		echo "encontrado com esses dados.</h3>";
	}
	else
	{
		
		echo '
					<table class="table table-bordered table-hover" border="2" bordercolor=BLACK >
						<tbody>';
						
		echo '
				<tr align="center">
					<td><strong>Assistido</strong></td>
					<td><strong>Relação</strong></td>
					<td><strong>Obs</strong></td>
				</tr>
		';
	
		
		for ($i=0;$i<$rowsSearch;$i++)
		{
			
			$nome = $resultSearch[$i]['nome'];
			if (in_array($nome,$nomes))
			{}
			else
			{
				
				array_push($nomes,$nome);
				$cpf = $resultSearch[$i]['cpf'];
				$reu = $resultSearch[$i]['reu'];
				$beneficiado = $resultSearch[$i]['beneficiado'];
				$autor = $resultSearch[$i]['autor'];
				$descricao = $resultSearch[$i]['descricao'];
				$responsavel = $resultSearch[$i]['responsavel'];
				//echo "$i -> Nome = $nome -> reu = $reu -> beneficiado = $beneficiado -> autor = $autor -> descricao = $descricao -> nomeAssistido = $nomeAssistido<br>";
				echo "<tr>";
				echo "<td>";
					echo "<button class=\"button-link\" type=\"submit\" name=\"mode\" value=\"verassistido$cpf\">$nome</button><br>";
				echo "</td>";
				
				echo "<td>";
					if (strstr(strtolower($nome),strtolower($nomeAssistido)))
					{
						echo "Assitido: $nome<br>";
					}if (strstr(strtolower($beneficiado),strtolower($nomeAssistido)))
					{
						echo "Beneficiado: $beneficiado<br>";
					}if (strstr(strtolower($autor),strtolower($nomeAssistido)))
					{
						echo "Autor: $autor<br>";
					}if (strstr(strtolower($reu),strtolower($nomeAssistido)))
					{
						echo "Parte Contraria	: $reu<br>";
					}
				echo "</td>";
				echo "<td>";
					
					if ($responsavel == $nomeProfessorPlantao)
						echo "Assistido Plantão";
					else
						echo "Assistido Monitoria";
				echo "</td>";
				echo "</tr>";
			}
		}
		echo "</tbody> </table>";
	}
	
?>