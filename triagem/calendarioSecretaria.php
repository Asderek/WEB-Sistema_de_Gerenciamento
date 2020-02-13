<?php
	
	function CALENDARIO_INSERECONTEUDO($dia, $mes, $ano)
	{
		include ('../../newconexao.php');
		
		if ($dia<1 || $dia>31)
			return;
		
		if ($dia < 10)
			$dia = '0'.$dia;
		
		echo "<p align=\"center\"><button value=\"$dia$mes$ano\" name=\"data\" formaction=\"novoevento.php\"> $dia </button></p>";
		
		$sqlMonths = array("nil","jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez");
		$mes = $sqlMonths[intval($mes)];
		
		
		$sqlCalendario = "SELECT * FROM `calendario` WHERE `dia` = \"$dia\" AND `mes` = \"$mes\" AND `ano` = \"$ano\"";
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
		
		$sqlAtendimentos = "SELECT * FROM `atendimentos` WHERE `dataDeRetorno` = \"$dia-$mes-$ano\"";
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
			$responsavel = $resultAtendimentos[$i]['responsavel'];
			$responsavel = substr($responsavel,0,strpos($responsavel," "));
			$responsavel = strtolower($responsavel);
			$responsavel = ucwords($responsavel);
			$area = $resultAtendimentos[$i]['area'];
			$area = strtolower($area);
			$area = ucwords($area);
			
			$responsavel .= "(".$area.")"."<br>($hora)";
			$responsavel = "<strong>".$responsavel."</strong>";
			
			
			echo "<p align=\"center\"><button type=\"submit\" name=\"mode\" value=\"$value\">$responsavel<br>$assistido</button></p>";
		}
		
		
		
		return;
	}

?>