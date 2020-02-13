<?php
	include('newconexao.php');
	$matricula = $_POST['matricula'];
	$professor = $_POST['plantaoprofessor'];
	$cont = 0;
	echo '<input type="hidden" name="matricula" value='.$matricula.'></input>';
	echo "<input type=\"hidden\" name=\"professor\" value=\"$professor\"></input>";

	$matricula = filter_var($matricula,FILTER_SANITIZE_NUMBER_INT);

	$dias = array();

	$sqlAluno = "SELECT * FROM alunos WHERE matricula = $matricula";
	$queryAluno = $conexao->query($sqlAluno);
	$resultAluno = $queryAluno->fetchAll( PDO::FETCH_ASSOC );

	array_push($dias, "a");
	array_push($dias, "b");
	array_push($dias, "segunda");
	array_push($dias, "terca");
	array_push($dias, "quarta");
	array_push($dias, "quinta");
	array_push($dias, "sexta");
										
	$sqlProfessor = "SELECT * FROM horariosplantao WHERE nome = \"$professor\"";
	$queryProfessor = $conexao->query($sqlProfessor);
	$resultProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );

	if(count($resultProfessor) <= 0)
	{
		echo '<h5 class="text-center">Este professor nao está oferecendo plantoes</h5>';
		echo '<br>';
		echo '<a href="inicio.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
	}else if(count($resultAluno) <= 0)
	{
		echo '<h5 class="text-center">Aluno não está cadastrado no EMA</h5>';
		echo '<br>';
		echo '<a href="inicio.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
	}
	else 
	{
		$sqlInscricao = "SELECT * FROM alunosplantao WHERE matricula = $matricula";
		$queryInscricao = $conexao->query($sqlInscricao);
		$resultInscricao = $queryInscricao->fetchAll( PDO::FETCH_ASSOC );
		$rowsInscricao = count($resultInscricao);
		
		if(count($resultInscricao)>0)
		{
				echo "<h5 class=\"text-center\">Sua inscrição atual: <br><b>    Professor:  </b>".$resultInscricao[0]['professor'].'<br><b>     Horario:  </b>'.$resultInscricao[0]['horario'].'</h5><br>';
		}
		
		echo "<label for=\"label\">Escolha o dia e hora do seu plantão para o(a) professor(a) $professor: </label>";
		echo '<select class="form-control" id="escolha" name="escolha">';
		
		for($dia=2;$dia<7;$dia++)
		{
			if ($dia == $resultProfessor[0]['dia1'])
			{
				$start = $resultProfessor[0]['ini1'];
				$end = $resultProfessor[0]['fim1'];
				$maxAluno = $resultProfessor[0]['alunos1'];
				
				for(;$start<$end;$start++)
				{	
					$startM1 = $start+1;
					
					$sqlOverflow = "SELECT * FROM alunosplantao WHERE horario = \"$dias[$dia] - ";
					if ($start < 10)
						$sqlOverflow .= '0'.$start.":00 ~ ";
					else 
						$sqlOverflow .= $start.":00 ~ ";
					
					if ($startM1 < 10)
						$sqlOverflow .= '0'.$startM1.":00\"";
					else
						$sqlOverflow .= $startM1.":00\"";
					
					
					$sqlOverflow .= " AND professor = \"$professor\"";
					
					$queryOverflow = $conexao->query($sqlOverflow);
					$resultOverflow = $queryOverflow->fetchAll( PDO::FETCH_ASSOC );
					$rowsOverflow = count($resultOverflow);
		
					if($start<9)
					{
						if($rowsOverflow<$maxAluno)
						{
							echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00</option>';
							$cont++;
						}
						else
							echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00 - LOTADO</option>';
					}
					else if($start==9)
					{
						if($rowsOverflow<$maxAluno)
						{
							echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00</option>';
							$cont++;
						}
						else
							echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00 - LOTADO</option>';
					}
					else
					{
						if ($rowsOverflow<$maxAluno)
						{
							echo "<option name=\"$dia-$start\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00</option>';
							$cont++;
						}
						else
							echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00 - LOTADO</strike></option>';
					}
				}
			}
				
			if ($dia == $resultProfessor[0]['dia2'])
			{
				$start = $resultProfessor[0]['ini2'];
				$end = $resultProfessor[0]['fim2'];
				$maxAluno = $resultProfessor[0]['alunos2'];
				
				for(;$start<$end;$start++)
				{	
					$startM1 = $start+1;
					$sqlOverflow = "SELECT * FROM alunosplantao WHERE horario = \"$dias[$dia] - ";
					if ($start < 10)
						$sqlOverflow .= '0'.$start.":00 ~ ";
					else 
						$sqlOverflow .= $start.":00 ~ ";
					
					if ($startM1 < 10)
						$sqlOverflow .= '0'.$startM1.":00\"";
					else
						$sqlOverflow .= $startM1.":00\"";
					
					$sqlOverflow .= " AND professor = \"$professor\"";
					$queryOverflow = $conexao->query($sqlOverflow);
					$resultOverflow = $queryOverflow->fetchAll( PDO::FETCH_ASSOC );
					$rowsOverflow = count($resultOverflow);
				
				
					if($start<9)
					{
						if($rowsOverflow<$maxAluno)
						{
							echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00</option>';
							$cont++;
						}
						else
							echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00 - LOTADO</strike></option>';
					}
					else if($start==9)
					{
						if($rowsOverflow<$maxAluno)
						{
							echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00</option>';
							$cont++;
						}
						else
							echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00 - LOTADO</strike></option>';
					}
					else
					{
						if ($rowsOverflow<$maxAluno)
						{
							echo "<option name=\"$dia-$start\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00</option>';
							$cont++;
						}
						else
							echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00 - LOTADO</strike></option>';
					}
				}
			}
				
			if ($dia == $resultProfessor[0]['dia3'])
			{
				$start = $resultProfessor[0]['ini3'];
				$end = $resultProfessor[0]['fim3'];
				$maxAluno = $resultProfessor[0]['alunos3'];
				
				for(;$start<$end;$start++)
				{	
					$startM1 = $start+1;
					$sqlOverflow = "SELECT * FROM alunosplantao WHERE horario = \"$dias[$dia] - ";
					if ($start < 10)
						$sqlOverflow .= '0'.$start.":00 ~ ";
					else 
						$sqlOverflow .= $start.":00 ~ ";
					
					if ($startM1 < 10)
						$sqlOverflow .= '0'.$startM1.":00\"";
					else
						$sqlOverflow .= $startM1.":00\"";
				
				
					$sqlOverflow .= " AND professor = \"$professor\"";
					$queryOverflow = $conexao->query($sqlOverflow);
					$resultOverflow = $queryOverflow->fetchAll( PDO::FETCH_ASSOC );
					$rowsOverflow = count($resultOverflow);
					
					
					if($start<9)
					{
						if($rowsOverflow<$maxAluno)
						{
							echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00</option>';
							$cont++;
						}
						else
							echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00 - LOTADO</strike></option>';
					}
					else if($start==9)
					{
						if($rowsOverflow<$maxAluno)
						{
							echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00</option>';
							$cont++;
						}
						else
							echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00 - LOTADO</strike></option>';
					}
					else
					{
						if ($rowsOverflow<$maxAluno)
						{
							echo "<option name=\"$dia-$start\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00</option>';
							$cont++;
						}
						else
							echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00 - LOTADO</strike></option>';
					}
				}
			}
		}
		echo '</select>';
		
		
	}
	if ($cont != 0)
	{
		echo '
				<br><button type="submit" class="btn btn-primary btn-lg btn-block" formaction="cadastrarplantao.php">Escolher</button>
			  ';
	}
	else
	{
		echo "<br><h4 class=\"text-center\"> Este professor não possui mais vagas abertas, por favor, volte e selecione outro</h4>";
		echo "<a href=\"javascript:history.go(-1)\" class=\"btn btn-primary btn-lg btn-block\">Voltar</a>";
	}
				  
?>