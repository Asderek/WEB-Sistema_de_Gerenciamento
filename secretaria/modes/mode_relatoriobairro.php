<?php

	$bairro = $_POST['bairro'];
	if ($bairro == "---")
		$bairro = "";
	
	echo "<br>bairro = $bairro<br>";
	$sqlRelatorio = "SELECT * FROM assistidos WHERE bairro = \"$bairro\" ORDER BY nome";
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