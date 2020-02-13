<div>
	<table class="table table-bordered">
		<tr><td align="center"><label>Matricula do Aluno  </label><input type="text" name="deleteMatricula"></td></tr>
		<tr><td align="center"><button type="submit" name="mode" value="deletaaluno" onclick="return DeletaAlert();" class="btn btn-primary">Delete</button></td></tr>
	</table>
</div>
<?php

	include("../utils/newconexao.php");
	include("../utils/documentos.php");
	if(!empty($_POST['deleteMatricula']))
	{
		$matriculaDelete = $_POST['deleteMatricula']; 
		$sqlProfessores = "SELECT * FROM `professores` WHERE 1";
		$queryProfessores = $conexao->query($sqlProfessores);
		$resultProfessores = $queryProfessores->fetchAll(PDO::FETCH_ASSOC);
		for($i=0;$i<count($resultProfessores);$i++)
		{
			$matriculaProfessor = $resultProfessores[$i]['matricula'];
			{//Deleta arquivo
				$search = $matriculaDelete.'-Comprovante.';
				$path = DOCUMENTS_GETDOCUMENTPATH($matriculaProfessor).'/atividades/';
				if (is_dir($path))
				{
				  if ($dh = opendir($path)){
					while (($file = readdir($dh)) !== false)
					{
						if (!is_dir($file))
						{
							if(strstr($file,$search) != false)
							{
															
								
								$ret = unlink($path.$file);
								
								if ($ret == true)
								{
									echo "Apaguei $path $file<br>";
								}
								else
								{
									
									echo "Não Apaguei $path $file<br>";
								}
							}
						}
					}
					closedir($dh);
				  }
				}
			}
			
		}
	}

?>

<script>
	function DeletaAlert()
	{
		return confirm("Essa ação vai deletar todos os arquivos do aluno");
	}
</script>