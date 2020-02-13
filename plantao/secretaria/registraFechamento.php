<?php
	include('../../newconexao.php');	
	$matricula = $_POST['matricula'];
	
	$deBoa = true;
	$erros = array();
	
	$fechamento = $_POST['fechamento'];
	echo "matricula = $matricula<br>fechamento = $fechamento<br><br>";
	
	$unblock = false;
	if (strstr($fechamento,"UNBLOCK") != false)
	{
		$fechamento = substr($fechamento,strlen("UNBLOCK"));
		$unblock = true;
	}
	
	$dia = substr($fechamento,0,1);
	$inicio = substr($fechamento,2,strpos($fechamento,"-")-2);
	$fim = substr($fechamento,strpos($fechamento,"-")+1);
	
	echo "dia = $dia<br>inicio = $inicio<br>fim = $fim<br>";
	
	if ($unblock == true)
		$sqlBlock = "DELETE FROM `NPJ_fechamentoPlantoes` WHERE `matricula` = $matricula AND `dia` = $dia AND `inicio` = $inicio AND `fim` = $fim";
	else
		$sqlBlock = "INSERT INTO `NPJ_fechamentoPlantoes`(`matricula`, `dia`, `inicio`, `fim`) VALUES ($matricula,$dia,$inicio,$fim)";
	echo "<br>sqlBlock = $sqlBlock<br>";	
	$queryBlock = $conexao->query($sqlBlock);
	if ($queryBlock == false)
	{
		$deBoa = false;
		array_push($erros,$sqlBlock);
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