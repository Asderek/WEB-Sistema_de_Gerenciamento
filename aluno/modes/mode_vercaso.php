<?php
							include('../../newconexao.php');
							include('../../injection.php');
							
							$assistencia = $_POST['redirect'];
							$sqlAssistencia = "SELECT * FROM `atendimentos` WHERE `index` = \"$assistencia\"";
							$queryAssistencia = $conexao->query($sqlAssistencia);
							$resultAssistencia = $queryAssistencia->fetchAll( PDO::FETCH_ASSOC );
							if ($queryAssistencia == false)
							{
								echo "Deu pau";
								return ;
							}
							$CPF = $resultAssistencia[0]['cpf'];
							
							echo "<button type=\"submit\" value=\"verassistido$CPF\" name=\"mode\" align=\"right\">Ver Ficha</button>";
							
							if(injection($CPF))
							{
								echo "My code is Sanitized";
								return;
							}
							
							echo "<input type=\"hidden\" name=\"index\" value=$assistencia>";
							echo "<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">";
							
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
							
							/*echo "<h3 align=\"center\">Caso do Assistido</h3>";
							echo "<h4 align=\"center\">descrição - $descricao</h4>";*/
							
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
							
							
		
							echo "
									
								<table class=\"table table-bordered table-hover\">
									<tbody>
										
										<tr bgcolor = \"#A0A0A0\" align=\"center\">
												<td colspan= \"3\"><strong>Relatório de Atendimento</td>
											</tr>
											
											<tr>
												<th width=\"10%\">Data</th>
												<th width=\"90%\" colspan=\"2\">Acompanhamento</th>
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
														<td width=\"90%\" colspan=\"2\">$coment</td>																		
													</tr>
												";
										} echo "
										
											<tr>
												<td width='30%' rowspan=\"5\"><strong>Relatório</strong></td>
												<td width='70%' rowspan=\"5\" colspan=\"2\"><textarea name=\"comment\" cols=\"40\" rows=\"5\"></textarea></td>
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
												<td colspan=\"3\">
													<!--<button name=\"assistencia\" value=\"cria\" formaction=\"processaratendimento.php\">Cadastrar Processo</button>-->
													<button name=\"comentar\" value=\"comentario\" formaction=\"cadastrarcomentario.php\">Inserir Comentario</button>
													<br>
													Um atendimento será cadastrado automaticamente.
												</td>
											</tr>
											
											<tr> 
												<td colspan=\"3\" bgcolor=\"#000000\">
												</td>
											</tr>
											<tr> 
											<td width=\"30%\">
												<strong>Inserir Documento</strong>
											</td>
											<td width=\"70%\" colspan=\"2\">
												<input type=\"text\" name=\"nomearquivo\" placeholder=\"Nome do Arquivo\" onkeyup=\"checkArquivoRepetido()\" id=\"id_fileName\">
												<input type=\"submit\" formaction=\"enviararquivo.php\" id=\"id_botaoEnviar\"><br><p id=\"id_alert\" style=\"visibility:hidden\">Já existe um arquivo com esse nome</p>
												<input type=\"file\" name=\"documento\" accept=\".pdf\">
											</td>
										</tr>
										
										<tr> 
											<td colspan=\"3\" bgcolor=\"#000000\">
											</td>
										</tr>
										
										<tr> 
											<td width=\"30%\">
												<strong>Proxima Consulta</strong>
											</td>
											<td width=\"30%\">
												<input type=\"date\" name=\"proximoatendimento\" value = \"$dataDeRetorno\">
											</td>
											<td width=\"15%\">
												<button type=\"submit\" formaction=\"reagendar.php\" >Reagendar</button>
												<button>Ausente</button>
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
													<td width='30%'><strong>Autor</strong></td>
													<td width='70%'><input type=\"text\" name=\"editAutor\" value=\"$autor\"></td>
												</tr>
												
												<tr>
													<td width='30%'><strong>Réu</strong></td>
													<td width='70%'><input type=\"text\" name=\"editReu\" value=\"$reu\"></td>
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
									<a href=\"../uploads/$CPF/RG.pdf\">RG</a><br>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>CPF</strong>
								</td>
								<td width=\"70%\" colspan=\"3\">
									<a href=\"../uploads/$CPF/CPF.pdf\">CPF</a><br>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>Comprovante de Renda</strong>
								</td>
								<td width=\"70%\" colspan=\"3\">
									<a href=\"../uploads/$CPF/CompRenda.pdf\">Comprovante de Renda</a><br>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>Comprovante de Residencia</strong>
								</td>
								<td width=\"70%\" colspan=\"3\">
									<a href=\"../uploads/$CPF/CompResidencia.pdf\">Comprovante de Residecia</a>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>Procuração</strong>
								</td>
								<td width=\"70%\" colspan=\"3\">
									<a href=\"../uploads/$CPF/Procuracao.pdf\">Procuracao</a>
								</td>
							</tr>
							
							<tr> 
								<td width=\"30%\">
									<strong>Termo de Compromisso</strong>
								</td>
								<td width=\"70%\" colspan=\"3\">
									<a href=\"../uploads/$CPF/Compromisso.pdf\">Termo de Compromisso</a>
								</td>
							</tr>
							";
							
							for($i=0;$i<count($arrayArquivos);$i++)
							{
								$nomeDoArquivo = $assistencia."$".$arrayArquivos[$i].".pdf";
								$displayName = $arrayArquivos[$i];
								$diretorio = "../uploads/$CPF/";
								
								echo"
										<tr>
											<td><strong>$displayName</strong></td>
											<td colspan=\"3\"><a href=\"$diretorio/$nomeDoArquivo\">$displayName.pdf</a></td>																		
										</tr>
									";
							}
							
							echo "
							</tbody>
						</table>
						
					</div>
					
					
						";	
						?>
						