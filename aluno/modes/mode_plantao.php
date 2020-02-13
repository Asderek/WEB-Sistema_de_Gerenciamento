<?php

	include('newconexao.php');	
	$sqlEma = "SELECT * FROM alunos WHERE matricula = $matricula";
	$queryEma = $conexao->query($sqlEma);
	$resultEma = $queryEma->fetchAll(PDO::FETCH_ASSOC);
	
	$disciplina = $resultEma[0]['disciplina'];
	$meuProfessor = $resultEma[0]['professor'];
	
	$sqlProfessor = "SELECT * FROM horariosplantao WHERE 1";
	$queryProfessor = $conexao->query($sqlProfessor);
	$result = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
	$cont = 0;
	
	$sqlInscricao = "SELECT * FROM alunosplantao WHERE matricula = $matricula";
	$queryInscricao = $conexao->query($sqlInscricao);
	$resultInscricao = $queryInscricao->fetchAll( PDO::FETCH_ASSOC );
	$rowsInscricao = count($resultInscricao);
	
	if(count($resultInscricao)>0)
	{
			echo "<h4 class=\"text-center\">Sua inscrição atual: <br><b>    Professor:  </b>".$resultInscricao[0]['professor'].'<br><b>     Horario:  </b>'.$resultInscricao[0]['horario'].'</h4><br>';
	}
	
	if(count($result) <= 0)
	{
		echo 'deu bug';
		echo '<a href="http://bit.ly/IqT6zt" class="btn btn-primary btn-lg btn-block">Back</a>';	
	}
	else
	{
		echo '<label for="Professor">Professor(a): </label>';
		echo '<select class="form-control" name="plantaoprofessor">';
		
		for($i=0;$i<count($result);$i++)
		{
			$accept = false;
			$dia1 = $result[$i]['dia1'];
			if ($dia1>0)
			{
				switch ($disciplina)
				{
					case "JUR1961":
						if ($result[$i]['disciplina'] == "JUR1961")
						{
							$accept = true;
						}
						if (strstr(strtolower($result[$i]['nome']),"firmino") != false)
						{
							$accept = true;
						}
					
					break;
					case "JUR1962":
						if ($result[$i]['disciplina'] == "JUR1962")
						{
							$accept = true;
						}
					break;
					case "JUR1963":
						if ($result[$i]['disciplina'] == "JUR1963")
						{
							$accept = true;
						}
					break;
					case "JUR1964":
						//FAMILIA
						if (strstr(strtolower($meuProfessor),"ines") != false || strstr(strtolower($meuProfessor),"pupo") != false)
						{
							if (	
									strstr(strtolower($result[$i]['nome']),"pupo") || 
									strstr(strtolower($result[$i]['nome']),"ines") || 
									strstr(strtolower($result[$i]['nome']),"pedro")|| 
									strstr(strtolower($result[$i]['nome']),"pelajo") ||
									strstr(strtolower($result[$i]['nome']),"assed") || 
									strstr(strtolower($result[$i]['nome']),"mia")
								)
								{
									$accept=true;
								}
						}
						//GIMEC
						if (strstr(strtolower($meuProfessor),"mia") != false ||strstr(strtolower($meuProfessor),"pelajo") != false ||strstr(strtolower($meuProfessor),"assed") != false )
						{
							if (strstr(strtolower($result[$i]['nome']),"mia") != false ||strstr(strtolower($result[$i]['nome']),"pelajo") != false ||strstr(strtolower($result[$i]['nome']),"assed") != false )
							{
								$accept = true;
							}
						}
						//EMPRESARIAL
						if (strstr(strtolower($meuProfessor),"felipe") != false)
						{
							if (strstr(strtolower($result[$i]['nome']),"felipe") != false)
							{
								$accept = true;
							}
						}
						//POSSESSORIO
						
						if (strstr(strtolower($meuProfessor),"mendonca") != false)
						{
							if (strstr(strtolower($result[$i]['nome']),"mendonca") != false)
							{
								
								$accept = true;
							}
						}
						//IVAN
						if (strstr(strtolower($meuProfessor),"ivan") != false)
						{
							if (strstr(strtolower($result[$i]['nome']),"ivan") != false)
							{
								$accept = true;
							}
							if ($result[$i]['disciplina'] == "JUR1961")
							{
								$accept = true;
							}
						}
						//CARLOS AFONSO
						if (strstr(strtolower($meuProfessor),"affonso") != false)
						{
							if ($result[$i]['disciplina'] == "JUR1963")
							{
								$accept = true;
							}
							if (strstr(strtolower($result[$i]['nome']),"mendonca") != false)
							{
								$accept = true;
							}
						}
						
					break;
				}
				if ($accept == true)
				{
					$cont++;
					$nome = $result[$i]['nome'];
					echo '<option name="'.$nome.'">'.$nome.'</option>'; 	
				}
			}
		}									
		
		echo '</select>';
	}
	
	echo '<br>';
	
	if($cont != 0)
	{
		echo "
		<div class=\"form-group\">
			<input type=\"checkbox\" name=\"Read\" value=\"Read\" onclick=\"action = inscricao-cadastro.php\">Estou ciente de que esta inscrição indica, apenas, o horário de preferência para os plantões deste semestre. A decisão final será dada pelo(a) professor(a) escolhido(a).
		</div>
		
		
		<div class=\"form-group\">
			<button type=\"submit\" class=\"btn btn-primary btn-lg btn-block\" onclick=\"ValidateCheckBox('Read')\" name=\"mode\" value=\"escolherplantao\">Ver plantões existentes</button>
		</div>";
	}
	else
	{
		echo "<h4 class=\"text-center\"> Um erro ocorreu que causa que você não tenha nenhum professor para selecionar. Contate a secretaria e aguarde a correção do erro.<br> A informatica agradece a compreensão. </h4>";
	}
?>