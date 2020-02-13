<?php

	include ('../utils/documentos.php');
	include('../../newconexao.php');

	$matricula = $_POST['matricula'];
	$indexCaso = $_POST['index'];
	$nomeArquivo = $_POST['nomearquivo'];
	$arquivo = $_FILES['documento'];
	$cpf = $_POST['cpf'];
	
	$sqlArquivoMesmoNome = "SELECT * FROM `atendimentos` WHERE `index` = $indexCaso";
	$queryArquivoMesmoNome = $conexao->query($sqlArquivoMesmoNome);
	if ($queryArquivoMesmoNome != false)
	{
		$resultArquivosMesmoNome = $queryArquivoMesmoNome->fetchAll(PDO::FETCH_ASSOC);
		$arquivos = $resultArquivosMesmoNome[0]['arquivos'];
		if (strpos($arquivos,$nomeArquivo) !== false)
		{
			echo "<form id=\"id_auto\" action=\"mainProfessor.php\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
				echo "<input type=\"hidden\" name=\"idCaso\" value=\"$indexCaso\">";
				echo "<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">";
				echo "<h3> Já existe um arquivo com este mesmo nome<br>Por favor, delete o outro arquivo ou mude o nome desse arquivo (aqui no sistema)</h3>";
				echo "<button type=\"submit\">Voltar</button>";
			echo "</form>";
			return;
		}
	}
	
	echo "cpf = $cpf<br>";
	
	$path = $_FILES['documento']['name'];
	$ext1 = pathinfo($path, PATHINFO_EXTENSION);
	
	$success = true;
	
	$ext1 = strtolower($ext1);
	
	if($ext1 != "pdf")
	{
		$success = false;
		echo '<h5 class="text-center">Tipo do arquivo invalido, por favor, tente novamente.<p></p>';
	}

	$target_Path = DOCUMENTS_GETDOCUMENTPATH($cpf).'/';
	echo "target_Path = $target_Path<br>";
	
	
	//$target_Path = "../uploads/$cpf/";
	if (is_dir($target_Path) != 1)
	{
		mkdir($target_Path, 0775);
		chmod($target_Path, 0777);
	}
	else
	{
		chmod($target_Path, 0775);
	}
	$target_Path = $target_Path.basename($path);
	 echo "target_Path = $target_Path<br>";
	
	
	
	if(move_uploaded_file( $arquivo['tmp_name'], $target_Path ) == false)
	{
		$success = false;
		echo '<h5 class="text-center">Arquivo1 nao pode ser enviado, contate a secretaria.<p></p>';
		return;
	}
	
	$newpath = DOCUMENTS_GETDOCUMENTPATH($cpf).'/'.$indexCaso."$".$nomeArquivo.".".$ext1;
	//$newpath = "../uploads/$cpf/".$indexCaso."$".$nomeArquivo.".".$ext1;
	$oldpath = DOCUMENTS_GETDOCUMENTPATH($cpf).'/'.$path;
	//$oldpath = "../uploads/$cpf/".$path;
	
	rename	($oldpath,$newpath);
	
	chmod($newpath,0777);
	
	
	$sqlArquivos = "SELECT * FROM `atendimentos` WHERE `index` = $indexCaso";
	$queryArquivos = $conexao->query($sqlArquivos);
	if ($queryArquivos!= false)
	{
		$resultArquivos = $queryArquivos->fetchAll( PDO::FETCH_ASSOC );
		$arquivos = $resultArquivos[0]['arquivos'];
	}
	if ($success == true)
	{
		$arquivos = $arquivos.'$'.$nomeArquivo;
		$data = date(DATE_RFC822);
		$sqlUpdate = "UPDATE `atendimentos` SET `arquivos`=\"$arquivos\", `dataUltimaAtualizacao`=\"$data\" WHERE `index` = $indexCaso";
		$queryUpdate = $conexao->query($sqlUpdate);
	
		if ($queryUpdate != false )
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
				echo "<h3> Arquivo não pode ser enviado. Evite caracteres especiais (á ü etc) e aspas (\" \") e tente novamente</h3>";
				echo "<button type=\"submit\">Voltar</button>";
			echo "</form>";
		}
	}
	else
		{
			echo "<form id=\"id_auto\" action=\"mainProfessor.php\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
				echo "<input type=\"hidden\" name=\"idCaso\" value=\"$indexCaso\">";
				echo "<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">";
				echo "<h3> Arquivo não pode ser enviado. Evite caracteres especiais (á ü etc) e aspas (\" \") e tente novamente</h3>";
				echo "<button type=\"submit\">Voltar</button>";
			echo "</form>";
		}
	

?>