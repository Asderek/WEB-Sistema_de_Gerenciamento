<?php			
	include ('../utils/documentos.php');
	include ('../utils/newconexao.php');
	include ('../utils/professores.php');

	$CPF = $_POST['redirect'];
	
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
	$endereco = $resultSearch[0]['endereco'];;
	$comunidade = $resultSearch[0]['comunidade'];
	$cep = $resultSearch[0]['CEP'];
	
	$comunidades = array();
		array_push($comunidades,"Cantagalo");
		array_push($comunidades,"Pavão-Pavãozinho");
		array_push($comunidades,"Cruzada");
		array_push($comunidades,"São Sebastião");
		array_push($comunidades,"Vidigal");
		array_push($comunidades,"Rocinha");
		array_push($comunidades,"Babilônia");
		array_push($comunidades,"Chapéu-Mangueira");
		array_push($comunidades,"Dona Marta");
		array_push($comunidades,"Cerro Corá");
		array_push($comunidades,"Tabajaras");
		array_push($comunidades,"Pererão");
		array_push($comunidades,"Julio Otoni");
		array_push($comunidades,"Santo Amáro");
		array_push($comunidades,"Morro Azul");
		array_push($comunidades,"Cabritos");
		array_push($comunidades,"Chácara do Céu");
		array_push($comunidades,"Parque da Cidade");
		array_push($comunidades,"Horto");
		array_push($comunidades,"Grotão");
		array_push($comunidades,"Tuiuti");
		array_push($comunidades,"Funcionarios PUC");
		array_push($comunidades,"Minhocão");
	sort($comunidades);
	
	$proximaConsulta = "02/01/1990"; 	
	
	$diretorio = DOCUMENTS_GETDOCUMENTPATH($CPF);

	echo "
		<div class=\"rightSide-Top\">
			<div class=\"assistido-right\">
			
				<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">
				<table class=\"table table-bordered table-hover\" style=\"margin-bottom: 0;\">
					<tbody>
						<tr align=\"center\">
							<td colspan=\"5\" align=\"center\"><strong>Dados do Assistido</strong></th>
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
							<td width='70%' colspan=\"3\" align=\"center\"><select name=\"comunidade\" align=\"center\">
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
									<a href=\"$diretorio/Procuracao.pdf\">Procuracao</a>
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
							<th>Descrição</th>
							<th></th>
						</tr>
				";
					
				{// SQL PLANTAO
					$responsavel = PROFESSORES_GETPROFESSORPLANTAONAME($matricula);
				}
				
				$sqlAtendimentos = "SELECT * FROM `atendimentos` WHERE `cpf` = \"$CPF\" AND `responsavel` = \"$responsavel\"";
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
	