<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
			html
			{ 
			  background: url(assets/img/bg.jpg) no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			}
			table, th, td 
			{
				border: 1px solid black;
				border-collapse: collapse;
				background-color:	#FFFFFF;
			}
			
			.modal-content
			{
				margin-left:                       	-750px;
				margin-top:                        	0px;
				position:                        	absolute;
				width:                             	1500px;
				left:                               50%;
				top:                                50%;
			}
			
			.modal-body2
			{
				float:								right;
				position:                        	relative;
				width:                             	75%;
				top:                                50%;
			}
			
			.modal-body1
			{
				float:								left;
				position:                        	relative;
				width:                             	25%;
			}
			
			.modal-footer {   border-top: 0px; }
			#loginModal { margin-top: 0px;}
			
				.inv {
						display: none;
					 }
			
        </style>
    </head>
    
    
    <body  >
        
        <!--login modal-->
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="text-center">Núcleo de Prática Jurídica</h1><br>
							<h5 class="text-center">Ficha do Assistido</h5>
							
						
						<?php
							include ('../utils/documentos.php');
							include('../../newconexao.php');
							include('../../injection.php');
							
							$CPF = $_POST['cpf'];
							
							$diretorio = DOCUMENTS_GETDOCUMENTPATH($CPF);
						
							$sqlInformacoes = "SELECT * FROM assistidos WHERE cpf = \"$CPF\"";
							$queryInformacoes = $conexao->query($sqlInformacoes);
							$resultInformacoes = $queryInformacoes->fetchAll(PDO::FETCH_ASSOC);
							
							$nome = $resultInformacoes[0]['nome'];
							$rg = $resultInformacoes[0]['rg'];
							$tel1 = $resultInformacoes[0]['tel1'];
							$tel2 = $resultInformacoes[0]['tel2'];
							$cel = $resultInformacoes[0]['cel'];
							$dob = $resultInformacoes[0]['dob'];
							$endereco = $resultInformacoes[0]['endereco'];
							$cep = $resultInformacoes[0]['CEP'];
							$bairro = $resultInformacoes[0]['bairro'];
							$email = $resultInformacoes[0]['email'];
							$comunidade = $resultInformacoes[0]['comunidade'];
							$etnia = $resultInformacoes[0]['etnia'];
							$renda = $resultInformacoes[0]['renda'];
							$moradia = $resultInformacoes[0]['moradia'];
							$ocupacao = $resultInformacoes[0]['ocupacao'];
							$estadocivil = $resultInformacoes[0]['estadocivil'];
							$obs = $resultInformacoes[0]['obs'];
							
							$extraNome = "";
							$extraRG = "";
							$extraTel1 = "";
							$extraTel2 = "";
							$extraCel = "";
							$extraDOB = "";
							$extraEndereco = "";
							$extraCEP = "";
							$extraBairro = "";
							$extraEmail = "";
							$extraComunidade = "";
							$extraEtnia = "";
							$extraRenda = "";
							$extraMoradia = "";
							$extraOcupacao = "";
							$extraEstado = "";
							
							echo "
								<form action=\"index.html\" method=\"post\">
									<button type=\"submit\" >Voltar</button>
									<input type=\"hidden\" value=\"$CPF\" name=\"cpf\">
									<button style=\"float:right;\" onclick=\"teste(); return false;\" id=\"id_buttonobs\">Editar Obs</button>
									<input type=\"hidden\" value=\"$obs\" name=\"obsText\" id=\"id_obstext\" style=\"float:right\">
								</form>
							</div>";
							
							$faltaDeDados = false;
							if (empty($nome) || empty($rg) || empty($tel1) || empty($tel2) || empty($cel) || empty($dob) || empty($endereco) || empty($cep) || empty($bairro) || empty($email) ||
								empty($comunidade) || empty($etnia) || empty($renda) || empty($moradia) || empty($ocupacao) || empty($estadocivil))
									$faltaDeDados = true;
							
							if(empty($nome))
								$extraNome = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($rg))
								$extraRG = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($tel1))
								$extraTel1 = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($tel2))
								$extraTel2 = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($cel))
								$extraCel = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($dob))
								$extraDOB = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($endereco))
								$extraEndereco = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($cep))
								$extraCEP = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($bairro))
								$extraBairro = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($email))
								$extraEmail = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($comunidade))
								$extraComunidade = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($etnia))
								$extraEtnia = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($renda))
								$extraRenda = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($moradia))
								$extraMoradia = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($ocupacao))
								$extraOcupacao = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							if(empty($estadocivil))
								$extraEstado = "<label style=\"color: red; font-size: large;\">&#160*</label>";
							
							
							
							$arrayMoradia = array();
							array_push($arrayMoradia,"Própria");
							array_push($arrayMoradia,"Alugada");
							array_push($arrayMoradia,"Comodato");
							array_push($arrayMoradia,"Posse");
							array_push($arrayMoradia,"Financiada");
							array_push($arrayMoradia,"Funcional");
							sort($arrayMoradia);
							
							$arrayEstadoCivil = array();
							array_push($arrayEstadoCivil,"Casad");
							array_push($arrayEstadoCivil,"Solteir");
							array_push($arrayEstadoCivil,"Uniao Estavel");
							array_push($arrayEstadoCivil,"Divorciad");
							array_push($arrayEstadoCivil,"Viuv");
							array_push($arrayEstadoCivil,"Separad Judicialmente");
							sort($arrayEstadoCivil);
							
							$arrayEtnia = array();
							array_push($arrayEtnia,"Branco");
							array_push($arrayEtnia,"Negro");
							array_push($arrayEtnia,"Pardo");
							array_push($arrayEtnia,"Asiatico");
							sort($arrayEtnia);
							
							$arrayComunidades = array();
								array_push($arrayComunidades,"Cantagalo");
								array_push($arrayComunidades,"Pavão-Pavãozinho");
								array_push($arrayComunidades,"Cruzada");
								array_push($arrayComunidades,"São Sebastião");
								array_push($arrayComunidades,"Vidigal");
								array_push($arrayComunidades,"Rocinha");
								array_push($arrayComunidades,"Babilônia");
								array_push($arrayComunidades,"Chapéu-Mangueira");
								array_push($arrayComunidades,"Santa Marta");
								array_push($arrayComunidades,"Cerro Corá");
								array_push($arrayComunidades,"Tabajaras");
								array_push($arrayComunidades,"Pererão");
								array_push($arrayComunidades,"Julio Otoni");
								array_push($arrayComunidades,"Santo Amáro");
								array_push($arrayComunidades,"Morro Azul");
								array_push($arrayComunidades,"Cabritos");
								array_push($arrayComunidades,"Chácara do Céu");
								array_push($arrayComunidades,"Parque da Cidade");
								array_push($arrayComunidades,"Horto");
								array_push($arrayComunidades,"Grotão");
								array_push($arrayComunidades,"Tuiuti");
								array_push($arrayComunidades,"Funcionarios PUC");
								array_push($arrayComunidades,"Minhocão");
								array_push($arrayComunidades,"---");
							sort($arrayComunidades);
											
							
							
							if(injection($CPF))
							{
								echo "My code is Sanitized";
								return;
							}
							$style = "style=\"background: transparent; border: none;\"";
							
							if ($obs != "")
							{
								echo "<table class=\"table table-bordered table-hover\" style=\"margin-bottom: 0;\">
											<tbody>
												<tr align=\"center\">
													<td colspan=\"5\" align=\"center\" style=\"background-color: #FF6666\"><strong><p id=\"id_obs\">Obs: $obs</p></strong></td>
												</tr>
											</tbody>
									  </table>";
									  
								echo "
									<script>
										var f = document.getElementById('id_obs');
										var i = 0;
										setInterval(function() {
											i++;
											if (i%2 == 0)
												f.style.color = \"#000000\";
											else
												f.style.color = \"#FF6666\";						
										}, 500);
									</script>
								";
							}
							echo "<div>";
							echo "
									<div class=\"modal-body1\">
										<form action=\"novoatendimento.php\" method=\"post\">
											<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">
											<table class=\"table table-bordered table-hover\">
												<tbody>
														<tr align=\"center\">
															<td colspan=\"2\" align=\"center\"><strong>Dados do Assistido</strong></td>
														</tr>";
														if ($faltaDeDados)
														{
															echo "
															<tr align=\"center\">
																<td colspan=\"2\" align=\"center\" style=\"background-color:#FFA0A0\"><strong>Existem Dados não Preenchidos</strong></td>
															</tr>";
														}
														echo "
														<tr> 
															<td colspan=\"2\" align=\"center\">
																<img width=\"256\" height=\"192\" ";
																	if (file_exists("$diretorio/foto.jpg"))
																	{
																		echo "src=\"$diretorio/foto.jpg\" ";
																	}
																	else if (file_exists("$diretorio/foto.png"))
																	{
																		echo "src=\"$diretorio/foto.png\" ";
																	}
																	else if (file_exists("$diretorio/foto.bmp"))
																	{
																		echo "src=\"$diretorio/foto.bmp\" ";
																	}
																	else
																	{
																		$tempDir = DOCUMENTS_GETDOCUMENTPATH("defaultAssets");
																		echo "src=\"$tempDir/foto.png\"";
																	}
																echo ">
															</td>
														</tr>
														<tr>
															<td width='30%'><strong>CPF</strong></td>
															<td width='70%'><input type=\"text\" name=\"cpf\" value=\"$CPF\" readonly $style></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Nome</strong></td>
															<td width='70%'><input type=\"text\" name=\"nome\" value=\"$nome\"></input>$extraNome</td>
														</tr>
													
														<tr>
															<td width='30%'><strong>RG</strong></td>
															<td width='70%'><input type=\"text\" name=\"rg\" value=\"$rg\"></input>$extraRG</td>
														</tr>";
														
															echo "
															<tr>
																<td width='30%'><strong>Telefone 1</strong></td>
																<td width='70%'><input type=\"text\" name=\"tel1\" value=\"$tel1\"></input>$extraTel1</td>
															</tr>";
														
															echo "
															<tr>
																<td width='30%'><strong>Telefone 2</strong></td>
																<td width='70%'><input type=\"text\" name=\"tel2\" value=\"$tel2\"></input>$extraTel2</td>
															</tr>";
														
															echo "
															<tr>
																<td width='30%'><strong>Celular</strong></td>
																<td width='70%'><input type=\"text\" name=\"cel\" value=\"$cel\"></input>$extraCel</td>
															</tr>";
														
															echo "
															<tr>
																<td width='30%'><strong>Email</strong></td>
																<td width='70%'><input type=\"text\" name=\"email\" value=\"$email\"></input>$extraEmail</td>
															</tr>";
														
														echo "
														<tr>
															<td width='30%'><strong>Data de Nascimento</strong></td>
															<td width='70%'><input type=\"text\" name=\"dob\" value=\"$dob\"></input>$extraDOB</td>
														</tr>
														
														<tr>
															<td colspan=\"2\" width='30%' align=\"center\"><strong>Endereço</strong></td></tr><tr>
															<td width='70%' colspan=\"2\" align=\"center\"><input size=\"40\" type=\"text\" name=\"endereco\" value=\"$endereco\"></input>$extraEndereco</td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Bairro</strong></td>
															<td width='70%'><input type=\"text\" name=\"bairro\" value=\"$bairro\"></input>$extraBairro</td>
														</tr>
														
														<tr>
															<td width='30%'><strong>CEP</strong></td>
															<td width='70%'><input type=\"text\" name=\"cep\" value=\"$cep\"></input>$extraCEP</td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Renda</strong></td>
															<td width='70%'><input type=\"text\" name=\"renda\" value=\"$renda\"></input>$extraRenda</td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Moradia</strong></td>";
															echo "<td width='70%'>
																	<select  style=\"width: 175px;\" name=\"moradia\" align=\"center\">";
																	echo "<option value=\"\">Sem Informação</option>";
																		for($i=0;$i<count($arrayMoradia);$i++)
																		{
																			$valor = $arrayMoradia[$i];
																			echo "<option value=\"$valor\"";
																				if($valor == $moradia)
																				{
																					echo " selected";
																				}
																			echo ">$valor</option>";
																		}														
															echo "</select>$extraMoradia</td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Ocupação</strong></td>
															<td width='70%'><input type=\"text\" name=\"ocupacao\" value=\"$ocupacao\"></input>$extraOcupacao</td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Estado Civil</strong></td>";
															echo "<td width='70%'>
																	<select  style=\"width: 175px;\" name=\"estadocivil\" align=\"center\">";
																	echo "<option value=\"\">Sem Informação</option>";
																		for($i=0;$i<count($arrayEstadoCivil);$i++)
																		{
																			$valor = $arrayEstadoCivil[$i];
																			echo "<option value=\"$valor\"";
																				if($valor == $estadocivil)
																				{
																					echo " selected";
																				}
																			echo ">$valor</option>";
																		}														
															echo "</select>$extraEstado</td>
														</tr>";
														
														echo "
														<tr>
															<td width='30%'><strong>Comunidade</strong></td>";
															echo "<td width='70%'>
																	<select  style=\"width: 175px;\" name=\"comunidade\" align=\"center\">";
																	echo "<option value=\"\">Sem Informação</option>";
																		for($i=0;$i<count($arrayComunidades);$i++)
																		{
																			$valor = $arrayComunidades[$i];
																			echo "<option value=\"$valor\"";
																				if($valor == $comunidade)
																				{
																					echo " selected";
																				}
																			echo ">$valor</option>";
																		}														
															echo "</select>$extraComunidade</td>
														</tr>";
													
												
														echo "
														<tr>
															<td width='30%'><strong>Etnia</strong></td>";
															echo "<td width='70%'>
																	<select  style=\"width: 175px;\" name=\"etnia\" align=\"center\">";
																	echo "<option value=\"\">Sem Informação</option>";
																		for($i=0;$i<count($arrayEtnia);$i++)
																		{
																			$valor = $arrayEtnia[$i];
																			echo "<option value=\"$valor\"";
																				if($valor == $etnia)
																				{
																					echo " selected";
																				}
																			echo ">$valor</option>";
																		}														
															echo "</select>$extraEtnia</td>
														</tr>";
														
														echo "
																												
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
																<a href=\"$diretorio/CompResidencia.pdf\">Comprovante de Residecia</a>
															</td>
														</tr>
														
														<tr bgcolor=\"#000000\">
															<td colspan=\"2\"><strong></strong></td>
														</tr>
														
														<tr bgcolor=\"#000000\">
															<td colspan=\"2\" align=\"center\"><button formaction=\"atualizacadastro.php\" type=\"submit\"> Atualizar Cadastro</button></td>
														</tr>
														</tbody>
														</table><br><br>
														</div>
														";
								
								echo "
									<div class=\"modal-body2\">
										<form action=\"novoatendimento.php\" method=\"post\">
											<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">
														<table class=\"table table-bordered table-hover\">
															<tbody>
																<tr align=\"center\">
																	<th colspan=\"5\" align=\"center\">Atendimentos Anteriores</th>
																</tr>
																<tr>
																	<th>Area</th>
																	<th>Professor</th>
																	<th>Ultimo Atendimento</th>
																	<td align=\"center\"><font size=\"5\">&#128065</font></td>
																	<th>Deletar</th>
																</tr>
														";
														
														
														$sqlAtendimentos = "SELECT * FROM `atendimentos` WHERE `cpf` = \"$CPF\"";
														$queryAtendimentos = $conexao->query($sqlAtendimentos);
														$resultAtendimentos = $queryAtendimentos->fetchAll( PDO::FETCH_ASSOC );
														$rowsAtendimentos = count($resultAtendimentos);														
														
														for($i=0;$i<$rowsAtendimentos;$i++)
														{
															$area = $resultAtendimentos[$i]['area'];
															$responsavel = $resultAtendimentos[$i]['responsavel'];
															$dataDeInscricao = $resultAtendimentos[$i]['dataDeInscricao'];
															$dataUltimaAtualizacao = $resultAtendimentos[$i]['dataUltimaAtualizacao'];
															$index = $resultAtendimentos[$i]['index'];
															
															echo "
																	<tr>
																		<td width='10%'><strong>$area</strong></td>
																		<td width='50%'><strong>$responsavel</strong></td>
																		<td width='30%'><strong>$dataUltimaAtualizacao</strong></td>
																		<td width='5%'><strong><button name=\"assistencia\" value=$index formaction=\"consultaatendimento.php\">Ver</button></strong></td>
																		<td width='5%' align=\"center\"><strong><button name=\"assistencia\" value=\"apaga$index\" formaction=\"deletaatendimento.php\">X</button></strong></td>
																	</tr>
																";
														}
														
														echo "
														<tr align=\"center\">
															<td colspan=\"5\"><input type=\"submit\" value=\"Cadastrar Novo Atendimento\"></input></td>
														</tr>
														
														<tr align=\"center\">
															<td colspan=\"5\"><input type=\"submit\" value=\"Terminar Atendimento\" formaction=\"remove.php\"></input></td>
														</tr>
														
													</tbody>
											</table>
										</form>
									</div>
								";
								
								echo "</div>";
						?>
						
						
						
						
					
					</div>
				</div>
		</div>



        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
        
        $(document).ready(function() {
        
            
        
        });
		
		function teste()
		{
			document.getElementById('id_obstext').setAttribute("type","text");
			document.getElementById('id_buttonobs').setAttribute("formaction","editOBS.php");
			document.getElementById('id_buttonobs').innerHTML = "Enviar";
			document.getElementById('id_buttonobs').setAttribute("type","submit");
			document.getElementById('id_buttonobs').setAttribute("onclick","");
			
		}
		
        </script>
		
    </body>
</html>