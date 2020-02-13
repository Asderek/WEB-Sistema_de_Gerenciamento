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
			}
			
			.modal-content
			{
				margin-left:                       -512px;
				margin-top:                        0px;
				position:                        relative;
				width:                             150%;
				left:                                 50%;
				top:                                  50%;
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
							<h5 class="text-center">Cadastro de Novo Atendimento</h5>
						</div>
						
						<?php
							include('../utils/documentos.php');
							include('../../newconexao.php');
							include('../../injection.php');
							
							$CPF = $_POST['cpf'];
							$nome = $_POST['nome'];
							$rg = $_POST['rg'];
							$tel1 = $_POST['tel1'];
							$dob = $_POST['dob'];
							$bairro = $_POST['bairro'];
							$tel2 = $_POST['tel2'];
							$cel = $_POST['cel'];
							$email = $_POST['email'];
							$endereco = $_POST['endereco'];
							
							$diretorio = DOCUMENTS_GETDOCUMENTPATH($CPF);
							
							$size = 50;
							
							if(injection($CPF))
							{
								echo "My code is Sanitized";
								return;
							}
							
							$style = "style=\"background: transparent; border: none;\"";
							
							echo "
									<div class=\"modal-body\">
										<form id=\"id_form\" action=\"escolhedata.php\" method=\"post\">
											<input type=\"hidden\" name=\"cpf\" value=\"$CPF\"></input>
											<table class=\"table table-bordered table-striped table-hover\">
												<tbody>
														<tr>
															<td width='30%'><strong>CPF</strong></td>
															<td width='30%'><input type=\"text\" value=\"$CPF\" readonly $style></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Nome</strong></td>
															<td width='70%'><input type=\"text\" name=\"nome\" value=\"$nome\" size=\"$size\" readonly $style></input></td>
														</tr>
													
														<tr>
															<td width='30%'><strong>RG</strong></td>
															<td width='70%'><input type=\"text\" name=\"rg\" value=\"$rg\" readonly $style></input></td>
														</tr>"; 
														
														if (!empty($tel1))
														echo "
														<tr>
															<td width='30%'><strong>Telefone 1</strong></td>
															<td width='70%'><input type=\"text\" name=\"tel1\" value=\"$tel1\" readonly $style></input></td>
														</tr>";
														
														if (!empty($tel2))
														echo "
														<tr>
															<td width='30%'><strong>Telefone 2</strong></td>
															<td width='70%'><input type=\"text\" name=\"tel2\" value=\"$tel2\" readonly $style></input></td>
														</tr>";
														
														if (!empty($cel))
														echo "
														<tr>
															<td width='30%'><strong>Celular</strong></td>
															<td width='70%'><input type=\"text\" name=\"cel\" value=\"$cel\" readonly $style></input></td>
														</tr>";
														
														if (!empty($email))
														echo "
														<tr>
															<td width='30%'><strong>Email</strong></td>
															<td width='70%'><input type=\"text\" name=\"email\" value=\"$email\" readonly $style></input></td>
														</tr>";
														
														
														echo "
														<tr>
															<td width='30%'><strong>Data de Nascimento</strong></td>
															<td width='70%'><input type=\"text\" name=\"dob\" value=\"$dob\" readonly $style></input></td>
														</tr>
														<tr>
															<td width='30%'><strong>Endereço</strong></td>
															<td width='70%'><input type=\"text\" name=\"endereco\" value=\"$endereco\" readonly $style size=\"100\"></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Bairro</strong></td>
															<td width='70%'><input type=\"text\" name=\"bairro\" value=\"$bairro\" readonly $style></input></td>
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
														
														
														
														
														<tr align=\"center\">
															<td align=\"center\" colspan=\"2\" style=\"width:50%\"><input type=\"checkbox\" name=\"orientacao\">SOMENTE ORIENTACAO</td>
														</tr>";
														echo "
														<tr align=\"center\">
															<td align=\"center\" colspan=\"2\" style=\"width:50%\"><input id=\"id_encaminhamento\" type=\"checkbox\" name=\"encaminhamento\" onchange=\"funcEncaminhamento()\">Encaminhamento</td>
														</tr>";
														
														
															
														$arrayArea = array();
														$arrayProfessores = array();
														$sqlProfessores = "SELECT * FROM professores WHERE 1 ORDER BY nome";
														$queryProfessores = $conexao->query($sqlProfessores);
														$resultProfessores = $queryProfessores->fetchAll( PDO::FETCH_ASSOC);
														for($i=0;$i<count($resultProfessores);$i++)
														{
															array_push($arrayProfessores,$resultProfessores[$i]['nome']);
															if (!in_array($resultProfessores[$i]['area'],$arrayArea))
															{
																array_push($arrayArea,$resultProfessores[$i]['area']);
															}
														}
														array_push($arrayArea,"PREVIDENCIARIO");
														array_push($arrayArea,"PRE-MEDIACAO");
														
														sort($arrayArea);
															echo "
														<tr id=\"id_area\">
															<td width='30%'><strong>Area</strong></td>
															<td width='70%'><select name=\"area\" align=\"center\" style=\"font-size:100%\">";
														for($i=0;$i<count($arrayArea);$i++)
														{
															$value = $arrayArea[$i];
															echo "<option value=\"$value\">$value</option>";
														}
														
														//echo "<option value=\"PRE-MEDIACAO\">PRE-MEDIAÇÃO</option>";
														//echo "<option value=\"PREVIDENCIARIO\">PREVIDENCIÁRIO</option>";
														echo "</select></td></tr>";
														
														echo "
														<tr id=\"id_responsavel\">
															<td width='30%'><strong>Responsavel</strong></td>
															<td width='70%'><select name=\"responsavel\" align=\"center\" style=\"font-size:100%\">";
														for($i=0;$i<count($arrayProfessores);$i++)
														{
															$value = $arrayProfessores[$i];
															echo "<option value=\"$value\">$value</option>";
														}
														echo "</select></td></tr>";
														
														/*echo"
														
														<tr>
															<td width='30%'><strong>CEP</strong></td>
															<td width='70%'><input type=\"text\" name=\"cep\" placeholder=\"22270-010\" required></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Renda Mensal</strong></td>
															<td width='70%'><input type=\"text\" name=\"renda\" placeholder=\"R$4870,00\" required></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Moradia</strong></td>
															<td width='70%'><select name=\"moradia\" align=\"center\" style=\"font-size:100%\">
																<option value=\"Propria\">CASA PROPRIA</option>
																<option value=\"Aluguel\">ALUGUEL</option>
																<option value=\"Comodato\">COMODATO</option>
																<option value=\"Financiada\">FINANCIADA</option>
																<option value=\"Posse\">POSSE</option>
																<option value=\"Funcional\">FUNCIONAL</option>
															<select></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Ocupação</strong></td>
															<td width='70%'><input type=\"text\" name=\"ocupacao\" placeholder=\"Assistente Social\" required></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Estado Civil</strong></td>
															<td width='70%'><select name=\"estadocivil\" align=\"center\" style=\"font-size:100%\">
																<option value=\"Solteir\">	SOLTEIRA(O)	</option>
																<option value=\"Casad\">	CASADA(O) 	</option>
																<option value=\"Viuv\">	 VIUVA(O) 	</option>
																<option value=\"Divorciad\">	 DIVORCIADA(O) 	</option>
																<option value=\"Uniao Estavel\">	 UNIAO ESTAVEL 	</option>
															<select></td>
														</tr>";*/
														
														echo "
														<tr id=\"id_beneficiado\">
															<td width='30%'><strong>Nome do Beneficiado</strong></td>
															<td width='70%'><input type=\"text\" name=\"beneficiado\" value=\"O Proprio\"></input></td>
														</tr>
														
														<tr id=\"id_parentesco\">
															<td width='30%'><strong>Grau de Parentesco</strong></td>
															<td width='70%'><input type=\"text\" name=\"parentesco\" value=\"O Proprio\"></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Descrição</strong></td>
															<td width='70%'><textarea name=\"descricao\" cols=\"100\" rows=\"10\"></textarea></td>
														</tr>
														
															
														
														<tr align=\"center\">
															<td colspan=\"2\"><input type=\"submit\" value=\"Cadastrar\"></input></td>
														</tr>
														
														
														
													</tbody>
											</table>
										</form>
									</div>
								";
								
							
						?>
						
						
						
						
					
					</div>
				</div>
		</div>



        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
        
		function funcEncaminhamento()
		{
			var value = document.getElementById('id_encaminhamento').checked;
			if(value == true)
			{
				document.getElementById('id_area').style.display = "none";
				document.getElementById('id_responsavel').style.display = "none";
				document.getElementById('id_beneficiado').style.display = "none";
				document.getElementById('id_parentesco').style.display = "none";
				
				document.getElementById('id_form').setAttribute("action","cadastraratendimento.php")
			}
			else
			{
				document.getElementById('id_area').style.display = "";
				document.getElementById('id_responsavel').style.display = "";
				document.getElementById('id_beneficiado').style.display = "";
				document.getElementById('id_parentesco').style.display = "";
				
				document.getElementById('id_form').setAttribute("action","escolhedata.php")
				
			}
		}
        </script>
		
    </body>
</html>