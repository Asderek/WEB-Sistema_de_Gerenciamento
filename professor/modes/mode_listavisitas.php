<?php
		include('newconexao.php');
		
		$matricula = $_POST['matricula'];
		
		$sql = "SELECT * FROM professores WHERE matricula = $matricula ";
		$query = $conexao->query($sql);
		$result = $query->fetchAll( PDO::FETCH_ASSOC );
		$rows = count($result);
		
		if($rows > 0)
		{

			$nome = $result[0]['nome'];			
			
			echo '<input type="hidden" name="matricula" value='.$matricula.'></input>';
			echo '<input type="hidden" name="nome" value='.$nome.'></input>';
			
			
			$sqlVisitas = "SELECT * FROM visitasAbertas WHERE professor = \"$nome\" ";
			$queryVisitas = $conexao->query($sqlVisitas);
			$resultVisitas = $queryVisitas->fetchAll( PDO::FETCH_ASSOC );
			$rowsVisitas = count($resultVisitas);
			
			if ($rowsVisitas>0)
			{
				for($i=0;$i<$rowsVisitas;$i++)
				{
					$local = $resultVisitas[$i]['local'];
					$vagasTotais = $resultVisitas[$i]['vagasTotais'];
					$horario = $resultVisitas[$i]['horario'];
					$nomeDaAtividade = $resultVisitas[$i]['nome'];
					
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
									<td width='70%'>$nome</td>
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
									<td colspan=\"2\" align='center'> <button value=\"vervisita$id\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" onclick=\"eatFood(); return false;\">Ver</button></td>
									</tr>
									";					
					
					
					echo' 		</tbody>
							</table>';
							
				}
			}
			else
			{
				echo '<div class="text-center">Professor não possui visitas cadastradas</div></br>';
			}

		}
		else{
			echo '<div class="text-center">Matrícula não cadastrada<br/>Por favor, procure a secretaria do NPJ – <a href="mailto:npj@puc-rio.com.br"> npj@puc-rio.br</a></div></br>';
		}
	?>
	
	
	
	
	
	
	
	
	
	
	