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
							<h5 class="text-center">Sistemas Implementados no NPJ</h5>
							
						
						<?php
							include ('../utils/documentos.php');
							include('../../newconexao.php');
							include('../../injection.php');
							
							$CPF = $_POST['cpf'];
							
							$diretorio = DOCUMENTS_GETDOCUMENTPATH($CPF);
							
							echo "
							<form action=\"index.html\" method=\"post\">
								<button type=\"submit\" style=\"float=right;\">Voltar</button>
							</form>
						</div>";
							$nome = $_POST['nome'];
							$rg = $_POST['rg'];
							$tel1 = $_POST['tel1'];
							$tel2 = $_POST['tel2'];
							$cel = $_POST['cel'];
							$dob = $_POST['dob'];
							$bairro = $_POST['bairro'];
							$email = $_POST['email'];
							
							if(injection($CPF))
							{
								echo "My code is Sanitized";
								return;
							}
							
							echo "<div>";
							echo "
									<div class=\"modal-body1\">
										<form action=\"novoatendimento.php\" method=\"post\">
										
											<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">
											<table class=\"table table-bordered table-hover\">
												<tbody>
														<tr align=\"center\">
															<th colspan=\"5\" align=\"center\">Dados do Assistido</th>
														</tr>
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
																		echo "src=\"$diretorio/foto.png\" ";
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
															<td width='70%'><input type=\"text\" name=\"cpf\" value=\"$CPF\" readonly></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Nome</strong></td>
															<td width='70%'><input type=\"text\" name=\"nome\" value=\"$nome\" readonly></input></td>
														</tr>
													
														<tr>
															<td width='30%'><strong>RG</strong></td>
															<td width='70%'><input type=\"text\" name=\"rg\" value=\"$rg\" readonly></input></td>
														</tr>";
														
														if (!empty($tel1))
														{
															echo "
															<tr>
																<td width='30%'><strong>Telefone 1</strong></td>
																<td width='70%'><input type=\"text\" name=\"tel1\" value=\"$tel1\" readonly></input></td>
															</tr>";
														}
														if (!empty($tel2))
														{
															echo "
															<tr>
																<td width='30%'><strong>Telefone 2</strong></td>
																<td width='70%'><input type=\"text\" name=\"tel2\" value=\"$tel2\" readonly></input></td>
															</tr>";
														}
														if (!empty($cel))
														{
															echo "
															<tr>
																<td width='30%'><strong>Celular</strong></td>
																<td width='70%'><input type=\"text\" name=\"cel\" value=\"$cel\" readonly></input></td>
															</tr>";
														}
														if (!empty($email))
														{
															echo "
															<tr>
																<td width='30%'><strong>Email</strong></td>
																<td width='70%'><input type=\"text\" name=\"email\" value=\"$email\" readonly></input></td>
															</tr>";
														}
														echo "
														<tr>
															<td width='30%'><strong>Data de Nascimento</strong></td>
															<td width='70%'><input type=\"text\" name=\"dob\" value=\"$dob\" readonly></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Bairro</strong></td>
															<td width='70%'><input type=\"text\" name=\"bairro\" value=\"$bairro\" readonly></input></td>
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
													</form>
														";
								
								echo "asdasd<br>";
								$decisao = $_POST['assistencia'];
								echo "decisao = $decisao<br>";
								
								
								
								echo "asdijasdio<br>";
								//echo "decisao = $decisao<br>idCaso = $idCaso<br>";
								if (strstr($decisao,"apaga") != false)
								{
									$idCaso = substr ($decisao,strlen("apaga"));
									$sqlAtendimento = "SELECT * FROM `atendimentos` WHERE `index` = $idCaso";
									$queryAtendimento = $conexao->query($sqlAtendimento);
									$resultAtendimento = $queryAtendimento->fetchAll(PDO::FETCH_ASSOC);	
									$responsavel = $resultAtendimento[0]['responsavel'];
									$area = $resultAtendimento[0]['area'];
									$descricao = $resultAtendimento[0]['descricao'];
									$dataDeRetorno = $resultAtendimento[0]['dataDeRetorno'];
									$hora = $resultAtendimento[0]['hora'];
									$hora = $hora.'h';
									echo "
										<div class=\"modal-body2\">
											<form action=\"deletaatendimento.php\" method=\"post\">
												<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">
												<input type=\"hidden\" name=\"nome\" value=\"$nome\">
												<input type=\"hidden\" name=\"rg\" value=\"$rg\">
												<input type=\"hidden\" name=\"tel1\" value=\"$tel1\">
												<input type=\"hidden\" name=\"tel2\" value=\"$tel2\">
												<input type=\"hidden\" name=\"cel\" value=\"$cel\">
												<input type=\"hidden\" name=\"dob\" value=\"$dob\">
												<input type=\"hidden\" name=\"bairro\" value=\"$bairro\">
												<input type=\"hidden\" name=\"email\" value=\"$email\">
												
												<h2 class=\"text-center\">Tem certeza que deseja apagar o seguinte atendimento?</h2><br><br><br>
												<table class=\"table table-bordered table-hover\">
													<tbody>
														<tr align=\"center\">
															<td colspan=\"5\" align=\"center\"><strong>Dados do Atendimento</strong></td>
														</tr>
														<tr> 
															<td align=\"center\">
																ID
															</td>
															<td align=\"center\">
																$idCaso
															</td>
														</tr>
														<tr> 
															<td align=\"center\">
																Area
															</td>
															<td align=\"center\">
																$area
															</td>
														</tr>
														<tr> 
															<td align=\"center\">
																Responsavel
															</td>
															<td align=\"center\">
																$responsavel
															</td>
														</tr>
														<tr> 
															<td align=\"center\">
																Descrição
															</td>
															<td align=\"center\">
																$descricao
															</td>
														</tr>
														<tr> 
															<td align=\"center\">
																Agendamento
															</td>
															<td align=\"center\">
																$dataDeRetorno ($hora)
															</td>
														</tr>
														<tr bgcolor=\"#000000\">
															<td colspan=\"2\" align=\"center\"><button name=\"assistencia\" value=\"confirma$idCaso\" type=\"submit\"> Confirmar</button></td>
														</tr>
														<tr bgcolor=\"#000000\">
															<td colspan=\"2\" align=\"center\"><button formaction=\"procurar.php\" name=\"cpf\" value=\"$CPF\" type=\"submit\"> Voltar</button></td>
														</tr>
													</tbody>
												</table>
											</form>
										</div>
									";
								}
								else
								{
									$idCaso = substr ($decisao,strlen("confirma"));
									$sqlAtendimento = "DELETE FROM `atendimentos` WHERE `index` = $idCaso";
									$queryAtendimento = $conexao->query($sqlAtendimento);
									if ($queryAtendimento == false)
									{
										echo "<h2 class=\"text-center\">Não foi possivel deletar o caso do atendido</h2><br>
											sqlAtendimento = $sqlAtendimento;
											<button formaction=\"procurar.php\" name=\"cpf\" value=\"$CPF\" type=\"submit\"> Voltar</button>
														";
									}
									else
									{
										echo "
										<div class=\"modal-body2\">
											<form id=\"id_form\" action=\"procurar.php\" method=\"post\">
												<input type=\"hidden\" value=\"$CPF\" name=\"cpf\">
											</form>
											<script>
												document.getElementById('id_form').submit();
											</script>
										</div>
									";
									}
									
								}
						?>
						
						</div>
						
						
					
					</div>
				</div>
		</div>



        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
        
        $(document).ready(function() {
        
            
        
        });
        </script>
		
    </body>
</html>