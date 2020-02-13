<?php

	include ('../utils/documentos.php');
	$matricula = $_POST['matricula'];
	print_r($_FILES);
	
	echo "<br><br>";
	
	$foto = $_FILES['documento'];
	
	echo "foto - $foto<br>";

	$path5 = $_FILES['documento']['name'];
	$ext5 = pathinfo($path5, PATHINFO_EXTENSION);
	$ext5 = strtolower($ext5);
	
	echo "path5 = $path5<br>";
	echo "ext5 = $ext5<br><br>";
	
	$target_Path5 = DOCUMENTS_GETDOCUMENTPATH($matricula).'/';
	//$target_Path5 = "../uploads/$matricula/";
	if (is_dir($target_Path5) != 1)
	{
		echo "not dir<br>";
		mkdir($target_Path5, 0775);
		chmod($target_Path5, 0777);
		$atividades = $target_Path5."/atividades/";
		mkdir($atividades, 0777);
		chmod($atividades, 0777);
	}
	else
	{
		echo "dir<br>";
		chmod($target_Path5, 0775);
		$atividades = $target_Path5."atividades/";
		if (is_dir($atividades) == false)
			echo "atividades not dir<br>";
		else
			echo "atividades dir<br>";
		chmod($atividades, 0777);
		
		echo "atividades = $atividades<br>";
	}
	
	$target_Path5 = $target_Path5.basename($path5);
	 
	echo "Target_Path5 = $target_Path5<br><br>";
	 
	if(move_uploaded_file( $foto['tmp_name'], $target_Path5 ) == false)
	{
		echo '<h5 class="text-center">Arquivo4 nao pode ser enviado, contate a secretaria.<p></p>';
		return;
		//echo '<a href="inscricao-cadastro.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
	}
	
	$oldpath = DOCUMENTS_GETDOCUMENTPATH($matricula).'/'.$path5;
	//$oldpath = "../uploads/$matricula/".$path5;
	chmod($oldpath,0777);
	
	echo "<form id=\"myForm\" class=\"form col-md-12 center-block\" action='mainProfessor.php' method=\"post\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
				<input type=\"hidden\" name=\"mode\" value=\"listardocumentos\">
				<button type=\"submit\">Go</button>
			</form>
			<script type=\"text/javascript\">
				document.getElementById('myForm').submit();
			</script>

";	
	
?>