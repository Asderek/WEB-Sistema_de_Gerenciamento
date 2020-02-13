<?php
	include('../../newconexao.php');	
	$matricula = $_POST['matricula'];
	
	$sqlDelete = "DELETE FROM `NPJ_bloqueioPlantoes` WHERE `matricula` = $matricula";
	$queryDelete = $conexao->query($sqlDelete);
	
	$deBoa = true;
	$erros = array();
	foreach($_POST as $name => $item)
	{
		if ($name == "matricula")
			continue;
		
		$dia = $name[0];
		$name = substr($name,2);
		$hora1 = substr($name,0,strpos($name,"-"));
		$sqlBlock = "INSERT INTO `NPJ_bloqueioPlantoes`(`matricula`, `dia`, `hora`) VALUES ($matricula,$dia,$hora1)";
		$queryBlock = $conexao->query($sqlBlock);
		if ($queryBlock == false)
		{
			$deBoa = false;
			array_push($erros,$sqlBlock);
		}
	}
	
	echo "<form action=\"inicio.php\" id=\"id_auto\">
			<input type=\"submit\" value=\"Voltar\">
		  </form>
	";
	
	if ($deBoa == true)
	{
		echo "<script>
				document.getElementById('id_auto').submit();
			</script>
		";
	}
	else
	{
		echo "<h4 class=\"text-center\"> Ocorreram erros ao bloquear alguns plantões<br>";
		for($i=0;$i<count($erros);$i++)
		{
			$erro = $erros[$i];
			echo "$erro<br>";
		}
		echo "</h4>";
	}
	
	

?>