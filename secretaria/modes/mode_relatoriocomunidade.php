<?php

	$bairro = $_POST['comunidade'];
	if ($bairro == "VAZIO")
		$sqlRelatorio = "SELECT * FROM assistidos WHERE comunidade IS NULL ORDER BY nome";
	else
		$sqlRelatorio = "SELECT * FROM assistidos WHERE comunidade = \"$bairro\" ORDER BY nome";
	
	echo "<br>comunidade = $bairro<br>";
	$queryRelatorio = $conexao->query($sqlRelatorio);
	if ($queryRelatorio == false)
		return;
	
	$resultRelatorio = $queryRelatorio->fetchAll(PDO::FETCH_ASSOC);
	for($i=0;$i<count($resultRelatorio);$i++)
	{
		$nome = $resultRelatorio[$i]['nome'];
		echo "$nome<br>";
	}
	
?>