<?php
							include('../utils/documentos.php');
							include('../../newconexao.php');
							include('../../injection.php');
							
							$assistencia = $_POST['idCaso'];
							$sqlAssistencia = "SELECT * FROM `atendimentos` WHERE `index` = \"$assistencia\"";
							$queryAssistencia = $conexao->query($sqlAssistencia);
							$resultAssistencia = $queryAssistencia->fetchAll( PDO::FETCH_ASSOC );
							if ($queryAssistencia == false)
							{
								echo "Deu pau";
								return ;
							}
							$CPF = $resultAssistencia[0]['cpf'];
							$arquivado = $resultAssistencia[0]['arquivado'];
							
							$diretorio = DOCUMENTS_GETDOCUMENTPATH($CPF);
							
							echo "<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">";
							
							echo "<button type=\"submit\" value=\"verassistido$CPF\" name=\"mode\" align=\"right\">Ver Ficha</button>";
							echo "<button style=\"float:right;\" type=\"submit\" value=\"arquivar\" name=\"mode\" align=\"right\" formaction=\"arquivar.php\" class=\"btn btn-primary\"><strong>"; 
								if ($arquivado == 1)
									echo "Desa";
								else
									echo "A";
							echo "rquivar</strong></button><br><br>";
							
							if(injection($CPF))
							{
								echo "My code is Sanitized";
								return;
							}
							
							echo "<input type=\"hidden\" name=\"index\" value=$assistencia>";
							
							$sqlAssistido = "SELECT * FROM `assistidos` WHERE `cpf` = \"$CPF\"";
							$queryAssistido = $conexao->query($sqlAssistido);
							$resultAssistido = $queryAssistido->fetchAll( PDO::FETCH_ASSOC );
							
							if ($queryAssistido == false)
							{
								echo "Deu pau";
								return ;
							}
							
							$nome = $resultAssistido[0]['nome'];
							$rg = $resultAssistido[0]['rg'];
							$tel1 = $resultAssistido[0]['tel1'];
							$tel2 = $resultAssistido[0]['tel2'];
							$cel = $resultAssistido[0]['cel'];
							$dob = $resultAssistido[0]['dob'];
							$bairro = $resultAssistido[0]['bairro'];
							$email = $resultAssistido[0]['email'];
						
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
							$dataDeInscricao = $resultAssistencia[0]['dataDeInscricao'];
							$dataUltimaAtualizacao = $resultAssistencia[0]['dataUltimaAtualizacao'];
							$dataDeRetorno = $resultAssistencia[0]['dataDeRetorno'];
							$reu = $resultAssistencia[0]['reu'];
							$autor = $resultAssistencia[0]['autor'];
							$comentarios = $resultAssistencia[0]['comentarios'];
							$processo = $resultAssistencia[0]['processo'];
							
							//echo "<h3 align=\"center\">Caso do Assistido</h3>";
							//echo "<h4 align=\"center\">descrição - $descricao</h4>";
							
							$length = substr_count($comentarios,"|");
							
							$arrayComentarios = array();
							
							for($i=0;$i<$length;$i++)
							{
								$start = strpos($comentarios,"|");
								$start++;
								$comentarios = substr($comentarios,$start);
								$end = strpos($comentarios,"|");
								if($end === false)
									$insert = substr($comentarios,0);
								else
									$insert = substr($comentarios,0,$end);
								array_push($arrayComentarios,$insert);
								$comentarios = substr($comentarios,$end);
							}
							
							$arquivos = $resultAssistencia[0]['arquivos'];
							
							$arquivoslen = substr_count($arquivos,"$");
							
							$arrayArquivos = array();
							
							for($i=0;$i<$arquivoslen;$i++)
							{
								$start = strpos($arquivos,"$");
								$start++;
								$comentarios = substr($arquivos,$start);
								$end = strpos($comentarios,"$");
								if($end === false)
								{
									$insert = substr($comentarios,0);
								}
								else
								{
									$insert = substr($comentarios,0,$end);
								}
								array_push($arrayArquivos,$insert);
								$arquivos = substr($comentarios,$end);
							}
							
							$months = array("jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez");
							$meses = array("01","02","03","04","05","06","07","08","09","10","11","12");
							for($i=0;$i<count($months);$i++)
							{
								if (strstr($dataDeRetorno,$months[$i]))
								{
									$dataDeRetorno = $dataDeRetorno[7].$dataDeRetorno[8].$dataDeRetorno[9].$dataDeRetorno[10].'-'.$meses[$i].'-'.$dataDeRetorno[0].$dataDeRetorno[1];
								}
							}
							
							
							echo "<table class=\"table table-bordered table-hover\">
									<tbody>
										
											<tr> 
											<td colspan='3' align='center'>
												<strong>Descrição</strong>
											</td ></tr><tr>
											<td colspan='3'>
												<p align=\"justify\">$descricao</p>
											</td>
										</tr></tbody></table>";
							
		
							echo "
									
								<table class=\"table table-bordered table-hover\">
									<tbody>
										
											<tr> 
											<td width=\"30%\">
												<strong>Inserir Documento</strong>
											</td>
											<td width=\"70%\" colspan=\"3\">
												<input type=\"text\" name=\"nomearquivo\" placeholder=\"Nome do Arquivo\" onkeyup=\"checkArquivoRepetido()\" id=\"id_fileName\">
												<input type=\"submit\" formaction=\"enviararquivo.php\" id=\"id_botaoEnviar\"><br><p id=\"id_alert\" style=\"visibility:hidden\">Já existe um arquivo com esse nome</p>
												<input type=\"file\" name=\"documento\" accept=\".pdf\">
											</td>
										</tr>
										
										<tr bgcolor = \"#A0A0A0\" align=\"center\">
											<td colspan= \"4\"><strong>Relatório de Atendimento</td>
										</tr>
										
										<tr>
											<td width='30%' rowspan=\"5\" style=\"vertical-align: middle;\"><strong>Relatório</strong></td>
											<td width='70%' rowspan=\"5\" colspan=\"2\"><textarea name=\"comment\" cols=\"40\" rows=\"5\"></textarea></td>
											<td rowspan=\"5\" style=\"vertical-align: middle;\"><button name=\"comentar\" value=\"comentario\" formaction=\"cadastrarcomentario.php\">Inserir Comentario</button></td>
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
												<th width=\"10%\">Data</th>
												<th width=\"10%\" colspan=\"2\">Acompanhamento</th>
												<th width=\"10%\">Autor</th>
											</tr>
										";
										for($i=0;$i<$length;$i++)
										{
											$dateEnd = strpos($arrayComentarios[$i],"#");
											$date = substr($arrayComentarios[$i],0,$dateEnd);
											$coment = substr($arrayComentarios[$i],$dateEnd+1);
											$autorEnd = strpos($coment,"&");
											$commentAutor = substr($coment,0,$autorEnd);
											$coment = substr($coment,$autorEnd+1);

											echo"
													<tr>
														<td width=\"10%\">$date</td>
														<td width=\"80%\" colspan=\"2\">$coment</td>	
														<td width=\"10%\">$commentAutor</td>																	
													</tr>
												";
										} echo "
										
										<tr> 
											<td colspan=\"4\" bgcolor=\"#ccc\">
											</td>
										</tr>
										
										<tr> 
											<td width=\"30%\">
												<strong>Proxima Consulta</strong>
											</td>
											<td width=\"30%\">
												Data: <input type=\"date\" name=\"proximoatendimento\" value = \"$dataDeRetorno\">
											</td>
											<td style=\"vertical-align:middle\" width=\"30%\">
												Hora: <select name=\"proximahora\">
												";
													for($i=8;$i<21;$i++)
													{
														$input = $i.":30";
														if ($i<10)
														{
															echo "<option value=\"$i\">0$i:00</option>";
															echo "<option value=\"$input\">0$input</option>";
														}
														else
														{
															echo "<option value=\"$i\">$i:00</option>";
															echo "<option value=\"$input\">$input</option>";
														}
													}
												echo "
												</select>
											</td>
											<td width=\"15%\">
												<button type=\"submit\" formaction=\"reagendar.php\" class=\"btn btn-primary btn-block\">Reagendar</button>
												<button type=\"submit\" formaction=\"reagendar.php\" class=\"btn btn-primary btn-block\" name=\"cancelar\" value=\"true\">Cancelar</button>
											</td>
										</tr>

										</tbody>
									</table>
	
	<button id=\"id_accordionAssistidos\" class=\"accordion\" onclick=\"return false\">Informações Adicionais</button>
					<div class=\"panel\">
	
				
											<input type=\"hidden\" name=\"index\" value=\"$assistencia\">
											<table class=\"table table-bordered table-hover\">
												<tbody>
												
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
													<td width='70%'><input name=\"endereco\" type=\"text\" size=\"100\" value=\"$endereco\" class=\"invisibox\"></input></td>
												</tr>

												<tr>
													<td width='30%'><strong>CEP</strong></td>
													<td width='70%'><input name=\"cep\" type=\"text\" size=\"100\" value=\"$cep\" class=\"invisibox\"></input></td>
												</tr>

												<tr>
													<td width='30%'><strong>Renda Mensal</strong></td>
													<td width='70%'><input name=\"renda\" type=\"text\" size=\"100\" value=\"$renda\" class=\"invisibox\"></input></td>
												</tr>

												<tr>
													<td width='30%'><strong>Moradia</strong></td>
													<td width='70%'><input name=\"moradia\" type=\"text\" size=\"100\" value=\"$moradia\" class=\"invisibox\"></input></td>
												</tr>

												<tr>
													<td width='30%'><strong>Ocupação</strong></td>
													<td width='70%'><input name=\"ocupacao\" type=\"text\" size=\"100\" value=\"$ocupacao\" class=\"invisibox\"></input></td>
												</tr>

												<tr>
													<td width='30%'><strong>Estado Civil</strong></td>
													<td width='70%'><input name=\"estadocivil\" type=\"text\" size=\"100\" value=\"$estadocivil\" class=\"invisibox\"></input></td>
												</tr>
												
												<tr>
													<td width='30%'><strong>Nome do Beneficiado</strong></td>
													<td width='70%'><input name=\"beneficiado\" type=\"text\" size=\"100\" value=\"$beneficiado\" class=\"invisibox\"></input></td>
												</tr>

												<tr>
													<td width='30%'><strong>Grau de Parentesco</strong></td>
													<td width='70%'><input name=\"parentesco\" type=\"text\" size=\"100\" value=\"$parentesco\" class=\"invisibox\"></input></td>
												</tr>

												<tr>
													<td width='30%' rowspan=\"5\"><strong>Descrição</strong></td>
													<td width='70%' rowspan=\"5\"><textarea name=\"descricao\" cols=\"120\" rows=\"5\" class=\"invisibox\">$descricao</textarea></td>
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
													<td width='70%' colspan=\"2\" align=\"center\"><button type=\"submit\" formaction=\"atualizarinformacao.php\" name=\"editCaso\" value=\"true\">Atualizar Cadastro</button></td>
												</tr>
												
												</tbody>
												</table>
												
												
										</div>

				<button id=\"id_accordionAssistidos\" class=\"accordion\" onclick=\"return false\">Informações do Processo</button>
					<div class=\"panel\">
						<table class=\"table table-bordered table-hover\">
							<tbody>
								<tr>
									<td width='30%'><strong>Número do Processo</strong></td>
									<td width='70%'><input type=\"text\" name=\"editProcesso\" value=\"$processo\"></td>
								</tr>

								<tr>
									<td width='30%'><strong>Ação</strong></td>
									<td width='70%'><input type=\"text\" name=\"editAcao\" value=\"$acao\"></td>
								</tr>
								
								<tr>
									<td width='30%'><strong>Autor</strong></td>
									<td width='70%'><input type=\"text\" name=\"editAutor\" value=\"$autor\"></td>
								</tr>
								
								<tr>
									<td width='30%'><strong>Réu</strong></td>
									<td width='70%'><input type=\"text\" name=\"editReu\" value=\"$reu\"></td>
								</tr>
								
								<tr>
									<td width='30%'><strong>Local</strong></td>
									<td width='70%'><input type=\"text\" name=\"editLocal\" value=\"$local\"></td>
								</tr>
								
								<tr>
									<td colspan=\"2\" align=\"center\"><button type=\"submit\" formaction=\"atualizarinformacao.php\">Atualizar Informação</button></td>
								</tr>
							</tbody>
						</table>
					</div>

							
	
				<button id=\"id_accordionAssistidos\" class=\"accordion\" onclick=\"return false\">Documentos</button>
					<div class=\"panel\">
						<table class=\"table table-bordered table-hover\">
						<tbody>
						<tr align=\"center\">
								<td colspan=\"4\"><strong>Documentos</strong></td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>RG</strong>
								</td>
								<td width=\"70%\" colspan=\"3\">
									<a href=\"$diretorio/RG.pdf\" target=\"_blank\">RG</a><br>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>CPF</strong>
								</td>
								<td width=\"70%\" colspan=\"3\">
									<a href=\"$diretorio/CPF.pdf\" target=\"_blank\">CPF</a><br>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>Comprovante de Renda</strong>
								</td>
								<td width=\"70%\" colspan=\"3\">
									<a href=\"$diretorio/CompRenda.pdf\" target=\"_blank\">Comprovante de Renda</a><br>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>Comprovante de Residencia</strong>
								</td>
								<td width=\"70%\" colspan=\"3\">
									<a href=\"$diretorio/CompResidencia.pdf\" target=\"_blank\">Comprovante de Residecia</a>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>Procuração</strong>
								</td>
								<td width=\"70%\" colspan=\"3\">
									<a href=\"$diretorio/Procuracao.pdf\" target=\"_blank\">Procuracao</a>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>Termo de Compromisso</strong>
								</td>
								<td width=\"70%\" colspan=\"3\">
									<a href=\"$diretorio/Compromisso.pdf\" target=\"_blank\">Termo de Compromisso</a>
								</td>
							</tr>
							";
							
							for($i=0;$i<count($arrayArquivos);$i++)
							{
								$nomeDoArquivo = $assistencia."$".$arrayArquivos[$i].".pdf";
								$displayName = $arrayArquivos[$i];
								//$diretorio = "../uploads/$CPF/";
								
								echo"
										<tr>
											<td><strong>$displayName</strong></td>
											<td colspan=\"2\"><a href=\"$diretorio/$nomeDoArquivo\" target=\"_blank\">$displayName.pdf</a></td>	
											<td>
												<button type=\"submit\" formaction=\"deletefile.php\" name=\"arquivo\" value=\"$diretorio/$nomeDoArquivo#$displayName\">X</button>
											</td>																		
										</tr>
									";
							}
							
							echo "
							</tbody>
						</table>
						";
						
						echo "
					</div>	
				<table class=\"table table-bordered table-hover\">
					<tbody>
						<tr align=\"center\">
							<td colspan=\"5\"><strong>Consulta Processual</strong></td>
						</tr>
						<tr>
				";
				
				
				switch ($area)
				{
					case "TRABALHO": 	
						echo "
							<td width='30%'><strong><a href=\"firefox:https://consultapje.trt1.jus.br/consultaprocessual/pages/consultas/ConsultaProcessual.seam\" target=\"_blank\">Link para PJE</a></strong></td>
							<td width='30%'><strong><a href=\"https://consultapje.trt1.jus.br/consultaprocessual/pages/consultas/ConsultaProcessual.seam\" target=\"_blank\">Link Alternativo</a></strong></td>
						</tr>
						";
						break;
					default:
						echo "
							<td width='30%'><strong><a href=\"http://www4.tjrj.jus.br/ConsultaUnificada/consulta.do#tabs-numero-indice0\" target=\"_blank\">Link para TJRJ</a></strong></td>
							<td width='30%'><strong><a href=\"http://www.stj.jus.br/portal/site/STJ\" target=\"_blank\">Link para STJ</a></strong></td>
							
						</tr>
						";
						
				}
				
				echo "
					</tbody>
				</table>
			";
					
					
						?>