<?php
								$DiasSelecionados = array();
								$startSelecionados = array();
								$endSelecionados = array();
							
								$matriculaInscrito = $_POST['matricula'];
								//echo '<input type="hidden" name="matricula" value='.$matriculaInscrito.'></input>';								
								
								for($dia=2;$dia<7;$dia++)
								{
									for($hora=7;$hora<22;$hora++)
									{
										$end = $hora+1;
										if (isset($_POST[$dia.'-'.$hora.'-'.$end]))
										{
												array_push($DiasSelecionados, $dia);
												array_push($startSelecionados, $hora);
												array_push($endSelecionados, $end);
										}
									}
								}
								
								
								
								for($i=0;$i<count($DiasSelecionados)-1;$i++)
								{
									
									if($DiasSelecionados[$i] == $DiasSelecionados[$i+1])
									{
										if($startSelecionados[$i+1] == $endSelecionados[$i])
										{
											
											$endSelecionados[$i] = $endSelecionados[$i+1];
											array_splice($DiasSelecionados,$i+1,1);
											array_splice($startSelecionados,$i+1,1);
											array_splice($endSelecionados,$i+1,1);
											
											$i=-1;
										}
									}
									
								}
													
								if (count($DiasSelecionados)>3)
								{
									echo '<h5 class="text-center">Por favor, escolha apenas 2 dias</h5><p></p>';
									echo "
											<div class=\"form-group\">
												<button type=\"submit\" name=\"mode\" value=\"escolherplantao\" class=\"btn btn-primary btn-lg btn-block\">Voltar</button>
											</div>";
								}else if (count($DiasSelecionados)<=0)
								{
									echo '<h5 class="text-center">Por favor, escolha pelo menos 1 dia</h5><p></p>';
									echo "
											<div class=\"form-group\">
												<button type=\"submit\" name=\"mode\" value=\"escolherplantao\" class=\"btn btn-primary btn-lg btn-block\">Voltar</button>
											</div>";
								}else
								{
									for($i=0;$i<count($DiasSelecionados);$i++)
									{
										$dia = $i+1;
										$str = "UPDATE `horariosplantao` SET `dia$dia`=$DiasSelecionados[$i],`ini$dia`=$startSelecionados[$i],`fim$dia`=$endSelecionados[$i], `atendimento$dia`=$startSelecionados[$i], `alunos$dia`=10, `assistidos$dia`=9  WHERE `matricula` = \"$matriculaInscrito\"";									
										
										$sqlUpdate = $str;
										$queryUpdate = $conexao->query($sqlUpdate);
										//$ret[$i] = mysql_query($sqlUpdate,$conexao);
										
									}
									
									while($i<3)
									{
										$dia = $i+1;
										$str = "UPDATE `horariosplantao` SET `dia$dia`=0,`ini$dia`=0,`fim$dia`=0 WHERE (`matricula` = $matriculaInscrito AND `area` = '$area')";									
										
										$sqlUpdate = $str;
										$queryUpdate = $conexao->query($sqlUpdate);
										//$ret[$i] = mysql_query($sqlUpdate,$conexao);
										$i++;
										
									}
									
									
									echo "<h4 class=\"text-center\">Cadastro de Plantao<br></h4><h5 class=\"text-center\">Passo 2/2<br></h5>";
									echo "<h3 align=\"center\">Por favor confirme sua Solicitação e,<br> em seguida, preencha os campos abaixo</h3><br><br>";
									echo '<table class="table table-bordered table-hover">';
									
									for($i=0;$i<count($DiasSelecionados);$i++)
									{
										echo '<tr><td align ="center"><b>';
										switch ($DiasSelecionados[$i])
										{
											case 2:
												echo "Segunda";
											break;
											case 3:
												echo "Terça";
											break;
											case 4:
												echo "Quarta";
											break;
											case 5:
												echo "Quinta";
											break;
											case 6:
												echo "Sexta";
											break;
											
										}
										echo '</b></td>';
										
										echo '<td align ="center"><b>';
										if($startSelecionados[$i]<10)
											echo '0';
										echo $startSelecionados[$i].":00 - ";
										if ($endSelecionados[$i]<10)
											echo '0';
										echo $endSelecionados[$i].":00";
										echo '</b></td>';
										
										
										echo '</tr>';
									}
									echo "<tr>
												<td align =\"center\" colspan=\"2\"><button type=\"submit\" name=\"mode\" value=\"escolherplantao\" class=\"btn btn-primary btn-lg btn-block\">Mudar Horário</button></td>
											</tr>";
									echo '</table><br><br>';
									
								
										echo '<br><table class="table table-bordered table-hover">';
											echo "<tr>";
												echo "<td align=\"center\"><strong>";
													echo "Dia";
												echo "</strong></td>";
												echo "<td align=\"center\"><strong>";
													echo "Primeiro Atendimento";
												echo "</strong></td>";
												echo "<td align=\"center\"><strong>";
													echo "Qtd Max de Atendimentos";
												echo "</strong></td>";
												echo "<td align=\"center\"><strong>";
													echo "Qtd Max de Alunos por Plantão";
												echo "</strong></td>";
											echo "</tr>";
											echo "<tr><td> </td><td> </td></tr>";
											
											
											
											
											for($i=0;$i<count($DiasSelecionados);$i++)
											{
												$startAtual = $startSelecionados[$i];
												$endAtual = $endSelecionados[$i];
												
												echo "<tr>";
													echo "<td align=\"center\"><strong>";
														switch ($DiasSelecionados[$i])
														{
															case 2:
																$input = "Segunda";
																break;
															case 3:
																$input = "Terça";
																break;
															case 4:
																$input = "Quarta";
																break;
															case 5:
																$input = "Quinta";
																break;
															case 6:
																$input = "Sexta";
																break;
														}
														echo "$input";
													echo "</td>";
													echo "<td  align=\"center\"><strong>";
														echo "<select align=\"center\" name=\"primeiroAtendimento$i\">";
														for($hora=7;$hora<23;$hora++)
														{
															if ($hora>=$startAtual && $hora<$endAtual)
															{
																echo "<option value=\"$hora\">$hora</option>";
															}
														}																
														echo "
															</select>";
													echo "</td>";
													echo "<td  align=\"center\"><strong>";
														echo "<select align=\"center\" name=\"qtdAtendimento$i\">";
														for($qtd=1;$qtd<10;$qtd++)
														{
																echo "<option value=\"$qtd\">$qtd</option>";
														}
														echo "</select>";
													echo "</td>";
													echo "<td  align=\"center\"><strong>";
														echo "<select align=\"center\" name=\"qtdAlunos$i\">";
														for($qtd=5;$qtd<27;$qtd+=5)
														{
																echo "<option value=\"$qtd\">$qtd</option>";
														}
														echo "</select>";
													echo "</td>";
													
												echo "</tr>";
												
												
											}
											
											echo "
												<tr>
													<td colspan=\"4\" align =\"center\"><button type=\"submit\" formaction=\"cadastraratendimento.php\" class=\"btn btn-primary btn-lg btn-block\">Finalizar Cadastro de Plantão</button></td>
												</tr>";
										echo "</table>";
									
									
									
								}
								
							?>