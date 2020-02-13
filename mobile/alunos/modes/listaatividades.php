<?php

		include ('../../utils/documentos.php');
		include_once ('../../utils/professores.php');
		
		echo "
			<div class=\"w3-cell-row\">
				<div class=\"w3-cell w3-container\">
					<table class=\"table table-bordered\">";
						
						if (strstr($mode,"pendentes"))
						{
							$sqlAtividades = "SELECT * FROM `atividades` WHERE `matricula` = $matricula AND `pendente` = 1 ORDER BY `dataAtv` DESC";
							echo "<tr bgcolor=\"#505050\" ><td colspan=\"9\" align=\"center\"><strong><font color=\"#FFFFFF\">HISTÓRICO DE ATIVIDADES PENDENTES</font></strong></td></tr>";
						}
						else
						{
							$sqlAtividades = "SELECT * FROM `atividades` WHERE `matricula` = $matricula AND `pendente` != 1 ORDER BY `dataAtv` DESC";
							echo "<tr bgcolor=\"#505050\" ><td colspan=\"9\" align=\"center\"><strong><font color=\"#FFFFFF\">HISTÓRICO DE ATIVIDADES ACEITAS</font></strong></td></tr>";
						}
						
						$queryAtividades = $conexao->query($sqlAtividades);
						$resultAtividades = $queryAtividades->fetchAll(PDO::FETCH_ASSOC);
						for($i=0;$i<count($resultAtividades);$i++)
						{
							
							$responsavel = $resultAtividades[$i]['responsavel'];
							$tipo = $resultAtividades[$i]['tipo'];
							$atividade = $resultAtividades[$i]['atividade'];
							$descricao = $resultAtividades[$i]['descricao'];
							$pendente = $resultAtividades[$i]['pendente'];
							$horas = $resultAtividades[$i]['horas'];
							$index = $resultAtividades[$i]['index'];
							$comentario = $resultAtividades[$i]['comentario'];
							$ano = date('Y');
							$mes = date('n');
							if (intval($mes) < 8)
							{
								$strInicio = "$ano-01-01";
								$strFim = "$ano-07-31";
							}
							else
							{
								$strInicio = "$ano-08-01";
								$strFim = "$ano-12-31";
							}
							$displayData = $resultAtividades[$i]['dataAtv'];
							$dataAtv = new DateTime($resultAtividades[$i]['dataAtv']);
							
							$dataInicio = new DateTime($strInicio);
							$dataFim = new DateTime($strFim);
							$dataFim->setTime(23,59);
							if ($dataFim < $dataAtv)
								continue;
							if ($dataInicio > $dataAtv)
								continue;
							$button = "";
							$apagar = "";
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
									$button = "<button type=\"submit\" formaction=\"deleteatividade.php\" name=\"index\" value=\"$index\" formnovalidate class=\"btn btn-primary\">X</button>";
									$apagar = "<tr><td width=\"50%\"><strong>Apagar</strong></td><td width=\"50%\">$button</td></tr>";
								break;
								case 2:
									$pendente = "Secretaria";
									$button = "<button type=\"submit\" formaction=\"deleteatividade.php\" name=\"index\" value=\"$index\" formnovalidate class=\"btn btn-primary\">X</button>";
									$apagar = "<tr><td width=\"50%\"><strong>Apagar</strong></td><td width=\"50%\">$button</td></tr>";
								break;
							}
							
							$matProfessor = PROFESSORES_GETMATRICULABYNAME($responsavel);
							$dir  = DOCUMENTS_GETDOCUMENTPATH($matProfessor)."/atividades";
							$dir = "../".$dir;
							$filename = $index."-".$matricula."-Comprovante";
							$files = glob("$dir/$filename.*");
							$filePath = $files[0];
							if (file_exists($filePath))
								$anchor = "<a href=\"$filePath\" target=\"_blank\"><img src=\"../../uploads/defaultAssets/download.png\" width=\"20%\" height=\"6%\"></a>";
							else
								$anchor = "Sem Documento";
							
							$primeiroNome = substr($responsavel,0,strpos($responsavel," "));
							$pieces = explode(' ', $responsavel);
							$ultimoNome = array_pop($pieces);
							
							$displayName = $primeiroNome." ".$ultimoNome;
							
							
							echo "
								<tr><td width=\"50%\"><strong>Data da Atividade</strong></td><td width=\"50%\">$displayData</td></tr>
								<tr><td width=\"50%\"><strong>Horas</strong></td><td width=\"50%\">$horas</td></tr>
								<tr><td width=\"50%\"><strong>Tipo</strong></td><td width=\"50%\">$tipo</td></tr>
								<tr><td width=\"50%\"><strong>Titulo</strong></td><td width=\"50%\">$atividade</td></tr>
								<tr><td width=\"50%\"><strong>Descricao</strong></td><td width=\"50%\">$descricao</td></tr>
								<tr><td width=\"50%\"><strong>Professor</strong></td><td width=\"50%\">$displayName</td></tr>
								<tr><td width=\"50%\"><strong>Status</strong></td><td width=\"50%\">$pendente</td></tr>
								<tr><td width=\"50%\"><strong>Comprovante</strong></td><td width=\"50%\">$anchor</td></tr>
								$apagar
								<td align=\"center\" colspan=\"2\">";
								if (!empty($comentario))
								{
									echo "<button onclick=\"alert('$comentario'); return false;\" formnovalidate class=\"btn btn-primary btn-block\">Comentario</button>";
								}
								else
								{
									echo "<s>Sem Comentario</s>";
								}
								echo "</td>
								<tr><td colspan=\"2\" style=\"background-color:#333333\"></td></tr>
							";
						}
						
						echo "
					</table>
				</div>
			</div>";		
				

?>