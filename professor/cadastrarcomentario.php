<?php

	include('../../newconexao.php');

	$matricula = $_POST['matricula'];
	$comentario = $_POST['comment'];
	$indexCaso = $_POST['index'];
	
	echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
	echo "<input type=\"hidden\" name=\"idCaso\" value=\"$indexCaso\">";
	echo "<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">";
	
	$sqlAssistencia = "SELECT * FROM `atendimentos` WHERE `index` = \"$indexCaso\"";
	$queryAssistencia = $conexao->query($sqlAssistencia);
	$resultAssistencia = $queryAssistencia->fetchAll( PDO::FETCH_ASSOC );
	if ($queryAssistencia == false)
	{
		echo "Deu pau";
		return ;
	}
	$CPF = $resultAssistencia[0]['cpf'];

	/*echo "matricula = $matricula<br>";
	echo "comentario = $comentario<br>";
	echo "indexCaso = $indexCaso<br>";
	echo "cpf = $CPF<br>";*/
	
	
	//$comentario = str_replace("$","＄",$comentario);
	$comentario = str_replace("\"","'",$comentario);
	
	
	$sqlGetComment = "SELECT * FROM `atendimentos` WHERE `index` = $indexCaso";
	$queryComment = $conexao->query($sqlGetComment);
	if ($queryComment != false)
	{
		$resultComment = $queryComment->fetchAll( PDO::FETCH_ASSOC );
		$commentInicial = $resultComment[0]['comentarios'];
	}
	else
	{
		echo "Nao Achei<br><br>";
		return;
	}
	
	
	
	$commentInicial = $commentInicial."|".date(DATE_RFC822)."#".$matricula."&".$comentario;
	echo "commentInicial = $commentInicial<br>";
	$data = date(DATE_RFC822);
	$sqlAtendimento = "UPDATE `atendimentos` SET `dataUltimaAtualizacao`=\"$data\",`comentarios`=\"$commentInicial\" WHERE `index` = $indexCaso";
	//echo "sqlAtendimento = $sqlAtendimento<br>";
	$queryAtendimento = $conexao->query($sqlAtendimento);
	if ($queryAtendimento != false)
	{
		echo "<form id=\"id_auto\" action=\"mainProfessor.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
			echo "<input type=\"hidden\" name=\"idCaso\" value=\"$indexCaso\">";
			echo "<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">";
		echo "</form>";
		echo "<script>
				document.getElementById(\"id_auto\").submit();
			  </script>";
	}
	else
	{
		echo "<form id=\"id_auto\" action=\"mainProfessor.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
			echo "<input type=\"hidden\" name=\"idCaso\" value=\"$indexCaso\">";
			echo "<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">";
			echo "<h3> Seu comentario não pode ser inserio. Evite caracteres especiais (á ü etc) e aspas (\" \")</h3>";
			echo "<button type=\"submit\">Voltar</button>";
		echo "</form>";
	}
	
?>