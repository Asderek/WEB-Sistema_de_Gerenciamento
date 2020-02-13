<?php			
	include ('../utils/documentos.php');
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
	
	$proximaConsulta = "02/01/1990"; 	

	$diretorio = DOCUMENTS_GETDOCUMENTPATH($CPF);
	
	echo "
		<div class=\"rightSide-Top\">
			<div class=\"assistido-left\">
			
				<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">
				<table class=\"table table-bordered table-hover\">
					<tbody>
						<tr align=\"center\">
							<th colspan=\"5\" align=\"center\">Dados do Assistido</th>
						</tr>
						
						<tr>
							<td width='30%'><strong>CPF</strong></td>
							<td width='70%'><input type=\"text\" name=\"cpf\" value=\"$CPF\" readonly style=\"background: transparent; border: none;\"></input></td>
						</tr>
					
						<tr>
							<td width='30%'><strong>RG</strong></td>
							<td width='70%'><input type=\"text\" name=\"rg\" value=\"$rg\" readonly style=\"background: transparent; border: none;\"></input></td>
						</tr>
						
						<tr>
							<td width='30%'><strong>Nome</strong></td>
							<td width='70%'><input type=\"text\" name=\"nome\" value=\"$nome\"></input></td>
						</tr>";
						
						if (strlen($tel1) > 5)
						{
							echo "
							<tr>
								<td width='30%'><strong>Telefone</strong></td>
								<td width='70%'><input type=\"text\" name=\"tela\" value=\"$tel1\"></input></td>
							</tr>";
						}
						
						if (strlen($tel2) > 5)
						{
							echo "
							<tr>
								<td width='30%'><strong>Telefone</strong></td>
								<td width='70%'><input type=\"text\" name=\"telb\" value=\"$tel2\"></input></td>
							</tr>";
						}
						
						if (strlen($cel) > 5)
						{
							echo "
							<tr>
								<td width='30%'><strong>Celular</strong></td>
								<td width='70%'><input type=\"text\" name=\"cel\" value=\"$cel\"></input></td>
							</tr>";
						}
						
						echo "
						<tr>
							<td width='30%'><strong>Email</strong></td>
							<td width='70%'><input type=\"text\" name=\"email\" value=\"$email\"></input></td>
						</tr>
						
						<tr>
							<td width='30%'><strong>Bairro</strong></td>
							<td width='70%'><input type=\"text\" name=\"bairro\" value=\"$bairro\"></input></td>
						</tr>
						
						<tr>
							<td width='30%'><strong>Data de Nascimento</strong></td>
							<td width='70%'><input type=\"text\" name=\"dob\" value=\"$dob\" readonly style=\"background: transparent; border: none;\"></input></td>
						</tr>
						
						<tr>
							<td colspan=\"2\" align=\"center\"><button formaction=\"atualizarinformacao.php\" name=\"editAssistido\" value=\"1\">Atualizar</button></td>
						</tr>
					</tbody>
				</table>
			</div>
			";
		
	echo "
			<div class=\"assistido-right\">
				<table class=\"table table-bordered table-hover\">
						<tbody>
							<tr> 
								<td colspan=\"2\" align=\"center\">
									<img width=\"256\" height=\"192\" src=\"$diretorio/foto.jpg\">
								</td>
							</tr>
				<tr align=\"center\">
								<td colspan=\"2\"><strong>Documentos</strong></td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>RG</strong>
								</td>
								<td width=\"70%\">
									<a href=\"$diretorio/RG.pdf\">RG</a><br>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>CPF</strong>
								</td>
								<td width=\"70%\">
									<a href=\"$diretorio/CPF.pdf\">CPF</a><br>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>Comprovante de Renda</strong>
								</td>
								<td width=\"70%\">
									<a href=\"$diretorio/CompRenda.pdf\">Comprovante de Renda</a><br>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>Comprovante de Residencia</strong>
								</td>
								<td width=\"70%\">
									<a href=\"$diretorio/CompResidencia.pdf\">Comprovante de Residencia</a><br>
								</td>
							</tr>
							
							<tr> 
								<td colspan=\"2\" bgcolor=\"#000000\">
								</td>
							</tr>
						</tbody>
					</table>
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
							<th>Descrição</th>
							<th></th>
						</tr>
				";
					
				$sqlProfName = "SELECT * FROM `professores` WHERE `matricula` = $matriculaResponsavel";
				$queryProfName = $conexao->query($sqlProfName);
				$resultProfName = $queryProfName->fetchAll( PDO::FETCH_ASSOC );
				if ($queryProfName == false)
				{
					echo "<tr><td>Deu Erro Professor</td></tr><br>";
					return;
				}
				
				$responsavel = $resultProfName[0]['nome'];
				
				$professorPlantao = PROFESSORES_GETPROFESSORPLANTAONAME($matricula);
				
					
				
				$sqlAtendimentos = "SELECT * FROM `atendimentos` WHERE `cpf` = \"$CPF\" AND (`responsavel` = \"$responsavel\" OR `responsavel` = \"$professorPlantao\")";
				
				$queryAtendimentos = $conexao->query($sqlAtendimentos);
				$resultAtendimentos = $queryAtendimentos->fetchAll( PDO::FETCH_ASSOC );
				$rowsAtendimentos = count($resultAtendimentos);
				
				
				for($i=0;$i<$rowsAtendimentos;$i++)
				{
					$area = $resultAtendimentos[$i]['area'];
					$dataDeInscricao = $resultAtendimentos[$i]['dataDeInscricao'];
					$descricao = $resultAtendimentos[$i]['descricao'];
					$index = $resultAtendimentos[$i]['index'];
					$value = "vercaso$index";
					
					echo "
							<tr>
								<td width='5%'><strong>$i</strong></td>
								<td width='90%'><strong>$descricao</strong></td>
								<td width='5%'><strong><button name=\"mode\" value=\"$value\" >Ver</button></strong></td>
							</tr>
						";
				}
				
				echo "</tbody> </table>";
				
				{//casos de outros professores
					echo "<table class=\"table table-bordered table-hover\">
						<tbody>
							<tr align=\"center\" style=\"background-color: #AAAAAA;\">
								<td colspan=\"5\"><strong>Casos de Outros Professores</strong></td>
							</tr>
							<tr>
								<th>#</th>
								<th>Professor</th>
								<th>Descrição</th>
								<th></th>
							</tr>
					";
					
					$sqlAtendimentos = "SELECT * FROM `atendimentos` WHERE `cpf` = \"$CPF\" AND `responsavel` != \"$responsavel\" AND `responsavel` != \"$professorPlantao\"";
					$queryAtendimentos = $conexao->query($sqlAtendimentos);
					$resultAtendimentos = $queryAtendimentos->fetchAll( PDO::FETCH_ASSOC );
					$rowsAtendimentos = count($resultAtendimentos);
					
					for($i=0;$i<$rowsAtendimentos;$i++)
					{
						$responsavel = $resultAtendimentos[$i]['responsavel'];
						$descricao = $resultAtendimentos[$i]['descricao'];
						$index = $resultAtendimentos[$i]['index'];
						$value = "vercaso$index";
					
						echo "
								<tr>
									<td width='5%'><strong>$i</strong></td>
									<td width='15%'><strong>$responsavel</strong></td>
									<td width='75%'><strong>$descricao</strong></td>
									<td width='5%'><strong><button name=\"mode\" value=\"$value\" >Ver</button></strong></td>
								</tr>
							";
					}
				}
				
				echo "
				<table class=\"table table-bordered table-hover\">
					<tbody>
						<tr align=\"center\">
							<td colspan=\"5\"><strong>Consulta Processual</strong></td>
						</tr>
						<tr>
				";
				$area = $resultProfName[0]['area'];
				
				
				switch ($area)
				{
					case "TRABALHO": 	
						echo "
							<td width='30%'><strong><a href=\"firefox:https://consultapje.trt1.jus.br/consultaprocessual/pages/consultas/ConsultaProcessual.seam\">Link para PJE</a></strong></td>
						</tr>
						";
						break;
					default:
						echo "
							<td width='30%'><strong><a href=\"http://www4.tjrj.jus.br/ConsultaUnificada/consulta.do#tabs-numero-indice0\">Link para tjrj</a></strong></td>
						</tr>
						";
						
				}
				
				echo "
					</tbody>
				</table>
			";
		echo "</div>"	;
		
	echo "
		<script>
			console.log(\"finished\");
		</script>";

	?>
	