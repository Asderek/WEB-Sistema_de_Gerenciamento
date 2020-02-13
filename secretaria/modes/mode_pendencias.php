<?php	
	include('../utils/documentos.php');
	include('../utils/newconexao.php');
	include('../utils/professores.php');
	
	$sqlAtividade = "SELECT * FROM atividades WHERE `pendente` = 2";
	$queryAtividade = $conexao->query($sqlAtividade);
	if($queryAtividade != false)
	{
		$resultAtividade = $queryAtividade->fetchAll( PDO::FETCH_ASSOC );
		$rowsAtividade = count($resultAtividade);
	}
	
	echo '
		<table class="table table-bordered table-hover" border="2" bordercolor=BLACK id="id_tableTest" >
			<tbody>';
			
	echo '
			<tr align="center">
				<td><input id="id_checkbox" type="checkbox"></td>
				<td><strong>Matricula</strong></td>
				<td><strong>Nome</strong></td>
				<td><strong>Tipo da Atividade</strong></td>
				<td><strong>Atividade</strong></td>
				<td><strong>Descrição</strong></td>
				<td><strong>Aceitar</strong></td>
				<td><strong>Acertos</strong></td>
				<td><strong>Rejeitar</strong></td>
				<td><strong>Documento</strong></td>
			</tr>
	';
	for($i=0;$i<$rowsAtividade;$i++)
	{
		$matriculaAluno = $resultAtividade[$i]['matricula'];
		$nomeAluno = $resultAtividade[$i]['nome'];
		$atividade = $resultAtividade[$i]['atividade'];
		$tipo = $resultAtividade[$i]['tipo'];
		$descricao = $resultAtividade[$i]['descricao'];
		$index = $resultAtividade[$i]['index'];
		$checkBox = $index."_checkbox";
		$indexRej = "rej_".$index;
		$indexAcc = "acc_".$index;
		$selectName = $index."_horas";
		$responsavel = $resultAtividade[$i]['responsavel'];
		$matResponsavel = PROFESSORES_GETMATRICULABYNAME($responsavel);
		
		$dir    = DOCUMENTS_GETDOCUMENTPATH($matResponsavel)."/atividades";
		$filename = $index."-".$matriculaAluno."-Comprovante";
		$files = glob("$dir/$filename.*");
		$filePath = $files[0];
		if (file_exists($filePath))
			$anchor = "<a href=\"$filePath\" target=\"_blank\"><img src=\"../uploads/defaultAssets/download.png\" width=\"40%\" height=\"6%\"></a>";
		else
			$anchor = "Sem Documento";
		
		
		echo '<tr align="left">';
			echo "<td width=\"2%\"><input type=\"checkbox\" name=\"$checkBox\"></input></td>";
			echo "<td width=\"8%\">$matriculaAluno</td>";
			
			echo "<td width=\"25%\" align=\"center\">
					<button type=\"submit\" name=\"mode\" value=\"veraluno$matriculaAluno\" class=\"button-link\">$nomeAluno</button>	
			</td>";
			echo "<td width=\"15%\" align=\"center\">$tipo</td>";
			echo "<td width=\"15%\" align=\"center\">$atividade</td>";										
			echo "<td width=\"50%\" align=\"center\">$descricao</td>";	
			
			$row = $i+2;
			$parameter = $row."reject".$index;
			
			echo "<td width=\"2%\" align=\"center\"><button type=\"submit\" formaction=\"processapendencias.php\" name=\"index\" value=\"$indexAcc\" class=\"accept btn-primary btn-lg btn-block\">V</button></td>";	
			
			if ($tipo == "primFase")
			{
				echo "<td align=\"center\"><select name=\"acertos\">";
					for($j=0;$j<81;$j++)
					{
						echo "<option value=\"$j\">$j</option>";
					}
				echo "</select></td>";
			}
			else
			{
				echo "<td></td>";
			}
			
			//echo "<td width=\"2%\" align=\"center\"><button type=\"submit\" onclick=\"showCommentaries('$parameter'); return false;\" formaction=\"processapendencias.php\" name=\"index\" value=\"$indexRej\" class=\"reject btn-primary btn-lg btn-block\">X</button></td>";								
			echo "<td width=\"2%\" align=\"center\"><button type=\"submit\" onclick=\"showCommentaries('$parameter'); return false;\" formaction=\"processapendencias.php\" name=\"index\"  value=\"$indexRej\" class=\"reject btn-primary btn-lg btn-block\">X</button></td>";
			echo "<td width=\"70%\" align=\"center\">
					$anchor
				</td>";
		echo '</tr>';
	}
	echo '</tbody>
		</table>';

	echo "
		<script>
			
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
				td2.setAttribute(\"colspan\",\"8\");
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
				sendButton.setAttribute(\"formaction\",\"processapendencias.php\");
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
		
			
		
				
		</script>";		
	
?>