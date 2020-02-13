<?php
		include('../utils/newconexao.php');
		$matricula = $_POST['matricula'];
		
		$sql = "SELECT * FROM alunos WHERE matricula = $matricula ";
		$query = $conexao->query($sql);
		$result = $query->fetchAll( PDO::FETCH_ASSOC );
		$rows = count($result);
		
		if($rows > 0)
		{
			$turma = $result[0]['turma'];
			$turma = $turma[2];
			$disciplina = $result[0]['disciplina'];
			$nome = $result[0]['nome'];			
			
			{
				$sqlVisitas = "SELECT * FROM `visitasAlunos` WHERE `Matricula` = $matricula";
				//echo "sqlMatricula = $sqlVisitas<br>";
				$queryVisitas = $conexao->query($sqlVisitas);
				$resultVisitas = $queryVisitas->fetchAll(PDO::FETCH_ASSOC);
				if (count($resultVisitas) > 0)
				{
					$doOnce = true;
					for($i=0;$i<count($resultVisitas);$i++)
					{
						
						$visitaID = $resultVisitas[$i]['VisitaID'];
						$visitaTurma = $resultVisitas[$i]['Turma'];
						$visitaEspera = $resultVisitas[$i]['Espera'];
						
						$sqlInfoVisitas = "SELECT * FROM `visitasAbertas` WHERE `ID` = $visitaID AND `aberta` = 1";
						$queryInfoVisitas = $conexao->query($sqlInfoVisitas);
						if ($queryInfoVisitas == false)
							continue;
						
						$resultInfoVisitas = $queryInfoVisitas->fetchAll(PDO::FETCH_ASSOC);
						if (count($resultInfoVisitas) == 0)
							continue;
							
						if($doOnce)
						{
							echo "<table class=\"table table-bordered\">";
							echo "<tr><td colspan=\"4\" style=\"background-color:#555\"></td></tr>";
							echo "<tr><td colspan=\"4\" align=\"center\"><strong>Você está inscrita nas seguintes visitas</strong></td></tr>";
							echo "<tr><td align=\"center\">Professor</td><td align=\"center\">Nome da Visita</td><td align=\"center\">Lista de Espera?</td><td align=\"center\">Delete</td></tr>";
							$doOnce = false;
						}						
							
						$nomeVisita = $resultInfoVisitas[0]['nome'];
						$professorVisita = $resultInfoVisitas[0]['professor'];
						
						$visitaEspera = ($visitaEspera==0)?"Não":"Sim";
						
						echo "<tr>";
							echo "<td align=\"center\">";
								echo "$professorVisita";
							echo "</td>";
							echo "<td align=\"center\">";
								echo "$nomeVisita";
							echo "</td>";
							echo "<td align=\"center\">";
								echo "$visitaEspera";
							echo "</td>";
							echo "<td align=\"center\">";
								echo "<button value=\"$visitaID\" name=\"deleteData\" formaction=\"deleteVisita.php\">X</button>";
							echo "</td>";
						echo "</tr>";
					}
					echo "<tr><td colspan=\"4\" style=\"background-color:#555\"></td></tr>";
					echo "</table>";
				}
		}
			
			
			
			$sqlVisitas = "SELECT * FROM visitasAbertas WHERE disciplina = \"$disciplina\"";
			$queryVisitas = $conexao->query($sqlVisitas);
			$resultVisitas = $queryVisitas->fetchAll( PDO::FETCH_ASSOC );
			$rowsVisitas = count($resultVisitas);
			if ($rowsVisitas>0)
			{
				$cont = 0;
				for($i=0;$i<$rowsVisitas;$i++)
				{
					$vagas = $resultVisitas[$i]['vagas'];
					$aberta = $resultVisitas[$i]['aberta'];
					$temVagas = true;
					if ($aberta == 0)
						continue;
					
					if (strstr($vagas,$turma."--") != false)
					{
						$cont++;
						$temVagas = false;
					}
					
					$temListaEspera = false;
					if(strstr($vagas,$turma."00") != false)
					{
						$temListaEspera = true;
					}
					
					
					{
						$local = $resultVisitas[$i]['local'];
						$tag = $resultVisitas[$i]['tag'];
						$professor = $resultVisitas[$i]['professor'];
						$horario = $resultVisitas[$i]['horario'];
						$nomeDaAtividade = $resultVisitas[$i]['nome'];
						$descricao = $resultVisitas[$i]['descricao'];
						$id = $resultVisitas[$i]['ID'];		
						$vagasRestantes = intval(substr($vagas,strstr($vagas,$turma)+1,2));			
						
						$sameTag = false;
						if ($tag != "")
						{
							$sqlTag = "SELECT * FROM `visitasAlunos` WHERE `tag` = \"$tag\" AND `Matricula` = $matricula";
							$queryTag = $conexao->query($sqlTag);
							if ($queryTag != false)
							{
								$resultTag = $queryTag->fetchAll(PDO::FETCH_ASSOC);
								if (count($resultTag) > 0)
									$sameTag = true;;
							}	
						}						
						
						$sqlInscrito = "SELECT * FROM `visitasAlunos` WHERE `Matricula` = $matricula AND `VisitaID` = $id";
						$queryInscrito = $conexao->query($sqlInscrito);
						$resultInscrito = $queryInscrito->fetchAll(PDO::FETCH_ASSOC);
						
						$disabled = false;
						if (count($resultInscrito) > 0)
							$disabled = true;
						
						if($professor == "LUCAS P NEPOMUCENO" && $matricula != 111111)
							continue;
						
						
						echo '
								<table class="table table-bordered table-striped table-hover">
									<tbody>';
					
						
							
						echo '
										<tr  >
										<th bgcolor="#AAAAAA" colspan = "2" style="text-align:center" ><strong>'.$nomeDaAtividade.'</strong></th>
										</tr>
										';
							
										
						echo "
										<tr>
										<td colspan=\"2\" align=\"center\"><strong>$descricao</strong></td>
										</tr>
										";
						
										
						echo "
										<tr>
										<td width='30%'><strong>Local</strong></td>
										<td width='70%'>$local</td>
										</tr>
										";
										
						echo "
										<tr>
										<td width='30%'><strong>Horario</strong></td>
										<td width='70%'>$horario</td>
										</tr>
										";														

						echo "
										<tr>
										<td width='30%'><strong>Professor</strong></td>
										<td width='70%'>$professor</td>
										</tr>
										";														

						echo "
										<tr>
										<td width='30%'><strong>Vagas turma 2H$turma</strong></td>
										<td width='70%'>$vagasRestantes</td>
										</tr>
										";
						echo "
										<tr>
										<td colspan=\"2\" align='center'> ";
										
											if ($disabled == true)
												echo "<button value=\"vervisita$id\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" onclick=\"eatFood(); return false;\" disabled><s>Aluno já inscrito neste evento</s></button>";
											else if ($sameTag == true)
												echo "<button value=\"vervisita$id\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" onclick=\"eatFood(); return false;\" disabled><s>Aluno inscrito em atividade semelhante</s></button>";
											else if ($temVagas == false)
												echo "<button value=\"vervisita$id\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" onclick=\"eatFood(); return false;\" disabled><s>Vagas Esgotadas</s></button>";
											else if ($temListaEspera == true)
												echo "<button value=\"vervisita$id\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" onclick=\"eatFood(); return false;\">Inscrever-se para Lista de Espera</button>";
											else
												echo "<button value=\"vervisita$id\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" onclick=\"eatFood(); return false;\">Inscrever-se</button>";
										echo "</td>
										</tr>
										";					
						
						
						echo' 		</tbody>
								</table>';
					}
							
				}
				
				if($cont > 0)
					echo "<p class=\"text-center\">Existem $cont visitas com vagas esgotadas ou fechadas para a inscricao para a sua turma</p>";
			}
			else
			{
				echo '<div class="text-center">Não existem visitas abertas</div></br>';
			}

		}
		else{
			echo '<div class="text-center">Matrícula não cadastrada<br/>Por favor, procure a secretaria do NPJ – <a href="mailto:npj@puc-rio.com.br"> npj@puc-rio.br</a></div></br>';
		}
		
		
	?>
	
	
	
	
	
	
	
	
	
	
	