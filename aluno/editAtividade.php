<?php
	include("../utils/newconexao.php");
	include("../utils/general.php");
	
	$i=0;
	$asdput = "documento$i";
	echo "asdput = $asdput<br>";
	print_r ($_FILES);
	
	while($_FILES[$asdput]['error'] != UPLOAD_ERR_OK)
	{
		echo "asdasd<br>";
		$i++;
		$asdput = "documento$i";
		if ($i>100)
		{
			echo "<h1>Nenhum arquivo recebido</h1>";
			
			echo "<form id=\"id_auto\" action=\"mainAluno.php\" method=\"post\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
				<input type=\"hidden\" name=\"mode\" value=\"listaatividades\">
				<input type=\"submit\" value=\"Voltar\">
			</form>
			";
			return;
		}
	}
	
	echo "i = $i<br>";
	
	if ( $_FILES["documento$i"]['error'] == UPLOAD_ERR_NO_FILE )
	{
		echo "ERR_NO_FILE<br>";
		return; 
	}
	else
	{//armazenar arquivo
		echo "FILE<br><br>";
	
		$atvIndex = $_POST['atvIndex'];
		$matricula = $_POST['matricula'];
		
		$sqlAtvInfo = "SELECT * FROM `atividades` WHERE `index` = $atvIndex";
		$queryAtvInfo = $conexao->query($sqlAtvInfo);
		if ($queryAtvInfo == false)
		{
			echo "queryAtv = false<br>sqlAtvInfo = $sqlAtvInfo<br>";
			
			return;
		}
		$resultAtvInfo = $queryAtvInfo->fetchAll(PDO::FETCH_ASSOC);
		$professor = $resultAtvInfo[0]['responsavel'];
	
		$path = $_FILES["documento$i"]['name'];
		$ext = pathinfo($path, PATHINFO_EXTENSION);
		$ext = strtolower($ext);
		
		echo "path = $path<br>";
		echo "ext = $ext<br><br>";
		include ('../utils/documentos.php');
		include_once ('../utils/professores.php');
		$matProfessor = PROFESSORES_GETMATRICULABYNAME($professor);
		echo "matProfessor = $matProfessor<br>";
		if($matProfessor == "Matricula not found")
		{
			transactionFailed("Professor responsavel não encontrado, contate a secretaria.<p></p>");
			return;
		}
		
		
		$target_Path = DOCUMENTS_GETDOCUMENTPATH($matProfessor).'/atividades/';
		if (is_dir($target_Path) != 1)
		{
			echo "path doesn't exist<br>";
			var_dump(mkdir($target_Path,0777, true));
			chmod($target_Path, 0777);
		}
		else
		{
			echo "path exists<br>";
			chmod($target_Path, 0777);
		}
		
		echo "Target_Path = $target_Path<br>";
		$target_Path = $target_Path.basename($path);
		echo "Target_Path = $target_Path<br><br>";
		 
		if(move_uploaded_file( $_FILES["documento$i"]['tmp_name'], $target_Path ) == false)
		{
			transactionFailed("Arquivo nao pode ser enviado, contate a secretaria.<p></p>");
			return;		
		}
		$arquivo = $atvIndex.'-'.$matricula.'-Comprovante'.".".$ext;
		$newpath = DOCUMENTS_GETDOCUMENTPATH($matProfessor).'/atividades/'.$arquivo;
		$oldpath = DOCUMENTS_GETDOCUMENTPATH($matProfessor).'/atividades/'.$path;
		
		rename	($oldpath,$newpath);
		chmod($oldpath,0777);
		
	}
	
	echo "<form id=\"id_auto\" action=\"mainAluno.php\" method=\"post\">
			<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
			<input type=\"hidden\" name=\"mode\" value=\"listaatividades\">
		</form>
	";
	
	echo "<script>
			document.getElementById('id_auto').submit();
		</script>";
	
	
?>