<?php
		
		include ("../utils/professores.php");
		include ("../utils/documentos.php");
		
		$matriculaAluno = $_POST['matriculaAluno'];
		$matricula = $_POST['matricula'];
		
		echo "<input type=\"hidden\" name=\"source\" value=\"aluno\">";
		/*echo "<table class=\"table\"><tr><td align=\"center\">";
		echo "<button type=\"submit\" name=\"aluno\" value=\"$matriculaAluno\" formaction=\"fecharpasta.php\" class=\"btn btn-primary\" style=\"background-color:#FF5555\">Fechar Pasta</button>";
		echo "</td></tr></table>";*/
		
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
			
		
		$sqlNome = "SELECT * FROM professores WHERE matricula = $matricula";
		$queryNome = $conexao->query($sqlNome);
		$resultNome = $queryNome->fetchAll( PDO::FETCH_ASSOC );
		$meuNome = $resultNome[0]['nome'];
		
		$sqlAtividades = "SELECT * FROM `atividades` WHERE `matricula` = $matriculaAluno AND ";
		
		
		$sqlAtividades .= " `pendente` != 1";
		
		$queryAtividades = $conexao->query($sqlAtividades);
		$resultAtividades = $queryAtividades->fetchAll( PDO::FETCH_ASSOC );
		if($queryAtividades != false)
		{
			$rowsAtividades = count($resultAtividades);
		}
		$horasTot = 0;
		
		$sqlCont = "SELECT * FROM `atividades` WHERE `matricula` = $matriculaAluno";
		$queryCont = $conexao->query($sqlCont);
		$resultCont = $queryCont->fetchAll(PDO::FETCH_ASSOC);
		$rowsCont = count($resultCont);
		
		
		$nome = $resultAtividades[0]['nome'];
		if ($rowsCont > 0)
		{
			echo "
					<table class=\"table table-bordered\">
						<tr>
							<td>Matricula</td>
							<td colspan=\"7\">$matriculaAluno</td>
						</tr>
						<tr>
							<td>Nome</td>
							<td colspan=\"7\">$nome</td>
						</tr>
						<tr style=\"background-color: #D0D0D0;\">
							<td colspan=\"8\" align=\"center\"><strong>ATIVIDADES ANALISADAS</strong></td>
						</tr>
						<tr align=\"center\" style=\"background-color: #F0F0F0;\">
							<td ><strong>Atividade</strong></td>
							<td ><strong>Descricao</strong></td>
							<td ><strong>Professor</strong></td>
							<td ><strong>Horas</strong></td>
							<td ><strong>Situação</strong></td>
							<td ><strong>Comprovante</strong></td>
							<td style=\"word-wrap: break-word; overflow:hidden; white-space: nowrap; text-overflow:ellipsis;\"><strong>Comentario</strong></td>
							<td ><strong>Alterar</strong></td>
						</tr>
						";

			for ($i=0;$i<$rowsAtividades;$i++)
			{
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
				$dataAtv = new DateTime($resultAtividades[$i]['dataAtv']);
				
				$dataInicio = new DateTime($strInicio);
				$dataFim = new DateTime($strFim);
				$dataFim->setTime(23,59);
				if ($dataFim < $dataAtv)
					continue;
				if ($dataInicio > $dataAtv)
					continue;
				
				$atividade = $resultAtividades[$i]['atividade'];
				$descricao = $resultAtividades[$i]['descricao'];
				$horas = $resultAtividades[$i]['horas'];
				$pendente = $resultAtividades[$i]['pendente'];
				if ($pendente == 1)
					$horas = 0;
				$responsavel = $resultAtividades[$i]['responsavel'];
				$horasTot += $horas;
				$index = $resultAtividades[$i]['index'];
				$comentario = $resultAtividades[$i]['comentario'];
				
				$dir  = DOCUMENTS_GETDOCUMENTPATH($matricula)."/atividades";
				$filename = $index."-".$matriculaAluno."-Comprovante";
				$files = glob("$dir/$filename.*");
				$filePath = $files[0];
				if (file_exists($filePath))
					$anchor = "<a href=\"$filePath\" target=\"_blank\"><img src=\"../uploads/defaultAssets/download.png\" width=\"30%\" height=\"6%\"></a>";
				else
					$anchor = "Sem Documento";
				
				if ($pendente != 1 && $responsavel == $meuNome)
					$alterar = "<button type=\"submit\" name=\"reopen\" value=\"$index\" formaction=\"reopen.php\" class=\"btn btn-primary btn-lg btn-block\"><strong>&#8634;</strong></button>";
				else 
					$alterar = "--";
			
				if($fechado)
					$alterar = "--";
			
				switch ($pendente)
				{
					case -1:
						$pendente = "Recusado";
						break;
					case 0:
						$pendente = "Aceito";
						break;
					case 1:
						$pendente = "Pendente";
						break;
				}
				echo "
						<tr align=\"center\">
							<td width=\"15%\">$atividade</td>
							<td width=\"40%\">$descricao</td>
							<td width=\"20\">$responsavel</td>
							<td width=\"5%\">$horas</td>
							<td width=\"15%\">$pendente</td>
							<td width=\"15%\">$anchor</td>
							<td width=\"15%\">$comentario</td>
							<td width=\"15%\">$alterar</td>
						</tr>
					";
			}
						
			echo "	
					</table>
			";
			
			echo "
					<table class=\"table table-bordered table-striped table-hover\">";
			echo "
						<tr align=\"center\">
							<td colspan=\"2\">Total de Horas do(a) Aluno(a)</td>
							<td colspan=\"2\">Horas que faltam</td>
						</tr>
					";
			
			$horasQueFaltam = 75 - $horasTot;
			if ($horasQueFaltam <0 )
				$horasQueFaltam = 0;
			echo "
						<tr align=\"center\">
							<td colspan=\"2\">$horasTot</td>
							<td colspan=\"2\">$horasQueFaltam</td>
						</tr>
					";
						
			echo "	
					</table>
			";
			
			
			
			{
				$sqlNome = "SELECT * FROM professores WHERE matricula = $matricula";
				$queryNome = $conexao->query($sqlNome);
				$resultNome = $queryNome->fetchAll( PDO::FETCH_ASSOC );
				$nome = $resultNome[0]['nome'];
				$meuNome = $resultNome[0]['nome'];
				$arrayProfessores = array();
				$disciplina = $resultNome[0]['disciplina'];
				$sqlDisciplina = "SELECT * FROM professores WHERE disciplina = \"$disciplina\"";
				$queryDisciplina = $conexao->query($sqlDisciplina);
				$resultDisciplina = $queryDisciplina->fetchAll(PDO::FETCH_ASSOC);
				
				$sqlAtividades = "SELECT * FROM `atividades` WHERE `matricula` = $matriculaAluno AND ";
				
				$sqlAtividades .= "`pendente` = 1";
				
				
				$queryAtividades = $conexao->query($sqlAtividades);
				$resultAtividades = $queryAtividades->fetchAll( PDO::FETCH_ASSOC );
				if($queryAtividades != false)
				{
					$rowsAtividades = count($resultAtividades);
				}
			
				if($rowsAtividades<0)
				{
					echo "Matricula nao encontrada somehow wtf??";
				}
				$horasTot = 0;
				
				$nome = $resultAtividades[0]['nome'];
				if ($rowsAtividades > 0)
				{
					echo "
							<table id=\"id_tableTest\" class=\"table table-bordered\">
							
								<tr style=\"background-color: #D0D0D0;\">
									<td colspan=\"8\" align=\"center\"><strong>ATIVIDADES PENDENTES</strong></td>
								</tr>
								<tr align=\"center\" style=\"background-color: #F0F0F0;\">
									<td><strong>Atividade</strong></td>
									<td><strong>Descricao</strong></td>
									<td><strong>Professor</strong></td>
									<td><strong>Aceitar</strong></td>
									<td><strong>Horas</strong></td>
									<td><strong>Rejeitar</strong></td>
									<td><strong>Comprovante</strong></td>
								</tr>
								";

					for ($i=0;$i<$rowsAtividades;$i++)
					{
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
						$dataAtv = new DateTime($resultAtividades[$i]['dataAtv']);
						
						$dataInicio = new DateTime($strInicio);
						$dataFim = new DateTime($strFim);
						$dataFim->setTime(23,59);
						if ($dataFim < $dataAtv)
							continue;
						if ($dataInicio > $dataAtv)
							continue;
						
						$atividade = $resultAtividades[$i]['atividade'];
						$descricao = $resultAtividades[$i]['descricao'];
						$horas = $resultAtividades[$i]['horas'];
						$pendente = $resultAtividades[$i]['pendente'];
						if ($pendente == 1)
							$horas = 0;
						$responsavel = $resultAtividades[$i]['responsavel'];
						$horasTot += $horas;
						$index = $resultAtividades[$i]['index'];
						$comentario = $resultAtividades[$i]['comentario'];
						
						$indexAcc = "acc_$index";
						$selectName = $index."_horas";
						
						$dir  = DOCUMENTS_GETDOCUMENTPATH($matricula)."/atividades";
						$filename = $index."-".$matriculaAluno."-Comprovante";
						$files = glob("$dir/$filename.*");
						$filePath = $files[0];
						if (file_exists($filePath))
							$anchor = "<a href=\"$filePath\" target=\"_blank\"><img src=\"../uploads/defaultAssets/download.png\" width=\"30%\" height=\"6%\"></a>";
						else
							$anchor = "Sem Documento";
						
						if ($pendente != 1 && $responsavel == $meuNome)
							$alterar = "<button type=\"submit\" name=\"reopen\" value=\"$index\" formaction=\"reopen.php\" class=\"btn btn-primary btn-lg btn-block\"><strong>&#8634;</strong></button>";
						else 
							$alterar = "--";
					
						switch ($pendente)
						{
							case -1:
								$pendente = "Recusado";
								break;
							case 0:
								$pendente = "Aceito";
								break;
							case 1:
								$pendente = "Pendente";
								break;
						}
						echo "
								<tr align=\"center\">
									<td width=\"15%\">$atividade</td>
									<td width=\"40%\">$descricao</td>
									<td width=\"20%\">$responsavel</td>";
									$row = $i+3;
									$parameter = $row."accept".$index;
									
									echo "<td width=\"2%\" align=\"center\">";
									if (!$fechado) 
										echo "<button type=\"submit\" formaction=\"../professor/cadastraratividade.php\" name=\"index\" value=\"$indexAcc\" class=\"accept btn-primary btn-lg btn-block\">V</button>";
									echo "</td>";								
									echo "<td width=\"10%\" align=\"center\">";
										echo "<input type=\"number\" name=\"$selectName\" value=\"1\" min=\"1\" max=\"75\">";
									echo "</td>";
									$parameter = $row."reject".$index;
									echo "<td width=\"2%\" align=\"center\">";
									if (!$fechado) 
										echo "<button type=\"submit\" onclick=\"showCommentaries('$parameter'); return false;\" formaction=\"../professor/cadastraratividade.php\" name=\"index\" value=\"$indexRej\" class=\"reject btn-primary btn-lg btn-block\">X</button>";
									echo "</td>";								
									
									echo "<td width=\"5%\" align=\"center\">$anchor</td>";
								echo "</tr>
							";
					}
								
					echo "</table>";
				}
			
			}
		}
		else
		{
			echo "<p align=\"center\">A(o) aluna(o) não possui atividades cadastradas</p>";
			include("mode_aluno.php");
		}
		
		echo "<button type=\"submit\" class=\"btn btn-primary\" name=\"mode\" value=\"novaatividade-$matriculaAluno\">Cadastrar Nova Atividade</button>";
		
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
				td2.setAttribute(\"colspan\",\"5\");
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
		
			
		
				
		</script>";
			
	?>