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
					<div class="modal-content" style="float:left">
						<div class="modal-header">
							<h1 class="text-center">Núcleo de Prática Jurídica</h1><br>
							<h5 class="text-center">Sistemas Implementados no NPJ</h5>
						</div>
						
						<?php
							include('../../newconexao.php');
							include('../../injection.php');
							
							$CPF = $_POST['cpf'];
							$assistencia = $_POST['assistencia'];
							
							
							if(injection($CPF))
							{
								echo "My code is Sanitized";
								return;
							}
							
							$sqlAssistido = "SELECT * FROM `assistidos` WHERE `cpf` = \"$CPF\"";
							$queryAssistido = $conexao->query($sqlAssistido);
							if ($queryAssistido == false)
							{
								echo "Deu pau";
								return ;
							}
							$resultAssistido = $queryAssistido->fetchAll( PDO::FETCH_ASSOC );
							
							$nome = $resultAssistido[0]['nome'];
							$rg = $resultAssistido[0]['rg'];
							$tel1 = $resultAssistido[0]['tel1'];
							$tel2 = $resultAssistido[0]['tel2'];
							$cel = $resultAssistido[0]['cel'];
							$dob = $resultAssistido[0]['dob'];
							$bairro = $resultAssistido[0]['bairro'];
							$email = $resultAssistido[0]['email'];
							
							$sqlAssistencia = "SELECT * FROM `atendimentos` WHERE `index` = \"$assistencia\"";
							$queryAssistencia = $conexao->query($sqlAssistencia);
							if ($queryAssistencia == false)
							{
								echo "Deu pau";
								return ;
							}
							$resultAssistencia = $queryAssistencia->fetchAll( PDO::FETCH_ASSOC );
							
							$orientacao = $resultAssistencia[0]['orientacao'];
							$area = $resultAssistencia[0]['area'];
							$endereco = $resultAssistencia[0]['endereco'];
							$cep = $resultAssistencia[0]['cep'];
							$renda = $resultAssistencia[0]['renda'];
							$moradia = $resultAssistencia[0]['moradia'];
							$ocupacao = $resultAssistencia[0]['ocupacao'];
							$estadocivil = $resultAssistencia[0]['estadocivil'];
							$beneficiado = $resultAssistencia[0]['beneficiado'];
							$parentesco = $resultAssistencia[0]['parentesco'];
							$descricao = $resultAssistencia[0]['descricao'];
							$responsavel = $resultAssistencia[0]['responsavel'];
							$dataDeInscricao = $resultAssistencia[0]['dataDeInscricao'];
							$dataUltimaAtualizacao = $resultAssistencia[0]['dataUltimaAtualizacao'];
							$dataDeRetorno = $resultAssistencia[0]['dataDeRetorno'];
							$hora = $resultAssistencia[0]['hora'];
							$hora = $hora."h";
							
							$index = $assistencia;
							
							$sqlProfessores = "SELECT * FROM professores WHERE 1";
							$queryProfessores = $conexao->query($sqlProfessores);
							$resultProfessores = $queryProfessores->fetchAll(PDO::FETCH_ASSOC);
							
							echo "
								<div>
									<div class=\"modal-body1\">
										<form action=\"cadastraratendimento.php\" method=\"post\">
											
											<table class=\"table table-bordered table-hover\">
												<tbody>
														<tr>
															<td colspan=\"2\"><button formaction=\"procurar.php\" name=\"cpf\" value=\"$CPF\" class=\"btn btn-primary btn-lg btn-block\"><-- Ficha do Assistido</button></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>CPF</strong></td>
															<td width='70%'>$CPF</td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Nome</strong></td>
															<td width='70%'>$nome</td>
														</tr>
													
														<tr>
															<td width='30%'><strong>RG</strong></td>
															<td width='70%'>$rg</td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Telefone</strong></td>
															<td width='70%'>$tel1</td>
														</tr>";
														if (!empty($tel2))
														{
															echo "
															<tr>
																<td width='30%'><strong>Telefone 2</strong></td>
																<td width='70%'>$tel2</td>
															</tr>";
														}
														if (!empty($cel))
														{
															echo "
															<tr>
																<td width='30%'><strong>Celular</strong></td>
																<td width='70%'>$cel</td>
															</tr>";
														}
														if (!empty($email))
														{
															echo "
															<tr>
																<td width='30%'><strong>Email</strong></td>
																<td width='70%'>$email</td>
															</tr>";
														}
														echo "
														<tr>
															<td width='30%'><strong>Data de Nascimento</strong></td>
															<td width='70%'>$dob</td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Bairro</strong></td>
															<td width='70%'>$bairro</td>
														</tr>
														
														<tr align=\"center\">
															<td colspan=\"2\"><strong>Documentos</strong></td>
														</tr>
														
														<tr> 
															<td width=\"30%\">
																<strong>RG</strong>
															</td>
															<td width=\"70%\">
																<a href=\"../uploads/$CPF/RG.pdf\">RG</a><br>
															</td>
														</tr>
														
														<tr> 
															<td width=\"30%\">
																<strong>CPF</strong>
															</td>
															<td width=\"70%\">
																<a href=\"../uploads/$CPF/CPF.pdf\">CPF</a><br>
															</td>
														</tr>
														
														<tr> 
															<td width=\"30%\">
																<strong>Comprovante de Renda</strong>
															</td>
															<td width=\"70%\">
																<a href=\"../uploads/$CPF/CompRenda.pdf\">Comprovante de Renda</a><br>
															</td>
														</tr>
														
														<tr> 
															<td width=\"30%\">
																<strong>Comprovante de Residencia</strong>
															</td>
															<td width=\"70%\">
																<a href=\"../uploads/$CPF/CompResidencia.pdf\">Comprovante de Residecia</a>
															</td>
														</tr>
														
													</tbody>
											</table>
										</form>
									</div>
									
									<div class=\"modal-body2\">
										<form action=\"atualizaratendimento.php\" method=\"post\">
											<input type=\"hidden\" name=\"index\" value=\"$index\">
											<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">
											<table class=\"table table-bordered table-hover\">
												<tbody>
														
														";
															echo "
															<tr align='center' bgcolor='#007FFF'>
																<td colspan='2'><strong><input type=\"checkbox\" name=\"orientacao\""; if ($orientacao==1) echo " checked";  echo ">SOMENTE ORIENTACAO</input></strong></td>
															</tr>";
														
														
														echo "
														
														<tr>
															<td colspan=\"2\" align=\"center\">Consulta: <strong>$dataDeRetorno ($hora)</strong></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Area</strong></td>
															<td width='70%'>$area</td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Responsavel</strong></td>
															<td><select name=\"responsavel\">";
																for($i=0;$i<count($resultProfessores);$i++)
																{
																	$nomeProfessor = $resultProfessores[$i]['nome'];
																	if ($nomeProfessor == $responsavel)
																		echo "<option value=\"$nomeProfessor\" selected>$nomeProfessor</option>";
																	else
																		echo "<option value=\"$nomeProfessor\">$nomeProfessor</option>";
																}
															echo "</select></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Endereço</strong></td>
															<td width='70%'><input type=\"text\" name=\"endereco\" value=\"$endereco\"></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>CEP</strong></td>
															<td width='70%'><input type=\"text\" name=\"cep\" value=\"$cep\"></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Renda Mensal</strong></td>
															<td width='70%'><input type=\"text\" name=\"renda\" value=\"$renda\"></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Moradia</strong></td>
															<td width='70%'><input type=\"text\" name=\"moradia\" value=\"$moradia\"></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Ocupação</strong></td>
															<td width='70%'><input type=\"text\" name=\"ocupacao\" value=\"$ocupacao\"></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Estado Civil</strong></td>
															<td width='70%'><input type=\"text\" name=\"estadocivil\" value=\"$estadocivil\"></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Nome do Beneficiado</strong></td>
															<td width='70%'><input type=\"text\" name=\"beneficiado\" value=\"$beneficiado\"></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Grau de Parentesco</strong></td>
															<td width='70%'><input type=\"text\" name=\"parentesco\" value=\"$parentesco\"></td>
														</tr>
														
														<tr>
															<td width='30%' rowspan=\"5\"><strong>Descrição</strong></td>
															<td width='70%' rowspan=\"5\"><textarea name=\"descricao\" cols=\"120\" rows=\"5\">$descricao</textarea></td>
														</tr>
														
														<tr>
															<td width='30%' style=\"display:none\"><strong></strong></td>
														</tr>
														
														<tr>
															<td width='30%' style=\"display:none\"><strong></strong></td>
														</tr>
														
														<tr>
															<td width='30%' style=\"display:none\"><strong></strong></td>
														</tr>
														
														<tr>
															<td width='30%' style=\"display:none\"><strong></strong></td>
														</tr>
														
														<tr>
															<td colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Atualizar\"></td>
														</tr>
														</tbody>
											</table>
										</form>
									</div>
								</div>
							";
								
							
						?>
						
						
						
						
					
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