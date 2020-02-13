<?php
	
	function CALENDARIO_INSERECONTEUDO($dia, $mes, $ano, $nome)
	{
		//echo "dia/mes/ano <br>$dia/$mes/$ano<br>";
		$matricula = $_POST['matricula'];
		include ('../../newconexao.php');
		
		if ($dia<1 || $dia>31)
			return;
		
		if ($dia < 10)
			$dia = '0'.$dia;
		
		echo "<p align=\"center\">$dia </p>";
		
		$sqlMonths = array("nil","jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez");
		$mes = $sqlMonths[intval($mes)];
		
		
		$sqlCalendario = "SELECT * FROM `calendario` WHERE `dia` = \"$dia\" AND `mes` = \"$mes\" AND `ano` = \"$ano\" AND (`destino` = \"alunos\" OR `destino` = \"global\" OR `destino` = \"professores\")";
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
		
		{// SQL MONITOR
		
			$sqlAreaProfessor = "SELECT * FROM professores WHERE nome = \"$nome\"";
			$queryAreaProfessor = $conexao->query($sqlAreaProfessor);
			if ($queryAreaProfessor == false)
				return;
			$resultAreaProfessor = $queryAreaProfessor->fetchAll(PDO::FETCH_ASSOC);
			$area = $resultAreaProfessor[0]['area'];
			
			if ($area != "GIMEC")
			{
				$sqlAtendimentos = "SELECT * FROM `atendimentos` WHERE `dataDeRetorno` = \"$dia-$mes-$ano\" AND responsavel = \"$nome\"";
				$queryAtendimentos = $conexao->query($sqlAtendimentos);
				if ($queryAtendimentos == false)
					return;
				$resultAtendimentos = $queryAtendimentos->fetchAll(PDO::FETCH_ASSOC);
				$rowsAtendimentos = count($resultAtendimentos);
				for($i=0;$i<$rowsAtendimentos;$i++)
				{	
					$value = "vercaso".$resultAtendimentos[$i]['index'];
					$assistido = $resultAtendimentos[$i]['nome'];
					$hora = $resultAtendimentos[$i]['hora'];
					$hora = $hora."h";
					
					if ($resultAtendimentos[$i]['orientacao'] == 1)
					{
						$sufixo = "<br><strong>(Orientação)</strong>";
						$class = "class=\"btn btn-block\"";
					}
					else if ($resultAtendimentos[$i]['dataDeInscricao'] == $resultAtendimentos[$i]['dataUltimaAtualizacao'])
					{
						$sufixo = "<br><strong>(1o Atendimento)</strong>";
						$class = "class=\"btn btn-block\"";
					}
					else
					{
						$sufixo = "<br><strong>(Retorno)</strong>";
						$class = "class=\"btn btn-block\"";
					}
					echo "<p align=\"center\"><button $class type=\"submit\" name=\"mode\" value=\"$value\"> $assistido ($hora) $sufixo</button></p>";
			
					/*$value = "vercaso".$resultAtendimentos[$i]['index'];
					$assistido = $resultAtendimentos[$i]['nome'];
					echo "<p align=\"center\"><button type=\"submit\" name=\"mode\" value=\"$value\">$assistido (Monitor)</button></p>";*/
				}
			}
			else
			{
				$sqlGimec = "SELECT * FROM professores WHERE area = \"GIMEC\"";
				$queryGimec = $conexao->query($sqlGimec);
				if ($queryGimec == false)
					return;
				$resultGimec = $queryGimec->fetchAll(PDO::FETCH_ASSOC);
				
				for ($i=0;$i<count($resultGimec);$i++)
				{					
					$joao = $resultGimec[$i]['nome'];
					$sqlAtendimentos = "SELECT * FROM `atendimentos` WHERE `dataDeRetorno` = \"$dia-$mes-$ano\" AND responsavel = \"$joao\"";
					$queryAtendimentos = $conexao->query($sqlAtendimentos);
					if ($queryAtendimentos == false)
						return;
					$resultAtendimentos = $queryAtendimentos->fetchAll(PDO::FETCH_ASSOC);
					$rowsAtendimentos = count($resultAtendimentos);
					
					
					for($j=0;$j<$rowsAtendimentos;$j++)
					{	
						$value = "vercaso".$resultAtendimentos[$j]['index'];
						$assistido = $resultAtendimentos[$j]['nome'];
						$hora = $resultAtendimentos[$j]['hora'];
						$hora = $hora."h";
						$prefixo = "(".substr($joao,0,strpos($joao," ")).")<br>";
						
						
						if ($resultAtendimentos[$j]['orientacao'] == 1)
						{
							$sufixo = "<br><strong>(Orientação)</strong>";
							$class = "class=\"btn btn-block\"";
						}
						else if ($resultAtendimentos[$j]['dataDeInscricao'] == $resultAtendimentos[$j]['dataUltimaAtualizacao'])
						{
							$sufixo = "<br><strong>(1o Atendimento)</strong>";
							$class = "class=\"btn btn-block\"";
						}
						else
						{
							$sufixo = "<br><strong>(Retorno)</strong>";
							$class = "class=\"btn btn-block\"";
						}
						echo "<p align=\"center\"><button $class type=\"submit\" name=\"mode\" value=\"$value\">$prefixo $assistido ($hora) $sufixo</button></p>";
					}
				}
			}
			
		}
		
		
		{// SQL PLANTAO
			$professor = "asd";
			$sqlAbr = "SELECT * FROM `alunosplantao` WHERE `matricula` = $matricula";
			$queryAbr = $conexao->query($sqlAbr);
			if ($queryAbr != false)
			{
				$resultAbr = $queryAbr->fetchAll( PDO::FETCH_ASSOC );
				$abr = $resultAbr[0]['professor'];
				
				$sqlNome = "SELECT * FROM `horariosplantao` WHERE `nome` = \"$abr\"";
				$queryNome = $conexao->query($sqlNome);
				if ($queryNome != false)
				{
					$resultNome = $queryNome->fetchAll(PDO::FETCH_ASSOC);
					$professor = $resultNome[0]['nome'];
				}
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
					$hora = $resultAtendimentos[$i]['hora']."h";
					$prefixo = "($hora)<br>";
					echo "<p align=\"center\"><button value=\"vercaso$index\" name=\"mode\">$prefixo $value (Plantao)</button></p>";
				}
			}
			
		}
		
		
		return;
	}

?>