<?php	
	$matricula = $_POST['matricula'];
	
	$sqlProfessor = "SELECT * FROM professores WHERE `matricula` = $matricula";
	$queryProfessor = $conexao->query($sqlProfessor);
	if($queryProfessor != false)
	{
		$resultProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
		$rowsProfessor = count($resultProfessor);
	}
	
	if($rowsProfessor>0)
	{
		$nome = $resultProfessor[0]['nome'];
		
		$sqlAluno = "SELECT * FROM alunos WHERE `professor` = \"$nome\" ORDER BY `nome` ASC";
		$queryAluno = $conexao->query($sqlAluno);
		if($queryAluno != false)
		{
			$resultAluno = $queryAluno->fetchAll( PDO::FETCH_ASSOC );
			$rowsAluno = count($resultAluno);
		}
		
		echo '
			<table class="table table-bordered table-hover" border="2" bordercolor=BLACK >
				<tbody>';
				
		echo '
				<tr align="center">
					<td align="center"><strong>Foto</strong></td>
					<td align="center"><strong>Matricula</strong></td>
					<td align="center"><strong>Nome</strong></td>
					<td align="center"><strong>Horas</strong></td>
					<td align="center"><strong>G3</strong></td>
					<td align="center"><strong>L1</strong></td>
					<td align="center" colspan="2"><strong>Ver</strong></td>
				</tr>
		';
		for($i=0;$i<$rowsAluno;$i++)
		{
			$matriculaAluno = $resultAluno[$i]['matricula'];
			
			$sqlFechamento = "SELECT * FROM fechamento WHERE professor = $matricula AND aluno = $matriculaAluno";
			$queryFechamento = $conexao->query($sqlFechamento);
			
			if ($matriculaAluno[0] == 9)
				$displayMatricula = substr($matriculaAluno,1);
			else
				$displayMatricula = $matriculaAluno;
			
			$nota = $resultAluno[$i]['l1'];
			$nome = $resultAluno[$i]['nome'];
			$atual1 = $resultAluno[$i]['atual1'];
			//$horas = $resultAluno[$i]['horas'];
			$horas = 0;
			$sqlTotalHoras = "SELECT * FROM `atividades` WHERE `matricula` = $matriculaAluno AND `pendente` = 0";
			$queryTotalHoras = $conexao->query($sqlTotalHoras);
			$resultTotalHoras = $queryTotalHoras->fetchAll(PDO::FETCH_ASSOC);
			for($j=0;$j<count($resultTotalHoras);$j++)
			{
				$dataAtv = $resultTotalHoras[$j]['dataAtv'];
				
				$ano = date('Y');
				$mes = date('n');
				
				$anoAtv = substr($dataAtv,0,4);
				$mesAtv = substr($dataAtv,5,2);
				$diaAtv = substr($dataAtv,8);
				
				//echo "ano = $ano<br>mes = $mes<br> anoFechamento = $anoFechamento<br> mesFechamento = $mesFechamento<br>";
				if ($anoAtv == $ano)
				{
					if ($mesAtv <= 7 && $mes > 7)
					{
						continue;
					}
					if ($mesAtv > 7 && $mes < 7)
					{
						continue;
					}
				}
				
				$horas += $resultTotalHoras[$j]['horas'];
			}
			
			if($horas < 55)
				$g3 = 0;
			else if (($horas >= 55) && ($horas < 60))
				$g3 = 1;
			else if (($horas >= 60) && ($horas < 65))
				$g3 = 2;
			else if (($horas >= 65) && ($horas < 70))
				$g3 = 3;
			else if (($horas >= 70) && ($horas < 75))
				$g3 = 4;
			else if (($horas >= 75) && ($horas < 80))
				$g3 = 5;
			else if (($horas >= 80) && ($horas < 85))
				$g3 = 6;
			else if (($horas >= 85) && ($horas < 90))
				$g3 = 7;
			else if (($horas >= 90) && ($horas < 95))
				$g3 = 8;
			else if (($horas >= 95) && ($horas < 100))
				$g3 = 9;
			else 
				$g3 = 10;
			
			if (file_exists("../uploads/alunos/$displayMatricula.jpg"))
				$src = "../uploads/alunos/$displayMatricula.jpg";
			else
				$src = "../uploads/defaultAssets/foto.png";
			
			$fechado = false;
			if ($queryFechamento != false)
			{
				$resultFechamento = $queryFechamento->fetchAll(PDO::FETCH_ASSOC);
				$dataFechamento = $resultFechamento[0]['dataFechamento'];
				
				$ano = date('Y');
				$mes = date('n');
				
				$anoFechamento = substr($dataFechamento,0,4);
				$mesFechamento = substr($dataFechamento,5);
				if ($anoFechamento == $ano)
				{
					if ($mesFechamento <= 7 && $mes <= 7)
						$fechado = true;
					if ($mesFechamento > 7 && $mes > 7)
						$fechado = true;
				}
			}
			
			if ($fechado)
			{
				echo "<tr align=\"left\" style=\"background-color:#FFEEEE;\">";
				$informacoes = "<button type=\"submit\" id=\"id_ButtonCadastrarPlantao\" name=\"mode\" value=\"veraluno$matriculaAluno\" class=\"btn btn-primary btn-block\"><strong>Informações</strong></button>";
				$atividades = "<button type=\"submit\" id=\"id_ButtonCadastrarPlantao\" name=\"mode\" value=\"veratividades$matriculaAluno\" class=\"btn btn-primary btn-block\" style=\"background-color:#FF5555\"><strong>Pasta Fechada</strong></button>";
				
			}
			else
			{
				echo "<tr align=\"left\">";
				$informacoes = "<button type=\"submit\" id=\"id_ButtonCadastrarPlantao\" name=\"mode\" value=\"veraluno$matriculaAluno\" class=\"btn btn-primary btn-block\"><strong>Informações</strong></button>";
				$atividades = "<button type=\"submit\" id=\"id_ButtonCadastrarPlantao\" name=\"mode\" value=\"veratividades$matriculaAluno\" class=\"btn btn-primary btn-block\"><strong>Atividades</strong></button>";
			}
			
			if ($horas > 0)
				$horas = "<strong>$horas</strong>";
			
					echo "<td width=\"10%\" align=\"center\"><img src=\"$src\" height=\"93px\" width=\"70px\"></td>";
					echo "<td width=\"10%\" align=\"center\">$displayMatricula</td>";
					echo "<td width=\"40%\" align=\"center\">$nome</td>";
					echo "<td width=\"10%\" align=\"center\">$horas</td>";
					echo "<td width=\"10%\" align=\"center\">$g3</td>";											
					echo "<td width=\"10%\" align=\"center\">$nota</td>";
					echo "<td width=\"10%\" align=\"center\">$informacoes</td>";
					echo "<td width=\"10%\" align=\"center\">$atividades</td>";
				echo '</tr>';
		}
		echo '
			<table class="table table-bordered table-hover" border="2" bordercolor=BLACK >
				<tbody>';
	}
	
?>