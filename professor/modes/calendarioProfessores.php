<?php
	
	function CALENDARIO_INSERECONTEUDO($dia, $mes, $ano, $nome)
	{
		//echo "dia/mes/ano <br>$dia/$mes/$ano<br>";
		include ('../../newconexao.php');
		
		if ($dia<1 || $dia>31)
			return;
		
		if ($dia < 10)
			$dia = '0'.$dia;
		
		echo "<p align=\"center\">$dia </p>";
		
		$sqlMonths = array("nil","jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez");
		$mes = $sqlMonths[intval($mes)];
		
		
		$sqlCalendario = "SELECT * FROM `calendario` WHERE `dia` = \"$dia\" AND `mes` = \"$mes\" AND `ano` = \"$ano\" AND (`destino` = \"professores\" OR `destino` = \"global\")";
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
		
		$matricula = $_POST['matricula'];
		$sqlAudiencia = "SELECT * FROM `audiencias` WHERE `dia` = \"$dia\" AND `mes` = \"$mes\" AND `ano` = \"$ano\" AND `matricula` = $matricula";
		$queryAudiencia = $conexao->query($sqlAudiencia);
		if ($queryAudiencia == false)
			return;
		$resultAudiencia = $queryAudiencia->fetchAll(PDO::FETCH_ASSOC);
		$rowsAudiencia = count($resultAudiencia);
		for ($i=0;$i<$rowsAudiencia;$i++)
		{
			$nome = $resultAudiencia[$i]['nome'];
			$local = $resultAudiencia[$i]['local'];
			$hora = $resultAudiencia[$i]['hora'];
			echo "<p align=\"center\"><strong>Audiencia: $nome<br>$local<br>($hora)</strong></p>";
		}
		
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
			echo "<p align=\"center\"><button $style type=\"submit\" name=\"mode\" value=\"$value\"> $assistido ($hora) $sufixo</button></p>";
		}
		
		
		
		return;
	}

?>