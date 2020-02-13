<table class="table table-bordered"><tbody>
<td>Data de Inicio do Relatorio: </td><td><input class="form-control " type="date" name="dataInicio"></td>
<td>Data de Termino do Relatorio: </td><td><input class="form-control " type="date" name="dataFim"></td></tr>
<tr>
	<td align="center"> Tipo </td>
	<td colspan="3" align="center" >
		<select name="tipo" onchange="showOption(); return false;" class="form-control " id="id_select" >
			<option value=""></option>
			<option value="id_tableAluno">Aluno</option>
			<option value="id_tableCliente">Cliente</option>
		</select>
	</td>
</tr>

</tbody></table>

<table class="table table-bordered" id="id_tableCliente" style="display:none"><tbody>	
	<tr><td colspan="4" align="center"><input type="checkbox" name="blasd">Pesquisar por clientes inscritos no periodo</td></tr>
	<tr><td colspan="4" align="center"><input type="checkbox" name="retorno">Pesquisar por clientes em Retorno de Atendimento</td></tr>
	<tr><td colspan="4" align="center"><input type="checkbox" name="bairro">Pesquisar numero de clientes por bairro</td></tr>
	<tr><td colspan="4" align="center"><input type="checkbox" name="comunidade">Pesquisar numero de clientes por comunidade</td></tr>
	<tr><td colspan="4" align="center"><input type="checkbox" name="genero">Pesquisar numero de clientes por genero</td></tr>
	<tr><td colspan="4" align="center"><input type="checkbox" name="idade">Pesquisar numero de clientes por idade</td></tr>
	<tr><td colspan="4" align="center"><input type="checkbox" name="renda">Pesquisar numero de clientes por renda</td></tr>
	<tr><td colspan="4" align="center"><button type="submit" name="mode" value="relatorio" class="btn btn-primary">Ver</button></td></tr>
</tbody></table>

<table class="table table-bordered" id="id_tableAluno" style="display:none"><tbody>
	<tr><td colspan="4" align="center"><label> Ver Relatorio de Atividades Matricula:</label><input type="text" name="nomeAluno" placeholder="Matricula do Aluno"></td></tr>
	<tr>
		<td colspan="4" align="center">
			<label> Responsavel:</label>
			<select name="responsavel">
				<option value=""></option>
				<?php
					include('../utils/newconexao.php');
					$sqlResponsaveis = "SELECT * FROM atividades WHERE 1 ORDER BY responsavel ASC";
					$array_professores = array();
					$queryResponsaveis = $conexao->query($sqlResponsaveis);
					$resultResponsaveis = $queryResponsaveis->fetchAll(PDO::FETCH_ASSOC);
					for($i=0;$i<count($resultResponsaveis);$i++)
					{
						$responsavel = $resultResponsaveis[$i]['responsavel'];
						if (!in_array($responsavel,$array_professores))
						{
							array_push($array_professores,$responsavel);
						}
					}
					
					for($i=0;$i<count($array_professores);$i++)
					{
						$input = $array_professores[$i];
						echo "<option value=\"$input\">$input</option>";
					}
				?>
			</select>
		</td>
	</tr>
	<tr><td colspan="4" align="center"><input type="submit" value="Listar todas as atividades de Todos os Alunos" formaction="../dragndrop/teste.php" class="btn btn-primary"></td></tr>
	<tr><td colspan="4" align="center"><input type="checkbox" name="oab">Pesquisar numero de aprovados na OAB</td></tr>
	<tr><td colspan="4" align="center"><input type="checkbox" name="oab">Pesquisar numero de aprovados na OAB</td></tr>
	<tr><td colspan="4" align="center"><button type="submit" name="mode" value="relatorio" class="btn btn-primary">Ver</button></td></tr>
</tbody></table>

<script>
	function showOption()
	{
		var choice = document.getElementById('id_select').value;
		console.log(choice);
		switch(choice)
		{
			case 'id_tableAluno':
				var hide = 'id_tableCliente';
			break;
			case 'id_tableCliente':
				var hide = 'id_tableAluno';
			break;
			default:
				vetor = document.getElementById('id_tableCliente');
				vetor.setAttribute("style","display:none");
				vetor = document.getElementById('id_tableAluno');
				vetor.setAttribute("style","display:none");
		}
		var vetor = document.getElementById(choice);
		vetor.setAttribute("style","");
		vetor.setAttribute("class","table table-bordered");
		vetor = document.getElementById(hide);
		vetor.setAttribute("style","display:none");

	}
</script>

<?php
	if (!empty($_POST['dataInicio']) && !empty($_POST['dataFim']))
	{
		$dataInicio = $_POST['dataInicio'];
		$dataFim = $_POST['dataFim'];
		
		$dataInicio = new DateTime($dataInicio);
		$dataFim = new DateTime($dataFim);
		$dataFim->setTime(23,59);
			
		include('../utils/newconexao.php');
		
		if (!empty($_POST['responsavel']))
		{
			include('../utils/documentos.php');
			include('../utils/professores.php');
			$responsavel = $_POST['responsavel'];
			$sqlAtendimentos = "SELECT * FROM atividades WHERE responsavel = \"$responsavel\" ORDER BY nome, dataAtv";
			$queryAtendimentos = $conexao->query($sqlAtendimentos);
			$resultAtendimentos = $queryAtendimentos->fetchAll(PDO::FETCH_ASSOC);
			
			echo "<table class=\"table table-bordered\"><tbody>";
			for($j=0;$j<count($resultAtendimentos);$j++)
			{
				$dataAtv = $resultAtendimentos[$j]['dataAtv'];
				if (strstr($dataAtv,"-")==false)
					continue;
				$dataAtual = new DateTime($resultAtendimentos[$j]['dataAtv']);
				
				if ($dataInicio > $dataAtual)
					continue;
				if ($dataFim < $dataAtual)
					continue;
				
				
				$index = $resultAtendimentos[$j]['index'];
				$matricula = $resultAtendimentos[$j]['matricula'];
				$nome = $resultAtendimentos[$j]['nome'];
				$tipo = $resultAtendimentos[$j]['tipo'];
				$descricao = $resultAtendimentos[$j]['descricao'];
				$matProfessor = PROFESSORES_GETMATRICULABYNAME($responsavel);
				$dir  = DOCUMENTS_GETDOCUMENTPATH($matProfessor)."/atividades";
				$filename = $index."-".$matricula."-Comprovante";
				$files = glob("$dir/$filename.*");
				$filePath = $files[0];
				if (file_exists($filePath))
					$anchor = "<a href=\"$filePath\" target=\"_blank\"><img src=\"../uploads/defaultAssets/download.png\" width=\"22%\" height=\"6%\"></a>";
				else
					$anchor = "Sem Documento";
				
				echo "<tr>
						<td align=\"center\" width=\"14%\">
							$matricula
						</td>
						<td align=\"center\" width=\"14%\">
							$nome
						</td>
						<td align=\"center\" width=\"14%\">
							$tipo
						</td>
						<td align=\"center\" width=\"14%\">
							$descricao
						</td>
						<td align=\"center\" width=\"14%\">
							$dataAtv
						</td>
						<td align=\"center\" width=\"14%\">
							$anchor
						</td>
					</tr>";
				
			}
			echo "</tbody></table>";
		}
		else if(isset($_POST['bairro']))
		{
			$cpfs = array();
			$bairros = array();
			$contBairros = array();
			$sqlAtendimentos = "SELECT * FROM atendimentos WHERE 1";
			$queryAtendimentos = $conexao->query($sqlAtendimentos);
			$resultAtendimentos = $queryAtendimentos->fetchAll(PDO::FETCH_ASSOC);
			
			for($j=0;$j<count($resultAtendimentos);$j++)
			{
				$dataAtual = new DateTime($resultAtendimentos[$j]['dataDeInscricao']);
				
				if ($dataInicio > $dataAtual)
					continue;
				if ($dataFim < $dataAtual)
					continue;
				
				$cpf = $resultAtendimentos[$j]['cpf'];
				if(in_array($cpf,$cpfs))
					continue;
				
				array_push($cpfs,$cpf);
				$sqlBairro = "SELECT * FROM assistidos WHERE cpf = \"$cpf\"";
				$queryBairro = $conexao->query($sqlBairro);
				if ($queryBairro != false)
				{
					$resultBairro = $queryBairro->fetchAll(PDO::FETCH_ASSOC);
					$bairro = strtoupper($resultBairro[0]['bairro']);
					$bairro = trim($bairro);
					$bairro = mb_strtoupper($bairro,'UTF-8');
					if(empty($bairro))
					{						
						$nome = $resultBairro[0]['nome'];
						if (empty($nome))
							continue;
					}
					
					if(!in_array($bairro,$bairros))
					{
						
						array_push($bairros,$bairro);
						array_push($contBairros,1);
					}
					else
					{
						$contBairros[array_search($bairro,$bairros)] += 1;
					}
				}
				
			}
			echo "<table class=\"table table-bordered\"><tbody>";
			echo "<th>Bairro</th><th>Cont</th>";
			
			for($i=0;$i<count($bairros);$i++)
			{
				$bairro = $bairros[$i];
				$contBairro = $contBairros[$i];
				if(empty($bairro))
				{
					
					$bairro = "---";
				}
				echo "<tr><td><button class=\"button-link\" name=\"mode\" value=\"pesquisa$bairro\">$bairro</button></td><td>$contBairro</td></tr>";
			}
			echo "</tbody></table>";
				
		}
		else if(isset($_POST['comunidade']))
		{
			$cpfs = array();
			$bairros = array();
			$contBairros = array();
			$sqlAtendimentos = "SELECT * FROM atendimentos WHERE 1";
			$queryAtendimentos = $conexao->query($sqlAtendimentos);
			$resultAtendimentos = $queryAtendimentos->fetchAll(PDO::FETCH_ASSOC);
			
			for($j=0;$j<count($resultAtendimentos);$j++)
			{
				$dataAtual = new DateTime($resultAtendimentos[$j]['dataDeInscricao']);
				if ($dataInicio > $dataAtual)
					continue;
				if ($dataFim < $dataAtual)
					continue;
				
				$cpf = $resultAtendimentos[$j]['cpf'];
				if(in_array($cpf,$cpfs))
					continue;
				
				array_push($cpfs,$cpf);
				$sqlBairro = "SELECT * FROM assistidos WHERE cpf = \"$cpf\"";
				$queryBairro = $conexao->query($sqlBairro);
				if ($queryBairro != false)
				{
					$resultBairro = $queryBairro->fetchAll(PDO::FETCH_ASSOC);
					$bairro = strtoupper($resultBairro[0]['comunidade']);
					if(empty($bairro))
					{						
						$nome = $resultBairro[0]['nome'];
						if (empty($nome))
							continue;
					}
					
					if(!in_array($bairro,$bairros))
					{
						array_push($bairros,$bairro);
						array_push($contBairros,1);
					}
					else
					{
						$contBairros[array_search($bairro,$bairros)] += 1;
					}
				}
				
			}
			echo "<table class=\"table table-bordered\"><tbody>";
			echo "<th>Comunidade</th><th>Cont</th>";
			
			for($i=0;$i<count($bairros);$i++)
			{
				$bairro = $bairros[$i];
				$contBairro = $contBairros[$i];
				if(empty($bairro))
				{
					$bairro = "VAZIO";
				}
				echo "<tr><td><button class=\"button-link\" name=\"mode\" value=\"comunidade$bairro\">$bairro</button></td><td>$contBairro</td></tr>";
			}
			echo "</tbody></table>";
				
		}
		else if(isset($_POST['idade']))
		{
			$arrayIdades = [0,0,0,0,0,0,0,0];
			$cpfs = array();
			
			$sqlAtendimentos = "SELECT * FROM atendimentos WHERE 1";
			$queryAtendimentos = $conexao->query($sqlAtendimentos);
			$resultAtendimentos = $queryAtendimentos->fetchAll(PDO::FETCH_ASSOC);
			
			$total = 0;
			for($j=0;$j<count($resultAtendimentos);$j++)
			{
				$dataAtual = new DateTime($resultAtendimentos[$j]['dataDeInscricao']);
				if ($dataInicio > $dataAtual)
					continue;
				if ($dataFim < $dataAtual)
					continue;
				
				$cpf = $resultAtendimentos[$j]['cpf'];
				if(in_array($cpf,$cpfs))
					continue;
				
				array_push($cpfs,$cpf);
				
				$sqlIdade = "SELECT * FROM assistidos WHERE cpf = \"$cpf\"";
				$queryIdade = $conexao->query($sqlIdade);
				if ($queryIdade != false)
				{
					$resultIdade = $queryIdade->fetchAll(PDO::FETCH_ASSOC);
					$dob = $resultIdade[0]['dob'];
					$anos = "";
					$total++;
					//echo "dob = $dob<br>";
					if(strstr($dob,"-")!= false)
					{
						
						$dob = substr($dob,5)."-".substr($dob,0,4);
						//echo "dob = $dob ->";
						$dob = str_replace("-","/",$dob);
						//echo "dob = $dob<br>";
						$dob = date_create($dob);
						$today = new DateTime("now");
						$interval = date_diff($dob, $today);
						$anos = $interval->format('%Y');
					}
					if(strstr($dob,"/")!= false)					
					{
						
						$dob = substr($dob,3,3).substr($dob,0,3).substr($dob,6);
						
						$dob = date_create($dob);
						$today = new DateTime("now");
						$interval = date_diff($dob, $today);
						$anos = $interval->format('%Y');
					}
					//echo "anos = $anos<br>";
					if ($anos == "")
						$arrayIdades[0]++;
					else if ($anos < 18)
						$arrayIdades[1]++;
					else if ($anos < 30)
						$arrayIdades[2]++;
					else if ($anos < 40)
						$arrayIdades[3]++;
					else if ($anos < 50)
						$arrayIdades[4]++;
					else if ($anos < 60)
						$arrayIdades[5]++;
					else if ($anos < 70)
						$arrayIdades[6]++;
					else
						$arrayIdades[7]++;
				}
				
			}
			$idades = ["sem informacao","18-", "18 <= idade < 30", "30 <= idade < 40", "40 <= idade < 50", "50 <= idade < 60", "60 <= idade < 70", "70+"];
			echo "<table class=\"table table-bordered\"><tbody>";
			echo "<th>Idade</th><th>Cont</th>";
			for($i=0;$i<count($arrayIdades);$i++)
			{
				$faixa = $idades[$i];
				$input = $arrayIdades[$i];				
				echo "<tr><td>$faixa</td><td>$input</td></tr>";
			}
			echo "<tr><td colspan=\"2\">Total = $total</td></tr>";
			echo "</tbody></table>";
				
		}
		else if(isset($_POST['genero']))
		{
			$arrayGeneros = array();
			$arrayQtd = $arrayGeneros;
			for($i=0;$i<count($arrayGeneros);$i++)
				$arrayQtd[$i] = 0;
			
			$cpfs = array();
			
			$sqlAtendimentos = "SELECT * FROM atendimentos WHERE 1";
			$queryAtendimentos = $conexao->query($sqlAtendimentos);
			$resultAtendimentos = $queryAtendimentos->fetchAll(PDO::FETCH_ASSOC);
			
			$total = 0;
			for($j=0;$j<count($resultAtendimentos);$j++)
			{
				$dataAtual = new DateTime($resultAtendimentos[$j]['dataDeInscricao']);
				if ($dataInicio > $dataAtual)
					continue;
				if ($dataFim < $dataAtual)
					continue;
				
				$cpf = $resultAtendimentos[$j]['cpf'];
				if(in_array($cpf,$cpfs))
					continue;
				
				array_push($cpfs,$cpf);
				
				$sqlIdade = "SELECT * FROM assistidos WHERE cpf = \"$cpf\"";
				$queryIdade = $conexao->query($sqlIdade);
				if ($queryIdade != false)
				{
					$resultIdade = $queryIdade->fetchAll(PDO::FETCH_ASSOC);
					$genero = $resultIdade[0]['genero'];
					/*echo "genero = $genero<br>";
					if ($genero == "---")
					{
						echo "cpf = $cpf<br>";
					}*/
					$total++;
					//echo "dob = $dob<br>";
					if (!in_array($genero,$arrayGeneros))
					{
						array_push($arrayGeneros,$genero);
					}
					
					for($i=0;$i<count($arrayGeneros);$i++)
					{
						if ($genero == $arrayGeneros[$i])
							$arrayQtd[$i]++;
					}
				}
				
			}
			echo "<table class=\"table table-bordered\"><tbody>";
			echo "<th>Generos</th><th>Cont</th>";
			for($i=0;$i<count($arrayGeneros);$i++)
			{
				$genero = $arrayGeneros[$i];
				$input = $arrayQtd[$i];				
				echo "<tr><td>$genero</td><td>$input</td></tr>";
			}
			echo "<tr><td colspan=\"2\">Total = $total</td></tr>";
			echo "</tbody></table>";
				
		}	
		else if(isset($_POST['renda']))
		{
			$arrayRenda = array();
			$arrayQtd = $arrayRenda;
			$arrayRendaNula = array();
			$cpfs = array();
			
			$sqlAtendimentos = "SELECT * FROM atendimentos WHERE 1";
			$queryAtendimentos = $conexao->query($sqlAtendimentos);
			$resultAtendimentos = $queryAtendimentos->fetchAll(PDO::FETCH_ASSOC);
			
			$total = 0;
			for($j=0;$j<count($resultAtendimentos);$j++)
			{
				$dataAtual = new DateTime($resultAtendimentos[$j]['dataDeInscricao']);
				if ($dataInicio > $dataAtual)
					continue;
				if ($dataFim < $dataAtual)
					continue;
				
				$cpf = $resultAtendimentos[$j]['cpf'];
				if(in_array($cpf,$cpfs))
					continue;
				
				array_push($cpfs,$cpf);
				
				$sqlRenda = "SELECT * FROM assistidos WHERE cpf = \"$cpf\"";
				$queryRenda = $conexao->query($sqlRenda);
				if ($queryRenda != false)
				{
					$resultRenda = $queryRenda->fetchAll(PDO::FETCH_ASSOC);
					$renda = $resultRenda[0]['renda'];
					
					if (strstr($renda,",") === false && strstr(strtolower($renda),"sem renda") === false)
						array_push($arrayRendaNula,$cpf);
					
					/*if(empty($renda))
					{
						array_push($arrayRendaNula,$cpf);
					}*/
					
					if(!in_array($renda,$arrayRenda))
					{
						array_push($arrayRenda,$renda);
					}
					
					for($i=0;$i<count($arrayRenda);$i++)
					{
						if ($arrayRenda[$i] == $renda)
						{
							$arrayQtd[$i]++;
						}
					}
				}
				
			}
			echo "<table class=\"table table-bordered\"><tbody>";
			echo "<th>Rendas</th><th>Cont</th>";
			for($i=0;$i<count($arrayRenda);$i++)
			{
				$renda = $arrayRenda[$i];
				$input = $arrayQtd[$i];				
				echo "<tr><td>$renda</td><td>$input</td></tr>";
			}
			$total = count($arrayRendaNula);
			echo "<tr><td colspan=\"2\">Total = $total</td></tr>";
			echo "</tbody></table>";
			
			echo "<br><br>";
			echo "<table class=\"table table-bordered\"><tbody>";
			echo "<tr><td colspan=\"2\" align=\"center\"><strong>Clientes com Renda Bugada</strong></td></tr>";
			echo "<th>CPF</th><th>CPF</th>";
			for($i=0;$i<count($arrayRendaNula);$i+=2)
			{
				$cpf1 = $arrayRendaNula[$i];
				$cpf2 = "";
				if($i+1 < count($arrayRendaNula))
					$cpf2 = $arrayRendaNula[$i+1];
				echo "<tr><td><button class=\"btn btn-primary\" formaction=\"../triagem/procurar.php\" type=\"submit\" value=\"$cpf1\" name=\"cpf\">$cpf1</button></td><td><button class=\"btn btn-primary\" formaction=\"../triagem/procurar.php\" type=\"submit\" value=\"$cpf2\" name=\"cpf\">$cpf2</button></td></tr>";
			}
			echo "</tbody></table>";
				
		}	
		else if(isset($_POST['retorno']))
		{
			$responsaveis = array();
			
			$sqlAtendimentos = "SELECT * FROM relatorio WHERE 1 ORDER BY Responsavel";
			$queryAtendimentos = $conexao->query($sqlAtendimentos);
			$resultAtendimentos = $queryAtendimentos->fetchAll(PDO::FETCH_ASSOC);
			
			$total = 0;
			for($j=0;$j<count($resultAtendimentos);$j++)
			{
				$dataAtual = new DateTime($resultAtendimentos[$j]['Data']);
				if ($dataInicio > $dataAtual)
					continue;
				if ($dataFim < $dataAtual)
					continue;
				
				$responsavel = $resultAtendimentos[$j]['Responsavel'];
				array_push($responsaveis,$responsavel);
				
			}
			
			$teste = array_count_values($responsaveis);
				
			echo "<table class=\"table table-bordered\"><tbody>";
			echo "<th>Resposavel</th><th>Cont</th>";
			foreach($teste as $key => $value) 
			{
				echo "<tr><td>$key</td><td>$value</td></tr>";
			}
			echo "</tbody></table>";
			
		}
		else
		{
			$sqlProfessor = "SELECT * FROM professores WHERE 1 ORDER BY `disciplina`";
			$queryProfessor = $conexao->query($sqlProfessor);
			$resultProfessor = $queryProfessor->fetchAll(PDO::FETCH_ASSOC);
			
			$totalArquivados = 0;
			$totalOrientacoes = 0;
			$totalAndamentos = 0;
			
			$searchInicio = $_POST['dataInicio'];
			$searchFim = $_POST['dataFim'];
			
			echo "<input type=\"hidden\" name=\"searchInicio\" value=\"$searchInicio\">";
			echo "<input type=\"hidden\" name=\"searchFim\" value=\"$searchFim\">";
			
			echo "<table class=\"table table-bordered\"><tbody>";
			echo "<th>Responsavel</th><th>Em Andamento</th><th>Arquivados</th><th>Somente Orientação</th>";
			
			for($i=0;$i<count($resultProfessor);$i++)
			{
				
				if($i%10 == 0 && $i>0)
				{
					echo "<td align=\"center\"><strong>Responsavel</strong></td><td align=\"center\"><strong>Em Andamento</strong></td><td align=\"center\"><strong>Arquivados</strong></td><td align=\"center\"><strong>Somente Orientação</strong></td>";
				}
				
				$responsavel = $resultProfessor[$i]['nome'];
				$sqlAtendimentos = "SELECT * FROM atendimentos WHERE responsavel = \"$responsavel\"";
				$queryAtendimentos = $conexao->query($sqlAtendimentos);
				$resultAtendimentos = $queryAtendimentos->fetchAll(PDO::FETCH_ASSOC);
				
				echo "<tr><td><button class=\"button-link\" value=\"relatorioprofessor$responsavel\" name=\"mode\"> $responsavel</button></td>";
				$arquivados = 0;
				$orientacoes = 0;
				$andamento = 0;
				for($j=0;$j<count($resultAtendimentos);$j++)
				{
					$dataAtual = new DateTime($resultAtendimentos[$j]['dataDeInscricao']);
					
					if ($dataInicio > $dataAtual)
						continue;
					if ($dataFim < $dataAtual)
						continue;
					if($resultAtendimentos[$j]['arquivado'] == 1)
					{
						$arquivados += 1;
						$totalArquivados += 1;
					}
					else
					{
						$andamento += 1;
						$totalAndamentos += 1;
					}
					
					if($resultAtendimentos[$j]['orientacao'] == 1)
					{
						$orientacoes += 1;
						$totalOrientacoes += 1;
					}
				}
				
				echo "<td>$andamento</td>";
				echo "<td>$arquivados</td>";
				echo "<td>$orientacoes</td>";
				
				
				
				echo "</tr>";
			}
			
				echo "<strong><tr><td align=\"center\">Total</td><td align=\"center\">$totalAndamentos</td><td align=\"center\">$totalArquivados</td><td align=\"center\">$totalOrientacoes</td><tr></strong>";
				echo "</tbody></table>";
			
		}
		
		
	}
	if(isset($_POST['oab']))
	{
		include('../utils/newconexao.php');
		$sqlProfessor = "SELECT * FROM `alunos` WHERE `oab`=1";
		$queryProfessor = $conexao->query($sqlProfessor);
		$resultProfessor = $queryProfessor->fetchAll(PDO::FETCH_ASSOC);
		
		$sqlEMA = "SELECT * from `alunos` WHERE `primFase` > 40 ORDER BY `disciplina`";
		$queryEMA = $conexao->query($sqlEMA);
		$resultEMA = $queryEMA->fetchAll(PDO::FETCH_ASSOC);
		
		echo "<table class=\"table table-bordered\"><tbody>";
		
		echo "<tr><td align=\"center\" colspan=\"3\">Total Alunos com OAB = ".count($resultProfessor)."</td></tr>";
		echo "<tr><td align=\"center\" colspan=\"3\">Total Alunos com PrimFase > 40 = ".count($resultEMA)."</td></tr>";
		echo "<td align=\"center\"><strong>Matricula</strong></td><td align=\"center\"><strong>Nome</strong></td><td align=\"center\"><strong>Email</strong></td>";
		
		$ema1 = 0;
		$ema2 = 0;
		$ema3 = 0;
		$ema4 = 0;
		for($i=0;$i<count($resultEMA);$i++)
		{
			$matricula = $resultEMA[$i]['matricula'];
			$nome = $resultEMA[$i]['nome'];
			$ema = $resultEMA[$i]['disciplina'];
			if($ema == "JUR1961")
				$ema1 += 1;
			if($ema == "JUR1962")
				$ema2 += 1;
			if($ema == "JUR1963")
				$ema3 += 1;
			if($ema == "JUR1964")
				$ema4 += 1;
			
			echo "<tr>";
				echo "<td align=\"center\">$matricula</td><td align=\"center\">$nome</td><td align=\"center\">$ema</td>";
			echo "</tr>";
		}
		
		if ($ema1 != 0)
		{
			echo "<tr>";
				echo "<td align=\"center\" colspan=\"3\">Total ema1 = $ema1</td>";
			echo "</tr>";
		}
		if ($ema2 != 0)
		{
			echo "<tr>";
				echo "<td align=\"center\" colspan=\"3\">Total ema2 = $ema2</td>";
			echo "</tr>";
		}
		if ($ema3 != 0)
		{
			echo "<tr>";
				echo "<td align=\"center\" colspan=\"3\">Total ema3 = $ema3</td>";
			echo "</tr>";
		}
		if ($ema4 != 0)
		{
			echo "<tr>";
				echo "<td align=\"center\" colspan=\"3\">Total ema4 = $ema4</td>";
			echo "</tr>";
		}
		
	}
	if(!empty($_POST['nomeAluno']))
	{
		include('../utils/documentos.php');
		include('../utils/professores.php');
		
		$matricula = $_POST['nomeAluno'];
		$sqlAtividades = "SELECT * FROM `atividades` WHERE `matricula` = $matricula ORDER BY disciplina, dataAtv";
		$queryAtividades = $conexao->query($sqlAtividades);
		$resultAtividades = $queryAtividades->fetchAll(PDO::FETCH_ASSOC);
		$horas = 0;
		$nome = $resultAtividades[0]['nome'];
		
		$colspan=7;
		echo "<table class=\"table table-bordered\"><tbody>";
		echo "<tr><td colspan=\"$colspan\" align=\"center\"><strong>$nome</strong></td></tr>";
		echo "<tr>
			<td align=\"center\"><strong>
				Responsavel
			</strong></td>
			<td align=\"center\"><strong>
				Tipo
			</strong></td>
			<td align=\"center\"><strong>
				Atividade
			</strong></td>
			<td align=\"center\"><strong>
				Descricao
			</strong></td>
			<td align=\"center\"><strong>
				Horas
			</strong></td>
			<td align=\"center\"><strong>
				Data
			</strong></td>
			<td align=\"center\"><strong>
				Comprovante
			</strong></td>
		</tr>";
		$auxDisciplina = "";
		for($i=0;$i<count($resultAtividades);$i++)
		{
			$index = $resultAtividades[$i]['index'];
			$responsavel = $resultAtividades[$i]['responsavel'];
			$tipo = $resultAtividades[$i]['tipo'];
			$atividade = $resultAtividades[$i]['atividade'];
			$descricao = $resultAtividades[$i]['descricao'];
			$hora = $resultAtividades[$i]['horas'];
			$data = $resultAtividades[$i]['dataAtv'];
			$disciplina = $resultAtividades[$i]['disciplina'];
			
			if($disciplina != $auxDisciplina)
			{
				if($auxDisciplina != "")
					echo "<tr><td colspan=\"$colspan\" align=\"center\">Total de Horas $auxDisciplina = <strong>$horas</strong></h4></td></tr>";
				
				$auxDisciplina = $disciplina;
				echo "<tr bgcolor=\"#ccc\" ><td colspan=\"$colspan\" align=\"center\"><h4><strong>$disciplina</strong></h4></td></tr>";
				echo "<tr>
					<td align=\"center\"><strong>
						Responsavel
					</strong></td>
					<td align=\"center\"><strong>
						Tipo
					</strong></td>
					<td align=\"center\"><strong>
						Atividade
					</strong></td>
					<td align=\"center\"><strong>
						Descricao
					</strong></td>
					<td align=\"center\"><strong>
						Horas
					</strong></td>
					<td align=\"center\"><strong>
						Data
					</strong></td>
					<td align=\"center\"><strong>
						Comprovante
					</strong></td>
				</tr>";
				$horas = 0;
			}
			
			$horas += $resultAtividades[$i]['horas'];
			$matProfessor = PROFESSORES_GETMATRICULABYNAME($responsavel);
			$dir  = DOCUMENTS_GETDOCUMENTPATH($matProfessor)."/atividades";
			$filename = $index."-".$matricula."-Comprovante";
			$files = glob("$dir/$filename.*");
			$filePath = $files[0];
			if (file_exists($filePath))
				$anchor = "<a href=\"$filePath\" target=\"_blank\"><img src=\"../uploads/defaultAssets/download.png\" width=\"22%\" height=\"6%\"></a>";
			else
				$anchor = "Sem Documento";
			
			echo "<tr>
				<td align=\"center\" width=\"21%\">
					$responsavel
				</td>
				<td align=\"center\" width=\"14%\">
					$tipo
				</td>
				<td align=\"center\" width=\"14%\">
					$atividade
				</td>
				<td align=\"center\" width=\"14%\">
					$descricao
				</td>
				<td align=\"center\" width=\"7%\">
					$hora
				</td>
				<td align=\"center\" width=\"14%\">
					$data
				</td>
				<td align=\"center\" width=\"14%\">
					$anchor
				</td>
			</tr>";
		}
		echo "<tr><td colspan=\"7\" align=\"center\">Total de Horas $disciplina = <strong>$horas</strong></td></tr>";
		echo "</tbody></table>";
	}
?>