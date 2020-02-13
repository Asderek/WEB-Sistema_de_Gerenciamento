<?php

	include("../utils/newconexao.php");
	print_r($_POST);
	$indexDelete = $_POST['deleteMonitor'];
	$sqlDelete = "DELETE FROM `historicoMonitores` WHERE `index` = $indexDelete";
	$queryDelete = $conexao->query($sqlDelete);
	
	echo "<form action=\"mainSecretaria.php\" id=\"id_auto\" method=\"post\">
			<input type=\"hidden\" name=\"mode\" value=\"monitores\">
			<input type=\"submit\" value=\"Voltar\">
		  </form>";
	
	if($queryDelete != false)
	{
		echo "<script>
					document.getElementById('id_auto').submit();
				</script>";
	}
	else
	{
		echo "<h2> Não foi possivel apagar o monitor de indice $indexDelete, contate a secretaria<br>sqlDelete = $sqlDelete</h2>";
	}

?>