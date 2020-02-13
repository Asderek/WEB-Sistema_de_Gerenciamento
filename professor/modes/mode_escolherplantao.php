<?php
									
									$sqlProfessor = "SELECT * FROM professores WHERE matricula = $matricula";
									$queryProfessor = $conexao->query($sqlProfessor);
									$rowsProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
									
									
									$display = true;
									$ConflitoProfessor = array();
									
									$area = $rowsProfessor[0]['area'];
									$name = $rowsProfessor[0]['nome'];
								
									
									echo "<h4 class=\"text-center\">Cadastro de Plantao<br></h4><h5 class=\"text-center\">Passo 1/2<br></h5>";
									if(count($rowsProfessor) <= 0)
									{
										echo '<h5 class="text-center">Professor não está cadastrado no EMA</h5>';
										echo '<br>';
										echo '<a href="inicio.html" class="btn btn-primary btn-lg btn-block">página inicial</a>';
									}
									else
									{
										//echo "<form action='confirmacao.php' method='post' enctype='multipart/form-data'>";
										
										//echo '<input type="hidden" name="matricula" value='.$matricula.'></input>';
										echo '<input type="hidden" name="area" value='.$area.'></input>';
										
										$sqlDiasEscolhidos = "SELECT * FROM horariosplantao WHERE matricula = $matricula";
										$queryDiasEscolhidos = $conexao->query($sqlDiasEscolhidos);
										$rowsDiasEscolhidos = $queryDiasEscolhidos->fetchAll( PDO::FETCH_ASSOC );
										
										/*$queryDiasEscolhidos = mysql_query($sqlDiasEscolhidos,$conexao);
										if($queryDiasEscolhidos == true)
										{
											$rowsDiasEscolhidos = mysql_num_rows($queryDiasEscolhidos);
										}*/
										
										if(count($rowsDiasEscolhidos) > 0)
										{
											$diaEscolhido1 = $abrProfessor = $rowsDiasEscolhidos[0]['dia1'];
											$startEscolhido1 = $abrProfessor = $rowsDiasEscolhidos[0]['ini1'];
											$endEscolhido1 = $abrProfessor = $rowsDiasEscolhidos[0]['fim1'];
											
											$diaEscolhido2 = $abrProfessor = $rowsDiasEscolhidos[0]['dia2'];
											$startEscolhido2 = $abrProfessor = $rowsDiasEscolhidos[0]['ini2'];
											$endEscolhido2 = $abrProfessor = $rowsDiasEscolhidos[0]['fim2'];
											
											$diaEscolhido3 = $abrProfessor = $rowsDiasEscolhidos[0]['dia3'];
											$startEscolhido3 = $abrProfessor = $rowsDiasEscolhidos[0]['ini3'];
											$endEscolhido3 = $abrProfessor = $rowsDiasEscolhidos[0]['fim3'];
												
											/*$diaEscolhido1 = $abrProfessor = mysql_result($queryDiasEscolhidos,0,'dia1');
											$startEscolhido1 = $abrProfessor = mysql_result($queryDiasEscolhidos,0,'ini1');
											$endEscolhido1 = $abrProfessor = mysql_result($queryDiasEscolhidos,0,'fim1');
											
											$diaEscolhido2 = $abrProfessor = mysql_result($queryDiasEscolhidos,0,'dia2');
											$startEscolhido2 = $abrProfessor = mysql_result($queryDiasEscolhidos,0,'ini2');
											$endEscolhido2 = $abrProfessor = mysql_result($queryDiasEscolhidos,0,'fim2');
											
											$diaEscolhido3 = $abrProfessor = mysql_result($queryDiasEscolhidos,0,'dia3');
											$startEscolhido3 = $abrProfessor = mysql_result($queryDiasEscolhidos,0,'ini3');
											$endEscolhido3 = $abrProfessor = mysql_result($queryDiasEscolhidos,0,'fim3');*/
										}else
										{
											echo "Professor não cadastrado no EMA<br>";
										}
										
										echo '
										<table style="width:100%">
											<tr>
												<td align ="center"><b>Horario</b></td>
												<td align ="center"><b>Segunda</b></td>
												<td align ="center"><b>Terça</b></td> 
												<td align ="center"><b>Quarta</b></td>
												<td align ="center"><b>Quinta</b></td> 
												<td align ="center"><b>Sexta</b></td>
											</tr>';
								
										
										
										for($hora = 8;$hora<21;$hora++)
										{
											$display = true;
											$aula = false;
											$end = $hora+1; 
											if($hora % 2 == 0)
												echo '<tr bgcolor="#DDDDDD">';
											else
												echo '<tr>';
											echo '<td align="center"><label for="nome">'.$hora.':00-'.$end.':00</label></td>';
											
											for($dia=2;$dia<7;$dia++)
											{
												$numConflitos = 0;
												$numArea = 0;
												$ConflitoProfessor = array();
												$display = true;
												
												$sqlDia = "SELECT * FROM horariosplantao WHERE (dia1 = $dia OR dia2 = $dia OR dia3 = $dia)";
												$queryDia = $conexao->query($sqlDia);
												$rowsDia = $queryDia->fetchAll( PDO::FETCH_ASSOC );
												//$queryDia = mysql_query($sqlDia,$conexao);
												
												
												
												
												if(count($rowsDia) < 0)
												{
														return;
												}
												for($x = 0;$x<count($rowsDia);$x++)
												{
													if ($dia == $rowsDia[$x]['dia1'])
													{
														if ($hora <= $rowsDia[$x]['ini1'])
														{
															if ($end > $rowsDia[$x]['ini1'])
															{
																$numConflitos++;
																if ($area == $rowsDia[$x]['area'])
																{
																	$nome = $rowsDia[$x]['nome'];
																	if(strtolower($name) != strtolower($nome))
																	{
																		$abrProfessor = $rowsDia[$x]['abr'];
																		array_push($ConflitoProfessor, $abrProfessor);
																		$numArea++;
																	}
																	else
																	{
																		$numConflitos--;
																	}
																}
															}//else nao importa
														}
														else
														{
															if ($hora < $rowsDia[$x]['fim1'])
															{
																$numConflitos++;
																if ($area == $rowsDia[$x]['area'])
																{
																	$nome = $rowsDia[$x]['nome'];
																	if(strtolower($name) != strtolower($nome))
																	{
																		$abrProfessor = $rowsDia[$x]['abr'];
																		array_push($ConflitoProfessor, $abrProfessor);
																		$numArea++;
																	}
																	else
																	{
																		$numConflitos--;
																	}
																}
															}//else nao importa	
														}
													}
													else if ($dia == $rowsDia[$x]['dia2'])
													{
														if ($hora <= $rowsDia[$x]['ini2'])
														{
															if ($end > $rowsDia[$x]['ini2'])
															{
																$numConflitos++;
																if ($area == $rowsDia[$x]['area'])
																{
																	$nome = $rowsDia[$x]['nome'];
																	if(strtolower($name) != strtolower($nome))
																	{
																		$abrProfessor = $rowsDia[$x]['abr'];
																		array_push($ConflitoProfessor, $abrProfessor);
																		$numArea++;
																	}
																	else
																	{
																		$numConflitos--;
																	}
																}
															}//else nao importa
														}
														else
														{
															if ($hora < $rowsDia[$x]['fim2'])
															{
																$numConflitos++;
																if ($area == $rowsDia[$x]['area'])
																{
																	$nome = $rowsDia[$x]['nome'];
																	if(strtolower($name) != strtolower($nome))
																	{
																		$abrProfessor = $rowsDia[$x]['abr'];
																		array_push($ConflitoProfessor, $abrProfessor);
																		$numArea++;
																	}
																	else
																	{
																		$numConflitos--;
																	}
																}
															}//else nao importa	
														}
													}
													else if ($dia == $rowsDia[$x]['dia3'])
													{
														if ($hora <= $rowsDia[$x]['ini3'])
														{
															if ($end > $rowsDia[$x]['ini3'])
															{
																$numConflitos++;
																if ($area == $rowsDia[$x]['area'])
																{
																	$nome = $rowsDia[$x]['nome'];
																	if(strtolower($name) != strtolower($nome))
																	{
																		$abrProfessor = $rowsDia[$x]['abr'];
																		array_push($ConflitoProfessor, $abrProfessor);
																		$numArea++;
																	}
																	else
																	{
																		$numConflitos--;
																	}
																}
															}//else nao importa
														}
														else
														{
															if ($hora < $rowsDia[$x]['fim3'])
															{
																$numConflitos++;
																if ($area == $rowsDia[$x]['area'])
																{
																	$nome = $rowsDia[$x]['nome'];
																	if(strtolower($name) != strtolower($nome))
																	{
																		$abrProfessor = $rowsDia[$x]['abr'];
																		array_push($ConflitoProfessor, $abrProfessor);
																		$numArea++;
																	}
																	else
																	{
																		$numConflitos--;
																	}
																}
															}//else nao importa	
														}
													}
													 
													if($numConflitos >= 5 || $numArea >= 1)
													{
														$display = false;
													}
													
												}
												
												{//Horario Bloqueado pela Secretaria
													$sqlBloqueio = "SELECT * FROM `NPJ_bloqueioPlantoes` WHERE `matricula` = $matricula";
													$queryBloqueio = $conexao->query($sqlBloqueio);
													$resultBloqueio = $queryBloqueio->fetchAll(PDO::FETCH_ASSOC);
													for($i=0;$i<count($resultBloqueio);$i++)
													{
														if ($dia == $resultBloqueio[$i]['dia'] && $hora == $resultBloqueio[$i]['hora'])
														{
															$display = false;
															$aula = true;
														}
													}
													
												}
												/*{//Horario do professor no direito
													$sqlNomeDireito = "SELECT * FROM `DIR_emailProfessores` WHERE `matricula` = \"$matricula\"";
													$queryNomeDireito = $conexao->query($sqlNomeDireito);
													$resultNomeDireito = $queryNomeDireito->fetchAll(PDO::FETCH_ASSOC);
													$nome = $resultNomeDireito[0]['nome'];
													
													$sqlAulas = "SELECT * FROM `sistemaDireito` WHERE `professor` = \"$nome\"";
													$queryAulas = $conexao->query($sqlAulas);
													if ($queryAulas != false)
													{
														$arrayDiasDireito = ["a","b","segunda","terca","quarta","quinta","sexta","sabado"];
														$auxDia = $arrayDiasDireito[$dia];
														$resultAulas = $queryAulas->fetchAll(PDO::FETCH_ASSOC);
														
														for($i=0;$i<count($resultAulas);$i++)
														{
															
															$dia1 = $resultAulas[$i]['dia1'];
															$horario1 = $resultAulas[$i]['horario1'];
															$start1 = substr($horario1,0,2);
															$end1 = substr($horario1,3);
															$dia2 = $resultAulas[$i]['dia2'];
															$horario2 = $resultAulas[$i]['horario2'];
															$start2 = substr($horario2,0,2);
															$end2 = substr($horario2,3);
															$dia3 = $resultAulas[$i]['dia3'];
															$horario3 = $resultAulas[$i]['horario3'];
															$start3 = substr($horario3,0,2);
															$end3 = substr($horario3,3);
															
															for($k=$start1;$k<$end1;$k++)
															{
																if ($dia1 == $auxDia && $hora == $k)
																{
																	$display = false;
																	$aula = true;
																}
															}
															for($k=$start2;$k<$end2;$k++)
															{
																if ($dia2 == $auxDia && $hora == $k)
																{
																	$display = false;
																	$aula = true;
																}
															}
															for($k=$start3;$k<$end3;$k++)
															{
																if ($dia3 == $auxDia && $hora == $k)
																{
																	$display = false;
																	$aula = true;
																}
															}
															
														}
													}
												}*/
												
												if($display==false)
												{
													if($numArea >= 1)
													{	
														echo '<td align="center"><label for="Lotado">';
														for($i=0;$i<count($ConflitoProfessor);$i++ )
														{
															echo '<font color="FF0000">';
															echo $ConflitoProfessor[$i];
															echo '</font>';
															echo '<br>';
														}
														echo '</label></td>';
													}
													else if($numConflitos >=5)
													{
														echo '<td align="center"><label for="Lotado">LOTADO</label></td>';
													}
													else if ($aula == true)
													{
														echo '<td align="center"><label for="Lotado"><font color="50C050">AULA<font color="FF0000"></label></td>';
													}
												}
												else
												{
													if($dia == $diaEscolhido1 && ($hora >= $startEscolhido1 && $hora < $endEscolhido1))
													{
														echo '<td align="center"><input type="checkbox" name="'.$dia.'-'.$hora.'-'.$end.'" "'.$hora.'-'.$end.' checked="checked""></td>';
													}else if ($dia == $diaEscolhido2 && ($hora >= $startEscolhido2 && $hora < $endEscolhido2))
													{
														echo '<td align="center"><input type="checkbox" name="'.$dia.'-'.$hora.'-'.$end.'" "'.$hora.'-'.$end.' checked="checked""></td>';
													}else if ($dia == $diaEscolhido3 && ($hora >= $startEscolhido3 && $hora < $endEscolhido3))
													{
														echo '<td align="center"><input type="checkbox" name="'.$dia.'-'.$hora.'-'.$end.'" "'.$hora.'-'.$end.' checked="checked""></td>';
													}else
													{
														echo '<td align="center"><input type="checkbox" name="'.$dia.'-'.$hora.'-'.$end.'" "'.$hora.'-'.$end.'"></td>';
													}
												}
												
											}
											echo '</tr>';
											
											
										}
										
										echo '</table><br><br>';
										echo '
											<div class="form-group">
												<button type="submit" name="mode" value="registrarplantao" class="btn btn-primary btn-lg btn-block">Ir para Passo 2 &rarr;</button>
											</div>';
										
										echo '<h5 class="text-left"><b><br><br>LOTADO - Não há mais espaço para plantão neste horário.</b></h5>';
										echo '<h5 class="text-left"><b>"<font color="FF0000">NOME</font>" - Indica que outro professor da sua area já está alocado neste horário.</b></h5>';
							
							
									}
									
									
								?>
							