<?php
	include ('../../newconexao.php');

	$select = $_POST['escolha'];
	
	$dia = $_POST['dia'];
	$recmes = $_POST['mes'];
	$ano = $_POST['ano'];
	$nome = $_POST['nome'];
	$bloqueado = $_POST['bloqueado'];
	$destino = $_POST['destino'];
	if ($bloqueado != "true")
		$bloqueado = 0;
	else
		$bloqueado = 1;
	
	
	$sqlMonths = array("nil","jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez");
	$mes = $sqlMonths[intval($recmes)];
	
	if ($select=="apagar")
	{
		echo "select = apagar<br>";
		$sqlDelete = "DELETE FROM `calendario` WHERE `dia` = \"$dia\" AND `mes` = \"$mes\" AND `ano` = \"$ano\"";
		$queryDelete = $conexao->query($sqlDelete);
		
		if ($queryDelete==false)
		{
			echo "Deu Pau da Uma Olhada<br>sqlInsert= $sqlDelete<br>";
		}
		else
		{
			
			echo "<form id=\"id_form\" action=\"mainSecretaria.php\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"mesano\" value=\"$recmes$ano\">";
			echo "</form>";
			echo "	<script>
						document.getElementById('id_form').submit();
					</script>";
		}
		return;
	}
	
	$sqlInsert = "INSERT INTO `calendario`(`nome`, `dia`, `mes`,`ano`,`bloqueado`,`destino`) VALUES (\"$nome\",\"$dia\",\"$mes\",\"$ano\",$bloqueado,\"$destino\")";
	echo "sqlInsert = $sqlInsert<br>";
	$queryInsert= $conexao->query($sqlInsert);
	
	if($queryInsert == false)
	{
		echo "Deu Pau da Uma Olhada<br>sqlInsert= $sqlInsert<br>";
	}
	else
	{
		
		echo "<form id=\"id_form\" action=\"mainSecretaria.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"mesano\" value=\"$recmes$ano\">";
		echo "</form>";
		echo "	<script>
					document.getElementById('id_form').submit();
				</script>";
	}

?>