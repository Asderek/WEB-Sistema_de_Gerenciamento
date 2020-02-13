<?php	
	include('../utils/documentos.php');
	$matricula = $_POST['matricula'];
		
	{
		$sqlProfessor = "SELECT * FROM professores WHERE `matricula` = $matricula";
		$queryProfessor = $conexao->query($sqlProfessor);
		if($queryProfessor != false)
		{
			$resultProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
			$rowsProfessor = count($resultProfessor);
		}
		
		if($rowsProfessor>0)
		{
			$nome = $resultProfessor[0]['nome'];
			$arrayAtividades = array();
			
			$sqlAtividade = "SELECT * FROM atividades WHERE `responsavel` = \"$nome\" AND pendente = 1 ORDER BY nome, dataAtv";
			$queryAtividade = $conexao->query($sqlAtividade);
			if($queryAtividade != false)
			{
				$resultAtividade = $queryAtividade->fetchAll( PDO::FETCH_ASSOC );
				$rowsAtividade = count($resultAtividade);
				
				array_push($arrayAtividades,"Selecione Um Filtro");
				array_push($arrayAtividades,"Todos");
				for($i=0;$i<$rowsAtividade;$i++)
				{
					$tipo = $resultAtividade[$i]['tipo'];
					$tipo = ucwords($tipo);
					if (!in_array($tipo,$arrayAtividades))
						array_push($arrayAtividades,$tipo);
				}
			}
			
			echo "<label>Filtrar</label>";
			echo "<select id=\"id_select\" name=\"filtro\" onchange=\"filtra(); return false;\" class=\"form-control\">";
				for($i=0;$i<count($arrayAtividades);$i++)
				{
					$value = $arrayAtividades[$i];
					echo "<option value=\"$value\">$value</option>";
				}
			echo "</select><br><br>";
			
				
			echo '
				<table class="table table-bordered table-hover" border="2" bordercolor=BLACK id="id_tableTest" >
					<tbody>';
					
			echo "<tr><td colspan=\"10\" align=\"center\">";
			echo "<label> Horas das atividades selecionadas </label>";
				/*$arrayHoras = array();
				for($i=1;$i<11;$i++)
					array_push($arrayHoras,$i);
				array_push($arrayHoras,25);
				array_push($arrayHoras,32);
				echo "<select name=\"horasGlobal\">";
					for($i=0;$i<count($arrayHoras);$i++)
					{
						$input = $arrayHoras[$i];
						echo "<option value=\"$input\">$input</option>";
					}
				echo "</select>   ";*/
				echo "<input type=\"number\" name=\"horasGlobal\" value=\"1\" min=\"1\" max=\"75\">";
			echo "<button type=\"submit\" class=\"accept btn-primary btn-lg btn-block\" name=\"acceptAll\" style=\"width:3%\" formaction=\"asd.php\">V</button>";
				
			echo "</td></tr>";
			echo '
					<tr align="center">';
					echo '<td><input id="id_checkbox" type="checkbox"></td>';
					
			echo '
						<td><strong>Matricula</strong></td>
						<td><strong>Nome</strong></td>
						<td><strong>Tipo</strong></td>
						<td><strong>Atividade</strong></td>
						<td><strong>Descrição</strong></td>
						<td><strong>Aceitar</strong></td>
						<td><strong>Horas</strong></td>
						<td><strong>Rejeitar</strong></td>
						<td><strong>Documento</strong></td>
					</tr>
			';
			$matriculaAux = 0;
			for($i=0;$i<$rowsAtividade;$i++)
			{
				
				$matriculaAluno = $resultAtividade[$i]['matricula'];
				
				if ($matriculaAluno != $matriculaAux)
				{
					$matriculaAux = $matriculaAluno;
					$sqlFechamento = "SELECT * FROM fechamento WHERE professor = $matricula AND aluno = $matriculaAluno";
					$queryFechamento = $conexao->query($sqlFechamento);
					$fechado = false;
					if ($queryFechamento != false)
					{
						$resultFechamento = $queryFechamento->fetchAll(PDO::FETCH_ASSOC);
						$dataFechamento = $resultFechamento[0]['dataFechamento'];
						
						$ano = date('Y');
						$mes = date('n');
						
						$anoFechamento = substr($dataFechamento,0,4);
						$mesFechamento = substr($dataFechamento,5);
						
						//echo "ano = $ano<br>mes = $mes<br> anoFechamento = $anoFechamento<br> mesFechamento = $mesFechamento<br>";
						if ($anoFechamento == $ano)
						{
							if ($mesFechamento <= 7 && $mes <= 7)
								$fechado = true;
							if ($mesFechamento > 7 && $mes > 7)
								$fechado = true;
						}
					}
				}
				
				$nomeAluno = $resultAtividade[$i]['nome'];
				$atividade = $resultAtividade[$i]['atividade'];
				$descricao = $resultAtividade[$i]['descricao'];
				$index = $resultAtividade[$i]['index'];
				$tipo = $resultAtividade[$i]['tipo'];
				$checkBox = $index."_checkbox";
				$indexRej = "rej_".$index;
				$indexAcc = "acc_".$index;
				$selectName = $index."_horas";
				$dataAtv = $resultAtividade[$i]['dataAtv'];
				
				try {
					$dataAtv = new DateTime($dataAtv);
				} catch (Exception $e) {					
					continue;
				}
				
				$tipo = ucwords($tipo);
				
				if (!empty($_POST['filtro']) && $_POST['filtro'] != "Todos")
				{
					if ($tipo != $_POST['filtro'])
						continue;
				}
				
				$dir    = DOCUMENTS_GETDOCUMENTPATH($matricula)."/atividades";
				$filename = $index."-".$matriculaAluno."-Comprovante";
				$files = glob("$dir/$filename.*");
				$filePath = $files[0];
				if (file_exists($filePath))
					$anchor = "<a href=\"$filePath\" target=\"_blank\"><img src=\"../uploads/defaultAssets/download.png\" width=\"40%\" height=\"6%\"></a>";
				else
					$anchor = "Sem Documento";
				
				echo "<tr align=\"left\">";
					echo "<td width=\"2%\">";
						if(!$fechado)
							echo "<input type=\"checkbox\" name=\"$checkBox\" onchange=\"check(); return false;\"></input>";
					echo "</td>";
					
					echo "<td width=\"8%\" align=\"center\">$matriculaAluno</td>";
					
					
					
					echo "<td width=\"25%\" align=\"center\">
							<button type=\"submit\" name=\"mode\" value=\"veraluno$matriculaAluno\" 
								class=\"button-link\"
								>
								$nomeAluno
								</button>	
					</td>";
					
					
					
					echo "<td width=\"15%\" align=\"center\">$tipo</td>";	
					echo "<td width=\"15%\" align=\"center\">$atividade</td>";										
					echo "<td width=\"50%\" align=\"center\">$descricao</td>";
					if (!$fechado)
					{
						$row = $i+2;
						$parameter = $row."accept".$index;
						//echo "<td width=\"2%\" align=\"center\"><button type=\"submit\" onclick=\"showCommentaries('$parameter'); return false;\" formaction=\"../professor/cadastraratividade.php\" name=\"index\" value=\"$indexAcc\" class=\"accept btn-primary btn-lg btn-block\">V</button></td>";								
						echo "<td width=\"2%\" align=\"center\"><button type=\"submit\" formaction=\"../professor/cadastraratividade.php\" name=\"index\" value=\"$indexAcc\" class=\"accept btn-primary btn-lg btn-block\">V</button></td>";								
						echo "<td width=\"10%\" align=\"center\">";
								echo "<input type=\"number\" name=\"$selectName\" value=\"1\" min=\"1\" max=\"75\">";
						echo "</td>";
						$parameter = $row."reject".$index;
						echo "<td width=\"2%\" align=\"center\"><button type=\"submit\" onclick=\"showCommentaries('$parameter'); return false;\" formaction=\"../professor/cadastraratividade.php\" name=\"index\" value=\"$indexRej\" class=\"reject btn-primary btn-lg btn-block\">X</button></td>";
						echo "<td width=\"70%\" align=\"center\">$anchor</td>";
					}
					else
					{								
						echo "<td colspan=\"4\" align=\"center\" style=\"background-color:#FFEEEE;\">Pasta Fechada</td>";
					}
				echo '</tr>';
			}
			
			if($matricula == 111111)
			{
				echo "<tr><td colspan=\"6\" align=\"center\">Atribuir cada hora para as atividades marcadas</td><td colspan=\"4\" align=\"center\"><button formaction=\"atribuiIndividual.php\" style=\"background-color:#468557;\" class=\"accept btn-primary btn-lg btn-block\">Vai La</button></td></tr>";
			}
			echo '</tbody>
				</table>';
			echo "
			<script>
				
				function filtra()
				{
					var selection = document.getElementById('id_select').value;
					
					if(selection == \"Selecione Um Filtro\")
						return false;
					
					var inp = document.createElement(\"input\");
					inp.setAttribute(\"type\",\"hidden\");
					inp.setAttribute(\"name\",\"filtro\");
					inp.setAttribute(\"value\",selection);
					var form = document.getElementById('id_Form');
					form.appendChild(inp);
					var mode = document.createElement(\"input\");
					mode.setAttribute(\"type\",\"hidden\");
					mode.setAttribute(\"name\",\"mode\");
					mode.setAttribute(\"value\",\"$mode\");
					
					var matricula = document.createElement(\"input\");
					matricula.setAttribute(\"type\",\"hidden\");
					matricula.setAttribute(\"name\",\"matricula\");
					matricula.setAttribute(\"value\",\"$matricula\");
					
					form.appendChild(mode);
					form.appendChild(matricula);
					form.submit();
					
				}
				
				function showCommentaries(trID)
				{
					var vectButtons = document.getElementsByName(\"index\");
					for(var i=0;i<vectButtons.length;i++)
					{
						vectButtons[i].setAttribute(\"style\",\"display:none\");
					}
					
					console.log(\"trID = \" + trID);
					
					var tr = document.createElement(\"tr\");
					var td1 = document.createElement(\"td\");
					var td2 = document.createElement(\"td\");
					var td3 = document.createElement(\"td\");
					td1.innerHTML = \"Comentario\";
					
					var inputText = document.createElement(\"input\");
					inputText.setAttribute(\"type\",\"text\");
					inputText.setAttribute(\"name\",\"comentario\");
					inputText.setAttribute(\"class\",\"form-control\");
					td2.setAttribute(\"colspan\",\"6\");
					td2.appendChild(inputText);
					
					for(i=0;i<trID.length;i++)
					{
						if (trID[i].toLowerCase() != trID[i].toUpperCase())
						{
							var row = trID.substr(0,i);
							var classe = trID.substr(i,6);
							var index = trID.substr(i+6);
							break;
						}
					}
					
					console.log(\"row = \" + row);
					console.log(\"classe = \" + classe);
					console.log(\"index = \" + index);
					
					var sendButton = document.createElement(\"button\");
					sendButton.setAttribute(\"type\",\"submit\");
					sendButton.setAttribute(\"class\", classe + \" btn-primary btn-lg btn-block\");
					sendButton.setAttribute(\"formaction\",\"../professor/cadastraratividade.php\");
					sendButton.setAttribute(\"name\",\"index\");
					
					sendButton.innerHTML = \"Enviar\";
					if(classe == \"accept\")
					{
						index = \"acc_\"+index;
						inputText.setAttribute(\"placeholder\",\"Digite comentario de aceitação da atividade\");
					}
					else
					{	
						index = \"rej_\"+index;
						inputText.setAttribute(\"placeholder\",\"Digite comentario de rejeição da atividade\");
					}
					
					sendButton.setAttribute(\"value\",index);

					console.log(\"index = \" + index);
					
					td3.setAttribute(\"align\",\"center\");
					td3.appendChild(sendButton);
					
					tr.appendChild(td1);
					tr.appendChild(td2);
					tr.appendChild(td3);
					
					var mainTable = document.getElementById('id_tableTest');
					var tbody = mainTable.children[0];
					tbody.insertBefore(tr, mainTable.rows[row]);	
					return false;
				}
			
				function check()
				{
					console.log(\"check\");
				}
			
					
			</script>";
			/*echo "
				<table class=\"table\" >
					<tbody>
						<tr>
							<td align=\"right\"><button type=\"submit\"  formaction=\"../professor/cadastraratividade.php\"   name=\"index\"  value=\"ACCALL\" class=\"accept btn-primary btn-lg btn-block\">Aceitar Todos</button></td>
							<td><button type=\"submit\"  formaction=\"../professor/cadastraratividade.php\"   name=\"index\"  value=\"REJALL\" class=\"reject btn-primary btn-lg btn-block\">Rejeitar Todos</button></td>
						</tr>
					</tbody>
				</table>";	*/
		}

	}
	
?>