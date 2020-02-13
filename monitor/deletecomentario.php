<?php

	include ('../utils/newconexao.php');
	$index = $_POST['index'];
	$comment = $_POST['targetcomment'];
	$matricula = $_POST['matricula'];
	
	echo "index = $index<br>";
	echo "comment = $comment<br>";
	
	$sqlRemove = "SELECT * FROM `atendimentos` WHERE `index` = $index";
	$queryRemove = $conexao->query($sqlRemove);
	if ($queryRemove == false)
	{
		return;
	}
	$resultRemove = $queryRemove->fetchAll(PDO::FETCH_ASSOC);
	$comments = $resultRemove[0]['comentarios'];
	echo "comments = $comments<br>";
	
	$newComment = substr($comments,0,strpos($comments,$comment));
	$restComment = substr($comments,strpos($comments,$comment)+strlen($comment));
	//echo "restComment = $restComment<br>";
	$newComment = $newComment.$restComment;
	echo "newComment = $newComment<br>";

	
	$sqlUpdate = "UPDATE `atendimentos` SET `comentarios`=\"$newComment\" WHERE `index` = $index";
	echo "sqlUpdate = $sqlUpdate<br>";
	$queryUpdate = $conexao->query($sqlUpdate);
	if ($queryUpdate != false)
	{
		echo "<form id=\"id_auto\" action=\"mainMonitor.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
			echo "<input type=\"hidden\" name=\"idCaso\" value=\"$index\">";
			echo "<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">";
		echo "</form>";
		echo "<script>
				document.getElementById(\"id_auto\").submit();
			  </script>";
	}
	else
	{
		echo "<form id=\"id_auto\" action=\"mainMonitor.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
			echo "<input type=\"hidden\" name=\"idCaso\" value=\"$index\">";
			echo "<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">";
			echo "<h3> Ocorreu um erro ao deletar o comentario, contate o tecnico de informatica</h3>";
			echo "<button type=\"submit\">Voltar</button>";
		echo "</form>";
	}
?>