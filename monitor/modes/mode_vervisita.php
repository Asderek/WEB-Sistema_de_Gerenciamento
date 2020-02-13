<?php
			include('newconexao.php');
			
			$butaoClicado = $_POST['idVisita'];
			
			
			
			$sqlAtividade = "SELECT * FROM visitasAbertas WHERE ID = $butaoClicado";
			$queryAtividade = $conexao->query($sqlAtividade);
			$resultAtividade = $queryAtividade->fetchAll( PDO::FETCH_ASSOC );
			$rowsAtividade = count($resultAtividade);
			
			if ($rowsAtividade > 0)
			{
				$local = $resultAtividade[0]['local'];
				$horario = $resultAtividade[0]['horario'];
				$nomeDaAtividade = $resultAtividade[0]['nome'];
			}
			
			
			
			
			echo "
					<h1 class=\"text-center\">Núcleo de Prática Jurídica</h1><br>
					<h4 class=\"text-center\">$nomeDaAtividade</h4>
					<h4 class=\"text-center\">$local</h4>
					<h4 class=\"text-center\">$horario</h4>
				";
				
			echo "
					<h4 class=\"text-center\">Lista de Alunos inscritos</h4>
				";
			
			$sqlVisitas = "SELECT * FROM visitasAlunos WHERE VisitaID = $butaoClicado ORDER BY Espera";
			$queryVisitas = $conexao->query($sqlVisitas);
			$resultVisitas = $queryVisitas->fetchAll( PDO::FETCH_ASSOC );
			$rowsVisitas = count($resultVisitas);
			
			$sqlNumero = "SELECT * FROM visitasAlunos WHERE VisitaID = $butaoClicado AND Espera = 0";
			$queryNumero = $conexao->query($sqlNumero);
			$resultNumero = $queryNumero->fetchAll( PDO::FETCH_ASSOC );
			$rowsNumero = count($resultNumero);
			
			echo "<h5 class=\"text-center\">Alunos na lista Principal: $rowsNumero</h5>";
			$espera = $rowsVisitas - $rowsNumero;
			echo "<h5 class=\"text-center\">Alunos na lista de Espera: $espera</h5>";
			
			//echo "butaoClicado = $butaoClicado<br>";
			echo '
							<table class="table table-bordered table-hover">
								<tbody>';
			for($i=0;$i<$rowsVisitas;$i++)
			{		
				if ($resultVisitas[$i]['Espera'] == 0)
				{
					$matriculaAluno = $resultVisitas[$i]['Matricula'];
					$turma = $resultVisitas[$i]['Turma'];	
					$sqlInfo = "SELECT * FROM `alunos` WHERE `matricula` = $matriculaAluno";
					$queryInfo = $conexao->query($sqlInfo);
					$resultInfo = $queryInfo->fetchAll( PDO::FETCH_ASSOC );
					$rowsInfo = count($resultInfo);
					if($rowsInfo>0)
					{
						$nomeAluno = $resultInfo[0]['nome'];
						$email = $resultInfo[0]['email'];
					}
					echo "
								<tr>
								<td width='30%'><strong>Matricula</strong></td>
								<td width='70%'>$matriculaAluno</td>
								</tr>
								";
								
					echo "
								<tr>
								<td width='30%'><strong>Nome</strong></td>
								<td width='70%'>$nomeAluno</td>
								</tr>
								";	
								
					echo "
								<tr>
								<td width='30%'><strong>Turma</strong></td>
								<td width='70%'>$turma</td>
								</tr>
								";

					echo "
								<tr>
								<td width='30%'><strong>Email</strong></td>
								<td width='70%'>$email</td>
								</tr>
								";				

					echo "
								<tr bgcolor=\"#ddd\">
								<td bgcolor=\"#ddd\" colspan = \"2\"></td>
								</tr>
								";								
				}					
				else
				{
					break;
				}
			}
			
			echo "
								<tr>
								<td bgcolor=\"#AAAAAA\" colspan = \"2\" align = \"center\"><strong>LISTA DE ESPERA</strong></td>
								</tr>
								";
			
			for(;$i<$rowsVisitas;$i++)
			{
				if ($resultVisitas[$i]['Espera'] == 1)
				{					
					$matriculaAluno = $resultVisitas[$i]['Matricula'];
					$turma = $resultVisitas[$i]['Turma'];
					
					$sqlInfo = "SELECT * FROM alunos WHERE matricula = $matriculaAluno";
					$queryInfo = $conexao->query($sqlInfo);
					$resultInfo = $queryInfo->fetchAll( PDO::FETCH_ASSOC );
					$rowsInfo = count($resultInfo);
					
					if($rowsInfo>0)
					{
						$nomeAluno = $resultInfo[0]['nome'];
						$email = $resultInfo[0]['email'];
					}
					
					echo "
								<tr>
								<td width='30%'><strong>Matricula</strong></td>
								<td width='70%'>$matriculaAluno</td>
								</tr>
								";
								
					echo "
								<tr>
								<td width='30%'><strong>Nome</strong></td>
								<td width='70%'>$nomeAluno</td>
								</tr>
								";	
								
					echo "
								<tr>
								<td width='30%'><strong>Turma</strong></td>
								<td width='70%'>$turma</td>
								</tr>
								";

					echo "
								<tr>
								<td width='30%'><strong>Email</strong></td>
								<td width='70%'>$email</td>
								</tr>
								";

						echo "
								<tr bgcolor=\"#ddd\">
								<td bgcolor=\"#ddd\" colspan = \"2\"></td>
								</tr>
								";
				}
			}	
			echo' 		</tbody>
							</table>';
			
		?>