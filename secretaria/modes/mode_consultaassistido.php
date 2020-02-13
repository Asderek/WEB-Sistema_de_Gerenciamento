<?php			
	include ('../utils/documentos.php');
	include ('../utils/newconexao.php');

	$CPF = $_POST['cpf'];
	
	$SQLSearch = "SELECT * FROM `assistidos` WHERE `cpf` = \"$CPF\"";
	$querySearch = $conexao->query($SQLSearch);
	$resultSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );
	$rowsSearch = count($resultSearch);
	
	$nome = $resultSearch[0]['nome'];
	$rg = $resultSearch[0]['rg'];
	$tel1 = $resultSearch[0]['tel1'];
	$tel2 = $resultSearch[0]['tel2'];
	$cel = $resultSearch[0]['cel'];
	$dob = $resultSearch[0]['dob'];
	$bairro = $resultSearch[0]['bairro'];
	$email = $resultSearch[0]['email'];
	$endereco = $resultSearch[0]['endereco'];
	$comunidade = $resultSearch[0]['comunidade'];
	$genero = $resultSearch[0]['genero'];
	$cep = $resultSearch[0]['CEP'];
	
	$comunidades = array();
		$sqlComunidades = "SELECT * FROM `comunidades` WHERE 1";
		$queryComunidades = $conexao->query($sqlComunidades);
		$resultComunidades = $queryComunidades->fetchAll(PDO::FETCH_ASSOC);
		for($i=0;$i<count($resultComunidades);$i++)
		{
			$asd = $resultComunidades[$i]['comunidade'];
			array_push($comunidades,$asd);
		}
	sort($comunidades);
	
	$generos = array();
		array_push($generos,"Masculino");
		array_push($generos,"Feminino");
		
	
	$proximaConsulta = "02/01/1990"; 	
	
	$diretorio = DOCUMENTS_GETDOCUMENTPATH($CPF);
	
	$sqlCommentaries = "SELECT * FROM `professorcommentaries` WHERE `cpf` = \"$CPF\"";
	$queryCommentaries = $conexao->query($sqlCommentaries);
	if ($queryCommentaries == false)
		return;
	$resultCommentaries = $queryCommentaries->fetchAll(PDO::FETCH_ASSOC);
	echo "<table class=\"table table-bordered table-hover\" id=\"id_table\" style=\"display: none\">";
	echo "<tr><td><strong>Professor</strong></td><td><strong>Comentario</strong></td><td><strong>Delete <button style=\"float: right; background-color: #AA0000\" id=\"id_closeCommentary\" onclick=\"return false;\" class=\"btn btn-primary\">X</button></strong></td></tr>";
	for($i=0;$i<count($resultCommentaries);$i++)
	{
		$commentary = $resultCommentaries[$i]['comentario'];
		$professor = $resultCommentaries[$i]['professor'];
		$index = $resultCommentaries[$i]['index'];
		echo "<tr>
			<td>$professor</td>
			<td>$commentary</td>
			<td><button class=\"btn btn-primary\" style=\"background-color: #FF6666; float: right\" formaction=\"deleteCommentary.php\" name=\"commentaryId\" value=\"$index\">X</button></td> 
		</tr>";
	}
	echo "<tr><td>Comentar</td><td><input type=\"text\" name=\"professorCommentary\"></td><td><button type=\"submit\" formaction=\"addCommentary.php\">Comentar</button></td></tr>";
	echo "</table>";
	
	$obs = $resultSearch[0]['obs'];
	if ($obs != "")
	{
		echo "<table class=\"table table-bordered table-hover\" style=\"margin-bottom: 0;\" id=\"id_tableObs\">
					<tbody>
						<tr align=\"center\" id=\"id_trObs\">
							<td align=\"center\" style=\"background-color: #FF6666\">
								<strong><p id=\"id_obs\">Obs: $obs</p></strong>
							</td>
						</tr>
						<tr id=\"id_trOptions\" style=\"display: none\">
							<td align=\"center\">
								<button type=\"submit\" formaction=\"editOBS.php\" id=\"id_buttonobs\">Editar Obs</button>
								<input type=\"text\" value=\"$obs\" name=\"obsText\" id=\"id_obstext\">
							</td>
						</tr>
					</tbody>
			  </table>";
	}
	echo "
		<div class=\"rightSide-Top\">
			<div class=\"assistido-right\" id=\"id_assistidoRight\">
			
				<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">
				<table class=\"table table-bordered table-hover\" style=\"margin-bottom: 0;\">
					<tbody>
						<tr align=\"center\">
							<td colspan=\"5\" align=\"center\"><strong>Dados do Assistido </strong></td>
						</tr>
						
						<tr>
							<td width='30%'><strong>Nome</strong></td>
							<td width='70%' colspan=\"3\" align=\"center\"><input type=\"text\" name=\"nome\" value=\"$nome\" size=\"80\" style=\"text-align:center;\";\"></input></td>
						</tr>
						
						<tr>
							<td width='30%'><strong>CPF</strong></td>
							<td width='70%'><input class=\"staticInvisibox\" type=\"text\" name=\"cpf\" value=\"$CPF\" readonly></input></td>
							<td width='30%'><strong>Telefone 1</strong></td>
							<td width='70%'><input type=\"text\" name=\"tela\" value=\"$tel1\"></input></td>
							
						</tr>
					
						<tr>
							<td width='30%'><strong>RG</strong></td>
							<td width='70%'><input type=\"text\" name=\"rg\" value=\"$rg\"></input></td>
							<td width='30%'><strong>Telefone 2</strong></td>
							<td width='70%'><input type=\"text\" name=\"telb\" value=\"$tel2\"></input></td>
						</tr>
						
						
						
						<tr>
							<td width='30%'><strong>Data de Nascimento</strong></td>
							<td width='70%'><input type=\"text\" name=\"dob\" value=\"$dob\"></input></td>
							<td width='30%'><strong>Celular</strong></td>
							<td width='70%'><input type=\"text\" name=\"cel\" value=\"$cel\"></input></td>
						</tr>
					
						<tr>
							<td width='30%'><strong>Email</strong></td>
							<td width='70%' colspan=\"3\" align=\"center\"><input size=\"65\" type=\"text\"  style=\"text-align: center;\" name=\"email\" value=\"$email\"></input></td>
						</tr>
						
						<tr>
							<td><strong>Endereco</strong></td>
							<td colspan=\"3\" align=\"center\"><input size=\"65\" type=\"text\" style=\"text-align: center;\" name=\"endereco\" value=\"$endereco\"></input></td>
						</tr>
						
						<tr>
							<td width='30%'><strong>Bairro</strong></td>
							<td width='70%'><input type=\"text\" name=\"bairro\" value=\"$bairro\"></input></td>
							<td width='30%'><strong>CEP</strong></td>
							<td width='70%'><input type=\"text\" name=\"cep\" value=\"$cep\"></input></td>
						</tr>
						
						<tr>
							<td width='30%'><strong>Comunidade</strong></td>
							<td width='70%' align=\"center\"><select name=\"comunidade\" align=\"center\">
								<option value=\"---\">---</option>
							";
							for ($i=0;$i<count($comunidades);$i++)
							{
								$value = $comunidades[$i];
								echo "<option value=\"$value\" ";
								if ($value == $comunidade)
									echo "selected";
								
								echo ">$value</option>";
							}
							echo "<select></td>
							
							<td width='30%'><strong>Genero</strong></td>
							<td width='70%' align=\"center\"><select name=\"genero\" align=\"center\">
								<option value=\"---\">---</option>
							";
							for ($i=0;$i<count($generos);$i++)
							{
								$value = $generos[$i];
								echo "<option value=\"$value\" ";
								if ($value == $genero)
									echo "selected";
								
								echo ">$value</option>";
							}
							echo "<select></td>
						</tr>
						
						
						<tr>
							<td colspan=\"4\" align=\"center\"><button formaction=\"atualizarinformacao.php\" name=\"editAssistido\" value=\"1\" class=\"btn btn-primary btn-block\">Atualizar</button></td>
						</tr>
					</tbody>
				</table>
				
				<!--<img width=\"311\" height=\"99\" src=\"../uploads/defaultAssets/megamatte.png\" style=\"float: left;position: relative;left: 30%;\">-->
			</div>
			";
		
	echo "
			<div class=\"assistido-left\">
				<table class=\"table table-bordered table-hover\">
						<tbody>
							<tr> 
								<td colspan=\"2\" align=\"center\">
									<img width=\"256\" height=\"192\" src=\"../uploads/$CPF/foto.jpg\">
								</td>
							</tr>
							<tr align=\"center\">
								<td colspan=\"2\"><strong>Documentos</strong></td>
							</tr>
							
							<tr> 
								<td width=\"50%\">
									<a href=\"$diretorio/RG.pdf\">RG</a><br>
								</td>
								<td width=\"50%\">
									<a href=\"$diretorio/CPF.pdf\">CPF</a><br>
								</td>
							</tr>
							
							<tr> 
								<td colspan=\"2\">
									<a href=\"$diretorio/CompRenda.pdf\">Comprovante de Renda</a><br>
								</td>
							</tr>
							
							<tr> 
								<td colspan=\"2\">
									<a href=\"$diretorio/CompResidencia.pdf\">Comprovante de Residencia</a>
								</td>
							</tr>
							
							<tr> 
								<td colspan=\"2\">
									Comentarios <button id=\"id_buttonComment\" onclick=\"showCommentaries(); return false;\" class=\"btn btn-primary\" style=\"background-color: #ffff80; color: #000000; size:75%;\">&#9888;</button>
								</td>
							</tr>
							
							<tr> 
								<td colspan=\"2\">
									<a href=\"$diretorio/Compromisso.pdf\">Termo de Compromisso</a>
								</td>
							</tr>
							
							
							
						</tbody>
					</table>
					<!--<img width=\"43\" height=\"51\" src=\"../uploads/defaultAssets/apple.png\" style=\"float: left;position: relative;left: 30%;\">-->
			</div>
		</div>
		<div class=\"Bottom\">
			<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">
				<table class=\"table table-bordered table-hover\">
					<tbody>
						<tr align=\"center\" style=\"background-color: #AAAAAA;\">
							<td colspan=\"5\"><strong>Casos</strong></td>
						</tr>
						<tr>
							<th>#</th>
							<th>Professor</th>
							<th>Descrição</th>
							<th></th>
						</tr>
				";
				
				$sqlAtendimentos = "SELECT * FROM `atendimentos` WHERE `cpf` = \"$CPF\" ORDER BY `arquivado`";
				$queryAtendimentos = $conexao->query($sqlAtendimentos);
				$resultAtendimentos = $queryAtendimentos->fetchAll( PDO::FETCH_ASSOC );
				$rowsAtendimentos = count($resultAtendimentos);
				
				
				$arquivado = $resultAtendimentos[0]['arquivado'];
				for($i=0;$i<$rowsAtendimentos;$i++)
				{
					$area = $resultAtendimentos[$i]['area'];
					$dataDeInscricao = $resultAtendimentos[$i]['dataDeInscricao'];
					$descricao = $resultAtendimentos[$i]['descricao'];
					$index = $resultAtendimentos[$i]['index'];
					$responsavel = $resultAtendimentos[$i]['responsavel'];
					$value = "vercaso$index";
					$lastArquivado = $resultAtendimentos[$i]['arquivado'];
					
					if ($arquivado != $lastArquivado)
					{
						$arquivado = $lastArquivado;
						echo "<tr><td colspan=\"4\" align=\"center\" style=\"background-color: #A4DDFF\"><strong>Casos Arquivados</strong></td>";
					}
					
					echo "
							<tr>
								<td width='5%'><strong>$i</strong></td>
								<td width='20%'><strong>$responsavel</strong></td>
								<td width='70%'><strong>$descricao</strong></td>
								<td width='5%'><strong><button name=\"mode\" value=\"$value\" >Ver</button></strong></td>
							</tr>
						";
				}
				
				echo "</tbody> </table>";
			
				echo "
				<table class=\"table table-bordered table-hover\">
					<tbody>";
					
				if ($obs == "")
				{
						echo "<tr>
							<td align=\"center\" style=\"background-color: #A4DDFF\"><strong> OBS </strong></td>
						
						</tr>
					";
				
				
					echo "<tr>";
						echo "<td align=\"center\">";
							echo "<input type=\"text\" name=\"obsText\"> <button type=\"submit\" formaction=\"editOBS.php\">Adicionar Obs</button>";
						echo "</td>";
					echo "</tr>";
				}
				
				echo "<tr>";
					echo "<td><button class=\"btn btn-block btn-primary\" name=\"cpfassistido\" value=\"$CPF\" formaction=\"deleteassistido.php\" style=\"background-color: #CC3333\" onclick=\"if(confirmAction()) return false;\">&#9888; Deletar Assistido &#9888;</button></td>";
				echo "</tr>";
				
				echo "
					</tbody>
				</table>
			";
		echo "</div>"	;
		
	echo "
		<script>
		
			function displayOptions()
			{
				document.getElementById('id_trObs').style = \"display: none\";
				document.getElementById('id_trOptions').style = \"\";
			}
			function hideOptions()
			{
				document.getElementById('id_trObs').style = \"\";
				document.getElementById('id_trOptions').style = \"display: none\";
			}
			function hideTable()
			{
				document.getElementById('id_table').setAttribute(\"style\",\"display: none\");
			}
		
			var f = document.getElementById('id_obs');
			if (f != null)
			{
				var i = 0;
				setInterval(function() {
					i++;
					if (i%2 == 0)
						f.style.color = \"#000000\";
					else
						f.style.color = \"#FF6666\";						
				}, 500);
			
				document.getElementById('id_tableObs').addEventListener(\"mouseenter\",displayOptions);
				document.getElementById('id_tableObs').addEventListener(\"mouseleave\",hideOptions);
			}
			";
			if (count($resultCommentaries)> 0)
				echo "document.getElementById('id_buttonComment').click();";
			
			echo "
			document.getElementById('id_closeCommentary').addEventListener(\"click\",hideTable);
			
			function showCommentaries()
			{
				console.log('cacete');
				var table = document.getElementById('id_table');
				var div = document.createElement(\"div\");
				
				div.setAttribute(\"style\",\"display: block; position: absolute; width: 100%; z-index: 1; background-color: #FFFFDDF0\");
				div.appendChild(table);
				table.setAttribute(\"style\",\"width: 100%;\");
				document.getElementById('id_assistidoRight').insertBefore(div,document.getElementById('id_assistidoRight').childNodes[0]);				
				//document.getElementById('id_Form').appendChild(div);
				return false;
			}
		
				
		</script>";

	?>
	