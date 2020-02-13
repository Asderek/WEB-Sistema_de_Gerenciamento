<?php include ('header.php'); ?>
    
    <body  >
        
        <!--login modal-->
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="text-center">Núcleo de Prática Jurídica</h1><br>
							<h5 class="text-center">Sistemas Implementados no NPJ</h5>
						</div>
						
						<?php
							include('../utils/documentos.php');
							include('../../newconexao.php');
							include('../../injection.php');
							
							$CPF = $_POST['cpf'];
							
							$diretorio = DOCUMENTS_GETDOCUMENTPATH($CPF);
							
							$sqlDados = "SELECT * FROM `assistidos` WHERE `cpf` = \"$CPF\"";
							$queryDados = $conexao->query($sqlDados);
							if ($queryDados == false)
							{
								echo "Cliente Não Encontrado<br>";
								return;
							}
							$resultDados = $queryDados->fetchAll(PDO::FETCH_ASSOC );
							$rg = $resultDados[0]['rg'];
							$nome = $resultDados[0]['nome'];
							$tel1 = $resultDados[0]['tel1'];
							$tel2 = $resultDados[0]['tel2'];
							$cel = $resultDados[0]['cel'];
							$bairro = $resultDados[0]['bairro'];
							$dob = $resultDados[0]['dob'];
							$email = $resultDados[0]['email'];
							$comunidade = $resultDados[0]['comunidade'];
							$endereco = $resultDados[0]['endereco'];
							$obs = $resultDados[0]['obs'];
							
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
							
							if(injection($CPF))
							{
								echo "My code is Sanitized";
								return;
							}
							
							echo "<div>";
							echo "
										<form action=\"atualizarcadastro.php\" method=\"post\">";
										
										if(isset($obs))
										{
											echo "<h1 id=\"id_blink\" class=\"text-center\">Problema no cadastro do cliente, por favor, chame um responsavel da secretaria</h1>";
										}
											
										 echo "
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
															<td width='30%'><strong>Nome</strong></td>
															<input type=\"hidden\" name=\"nome\" value=\"$nome\" readonly style=\"background: transparent; border: none;\"></input>
															<td width='70%'>$nome</td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Data de Nascimento</strong></td>
															<td width='70%'><input type=\"text\" name=\"dob\" value=\"$dob\" readonly style=\"background: transparent; border: none;\"></input></td>
														</tr>	
													
														<tr>
															<td width='30%'><strong>RG</strong></td>
															<td width='70%'><input type=\"text\" name=\"rg\" value=\"$rg\" readonly style=\"background: transparent; border: none;\"></input></td>
														</tr>";
														
														if (!empty($tel1))
														{
															echo "
																<tr>
																	<td width='30%'><strong>"; 
																
																if (!empty($tel2))
																{
																	echo "Telefone 1";
																}
																else
																{
																	echo "Telefone";
																}
																
																
																echo "</strong></td>
																	<td width='70%'><input type=\"text\" name=\"tel1\" value=\"$tel1\"></input></td>
																</tr>";
														}
														
														if (!empty($tel2))
														{
															echo "
																<tr>
																	<td width='30%'><strong>Telefone 2</strong></td>
																	<td width='70%'><input type=\"text\" name=\"tel2\" value=\"$tel2\"></input></td>
																</tr>";
														}
														
														if (!empty($cel))
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
															<td width='30%'><strong>Endereco</strong></td>
															<td width='70%'><input type=\"text\" name=\"endereco\" value=\"$endereco\"></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Bairro</strong></td>
															<td width='70%'><input type=\"text\" name=\"bairro\" value=\"$bairro\"></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Comunidade</strong></td>
															<td width='70%'><select name=\"comunidade\" align=\"center\">
																<option value=\"---\">---</option>
															";
															for ($i=0;$i<count($comunidades);$i++)
															{
																$value = $comunidades[$i];
																echo "<option value=\"$value\"";
																	if ($value == $comunidade)
																		echo " selected";
																echo ">$value</option>";
															}
															echo "<select></td>
														</tr>
														
														
														<tr align=\"center\">
															<td colspan=\"2\"><strong>Documentos</strong></td>
														</tr>
														
														<tr> 
															<td width=\"30%\">
																<strong>RG</strong>
															</td>
															<td width=\"70%\">
																<a href=\"$diretorio/RG.pdf\" target=\"_blank\">RG</a><br>
															</td>
														</tr>
														
														<tr> 
															<td width=\"30%\">
																<strong>CPF</strong>
															</td>
															<td width=\"70%\">
																<a href=\"$diretorio/CPF.pdf\" target=\"_blank\">CPF</a><br>
															</td>
														</tr>
														
														<tr> 
															<td width=\"30%\">
																<strong>Comprovante de Renda</strong>
															</td>
															<td width=\"70%\">
																<a href=\"$diretorio/CompRenda.pdf\" target=\"_blank\">Comprovante de Renda</a><br>
															</td>
														</tr>
														
														<tr> 
															<td width=\"30%\">
																<strong>Comprovante de Residencia</strong>
															</td>
															<td width=\"70%\">
																<a href=\"$diretorio/CompResidencia.pdf\" target=\"_blank\">Comprovante de Residecia</a>
															</td>
														</tr>
														
														<tr bgcolor=\"#000000\">
															<td colspan=\"2\"><strong></strong></td>
														</tr>
														
														<tr>
															<td colspan=\"2\"><input type=\"submit\" name=\"tipo\" value=\"Atualizar Cadastro\" class=\"btn btn-primary btn-lg btn-block\"></td>
														</tr>
														<tr>
															<td colspan=\"2\"><input type=\"submit\" value=\"Atualizar Documento\" formaction=\"atualizardocumento.php\" class=\"btn btn-primary btn-lg btn-block\"></td>
														</tr>
														<tr>
															<td colspan=\"2\"><input type=\"submit\" value=\"Triagem\" formaction=\"enfilera.php\" class=\"btn btn-primary btn-lg btn-block\"></td>
														</tr>
														</tbody>
														</table><br><br>
														";
								
								echo "</div>";
						?>
						
						
						
						
					
					</div>
				</div>
		</div>



        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
        
		onload = function()
		{
			var curState = false;
			setInterval(function()
			{ 
				curState = !curState;
				if (curState == false)
				{
					document.getElementById('id_blink').setAttribute("style","color:#FFFFFF" );
				}
				else
				{
					document.getElementById('id_blink').setAttribute("style","color:#FF0000" );
				}
			}, 1000);
		}
		
        $(document).ready(function() {
        
        });
        </script>
		
    </body>
</html>