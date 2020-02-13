<?php

	include('../../utils/newconexao.php');

	$index = $_POST['index_caso'];
	$data = $_POST['data'];
	$hora = $_POST['hora'];
	
	$ano = substr($data,0,4);
	$mes = substr($data,5,2);
	$dia = substr($data,8,2);
	
	
	switch($mes)
	{
		case "01":
			$mes = "jan";
			break;
		case "02":
			$mes = "fev";
			break;
		case "03":
			$mes = "mar";
			break;
		case "04":
			$mes = "abr";
			break;
		case "05":
			$mes = "mai";
			break;
		case "06":
			$mes = "jun";
			break;
		case "07":
			$mes = "jul";
			break;
		case "08":
			$mes = "ago";
			break;
		case "09":
			$mes = "set";
			break;
		case "10":
			$mes = "out";
			break;
		case "11":
			$mes = "nov";
			break;
		case "12":
			$mes = "dez";
			break;
	}
	$proximoAtendimento = $dia."-".$mes."-".$ano;
	$data = date(DATE_RFC822);
	
	$sqlUpdate = "UPDATE `atendimentos` SET `dataUltimaAtualizacao`=\"$data\",`dataDeRetorno`=\"$proximoAtendimento\",`hora`=\"$hora\" WHERE `index` = $index";
	$queryUpdate = $conexao->query($sqlUpdate);
	if ($queryUpdate != false)
	{
		echo "<form id=\"id_auto\" action=\"inserirComentario.php\" method=\"post\">
					<input type=\"hidden\" value=\"cliente\" name=\"fonte\">
					<input type=\"hidden\" value=\"$matricula\" name-\"matricula\">
					<input type=\"hidden\" value=\"informacao\" name=\"mode\">
					<input type=\"hidden\" value=\"$index\" name=\"indice\">
			</form>";
		echo "<script>
					document.getElementById('id_auto').submit();
			</script>";
	}
	else
	{
		echo "<form id=\"id_auto\" action=\"main.php\" method=\"post\">
					<input type=\"hidden\" value=\"$matricula\" name-\"matricula\">
					<input type=\"hidden\" value=\"informacao\" name=\"mode\">
					<input type=\"hidden\" value=\"$index\" name=\"indice\">
					<h4 class=\"text-center\">Não foi possivel reagendar, tente novamente</h4>
			</form>";
	}
?>