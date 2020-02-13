<?php

	$sqlAudiencias = "SELECT * FROM audiencias WHERE matricula = $matricula ORDER BY ano, mes, dia";
	$queryAudiencias = $conexao->query($sqlAudiencias);
	if ($queryAudiencias == false)
		return;
	$resultAudiencias = $queryAudiencias->fetchAll(PDO::FETCH_ASSOC);
	echo "<table class=\"table table-bordered\">";
	echo "<tr>";
		echo "<td align=\"center\"><strong>CPF</strong></td>";
		echo "<td align=\"center\"><strong>Nome</strong></td>";
		echo "<td align=\"center\"><strong>Data</strong></td>";
		echo "<td align=\"center\"><strong>Local</strong></td>";
	echo "</tr>";
	
	$arrayMenos7 = array();
	$arrayMais7 = array();
	for ($i=0;$i<count($resultAudiencias);$i++)
	{
		$cpf = $resultAudiencias[$i]['cpf'];
		$nome = $resultAudiencias[$i]['nome'];
		$dia = $resultAudiencias[$i]['dia'];
		$mes = $resultAudiencias[$i]['mes'];
		$ano = $resultAudiencias[$i]['ano'];
		$hora = $resultAudiencias[$i]['hora'];
		$local = $resultAudiencias[$i]['local'];
		
		$data = $dia.'/'.$mes.'/'.$ano." ($hora)";
		
		{
			$meses = array();
			$meses['jan'] = "01";
			$meses['fev'] = "02";
			$meses['mar'] = "03";
			$meses['abr'] = "04";
			$meses['mai'] = "05";
			$meses['jun'] = "06";
			$meses['jul'] = "07";
			$meses['ago'] = "08";
			$meses['set'] = "09";
			$meses['out'] = "10";
			$meses['nov'] = "11";
			$meses['dez'] = "12";
			
			
			$diaAudiencia = $resultAudiencias[$i]['dia'];
			$mesAudiencia = $resultAudiencias[$i]['mes'];
			$anoAudiencia = $resultAudiencias[$i]['ano'];
			
			$mesAudiencia = $meses[$mesAudiencia];
			
			$dia = date('d');
			$mes = date('m');
			$ano = date('Y');
			
			$strHoje = "$ano-$mes-$dia";
			$strAudiencia = "$anoAudiencia-$mesAudiencia-$diaAudiencia";
			
			//echo "strHoje = $strHoje<br>strAudiencia = $strAudiencia<br>";
			
			
			$dataHoje = new DateTime($strHoje);
			$dataAudiencia = new DateTime($strAudiencia);
			
			$diff = $dataHoje->diff($dataAudiencia);
			
			if ((int)$diff->format("%r%a") < 0)
				continue;
			
			if ($diff->d < 7)			
			{
				array_push($arrayMenos7,["$cpf","$nome","$data","$local"]);
			}
			else
			{
				array_push($arrayMais7,["$cpf","$nome","$data","$local"]);
			}
		}
	}
	
	if (count($arrayMenos7) != 0)
		echo "<tr style=\"background-color: #FF6666\"><td colspan=\"4\" align=\"center\"><strong>Assistidos com audiencias nos proximos 7 dias<strong></td></tr>";
	
	for($i=0;$i<count($arrayMenos7);$i++)
	{
		$cpf = $arrayMenos7[$i][0];
		$nome = $arrayMenos7[$i][1];
		$data = $arrayMenos7[$i][2];
		$local = $arrayMenos7[$i][3];
		echo "<tr>";
			echo "<td align=\"center\">$cpf</td>";
			echo "<td align=\"center\">$nome</td>";
			echo "<td align=\"center\">$data</td>";
			echo "<td align=\"center\">$local</td>";
		echo "</tr>";
	}
	
	if (count($arrayMais7) != 0)
		echo "<tr style=\"background-color: #CCFFDD\"><td colspan=\"4\" align=\"center\"><strong>Assistidos com audiencias em mais 7 dias</strong></td></tr>";
	for($i=0;$i<count($arrayMais7);$i++)
	{
		$cpf = $arrayMais7[$i][0];
		$nome = $arrayMais7[$i][1];
		$data = $arrayMais7[$i][2];
		$local = $arrayMais7[$i][3];
		echo "<tr>";
			echo "<td align=\"center\">$cpf</td>";
			echo "<td align=\"center\">$nome</td>";
			echo "<td align=\"center\">$data</td>";
			echo "<td align=\"center\">$local</td>";
		echo "</tr>";
	}

?>