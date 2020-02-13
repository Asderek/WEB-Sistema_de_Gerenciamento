<?php
	include ('../utils/professores.php');
	
	$nomeProfessor = PROFESSORES_GETPROFESSORPLANTAONAME($matricula);
	
	if (isset($_POST['assistido']))
	{
		$nomeAssistido=$_POST['assistido'];
		$escolha = $_POST['tipo'];
	}
	else
		echo "Não recebi o.O<br>";
	
	$nomes = array();
	$atendimento = false;
	if ($escolha == 1)
	{
		$sqlSearch = "SELECT * FROM `atendimentos` WHERE   `responsavel` = \"$nomeProfessor\" AND (`nome` LIKE \"%$nomeAssistido%\" OR `autor`  LIKE \"%$nomeAssistido%\" OR `beneficiado` LIKE \"%$nomeAssistido%\" )";
	}
	else
		$sqlSearch = "SELECT * FROM `atendimentos` WHERE `reu` LIKE \"%$nomeAssistido%\" AND  `responsavel` = \"$nomeProfessor\"";
	
	//echo "sqlSearch = $sqlSearch<br>";
	$querySearch = $conexao->query($sqlSearch);
	$resultSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );
	$rowsSearch = count($resultSearch);
	//echo "rowsSearch = $rowsSearch<br>";
	
	if ($rowsSearch <= 0)
	{
		echo "<h3>Nenhum ";
		if ($escolha==1)
			echo "Assistido, Autor ou Beneficiado ";
		else
			echo "Réu ";
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
				//echo "$i -> Nome = $nome -> reu = $reu -> beneficiado = $beneficiado -> autor = $autor -> descricao = $descricao<br>";
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
				echo "</tr>";
			}
		}
		echo "</tbody> </table>";
	}
	
?>