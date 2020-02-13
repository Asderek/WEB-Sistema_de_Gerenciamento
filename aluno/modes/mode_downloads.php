<?php
	include ('../../newconexao.php');
	include ('../utils/professores.php');
	
	$matricula = $_POST['matricula'];

	$matriculaProfessor = PROFESSORES_GETMATRICULABYALUNO($matricula);
	
	$plantao = PROFESSORES_GETPROFESSORPLANTAOMATRICULA($matricula);
	
	$arquivos = array();
	
	if ($matriculaProfessor != "")
	{
		$dir = "../uploads/$matriculaProfessor";
		
		if (is_dir($dir)){
		  if ($dh = opendir($dir)){
			while (($file = readdir($dh)) !== false){
				if (!is_dir($file))
				{
					if (strpos($file,'.') != false)
						array_push($arquivos,$file);	
				}
					
			}
			closedir($dh);
		  }
		}
	}
	
	if ($plantao != "")
	{
		$arquivosPlantao = array();
		$dir = "../uploads/$plantao";
		if (is_dir($dir)){
		  if ($dh = opendir($dir)){
			while (($file = readdir($dh)) !== false){
				if (strpos($file,'.') != false)
					array_push($arquivosPlantao,$file);
			}
			closedir($dh);
		  }
		}
	}
	
	echo "
	
	
	
	<table class=\"table table-bordered table-hover\">
		<tbody>
				<tr align=\"center\" bgcolor = \"#A0A0A0\">
					<td> Documentos Gerais EMA </td>
				</tr>
				<tr align=\"center\">
					<td><a target=\"_blank\" href=\"../uploads/defaultAssets/Controle-de-Carga-Horaria.pdf\">Controle de Carga Horária</a></td>
				</tr>
				<tr align=\"center\">
					<td><a target=\"_blank\" href=\"../uploads/defaultAssets/Manual-do-Estagiario.pdf\">Manual do Estagiario</a><br></td>
				</tr>
				<tr align=\"center\">
					<td><a target=\"_blank\" href=\"../uploads/defaultAssets/CONTROLE-DE-PLANTAO_MODELO-site.docx\">Relatório de Plantão</a><br></td>
				</tr>
				<tr align=\"center\">
					<td><a target=\"_blank\" href=\"../uploads/defaultAssets/Orientacao-Aproveitamento-de-Estagio-Profissional.pdf\">Relatório de Estágio</a><br></td>
				</tr>
				<tr align=\"center\">
					<td><a target=\"_blank\" href=\"../uploads/defaultAssets/Relatorio de Audiencia.pdf\">Relatório de Audiência</a><br></td>
				</tr>
				<tr align=\"center\">
					<td><a target=\"_blank\" href=\"../uploads/defaultAssets/Relatorio de Monitoria.pdf\">Relatório de Monitoria</a><br></td>
				</tr>
				<tr align=\"center\">
					<td><a target=\"_blank\" href=\"../uploads/defaultAssets/Relatorio de Visita Orientada.pdf\">Relatório de Visita Orientada</a></td>
				</tr>
				<tr align=\"center\" bgcolor = \"#A0A0A0\">
					<td> Documentos do Professor </td>
				</tr>";
				
				
				$dir = "../uploads/$matriculaProfessor";
				
				for($i=0;$i<count($arquivos);$i++)
				{
					$input = $arquivos[$i];
					if ($input==".." || $input == ".")
					{}
					else
					{
						echo "<tr align=\"center\">";
							echo "<td>";
									echo "<a target=\"_blank\" href=\"$dir/$input\">$input</a><br>";
							echo "</td>";
						echo "</tr>";
					}
				}
				
				
				$dir = "../uploads/$plantao";
				echo "<tr align=\"center\" bgcolor = \"#A0A0A0\">
					<td> Documentos do Plantao </td>
				</tr>";
				for($i=0;$i<count($arquivosPlantao);$i++)
				{
					$input = $arquivosPlantao[$i];
					if ($input==".." || $input == ".")
					{}
					else
					{
						echo "<tr align=\"center\">";
							echo "<td>";
									echo "<a target=\"_blank\" href=\"$dir/$input\">$input</a><br>";
							echo "</td>";
						echo "</tr>";
					}
				}
				
				echo "
		</tbody>
	</table>	";

?>
