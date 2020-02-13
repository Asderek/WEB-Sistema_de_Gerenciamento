<?php

	include('../../newconexao.php');

	$matricula= $_POST['matricula'];
	$butaoClicado = $_POST['redirect'];
	
	$sqlAluno = "SELECT * FROM alunos WHERE matricula = $matricula";
	$queryAluno = $conexao->query($sqlAluno);
	$resultAluno = $queryAluno->fetchAll(PDO::FETCH_ASSOC);
	$turma = $resultAluno[0]['turma'];
	
	$sqlVisitas = "SELECT * FROM visitasAbertas WHERE ID = $butaoClicado ";
	$queryVisitas = $conexao->query($sqlVisitas);
	$resultVisitas = $queryVisitas->fetchAll( PDO::FETCH_ASSOC );
	$rowsVisitas = count($resultVisitas);
	
	$tag = $resultVisitas[0]['tag'];
	
	$sqlMesmaTag = "SELECT * FROM `visitasAlunos` WHERE `Matricula` = $matricula AND `tag` = \"$tag\"";
	$queryMesmaTag = $conexao->query($sqlMesmaTag);
	$resultMesmaTag = $queryMesmaTag->fetchAll(PDO::FETCH_ASSOC);
	if (count($resultMesmaTag) > 0)
	{
		echo '<h5 class="text-center">Aluna já está inscrita em atividade semelhante.<p></p></h5>';
	}
	else
	{
		switch ($turma)
		{
			case "2HA":
				$indice = 1;
				break;
			case "2HB":
				$indice = 4;
				break;
			case "2HC":
				$indice = 7;
				break;
			case "2HD":
				$indice = 10;
				break;
			case "2HE":
				$indice = 13;
				break;
			case "2HF":
				$indice = 16;
				break;
			case "2HG":
				$indice = 19;
				break;
			case "2HH":
				$indice = 22;
				break;
			case "2HX":
				$indice = 25;
				break;														
		}
		
		$vg = $resultVisitas[0]['vagas'][$indice].$resultVisitas[0]['vagas'][$indice+1];
		//echo "VG = $vg<br>";
		$vagasTurma = intval($vg);
		//echo "vagasTurma = $vagasTurma<br>";
		//echo "strinVagas = ".$resultVisitas[0]['vagas'];
		if($vg == "--")
		{
			echo '<h5 class="text-center">O professor não disponibilizou vagas para esta turma.<p></p>';
			//echo '<a href="index.html" class="btn btn-primary btn-lg btn-block">Página Inicial</a>';
		}
		else if($vagasTurma == 0)
		{
			$sqlInsereAluno = "INSERT INTO `visitasAlunos`(`Matricula`, `VisitaID`, `Turma`, `Espera`, `tag` ) VALUES ($matricula,$butaoClicado,\"$turma\", 1, \"$tag\")";
			$queryInsereAluno = $conexao->query($sqlInsereAluno);
			if($queryInsereAluno != false)
			{
				echo '<h5 class="text-center">Sua inscrição para a lista de espera está confirmada!.<p></p>';
				//echo '<a href="index.html" class="btn btn-primary btn-lg btn-block">Página Inicial</a>';
			}
			else
			{
				echo "errei em inserir aluno";
				//echo '<a href="index.html" class="btn btn-primary btn-lg btn-block">Página Inicial</a>';
			}
		}
		else
		{
			$sqlAlunoJaInscrito = "SELECT * FROM `visitasAlunos` WHERE `Matricula` = $matricula AND `VisitaID` = $butaoClicado";
			$queryAlunoJaInscrito = $conexao->query($sqlAlunoJaInscrito);
			$resultAlunoJaInscrito = $queryAlunoJaInscrito->fetchAll( PDO::FETCH_ASSOC );
			$rowsInscrito = count($resultAlunoJaInscrito);
			
			if($rowsInscrito>0)
			{
				echo '<h5 class="text-center">Aluno já se inscreveu nessa atividade.<p></p>';
				//echo '<a href="index.html" class="btn btn-primary btn-lg btn-block">Página Inicial</a>';
			}
			else
			{
				$stringOriginal = $resultVisitas[0]['vagas'];
				$stringModificada = $stringOriginal;
				
				for($i=0;$i<strlen($stringOriginal);$i++)
				{
					if($i == $indice)
					{
						if($vg[1] == '0')
						{
							$char = $stringOriginal[$i];
							$char--;
							$stringModificada[$i] = $char;
						}
						else 
						{
							$stringModificada[$i] = $stringOriginal[$i];
						}
					}
					else if ($i == $indice+1)
					{
						if($vg[1] == '0' && $vg[0] != 0)
						{
							$char = $stringOriginal[$i];
							$char--;
							$stringModificada[$i] = '9';
						}
						else 
						{
							$char = $stringOriginal[$i];
							$char--;
							$stringModificada[$i] = $char;
						}
					}
					else
					{
						$stringModificada[$i] = $stringOriginal[$i];
					}
				}
				
				$sqlUpdate = " UPDATE `visitasAbertas` SET `vagas`=\"$stringModificada\" WHERE `ID` = $butaoClicado";
				$queryUpdate = $conexao->query($sqlUpdate);
				if($queryUpdate != false)
				{
					$sqlInsereAluno = "INSERT INTO `visitasAlunos`(`Matricula`, `VisitaID`, `Turma`, `Espera`, `tag` ) VALUES ($matricula,$butaoClicado,\"$turma\", 0, \"$tag\")";
					$queryInsereAluno = $conexao->query($sqlInsereAluno);
					if($queryInsereAluno != false)
					{
						echo '<h5 class="text-center">Sua inscrição no evento está confirmada!.<p></p>';
						//echo '<a href="index.html" class="btn btn-primary btn-lg btn-block">Página Inicial</a>';
					}
					else
					{
						echo "errei em inserir aluno";
						//echo '<a href="index.html" class="btn btn-primary btn-lg btn-block">Página Inicial</a>';
					}
				}
				else
				{
					echo "errei em updatar visita";
					//echo '<a href="index.html" class="btn btn-primary btn-lg btn-block">Página Inicial</a>';
				}
			}
		
		}
	}
?>