<?php

	print_r($_POST);
	include ('../utils/newconexao.php');
	$newObs = $_POST['obsText'];
	
	str_replace("\"","'",$newObs);
	
	$cpf = $_POST['cpf'];
	$sqlOBS = "UPDATE `assistidos` SET `obs`=\"$newObs\" WHERE `cpf`= \"$cpf\"";
	$queryOBS = $conexao->query($sqlOBS);
	echo "<form action=\"mainSecretaria.php\" method=\"post\" id=\"id_auto\">
		<input type=\"hidden\" name=\"cpf\" value=\"$cpf\">
		<input type=\"hidden\" name=\"mode\" value=\"consultaassistido\">
		</form>
		<script>
			document.getElementById('id_auto').submit();
		</script>";

?>