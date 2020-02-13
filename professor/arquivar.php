<?php
	
	print_r($_POST);
	include('../utils/newconexao.php');
	$index = $_POST['index'];
	$matricula = $_POST['matricula'];
	$sqlCaso = "SELECT * FROM `atendimentos` WHERE `index` = $index";
	
	echo "<br>sqlCaso = $sqlCaso<br>";
	
	$dia= date('d');
	$mes = date('M');
	$ano = date('y');
	
	$queryCaso = $conexao->query($sqlCaso);
	$resultCaso = $queryCaso->fetchAll(PDO::FETCH_ASSOC);
	$arquivado = $resultCaso[0]['arquivado'];
	$arquivado =  ($arquivado == 0 ? 1 : 0);
	echo "arquivado = $arquivado";
	
	$comentario = "Caso ";
	
	if ($arquivado == 1)
		$comentario .= "arquivado";
	else
		$comentario .= "desarquivado";
	
	$comentario .= " em $dia-$mes-$ano";

	$sqlUpdate = "UPDATE `atendimentos` SET `arquivado`=$arquivado WHERE `index` = $index";
	$queryUpdate = $conexao->query($sqlUpdate);
	if ($queryUpdate != false)
	{
		echo "
			<form id=\"myForm\" class=\"form col-md-12 center-block\" action='cadastrarcomentario.php' method=\"post\">								
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\"></input>
				<input type=\"hidden\" name=\"index\" value=\"$index\"></input>
				<input type=\"hidden\" name=\"comment\" value=\"$comentario\"></input>
			</form>		
			<script type=\"text/javascript\">
				document.getElementById('myForm').submit();
			</script>";
	}
	else
	{
		echo "<p align=\"center\">";
		echo "<h3>Não consegui arquivar, por favor contate a secretaria</h3>";		
		echo "<a href=\"javascript:history.go(-1)\" class=\"button btn-primary btn-lg btn-block\">Voltar</a>";
		echo "</p>";
		return;
	}
?>