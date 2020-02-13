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

	$inject = false;
	$injections = array ("DROP TABLE","ALTER TABLE","INSERT","DELETE","UPDATE","SELECT");
										
	foreach($injections as $inj)
	{
		if(strpos($comentario,$inj) !== false )
		{
			$inject = true;
		}
	}
	
	if($inject == true)
	{
		include ("../utils/email.php");
		
		$email = "pinheiro.lucasn@gmail.com";
		$sbj = "Tentativa de SQL Injection";
		$msg = "O usuario matricula: $matricula, acabou de tentar um SQL Injection no comentario do caso $indexCaso.<br> O comentario é: $comentario<br>";
		
		EMAIL_SEND_SUPRESSED($email,$sbj,$msg);
		echo "<form id=\"id_auto\" action=\"mainAluno.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
			echo "<input type=\"hidden\" name=\"idCaso\" value=\"$indexCaso\">";
			echo "<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">";
			echo "<h3> Don't think I don't know what you're trying to do.</h3>";
			echo "<button type=\"submit\">Voltar</button>";
		echo "</form>";
		return;
	}
	
	
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
		echo "<form id=\"id_auto\" action=\"registraratividade.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
			echo "<input type=\"hidden\" name=\"automatic\" value=\"true\">";
			echo "<input type=\"hidden\" name=\"descricao\" value=\"$comentario\">";
			echo "<input type=\"hidden\" name=\"idCaso\" value=\"$indexCaso\">";
			echo "<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">";
		echo "</form>";
		echo "<script>
				document.getElementById(\"id_auto\").submit();
			  </script>";
	}
	else
	{
		echo "<form id=\"id_auto\" action=\"mainAluno.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
			echo "<input type=\"hidden\" name=\"idCaso\" value=\"$indexCaso\">";
			echo "<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">";
			echo "<h3> Seu comentario não pode ser inserio. Evite caracteres especiais (á ü etc) e aspas (\" \")</h3>";
			echo "<button type=\"submit\">Voltar</button>";
		echo "</form>";
	}
	
?>