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
			
			.rightSide
			{
				float:								right;
				position:                        	relative;
				width:                             	75%;
				top:                                50%;
			}
			
			.leftSide
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
							include('../../conexao.php');
							include('../../injection.php');
							include('processos.php');
							mysql_set_charset("utf8", $conexao);
							
							$CPF = $_POST['cpf'];
							$assistencia = $_POST['assistencia'];
							
							
							if(injection($CPF))
							{
								echo "My code is Sanitized";
								return;
							}
							
							$sqlAssistido = "SELECT * FROM `assistidos` WHERE `cpf` = \"$CPF\"";
							$queryAssistido = mysql_query($sqlAssistido,$conexao);
							if ($queryAssistido == false)
							{
								echo "Deu pau";
								return ;
							}
							
							$nome = mysql_result($queryAssistido,0,'nome');
							$rg = mysql_result($queryAssistido,0,'rg');
							$tel = mysql_result($queryAssistido,0,'tel');
							$dob = mysql_result($queryAssistido,0,'dob');
							$bairro = mysql_result($queryAssistido,0,'bairro');
							
							$sqlAssistencia = "SELECT * FROM `atendimentos` WHERE `index` = \"$assistencia\"";
							$queryAssistencia = mysql_query($sqlAssistencia,$conexao);
							if ($queryAssistido == false)
							{
								echo "Deu pau";
								return ;
							}
							
							$orientacao = mysql_result($queryAssistencia,0,'orientacao');
							$area = mysql_result($queryAssistencia,0,'area');
							$endereco = mysql_result($queryAssistencia,0,'endereco');
							$cep = mysql_result($queryAssistencia,0,'cep');
							$renda = mysql_result($queryAssistencia,0,'renda');
							$moradia = mysql_result($queryAssistencia,0,'moradia');
							$ocupacao = mysql_result($queryAssistencia,0,'ocupacao');
							$estadocivil = mysql_result($queryAssistencia,0,'estadocivil');
							$beneficiado = mysql_result($queryAssistencia,0,'beneficiado');
							$parentesco = mysql_result($queryAssistencia,0,'parentesco');
							$descricao = mysql_result($queryAssistencia,0,'descricao');
							$dataDeInscricao = mysql_result($queryAssistencia,0,'dataDeInscricao');
							$dataUltimaAtualizacao = mysql_result($queryAssistencia,0,'dataUltimaAtualizacao');
							$comentarios = mysql_result($queryAssistencia,0,'comentarios');
							
							$length = substr_count($comentarios,"$");
							
							$arrayComentarios = array();
							
							for($i=0;$i<$length;$i++)
							{
								$start = strpos($comentarios,"$");
								$start++;
								$comentarios = substr($comentarios,$start);
								$end = strpos($comentarios,"$");
								if($end === false)
									$insert = substr($comentarios,0);
								else
									$insert = substr($comentarios,0,$end);
								array_push($arrayComentarios,$insert);
								$comentarios = substr($comentarios,$end);
							}
							
							echo "
								<div>
								
									<div class=\"leftSide\">
										<table class=\"table table-bordered table-hover\">
											<tbody>
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


							";
							if($orientacao==1)
							{
								echo "
										<tr align='center' bgcolor='#007FFF'>
											<td colspan='2'><strong>SOMENTE ORIENTACAO</strong></td>
										</tr>
									";
							}

							echo "
												<tr align=\"center\">
													<td colspan=\"2\"><strong> Informações Adicionais</strong></td>
												</tr>
										
												<tr>
													<td width='30%'><strong>Area</strong></td>
													<td width='70%'>$area</td>
												</tr>

												<tr>
													<td width='30%'><strong>Endereço</strong></td>
													<td width='70%'>$endereco</td>
												</tr>

												<tr>
													<td width='30%'><strong>CEP</strong></td>
													<td width='70%'>$cep</td>
												</tr>

												<tr>
													<td width='30%'><strong>Renda Mensal</strong></td>
													<td width='70%'>$renda</td>
												</tr>

												<tr>
													<td width='30%'><strong>Moradia</strong></td>
													<td width='70%'>$moradia</td>
												</tr>

												<tr>
													<td width='30%'><strong>Ocupação</strong></td>
													<td width='70%'>$ocupacao</td>
												</tr>

												<tr>
													<td width='30%'><strong>Estado Civil</strong></td>
													<td width='70%'>$estadocivil</td>
												</tr>

												<tr>
													<td width='30%'><strong>Nome do Beneficiado</strong></td>
													<td width='70%'>$beneficiado</td>
												</tr>

												<tr>
													<td width='30%'><strong>Grau de Parentesco</strong></td>
													<td width='70%'>$parentesco</td>
												</tr>

												<tr>
													<td width='30%' rowspan=\"5\"><strong>Descrição</strong></td>
													<td width='70%' rowspan=\"5\">$descricao</td>
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

											</tbody>
										</table>
									</div>

									<div class=\"rightSide\">

											<table class=\"table table-bordered table-hover\">
												<tbody>
													<tr bgcolor = \"#A0A0A0\" align=\"center\">
														<td colspan= \"2\"><strong>Processos</td>
													</tr>
													
													<tr align='center'>
														<td colspan=\"2\"><a href=\"http://www4.tjrj.jus.br/ConsultaUnificada/consulta.do#tabs-numero-indice0\">Link para o TJRJ: http://www4.tjrj.jus.br/</a></td>
													</tr>
													
													<tr align='center'>
														<td colspan=\"2\"><strong>Numero do Processo</strong></th>
													</tr>
													
													
													";

										$processos = PROC_GetListaProcessos($assistencia,$conexao);

										for($i=0;$i<count($processos);$i++)
										{
											$processo = $processos[$i];
											$indexProcesso = $processo[0];
											$numeroDoProcesso = $processo[1];

											echo"
													<tr align='center'>
														<td colspan=\"2\">$numeroDoProcesso</td>
														<!--<td width='30%'><strong>
															<button name=\"processo\" value=$indexProcesso formaction=\"consultaprocesso.php\">Ver</button></strong>
														</td>-->
													</tr>

												";
										}

											echo"
													<form action=\"inserecomentario.php\" method=\"post\">
													<input type=\"hidden\" name=\"index\" value=\"$assistencia\">
													<tr bgcolor = \"#A0A0A0\" align=\"center\">
														<td colspan= \"2\"><strong>Comentarios</td>
													</tr>
													
													<tr>
														<th>Data</th>
														<th>Comentario</th>
													</tr>
												";
										for($i=0;$i<$length;$i++)
										{
											$dateEnd = strpos($arrayComentarios[$i],"#");
											$date = substr($arrayComentarios[$i],0,$dateEnd);
											$coment = substr($arrayComentarios[$i],$dateEnd+1);

											echo"
													<tr>
														<td>$date</td>
														<td>$coment</td>																		
													</tr>
												";
										}

											echo"

													<tr>
														<td width='30%' rowspan=\"5\"><strong>Comentario</strong></td>
														<td width='70%' rowspan=\"5\"><textarea name=\"comment\" cols=\"40\" rows=\"5\"></textarea></td>
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

													<tr align=\"center\">
														<td colspan=\"2\"><input type=\"submit\" value=\"Adicionar Comentario\"></td>
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