<?php
								include('../../professores.php');
								include('newconexao.php');
								$matriculaAluno = $_POST['matriculaAluno'];
								$matricula = $_POST['matricula'];
								
								$name = PROFESSORES_GETNAME($matricula);
								
								
								$sqlFind = "SELECT * FROM `inscritosmonitoria` WHERE `professor` LIKE '%$name%' AND `matricula` = $matriculaAluno";
								$queryFind = $conexao->query($sqlFind);
								$resultFind = $queryFind->fetchAll( PDO::FETCH_ASSOC );
								$rowsFind = count($resultFind);
									
	  
								if($rowsFind > 0)
								{
									
										for($index =0;$index<$rowsFind;$index++)
										{
											$nome = $resultFind[$index]['nome'];
											$area = $resultFind[$index]['professor'];
											$matricula = $resultFind[$index]['matricula'];
											$formatura = $resultFind[$index]['formatura'];
											$oab = $resultFind[$index]['oab'];
											$email = $resultFind[$index]['email'];
											$tel = $resultFind[$index]['tel'];
											
											
											
											$area = strrchr($area,"-");
											$area = substr($area,2);
											
											$apresentacao = $resultFind[$index]['apresentacao'];
											$razao = $resultFind[$index]['razao'];
											$exp = $resultFind[$index]['exp'];
												
											echo '
													<form action="enviaremail.php" method="post">';
													
											echo "		
													
													<input type=\"hidden\" value=\"$email\" name=\"email\">
													<input type=\"hidden\" value=\"$matricula\" name=\"professor\">
													<input type=\"hidden\" value=\"$matriculaAluno\" name=\"aluno\">
													<input type=\"hidden\" value=\"$name\" name=\"nome\">
													
													<table class=\"table table-bordered table-hover\">
														<tbody>";
											echo "
															<tr>
															<td width='40%'><strong>Matricula</strong></td>
															<td width='60%'>$matricula</td>
															</tr>
															";
															
											echo "
															<tr>
															<td width='40%'><strong>Nome</strong></td>
															<td width='60%'>$nome</td>
															</tr>
															";
															
											echo "
															<tr>
															<td width='40%'><strong>Area</strong></td>
															<td width='60%'>$area</td>
															</tr>
															";
										
											echo "
															<tr>
																<td width='40%'><strong>Previsão de Formatura</strong></td>
																<td width='60%'>$formatura</td>
															</tr>
															";
											echo "
															<tr>
																<td width='40%'><strong>OAB</strong></td>
																<td width='60%'>"; 
																
																if($oab == 1) 
																	echo "SIM"; 
																else 
																	echo "NÃO";
															
																echo "</td>
															</tr>
															";
										
											echo "
															<tr>
																<td width='40%'><strong>E-Mail</strong></td>
																<td width='60%'>$email</td>
															</tr>
															";
										
											echo "
															<tr>
																<td width='40%'><strong>Telefone</strong></td>
																<td width='60%'>$tel</td>
															</tr>
															";
										
											echo "
															<tr>
																<td width='40%'><strong>Apresentacao</strong></td>
																<td width='60%'>$apresentacao</td>
															</tr>
															";
										
											echo "
															<tr>
																<td width='40%'><strong>Razao de Inscrição na Monitoria</strong></td>
																<td width='60%'>$razao</td>
															</tr>
															";
										
											echo "
															<tr>
																<td width='40%'><strong>Experiencia Profissional</strong></td>
																<td width='60%'>$exp</td>
															</tr>
															";
										
											echo "
															<tr align=\"center\">
																<td colspan=\"2\">	
																
																	<button name=\"escolha\" type=\"submit\" value=\"marcar\" style=\"float: left;\" class=\"btn btn-primary btn-lg\" onclick=\"return confirm('Essa ação enviará um email para a secretaria solicitando o agendamento de uma entrevista. Deseja continuar?');\">Marcar entrevista</button>						
																	<button name=\"escolha\" type=\"submit\" value=\"selecionar\" style=\"float: right;\" class=\"btn btn-primary btn-lg\" onclick=\"return confirm('Essa ação enviará um email para o candidato confirmando sua aceitação para a vaga de monitoria. Deseja continuar?');\">Selecionar</button>
																</td>														
															</tr>
															";
															
											echo "
															<tr align=\"center\">
																<td colspan=\"2\">	
																	<a href=\"javascript:history.go(-1)\" class=\"btn btn-primary btn-lg btn-block\">Voltar</a>
																</td>														
															</tr>
															";
										
															
											echo' 		</tbody>
														</table>
														
														</form>';
										}
									}
								
									
								
								
							?>