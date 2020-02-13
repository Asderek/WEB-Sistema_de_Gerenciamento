<?php
	
	function CALENDARIO_INSERECONTEUDO($dia, $mes, $ano, $matricula)
	{
		include ('../../newconexao.php');
		
		if ($dia<1 || $dia>31)
			return;
		
		if ($dia < 10)
			$dia = '0'.$dia;
		
		echo "<p align=\"center\">$dia</p>";
		
		$sqlMonths = array("nil","jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez");
		$mes = $sqlMonths[intval($mes)];
		
		{//SQL Calendario
			$sqlCalendario = "SELECT * FROM `calendario` WHERE `dia` = \"$dia\" AND `mes` = \"$mes\" AND `ano` = \"$ano\" AND (`destino` = \"alunos\" OR `destino` = \"global\")";
			$queryCalendario = $conexao->query($sqlCalendario);
			if ($queryCalendario == false)
				return;
			$resultCalendario = $queryCalendario->fetchAll(PDO::FETCH_ASSOC);
			$rowsCalendario = count($resultCalendario);
			for ($i=0;$i<$rowsCalendario;$i++)
			{
				$value = $resultCalendario[$i]['nome'];
				echo "<p align=\"center\"><strong>$value</strong></p>";
			}
		}
		
		
		{// SQL PLANTAO
			$professor = "asd";
			$sqlAbr = "SELECT * FROM `alunosplantao` WHERE `matricula` = $matricula";
			$queryAbr = $conexao->query($sqlAbr);
			if ($queryAbr != false)
			{
				$resultAbr = $queryAbr->fetchAll( PDO::FETCH_ASSOC );
				$professor = $resultAbr[0]['professor'];
			}
			
			if ($professor != "asd")
			{				
				$sqlAtendimentos = "SELECT * FROM `atendimentos` WHERE `dataDeRetorno` = \"$dia-$mes-$ano\" AND `responsavel` = \"$professor\"";
				$queryAtendimentos = $conexao->query($sqlAtendimentos);
				if ($queryAtendimentos == false)
					return;
				$resultAtendimentos = $queryAtendimentos->fetchAll(PDO::FETCH_ASSOC);
				$rowsAtendimentos = count($resultAtendimentos);
				for($i=0;$i<$rowsAtendimentos;$i++)
				{
					$value = $resultAtendimentos[$i]['nome'];
					$index = $resultAtendimentos[$i]['index'];
					$hora = $resultAtendimentos[$i]['hora'];
					$inputhora = $hora.'h';
					
					if ($resultAtendimentos[$i]['orientacao'] == 1)
					{
						$sufixo = "<br><strong>(Orientação)</strong>";
						$style = "class=\"btn btn-block\"";
					}
					else if ($resultAtendimentos[$i]['dataDeInscricao'] == $resultAtendimentos[$i]['dataUltimaAtualizacao'])
					{
						$sufixo = "<br><strong>(1o Atendimento)</strong>";
						$style = "class=\"btn btn-block\"";
					}
					else
					{
						$sufixo = "<br><strong>(Retorno)</strong>";
						$style = "class=\"btn btn-block\"";
					}
					
					echo "<p align=\"center\"><button value=\"vercaso$index\" name=\"mode\" class=\"btn\">$value ($inputhora) $sufixo</button></p>";
				}
			}
			
		}
		
		{//SQL Eventos
			$sqlDisciplina = "SELECT * FROM `alunos` WHERE `matricula` = $matricula";
			$queryDisciplina = $conexao->query($sqlDisciplina);
			$resultDisplina = $queryDisciplina->fetchAll( PDO::FETCH_ASSOC );
			$disciplina = $resultDisplina[0]['disciplina'];
			$sqlMonth = $dia.'/'.$mes.'/'.$ano;
			$sqlEventos = "SELECT * FROM `visitasAbertas` WHERE `disciplina` = \"$disciplina\" AND `horario` = \"$sqlMonth\"";
			$queryEventos = $conexao->query($sqlEventos);
			if ($queryEventos != false)
			{
				$resultEventos = $queryEventos->fetchAll( PDO::FETCH_ASSOC );
				for ($i=0;$i<count($resultEventos);$i++)
				{
					$nome = $resultEventos[$i]['professor'];
					
					$value = "visita (".$nome.")";
					echo "<p align=\"center\"><button value=\"verevento\" name=\"mode\">$value</button></p>";
				}
			}
		}
		
		return;
	}

?>