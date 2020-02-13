<?php
		include('newconexao.php');
		
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
			
			$sqlVisitas = "SELECT * FROM visitasAbertas WHERE disciplina = \"$disciplina\"";
			$queryVisitas = $conexao->query($sqlVisitas);
			$resultVisitas = $queryVisitas->fetchAll( PDO::FETCH_ASSOC );
			$rowsVisitas = count($resultVisitas);
			
			if ($rowsVisitas>0)
			{
				for($i=0;$i<$rowsVisitas;$i++)
				{
					$vagas = $resultVisitas[$i]['vagas'];
					$aberta = $resultVisitas[$i]['aberta'];
					if (strstr($vagas,$turma."--") != false || strstr($vagas,$turma."00") != false || $aberta == 0)
					{
						
					}
					else
					{
						$local = $resultVisitas[$i]['local'];
						$professor = $resultVisitas[$i]['professor'];
						$horario = $resultVisitas[$i]['horario'];
						$nomeDaAtividade = $resultVisitas[$i]['nome'];
						$descricao = $resultVisitas[$i]['descricao'];
						$id = $resultVisitas[$i]['ID'];					
						
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
										<td width='30%'><strong>Professor</strong></td>
										<td width='70%'>$professor</td>
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
										<td width='30%'><strong>Descrição</strong></td>
										<td width='70%'>$descricao</td>
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
										<td colspan=\"2\" align='center'> <button value=\"vervisita$id\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" onclick=\"eatFood(); return false;\">Inscrever-se</button></td>
										</tr>
										";					
						
						
						echo' 		</tbody>
								</table>';
					}
							
				}
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
	
	
	
	
	
	
	
	
	
	
	