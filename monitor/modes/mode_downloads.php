<?php
	include ('../../newconexao.php');
	
	$matricula = $_POST['matricula'];
	$sqlProfessor = "SELECT * FROM alunos WHERE matricula = $matricula";
	$queryProfessor = $conexao->query($sqlProfessor);
	$resultProfessor = $queryProfessor->fetchAll(PDO::FETCH_ASSOC);
	$professor = $resultProfessor[0]['professor'];
	
	$sqlMatriculaProfessor = "SELECT * FROM professores WHERE nome = \"$professor\"";
	$queryMatriculaProfessor = $conexao->query($sqlMatriculaProfessor);
	if ($queryMatriculaProfessor != false)
	{
		$resultMatriculaProfessor=  $queryMatriculaProfessor->fetchAll(PDO::FETCH_ASSOC );
		$matriculaProfessor = $resultMatriculaProfessor[0]['matricula'];
	}
	{// SQL PLANTAO
		$plantao = "";
		$plantao = PROFESSORES_GETPROFESSORPLANTAOMATRICULA($matricula);
	}
	
	$arquivos = array();
	
	$dir = "../uploads/$matriculaProfessor";
	
	if (is_dir($dir)){
	  if ($dh = opendir($dir)){
		while (($file = readdir($dh)) !== false){
			if (strpos($file,'.') != false)
				array_push($arquivos,$file);
		}
		closedir($dh);
	  }
	}
	
	if ($plantao != "" && $plantao!= "NONE")
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
					<td><a href=\"../uploads/defaultAssets/Controle-de-Carga-Horaria.pdf\" target=\"_blank\">Controle de Carga Horária</a></td>
				</tr>
				<tr align=\"center\">
					<td><a href=\"../uploads/defaultAssets/Manual-do-Estagiario.pdf\" target=\"_blank\">Manual do Estagiario</a><br></td>
				</tr>
				<tr align=\"center\">
					<td><a href=\"../uploads/defaultAssets/CONTROLE-DE-PLANTAO_MODELO-site.docx\" target=\"_blank\">Relatório de Plantão</a><br></td>
				</tr>
				<tr align=\"center\">
					<td><a href=\"../uploads/defaultAssets/Orientacao-Aproveitamento-de-Estagio-Profissional.pdf\" target=\"_blank\">Relatório de Estágio</a><br></td>
				</tr>
				<tr align=\"center\">
					<td><a href=\"../uploads/defaultAssets/Relatorio de Audiencia.pdf\" target=\"_blank\">Relatório de Audiência</a><br></td>
				</tr>
				<tr align=\"center\">
					<td><a href=\"../uploads/defaultAssets/Relatorio de Monitoria.pdf\" target=\"_blank\">Relatório de Monitoria</a><br></td>
				</tr>
				<tr align=\"center\">
					<td><a href=\"../uploads/defaultAssets/Relatorio de Visita Orientada.pdf\" target=\"_blank\">Relatório de Visita Orientada</a></td>
				</tr>
				<tr align=\"center\">
					<td><a href=\"../uploads/defaultAssets/Gabarito.pdf\" target=\"_blank\">Ultimo Gabarito Simulado OAB</a></td>
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
									echo "<a href=\"$dir/$input\" target=\"_blank\">$input</a><br>";
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
									echo "<a href=\"$dir/$input\" target=\"_blank\">$input</a><br>";
							echo "</td>";
						echo "</tr>";
					}
				}
				
				echo "
		</tbody>
	</table>	";

?>
