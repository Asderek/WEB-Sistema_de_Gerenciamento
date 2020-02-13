<?php
	
	include('../../newconexao.php');

	$matricula = $_POST['matricula'];
	{
		echo "<div id=\"id_listaAtividades\">";
		
			$sqlAtividades = "SELECT * FROM `atividades` WHERE `matricula` = $matricula ORDER BY `disciplina`,`dataAtv`";
			$queryAtividades = $conexao->query($sqlAtividades);
			if ($queryAtividades == false)
			{
				echo "Matricula Incorreta tente novamente<br>";
				return;
			}
			$resultAtividades = $queryAtividades->fetchAll( PDO::FETCH_ASSOC );
			$rowsAtividades = count($resultAtividades);

			$nome = $resultAtividades[0]['nome'];

			if($rowsAtividades<0)
			{
				echo "Atividades nao encontrada somehow wtf??";
			}
			$colspan = 7;
			echo "
				<table class=\"table table-bordered \" style=\"border: 1px black;\" id=\"id_table\">
				<tr bgcolor=\"#FFFFFF\" ><td colspan=\"$colspan\" align=\"center\"><h3><strong><font color=\"#000000\">RELATÓRIO DE ATIVIDADES EMA PUC-RIO</font></strong></h3></td></tr>
				<tr><td colspan=\"$colspan\" align=\"center\"><h4><strong><font color=\"#000000\">$nome [$matricula]</font></strong></h4></td></tr>
			";
				
			include ('../utils/documentos.php');
			include ('../utils/professores.php');
			$disciplinaAux = "";
			for($i=0;$i<$rowsAtividades;$i++)
			{
				$responsavel = $resultAtividades[$i]['responsavel'];
				$tipo = $resultAtividades[$i]['tipo'];
				$atividade = $resultAtividades[$i]['atividade'];
				$pendente = $resultAtividades[$i]['pendente'];
				$horas = $resultAtividades[$i]['horas'];
				$index = $resultAtividades[$i]['index'];
				$dataAtv = $resultAtividades[$i]['dataAtv'];
				$disciplina = $resultAtividades[$i]['disciplina'];
				
				if($disciplina != $disciplinaAux)
				{
					$disciplinaAux = $disciplina;
										
					echo "
					<tr bgcolor=\"#ccc\" ><td colspan=\"$colspan\" align=\"center\"><h4><strong>$disciplina</strong></h4></td></tr>
					
					<tr align=\"center\" style=\"background-color: #F0F0F0;\">
						<td><strong>Responsavel</strong></td>
						<td><strong>Tipo</strong></td>
						<td><strong>Titulo</strong></td>
						<td><strong>Status</strong></td>
						<td><strong>Horas</strong></td>
						<td><strong>Data da Atividade</strong></td>
						<td><strong>Comprovante</strong></td>
					</tr>";
					
				}
				switch ($pendente)
				{
					case -1:
						$pendente = "Rejeitado";
					break;
					case 0:
						$pendente = "Aceito";
					break;
					case 1:
						$pendente = "Pendente";
					break;
					case 2:
						$pendente = "Pendente (Secretaria)";
					break;
				}
				
				$matProfessor = PROFESSORES_GETMATRICULABYNAME($responsavel);
				$dir  = DOCUMENTS_GETDOCUMENTPATH($matProfessor)."/atividades";
				$filename = $index."-".$matricula."-Comprovante";
				$files = glob("$dir/$filename.*");
				$filePath = $files[0];
				if (file_exists($filePath))
				{
					$anchor = "<a href=\"$filePath\" target=\"_blank\"><img name=\"img\" src=\"../uploads/defaultAssets/download.png\" width=\"40%\" height=\"6%\"></a>";
				}
				else
				{
					$anchor = "Sem Documento";
				}
												
				echo "<tr>";
					echo "
					<td align=\"center\">$responsavel</td>
					<td align=\"center\">$tipo</td>
					<td align=\"center\">$atividade</td>
					<td align=\"center\">$pendente</td>
					<td align=\"center\">$horas</td>
					<td align=\"center\">$dataAtv</td>
					<td width=\"5%\" align=\"center\">$anchor</td>";
				echo "</tr>";
			
		}

		echo	"</table><br>";
			echo "</div>";
	}
?>