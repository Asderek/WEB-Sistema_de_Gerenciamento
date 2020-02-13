<?php
	include('../utils/documentos.php');
	include('../../newconexao.php');

	$matriculaResponsavel = $_POST['matriculaResponsavel'];
	$matricula = $_POST['matricula'];
	$indexCaso = $_POST['index'];
	$nomeArquivo = $_POST['nomearquivo'];
	$arquivo = $_FILES['documento'];
	$cpf = $_POST['cpf'];
	
	$path = $_FILES['documento']['name'];
	$ext1 = pathinfo($path, PATHINFO_EXTENSION);
	
	$success = true;
	
	$ext1 = strtolower($ext1);
	
	$diretorio = DOCUMENTS_GETDOCUMENTPATH($cpf);
	
	if($ext1 != "pdf")
	{
		$success = false;
		echo '<h5 class="text-center">Tipo do arquivo invalido, por favor, tente novamente.<p></p>';
	}

	$target_Path = $diretorio.'/';
	//$target_Path = "../uploads/$cpf/";
	if (is_dir($target_Path) != 1)
	{
		mkdir($target_Path, 0775);
	}
	$target_Path = $target_Path.basename($path);
	 
	
	
	
	if(move_uploaded_file( $arquivo['tmp_name'], $target_Path ) == false)
	{
		$success = false;
		echo '<h5 class="text-center">Arquivo1 nao pode ser enviado, contate a secretaria.<p></p>';
		return;
	}
	
	$newpath = $diretorio.'/'.$indexCaso."$".$nomeArquivo.".".$ext1;
	//$newpath = "../uploads/$cpf/".$indexCaso."$".$nomeArquivo.".".$ext1;
	$oldpath = $diretorio.'/'.$path;
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
		$sqlUpdate = "UPDATE `atendimentos` SET `arquivos`=\"$arquivos\" WHERE `index` = $indexCaso";
		$queryUpdate = $conexao->query($sqlUpdate);
	
		if ($queryUpdate != false )
		{
			echo "<form id=\"id_auto\" action=\"mainMonitor.php\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"matriculaResponsavel\" value=\"$matriculaResponsavel\">";
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
			echo "<form id=\"id_auto\" action=\"mainMonitor.php\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"matriculaResponsavel\" value=\"$matriculaResponsavel\">";
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
		echo "<form id=\"id_auto\" action=\"mainMonitor.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"matriculaResponsavel\" value=\"$matriculaResponsavel\">";
			echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
			echo "<input type=\"hidden\" name=\"idCaso\" value=\"$indexCaso\">";
			echo "<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">";
			echo "<h3> Arquivo não pode ser enviado. Evite caracteres especiais (á ü etc) e aspas (\" \") e tente novamente</h3>";
			echo "<button type=\"submit\">Voltar</button>";
		echo "</form>";
	}

?>