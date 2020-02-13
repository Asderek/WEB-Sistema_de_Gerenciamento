<?php

	$dataInicio = $_POST['searchInicio'];
	$dataFim = $_POST['searchFim'];
	
	$textInicio = $dataInicio;
	$textFim = $dataFim;
	
	$dataInicio = new DateTime($dataInicio);
	$dataFim = new DateTime($dataFim);
	$dataFim->setTime(23,59);
			
	$professor = $_POST['professor'];
	$sqlRelatorio = "SELECT * FROM atendimentos WHERE responsavel = \"$professor\" ORDER BY nome";
	
	$queryRelatorio = $conexao->query($sqlRelatorio);
	if ($queryRelatorio == false)
		return;
	
	echo "<table class=\"table table-hovered table-bordered\"><tbody>";
	
	echo "<tr>";
		echo "<td align=\"center\" colspan=\"3\"><strong>$professor</strong></td>";
	echo "</tr>";
	
	echo "<tr>";
		echo "<td align=\"center\" colspan=\"3\"><strong>DataInicio = $textInicio <br> DataFim = $textFim</strong></td>";
	echo "</tr>";
	
	echo "<tr>";
		echo "<td align=\"center\"><strong>Nome</strong></td>";
		echo "<td align=\"center\"><strong>Caso</strong></td>";
		echo "<td align=\"center\"><strong>Arquivado</strong></td>";
	echo "</tr>";
	
	
	$resultRelatorio = $queryRelatorio->fetchAll(PDO::FETCH_ASSOC);
	for($i=0;$i<count($resultRelatorio);$i++)
	{
		$dataAtual = new DateTime($resultRelatorio[$i]['dataDeInscricao']);
		if ($dataInicio > $dataAtual)
		{
			continue;
		}
		if ($dataFim < $dataAtual)
		{
			continue;
		}
		
		echo "<tr>";
		$nome = $resultRelatorio[$i]['nome'];
		$descricao = $resultRelatorio[$i]['descricao'];
		$arquivado = $resultRelatorio[$i]['arquivado'];
		if ($arquivado == 1)
			$arquivado = "x";
		else
			$arquivado = "";
		
		echo "<td align=\"center\">$nome</td>";
		echo "<td align=\"center\">$descricao</td>";
		echo "<td align=\"center\">$arquivado</td>";
		
	}
	
?>