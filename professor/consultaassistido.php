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
			  background: url(../../assets/img/pilotis.jpg) no-repeat center center fixed; 
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
						</div>
						
						<?php
							include('../../newconexao.php');
							include('../../injection.php');
							
							$CPF = $_POST['cpf'];
							$nome = $_POST['nome'];
							$rg = $_POST['rg'];
							$tel = $_POST['tel'];
							$dob = $_POST['dob'];
							$bairro = $_POST['bairro'];
							$matricula = $_POST['matricula'];
							
							$sqlAssistido = "SELECT * FROM assistidos WHERE cpf = \"$CPF\"";
							$queryAssistido = $conexao->query($sqlAssistido);
							if ($queryAssistido != false)
							{
								$resultAssitido = $queryAssistido->fetchAll(PDO::FETCH_ASSOC);
								$etnia = $resultAssitido[0]['etnia'];
								if (empty($etnia))
									$etnia = "---";
							}
							
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
														</tr>
														
														<tr>
															<td width='30%'><strong>Telefone</strong></td>
															<td width='70%'><input type=\"text\" name=\"tel\" value=\"$tel\" readonly></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Data de Nascimento</strong></td>
															<td width='70%'><input type=\"text\" name=\"dob\" value=\"$dob\" readonly></input></td>
														</tr>
														
														";
														
														if ($etnia != "---")
														{
															echo "<tr>
																<td width='30%'><strong>Etnia</strong></td>
																<td width='70%'><input type=\"text\" name=\"etnia\" value=\"$etnia\" readonly></input></td>
															</tr>";
														}
														
														echo "
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
																<a href=\"../uploads/$CPF-RG.pdf\">RG</a><br>
															</td>
														</tr>
														
														<tr> 
															<td width=\"30%\">
																<strong>CPF</strong>
															</td>
															<td width=\"70%\">
																<a href=\"../uploads/$CPF-CPF.pdf\">CPF</a><br>
															</td>
														</tr>
														
														<tr> 
															<td width=\"30%\">
																<strong>Comprovante de Renda</strong>
															</td>
															<td width=\"70%\">
																<a href=\"../uploads/$CPF-CompRenda.pdf\">Comprovante de Renda</a><br>
															</td>
														</tr>
														
														<tr> 
															<td width=\"30%\">
																<strong>Comprovante de Residencia</strong>
															</td>
															<td width=\"70%\">
																<a href=\"../uploads/$CPF-CompResidencia.pdf\">Comprovante de Residecia</a>
															</td>
														</tr>
														
														<tr bgcolor=\"#000000\">
															<td colspan=\"2\"><strong></strong></td>
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
															<td colspan=\"5\"><strong>Processos Correntes</strong></td>
														</tr>
														<tr>
															<th>Area</th>
															<th>Numero do Processo</th>
															<th>Tipo de Processo</th>
															<th>Data do Ultimo Atendimento</th>
															<th></th>
														</tr>
												";
												
												
												$sqlProfName = "SELECT * FROM `professores` WHERE `matricula` = $matricula";
												$queryProfName = $conexao->query($sqlProfName);
												$resultProfName = $queryProfName->fetchAll( PDO::FETCH_ASSOC );
												if ($queryProfName == false)
												{
													echo "Deu Erro<br>";
													return;
												}
												
												$responsavel = $resultProfName[0]['nome'];
												
												$sqlProcessos = "SELECT * FROM `processos` WHERE `cpf` = \"$CPF\" AND `responsavel` = \"$responsavel\"";
												$queryProcessos = $conexao->query($sqlProcessos);
												$resultProcessos = $queryProcessos->fetchAll( PDO::FETCH_ASSOC );
												$rowsProcessos = count($resultProcessos);
												
												
												
												for($i=0;$i<$rowsProcessos;$i++)
												{
													$area = $resultProcessos[$i]['area'];
													$numProc = $resultProcessos[$i]['numerodoprocesso'];
													$tipodeprocesso = $resultProcessos[$i]['tipo'];
													$dataUlt = $resultProcessos[$i]['dataUltimaAtualizacao'];
													$index = $resultProcessos[$i]['index'];
													
													if($numProc == false)
													{
														$numProc = "Não existe";
													}
													
													echo "
															<tr>
																<td width='20%'><strong>$area</strong></td>
																<td width='20%'><strong>$numProc</strong></td>
																<td width='20%'><strong>$tipodeprocesso</strong></td>
																<td width='20%'><strong>$dataUlt</strong></td>
																<td width='20%'><strong><button name=\"assistencia\" value=$index formaction=\"consultaprocesso.php\">Ver</button></strong></td>
															</tr>
														";
												}
												
												echo "
														
													</tbody>
												</table>
											
												<table class=\"table table-bordered table-hover\">
													<tbody>
														<tr align=\"center\">
															<td colspan=\"5\"><strong>Atendimentos Pendentes</strong></td>
														</tr>
														<tr>
															<th>Area</th>
															<th>Data de Cadastro</th>
															<th>Descrição</th>
															<th></th>
														</tr>
												";
												
												$sqlAtendimentos = "SELECT * FROM `atendimentos` WHERE `cpf` = \"$CPF\" AND `responsavel` = \"$responsavel\"";
												$queryAtendimentos = $conexao->query($sqlAtendimentos);
												$resultAtendimentos = $queryAtendimentos->fetchAll( PDO::FETCH_ASSOC );
												$rowsAtendimentos = count($resultAtendimentos);
												
												
												for($i=0;$i<$rowsAtendimentos;$i++)
												{
													$area = $resultAtendimentos[$i]['area'];
													$dataDeInscricao = $resultAtendimentos[$i]['dataDeInscricao'];
													$descrição = $resultAtendimentos[$i]['descricao'];
													$index = $resultAtendimentos[$i]['index'];
													
													echo "
															<tr>
																<td width='30%'><strong>$area</strong></td>
																<td width='30%'><strong>$dataDeInscricao</strong></td>
																<td width='30%'><strong>$descrição</strong></td>
																<td width='30%'><strong><button name=\"assistencia\" value=$index formaction=\"consultaatendimento.php\">Ver</button></strong></td>
															</tr>
														";
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
        </script>
		
    </body>
</html>