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
			
			.modal-body2
			{
				float:								right;
				margin-left:                       -100px;
				margin-top:                        0px;
				position:                        relative;
				width:                             100%;
				left:                                 50%;
				top:                                  50%;
			}
			
			.modal-body1
			{
				float:								left;
				margin-left:                       -600px;
				margin-top:                        0px;
				position:                        relative;
				width:                             100%;
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
							<h5 class="text-center">Sistemas Implementados no NPJ</h5>
						</div>
						
						<div class="modal-body">
							<form action="procurar.php" method="post">
						
						
							<?php
								include('../../newconexao.php');
								include('../../injection.php');
								include('../utils/email.php');
								
								print_r($_POST);
								
								
								$confirma = $_POST['confirmacao'];
								$CPF = $_POST['cpf'];
								$nome = $_POST['nome'];
								
								$orientacao = $_POST['orientacao'];
								$area = $_POST['area'];
								/*$cep = $_POST['cep'];
								$renda = $_POST['renda'];
								$moradia = $_POST['moradia'];
								$ocupacao = $_POST['ocupacao'];
								$estadocivil = $_POST['estadocivil'];*/
								$beneficiado = $_POST['beneficiado'];
								$parentesco = $_POST['parentesco'];
								$descricao = $_POST['descricao'];
								$responsavel = $_POST['responsavel'];
								$dataInscricao = date(DATE_RFC822);
								$dataUltima = date(DATE_RFC822);
								$dataRetorno = $_POST['data'];
								
								
								/*echo "<br><br>DataRetorno = $dataRetorno<br><br>";*/
								
								$dia = substr($dataRetorno,0,2);
								$mes = substr($dataRetorno,2,2);
								$ano = substr($dataRetorno,4);
								$sqlMonths = array("nil","jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez");
								$mes = $sqlMonths[intval($mes)];
								if($mes == "nil")
									$mes = "";
								
								$postHora = "hora$dia";
								$horaAtendimento = $_POST[$postHora];
								
								
								
								if (isset($_POST['encaminhamento']) && $_POST['encaminhamento'] == "on")
								{
									echo "<input type=\"hidden\" value=\"true\" name=\"encaminhamento\">";
									$responsavel = "LUCIANA QUEIROS DE OLIVEIRA";
									$area = "TRIAGEM";
									$beneficiado = "";
									$parentesco = "";
									$dataRetorno = "";
									$dia = "";
									$mes = "";
									$ano = "";
									$horaAtendimento = "";
								}
								
								if(injection($CPF))
								{
									echo "My code is Sanitized";
									return;
								}
								
								 if ($orientacao == "on")
								{
									$orientacao = 1;
								}
								else if (!isset($_POST['orientacao']))
								{
									$orientacao = 0;
								}
								
								if ($confirma =="OK")
								{
									
									$data = $dia."-".$mes."-".$ano;
									if ($data == "--")
										$data = "";
									
									$sqlAtendimento = "INSERT INTO `atendimentos`(`cpf`,`nome`, `arquivado`, `orientacao`,
																					`area`, `reu`, `autor`,
																					`beneficiado`, `parentesco`, `descricao`,
																					`responsavel`, `dataDeInscricao`, `dataUltimaAtualizacao`, `dataDeRetorno`,
																					`comentarios`,`hora`)
													   VALUES (\"$CPF\",\"$nome\",0,$orientacao,
																\"$area\",\"\",\"\",\"$beneficiado\",
																\"$parentesco\", \"$descricao\", \"$responsavel\",
																\"$dataInscricao\", \"$dataUltima\",\"$data\",
																\"\",\"$horaAtendimento\")";
								
									echo "<br><br>sqlAtendimento = $sqlAtendimento<br><br>";
									
									$queryAtendimento = $conexao->query($sqlAtendimento);
									if ($queryAtendimento != false)
									{
										echo "<h3 class=\"text-center\">Atendimento Inserido com Sucesso</h3><br><br>";
										echo "<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">";
									}
									else
									{
										echo "<h3 class=\"text-center\">Nao Inserido<br><br></h3>";
										
										echo "<h2 class=\"text-center\">Informações para a informatica</h2>"; 
										echo "
											cpf = $CPF<br>
											orientacao = $orientacao<br>
											area = $area<br>
											cep = $cep<br>
											renda = $renda<br>
											moradia = $moradia<br>
											ocupacao = $ocupacao<br>
											estadocivil = $estadocivil<br>
											beneficiado = $beneficiado<br>
											parentesco = $parentesco<br>
											descricao = $descricao<br>
											responsavel = $responsavel<br>
											dataDeInscricao = $dataInscricao<br>
											dataUltimaAtualizacao = $dataUltima<br>
											data = $dataRetorno<br>
											dia = $dia<br>
											mes = $mes<br>
											ano = $ano<br>
											<br>horaAtendimento = $horaAtendimento<br>
										";
										
										echo "<br><br>sqlAtendimento = $sqlAtendimento<br><br>";
									
									}
										
										
									/*{//Enviar Email
										$sqlEmail = "SELECT * FROM `assistidos` WHERE `cpf` = \"$CPF\"";
										$queryEmail = $conexao->query($sqlEmail);
										if ($queryEmail == false)
										{
											
										}
										else
										{
											$resultEmail = $queryEmail->fetchAll(PDO::FETCH_ASSOC);
											$email = $resultEmail[0]['email'];
											if (!empty($email))
											{
												$npj = "npj@puc-rio.br";
												$sbj = "Confirmação de Primeiro Atendimento";
												$msg = "Prezado $nome,\n\nInformamos que seu primeiro atendimento no Núcleo de Prática Jurídica foi agendado para o dia $dia-$mes-$ano no horario $horaAtendimento\nFavor comparecer prefenrencialmente 30 minutos antes do horario agendado e apresentar-se à secretaria\nEm caso de impossibilidade de comparecimento, por favor, entre em contato conosco o mais breve possivel\n\n";
												EMAIL_SEND($email,$sbj,$msg);
												EMAIL_SEND($npj,$sbj,$msg);
											}
										}
										
									}*/
									
								}
								else
								{
									$style = "style=\"background: transparent; border: none;\"";
									
									echo "<h2 class=\"text-center\">Por favor confirme os Dados do Atendimento</h2>";
									echo "
										<table class=\"table table-bordered table-hover\">
											<tbody>
												<tr>
													<td width='30%'><strong>CPF</strong></td>
													<td width='70%'><input type=\"text\" name=\"cpf\" value=\"$CPF\" readonly $style></input></td>
												</tr>
												<tr>
													<td width='30%'><strong>Nome</strong></td>
													<td width='70%'><input type=\"text\" size=\"50\" name=\"nome\" value=\"$nome\" readonly $style></input></td>
												</tr>
													
												<tr>
													<td width='30%'><strong>Orientacao</strong></td>
													<td width='70%'><input type=\"text\" name=\"orientacao\" value=\"$orientacao\" readonly $style></input></td>
												</tr>
												
												<tr>
													<td width='30%'><strong>area</strong></td>
													<td width='70%'><input type=\"text\" name=\"area\" value=\"$area\" readonly $style></input></td>
												</tr>";
												
												/*echo "
												<tr>
													<td width='30%'><strong>cep</strong></td>
													<td width='70%'><input type=\"text\" name=\"cep\" value=\"$cep\" readonly $style></input></td>
												</tr>
												<tr>
													<td width='30%'><strong>renda</strong></td>
													<td width='70%'><input type=\"text\" name=\"renda\" value=\"$renda\" readonly $style></input></td>
												</tr>
												<tr>
													<td width='30%'><strong>moradia</strong></td>
													<td width='70%'><input type=\"text\" name=\"moradia\" value=\"$moradia\" readonly $style></input></td>
												</tr>
												<tr>
													<td width='30%'><strong>ocupacao</strong></td>
													<td width='70%'><input type=\"text\" name=\"ocupacao\" value=\"$ocupacao\" readonly $style></input></td>
												</tr>
												<tr>
													<td width='30%'><strong>estadocivil</strong></td>
													<td width='70%'><input type=\"text\" name=\"estadocivil\" value=\"$estadocivil\" readonly $style></input></td>
												</tr>";*/
												
												if($beneficiado != "")
												{
													echo "
													<tr>
														<td width='30%'><strong>beneficiado</strong></td>
														<td width='70%'><input type=\"text\" name=\"beneficiado\" value=\"$beneficiado\" readonly $style></input></td>
													</tr>";
												}
												if ($parentesco != "")
												{
													echo "
													<tr>
														<td width='30%'><strong>parentesco</strong></td>
														<td width='70%'><input type=\"text\" name=\"parentesco\" value=\"$parentesco\" readonly $style></input></td>
													</tr>";
												}
												
												echo "
												<tr>
													<td width='30%'><strong>descricao</strong></td>
													<td width='70%'><input type=\"text\" name=\"descricao\" value=\"$descricao\" readonly $style></input></td>
												</tr>
												<tr>
													<td width='30%'><strong>responsavel</strong></td>
													<td width='70%'><input type=\"text\"  size=\"50\" name=\"responsavel\" value=\"$responsavel\" readonly $style></input></td>
												</tr>";
												
													echo "
													<tr>
													<td width='30%'><strong>dataInscricao</strong></td>
													<td width='70%'><input type=\"text\" size=\"50\" name=\"dataInscricao\" value=\"$dataInscricao\" readonly $style></input></td>
													</tr>";
													
												echo "
												<tr>
													<td width='30%'><strong>dataUltima</strong></td>
													<td width='70%'><input type=\"text\" size=\"50\" name=\"dataUltima\" value=\"$dataUltima\" readonly $style></input></td>
												</tr>";
												
												if($dia != "")
												{
													echo "
													<tr>
														<td width='30%'><strong>dataRetorno</strong></td>
														<input type=\"hidden\" name=\"data\" value=\"$dataRetorno\">
														<td width='70%'>$dia-$mes-$ano</input></td>
													</tr>";
												}
												if($dia != "")
												{
													echo "
												<tr>
													<td width='30%'><strong>Hora</strong></td>
													<td width='70%'><input type=\"text\" name=\"$postHora\" value=\"$horaAtendimento\" readonly $style></input></td>
												</tr>";
												}
												echo "
												<tr>
													
													<td colspan=\"2\" align=\"center\"><button type=\"submit\" formaction=\"cadastraratendimento.php\" name=\"confirmacao\" value=\"OK\">Confirma</button></td>
												</tr>
												
											</tbody>
										</table><br><br>
									";
									echo "
										
										
								
								";
								
								}
								
								
								
							?>
							
							<div style="float:left">
								<button type="submit" class="btn btn-primary btn-lg btn-block" formaction="index.html">Pagina Inicial</a>
							</div>
							
							<div style="float:right">
								<button type="submit" class="btn btn-primary btn-lg btn-block">Ver Informações do Assistido</a>
							</div>
							
							</form>
							
						</div>
						 <div class="modal-footer"></div>
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