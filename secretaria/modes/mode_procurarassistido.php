<?php
	include ('../../newconexao.php');
	$nomeAssistido = $_POST['nomeAssistido'];
	$sqlSearch = "SELECT * FROM `atendimentos` WHERE   (`nome` LIKE \"%$nomeAssistido%\" OR `autor`  LIKE \"%$nomeAssistido%\" OR `beneficiado` LIKE \"%$nomeAssistido%\" OR `reu` LIKE \"%$nomeAssistido%\") ORDER BY `nome` ASC";
	
	//echo "sqlSearch = $sqlSearch<br>";
	$querySearch = $conexao->query($sqlSearch);
	$resultSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );
	$rowsSearch = count($resultSearch);
	//echo "rowsSearch = $rowsSearch<br>";
	
	$sqlAssistidos = "SELECT * FROM `assistidos` WHERE `nome` LIKE \"%$nomeAssistido%\" ORDER BY `nome` ASC";
	
	//echo "sqlSearch = $sqlSearch<br>";
	$queryAssistidos = $conexao->query($sqlAssistidos);
	$resultAssistidos = $queryAssistidos->fetchAll( PDO::FETCH_ASSOC );
	$rowsAssistidos = count($resultAssistidos);
	
	$sqlAssistidosAntigos = "SELECT * FROM `NPJ_AssistidosAntigos` WHERE `nome` LIKE \"%$nomeAssistido%\" ORDER BY `nome` ASC";
	
	//echo "sqlSearch = $sqlSearch<br>";
	$queryAssistidosAntigos = $conexao->query($sqlAssistidosAntigos);
	$resultAssistidosAntigos = $queryAssistidosAntigos->fetchAll( PDO::FETCH_ASSOC );
	$rowsAssistidosAntigos = count($resultAssistidosAntigos);
	
	if ($rowsSearch <= 0 && $rowsAssistidos <= 0 && $rowsAssistidosAntigos <= 0)
	{
		echo "<h3>Nenhum ";
			echo "Assistido, Autor ou Beneficiado ";
			echo "ou Réu ";
		echo "encontrado com esses dados.</h3>";
	}
	else
	{
		$cpfs = array();
		
		echo '
					<table class="table table-bordered table-hover" border="2" bordercolor=BLACK >
						<tbody>';
						
		echo '
				<tr align="center">
					<td><strong>Assistido</strong></td>
					<td><strong>Relação</strong></td>
				</tr>
		';
	
		echo "<tr><td colspan=\"2\" align=\"center\" bgcolor=\"#e6e6ff\"><strong>Assistidos com Casos no Escritorio</strong></td></tr>";
		for ($i=0;$i<$rowsSearch;$i++)
		{
			$cpf = $resultSearch[$i]['cpf'];
			if (in_array($cpf,$cpfs))
			{}
			else
			{
				array_push($cpfs,$cpf);
				$nome = $resultSearch[$i]['nome'];
				$reu = $resultSearch[$i]['reu'];
				$beneficiado = $resultSearch[$i]['beneficiado'];
				$autor = $resultSearch[$i]['autor'];
				$descricao = $resultSearch[$i]['descricao'];
				//echo "$i -> Nome = $nome -> reu = $reu -> beneficiado = $beneficiado -> autor = $autor -> descricao = $descricao -> nomeAssistido = $nomeAssistido<br>";
				echo "<tr>";
				echo "<td>";
					echo "<button type=\"submit\" name=\"mode\" value=\"verassistido$cpf\">$nome</button><br>";
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
		echo "<tr><td colspan=\"2\" align=\"center\" bgcolor=\"#e6e6ff\"><strong>Assistidos sem Casos no Escritorio</strong></td></tr>";
		for ($i=0;$i<$rowsAssistidos;$i++)
		{
			$cpf = $resultAssistidos[$i]['cpf'];
			if (in_array($cpf,$cpfs))
			{}
			else
			{
				array_push($cpfs,$cpf);
				$nome = $resultAssistidos[$i]['nome'];
				echo "<tr>";
				echo "<td>";
					echo "<button type=\"submit\" name=\"mode\" value=\"verassistido$cpf\">$nome</button><br>";
				echo "</td>";
				
				echo "<td>";
					echo "Assistido = $nome";
				echo "</td>";
				echo "</tr>";
			}
		}
		echo "<tr><td colspan=\"2\" align=\"center\" bgcolor=\"#e6e6ff\"><strong>Assistidos com Casos Antigos</strong></td></tr>";
		for ($i=0;$i<$rowsAssistidosAntigos;$i++)
		{
			$cpf = $rowsAssistidosAntigos[$i]['cpf'];
			if (in_array($cpf,$cpfs))
			{}
			else
			{
				array_push($cpfs,$cpf);
				$nome = $resultAssistidosAntigos[$i]['nome'];
				echo "<tr>";
				echo "<td>";
					echo "<button type=\"submit\" name=\"mode\" value=\"verassistido$cpf\">$nome</button><br>";
				echo "</td>";
				
				echo "<td>";
					echo "Assistido = $nome";
				echo "</td>";
				echo "</tr>";
			}
		}
		echo "</tbody> </table>";
	}
	
?>