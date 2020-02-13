<?php
	
	include('../../newconexao.php');
	
	$professorMonitoria = PROFESSORES_GETPROFESSORMONITORIANAME($matricula);
	$professorMonitoria = ucwords($professorMonitoria);
	
	$sqlAlunos = "SELECT * FROM alunosplantao WHERE `professor` = \"$professorMonitoria\"";
	$queryAlunos = $conexao->query($sqlAlunos);
	if($queryAlunos != false)
	{
		$rowsAlunos = $queryAlunos->fetchAll( PDO::FETCH_ASSOC );
	}
	
	$dias = array();
	for($i=0;$i<5;$i++)
	{
		$dias[$i] = array();
	}
	
	for ($i=0;$i<5;$i++)
	{
		for($j=0;$j<13;$j++)
		{
			$dias[$i][$j] = array();
		}
	}
	
	
	
	echo '<h3 class="text-center">'.$professorMonitoria.'</h3>';
	
	
	for($i=0;$i<count($rowsAlunos);$i++)
	{
		$horario = $rowsAlunos[$i]['horario'];
		$nome = $rowsAlunos[$i]['nome'];
		$matAluno = $rowsAlunos[$i]['matricula'];
		
		$sqlInfo = "SELECT * FROM alunos WHERE matricula = $matAluno";
		$queryInfo = $conexao->query($sqlInfo);
		$result = $queryInfo->fetchAll( PDO::FETCH_ASSOC );
		
		$email = $result[0]['email'];
		$tel = $result[0]['telefone'];
		

		
		if (strpos($horario, 'segunda') !== false) 
		{
			$hora = $horario[10].$horario[11];
			$hora = intval($hora)-8;
			array_push($dias[0][$hora],array($matAluno,$nome, $email, $tel));
		}
		else if (strpos($horario, 'terca') !== false) 
		{
			$hora = $horario[8].$horario[9];
			$hora = intval($hora)-8;
			array_push($dias[1][$hora],array($matAluno,$nome, $email, $tel));
			
		}
		else if (strpos($horario, 'quarta') !== false) 
		{
			$hora = $horario[9].$horario[10];
			$hora = intval($hora)-8;
			array_push($dias[2][$hora],array($matAluno,$nome, $email, $tel));
		}
		else if (strpos($horario, 'quinta') !== false) 
		{
			$hora = $horario[9].$horario[10];
			$hora = intval($hora)-8;
			array_push($dias[3][$hora],array($matAluno,$nome, $email, $tel));
		}
		else if (strpos($horario, 'sexta') !== false) 
		{
			$hora = $horario[8].$horario[9];
			$hora = intval($hora)-8;
			array_push($dias[4][$hora],array($matAluno,$nome, $email, $tel));
		}

	}
	
	$dia = array("segunda","terca","quarta","quinta","sexta");
	$hora = array("08:00~09:00","09:00~10:00","10:00~11:00","11:00~12:00","12:00~13:00","13:00~14:00","14:00~15:00","15:00~16:00","16:00~17:00","17:00~18:00","18:00~19:00","19:00~20:00","20:00~21:00");									
	
	for($day=0;$day<5;$day++)
	{	
		for($hour=0;$hour<13;$hour++)
		{												
			if(count($dias[$day][$hour])>0)
			{
				
				echo '
					<table style="width:100%">
						<tr>
							<td colspan="4" align="center"><b><font size="4">'.$dia[$day].' - '.$hora[$hour].'</font></b></td>
						</tr>';
				echo '
						<tr>
							<td align="center"><b><font size="4">Matricula</font></b></td>
							<td align="center"><b><font size="4">Nome</font></b></td>
							<td align="center"><b><font size="4">Email</font></b></td>
							<td align="center"><b><font size="4">Telefone</font></b></td>
						</tr>';
				
				for($aluno=0;$aluno<count($dias[$day][$hour]);$aluno++)
				{
					if($aluno % 2 == 0)
						echo '<tr bgcolor="#DDDDDD">';
					else
						echo '<tr>';
					
					for($atr=0;$atr<count($dias[$day][$hour][$aluno]);$atr++)
					{
						echo '<td align="center">'.$dias[$day][$hour][$aluno][$atr].'</td>';	
					}
					echo '</tr>';
				}
				
				
				echo '</table>';
				echo '<br><br>';
			}
			
			
		}
	}
	
	
?>