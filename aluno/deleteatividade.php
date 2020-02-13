<?php

	include('../utils/newconexao.php');
	include('../utils/documentos.php');
	include('../utils/professores.php');
	
	$index = $_POST['index'];
	$matricula = $_POST['matricula'];
	$mode = "listaatividades";
	
	$sqlNomeProfessor = "SELECT * FROM `atividades` WHERE `index` = $index";
	$queryNomeProfessor = $conexao->query($sqlNomeProfessor);
	if ($queryNomeProfessor != false)
	{
		$resultNomeProfessor = $queryNomeProfessor->fetchAll(PDO::FETCH_ASSOC);
		$responsavel = $resultNomeProfessor[0]['responsavel'];
	}
	
	$sqlDelete = "DELETE FROM `atividades` WHERE `index` = $index";
	$queryDelete = $conexao->query($sqlDelete);
	if ($queryDelete != false)
	{
		{//Deleta arquivo
			$matriculaProfessor = PROFESSORES_GETMATRICULABYNAME($responsavel);
			echo "matriculaProfessor = $matriculaProfessor<br>";
			$search = $index.'-'.$matricula.'-Comprovante.';
			echo "Search = $search<br><br>";	
			if ($matriculaProfessor != "Matricula not found")
			{
				$path = DOCUMENTS_GETDOCUMENTPATH($matriculaProfessor).'/atividades/';
				echo "path = $path<br>";
				if (is_dir($path)){
				  if ($dh = opendir($path)){
					while (($file = readdir($dh)) !== false)
					{
						echo "file = $file<br>";
						echo "realpath(file) = ".realpath($file)."<br>";
						if (!is_dir($file))
						{
							if(strstr($file,$search) != false)
							{
								echo "strPos<br>";
								$ret = unlink($path.$file);
								
								if ($ret == true)
								{
									echo "Apaguei<br>";
								}
								else
								{
									
									echo "Não Apaguei<br>";
								}
								
							}
						}
					}
					closedir($dh);
				  }
				}
			}
		}
		
		echo "<form id=\"id_form\" action=\"mainAluno.php\" method=\"post\">";
		echo "
			<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
			<input type=\"hidden\" name=\"mode\" value=\"$mode\">
		</form>
			<script>
				document.getElementById('id_form').submit();
			</script>
		";
	}
	else
	{
		echo " Não foi possivel deletar<br> ";
		echo "<a href=\"javascript:history.go(-1)\">Voltar</a>";
	}
	
	

?>