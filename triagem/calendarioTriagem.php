<?php
	
	function CALENDARIO_INSERECONTEUDO($dia, $mes, $ano, $professor)
	{		
		include ('../../newconexao.php');
		if ($dia<1 || $dia>31)
			return;
		if ($dia < 10)
			$dia = '0'.$dia;
		echo "<p align=\"center\">$dia</p>";
		$sqlMonths = array("nil","jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez");
		$mesNumero = $mes;
		$mes = $sqlMonths[intval($mes)];
		
		$sqlPlantao = "SELECT * FROM `horariosplantao` WHERE `nome` = \"$professor\" ";
		$queryPlantao = $conexao->query($sqlPlantao);
		if ($queryPlantao == false)
		{
			return;
		}
		$resultPlantao = $queryPlantao->fetchAll( PDO::FETCH_ASSOC );
		
		$currentDayOfTheWeek = date('N',strtotime($ano.'-'.$mesNumero.'-'.$dia));
		$currentDayOfTheWeek++;
		
		$atendimento = array();
		
		if ($resultPlantao[0]['dia1'] == $currentDayOfTheWeek)
		{
			array_push($atendimento,$resultPlantao[0]['atendimento1']);
			array_push($atendimento,$resultPlantao[0]['fim1']);
		}
		if ($resultPlantao[0]['dia2'] == $currentDayOfTheWeek)
		{
			array_push($atendimento,$resultPlantao[0]['atendimento2']);
			array_push($atendimento,$resultPlantao[0]['fim2']);
		}
		if ($resultPlantao[0]['dia3'] == $currentDayOfTheWeek)
		{
			array_push($atendimento,$resultPlantao[0]['atendimento3']);
			array_push($atendimento,$resultPlantao[0]['fim3']);
		}
		
		//<Escolher>
		{
			$sqlValue = $dia.'-'.$mes.'-'.$ano;
			$sqlQtdAtendimentos = "SELECT * FROM `atendimentos` WHERE `dataDeRetorno` = \"$sqlValue\" AND `responsavel` = \"$professor\"";
			$queryQtdAtendimentos = $conexao->query($sqlQtdAtendimentos);
			$resultQtdAtendimentos = $queryQtdAtendimentos->fetchAll(PDO::FETCH_ASSOC);
			
			$sqlQtdAssistidos = "SELECT * FROM `horariosplantao` WHERE `nome` = \"$professor\"";
			$queryQtdAssistidos = $conexao->query($sqlQtdAssistidos);
			$resultQtdAssistidos = $queryQtdAssistidos->fetchAll(PDO::FETCH_ASSOC);
			
			if($resultQtdAssistidos[0]['dia1'] == $currentDayOfTheWeek)
			{
				$indiceAssistidos = "assistidos1";
			}
			else if($resultQtdAssistidos[0]['dia2'] == $currentDayOfTheWeek)
			{
				$indiceAssistidos = "assistidos2";
			}
			else if($resultQtdAssistidos[0]['dia3'] == $currentDayOfTheWeek)
			{
				$indiceAssistidos = "assistidos3";
			}
			
			$maxAssistidos = $resultQtdAssistidos[0][$indiceAssistidos];
			
			if (count($resultQtdAtendimentos) < $maxAssistidos || $_POST['area'] == "PRE-MEDIACAO")
			{
				echo "<p align=\"center\">Hora: <select name=\"hora$dia\" align=\"center\">";
				if ($_POST['area'] == "PRE-MEDIACAO")
				{
					for($i=8;$i<21;$i++)
					{
						$input = $i.":30";
						echo "<option value=\"$i\">$i</option>";
						echo "<option value=\"$input\">$input</option>";
					}
				}
				else
				{
					for ($i=0;$i<count($atendimento);$i+=2)
					{
						$diferenca = $atendimento[$i+1] - $atendimento[$i];
						for($j=0;$j<$diferenca;$j++)
						{
							$value = $atendimento[$i]+$j;
							$sqlValue = $dia.'-'.$mes.'-'.$ano;
							
							$sqlDupe = "SELECT * FROM `atendimentos` WHERE `dataDeRetorno` = \"$sqlValue\" AND `hora` = \"$value\" AND `responsavel` = \"$professor\"";
							//echo "<option value=\"asd\">$sqlDupe</option>";
							$queryDupe = $conexao->query($sqlDupe);
							if ($queryDupe!=false)
							{
								$resultDupe = $queryDupe->fetchAll( PDO::FETCH_ASSOC );
								$rowsDupe = count($resultDupe);
								if ($rowsDupe > 0)
								{
								}
								else
								{
									echo "<option value=\"$value\">$value</option>";
								}
									
							}
							
							$value = $value.":30";
							$sqlHalf = "SELECT * FROM `atendimentos` WHERE `dataDeRetorno` = \"$sqlValue\" AND `hora` = \"$value\" AND `responsavel` = \"$professor\""; 
							$queryHalf = $conexao->query($sqlHalf);
							if ($queryHalf!= false)
							{
								$resultHalf = $queryHalf->fetchAll(PDO::FETCH_ASSOC);
								if (count($resultHalf) > 0)
								{}
								else
								{
									echo "<option value=\"$value\">$value</option>";
								}
							}
							else
							{
								echo "<option value=\"asd\">Deu Ruim</option>";
								echo "<option value=\"asd\">sqlHalf = $sqlHalf</option>";
							}
							
							
						}
					}
				}
				echo "</select>      <button value=\"$dia$mesNumero$ano\" name=\"data\"> Escolher </button></p>";
			}
		}
		//</Escolher>
		
		$sqlCalendario = "SELECT * FROM `calendario` WHERE `dia` = \"$dia\" AND `mes` = \"$mes\"";
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
		
		$sqlAtendimentos = "SELECT * FROM `atendimentos` WHERE `dataDeRetorno` = \"$dia-$mes-$ano\" AND `responsavel` = \"$professor\"";
		$queryAtendimentos = $conexao->query($sqlAtendimentos);
		if ($queryAtendimentos == false)
			return;
		$resultAtendimentos = $queryAtendimentos->fetchAll(PDO::FETCH_ASSOC);
		$rowsAtendimentos = count($resultAtendimentos);
		for($i=0;$i<$rowsAtendimentos;$i++)
		{
			$hora = $resultAtendimentos[$i]['hora'];
			$value = $resultAtendimentos[$i]['nome']. "(" . $hora. "h)";
			
			$index = $resultAtendimentos[$i]['index'];
			echo "<p align=\"center\">$value</p>";
		}
		
		
		
		return;
	}

?>