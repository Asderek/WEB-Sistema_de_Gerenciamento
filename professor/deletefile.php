<?php

	include ('../utils/documentos.php');

	if(isset($_POST['index']))
	{
		$matricula = $_POST['matricula'];

		$file = $_POST['arquivo'];
		echo "file = $file<br>";
		
		$displayName = "$".substr($file,strpos($file,"#")+1);
		$file = substr($file,0,strpos($file,"#"));
		
		echo "displayName = $displayName<br>file = $file<br>";
		
		
		$file = DOCUMENTS_GETDOCUMENTPATH($file); 
		//$file = "../uploads/$file";
		echo "file = $file<br>";
		echo "realpath = ".realpath($file)."<br>";
		

		$ret = unlink($file);
		
		echo "<a href=\"$file\">arquivo</a><br>";
		
		if ($ret == true)
		{
			echo "if<br>";
			include ("../utils/newconexao.php");
			
			$index = $_POST['index'];
			$mode = "vercaso$index";
			$sqlCliente = "SELECT * FROM `atendimentos` WHERE `index` = $index";
			echo "sqlCliente = $sqlCliente<br>";
			$queryCliente = $conexao->query($sqlCliente);
			if ($queryCliente == false)
			{
				echo "queryCliente = false<br>";
			}
			else
			{
				echo "queryCliente = true<br>";
			}
			$resultCliente = $queryCliente->fetchAll(PDO::FETCH_ASSOC);
			$arquivos = $resultCliente[0]['arquivos'];
			echo "arquivos = $arquivos<br>";
			
			$newString = substr($arquivos,0,strpos($arquivos,$displayName)).substr($arquivos,strpos($arquivos,$displayName)+strlen($displayName));
			echo "newString = $newString<br>";
			$sqlUpdate = "UPDATE `atendimentos` SET `arquivos`=\"$newString\" WHERE `index` = $index";
			$queryUpdate = $conexao->query($sqlUpdate);
			if ($queryUpdate == false)
			{
				include("../utils/email.php");
				$email = "npjpucrio@gmail.com";
				$sbj = "[AUTOMATICO] Falha na remoção de arquivos de cliente";
				$msg = "A matricula $matricula tentou remover o arquivo $displayName do atendimento de ID = $index. O arquivo fisico foi removido, porem a referencia ao arquivo nao foi removida do BD";
				EMAIL_SEND($email,$sbj,$msg);
			}
		}
	}
	else
	{
		$matricula = $_POST['matricula'];

		$file = $_POST['arquivo'];
		echo "file = $file<br>";
		
		/*$displayName = "$".substr($file,strpos($file,"#")+1);
		$file = substr($file,0,strpos($file,"#"));
		
		echo "displayName = $displayName<br>file = $file<br>";*/
		
		
		$file = DOCUMENTS_GETDOCUMENTPATH($file); 
		//$file = "../uploads/$file";
		echo "file = $file<br>";
		echo "realpath = ".realpath($file)."<br>";
		

		$ret = unlink($file);
		
		echo "<a href=\"$file\">arquivo</a><br>";
		$mode = "listardocumentos";
	}
	
	echo "<form id=\"myForm\" class=\"form col-md-12 center-block\" action='mainProfessor.php' method=\"post\">
					<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
					<input type=\"hidden\" name=\"mode\" value=\"$mode\">
					<input type=\"submit\" value=\"Voltar\">
				</form>";
	
	if ($ret == true)
	{
		echo "
					<script type=\"text/javascript\">
						document.getElementById('myForm').submit();
					</script>		

		";
	}
	
?>