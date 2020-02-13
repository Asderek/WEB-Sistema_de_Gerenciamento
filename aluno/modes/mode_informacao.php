<?php
						include('../../newconexao.php');
						
						/*if(is_null($_POST['matricula']));
						{
							$mat = $_POST['matricula'];
							echo "mat = $mat<br>";
							echo "Deu Pau";
							return;
						}*/
						
						$matricula = $_POST['matricula'];
						
						$sqlMatricula = "SELECT * FROM `alunos` WHERE matricula = $matricula";
						$queryMatricula = $conexao->query($sqlMatricula);
						if ($queryMatricula == false)
						{
							echo "Matricula Incorreta tente novamente<br>";
							return;
						}
						$resultMatricula = $queryMatricula->fetchAll( PDO::FETCH_ASSOC );
						$rowsMatricula = count($resultMatricula);
						echo "<input type='hidden' name='matricula' value='$matricula'/>";	

						if($rowsMatricula<0)
						{
							echo "Matricula nao encontrada somehow wtf??";
						}
						
						$nome = $resultMatricula[0]['nome'];
						$disciplina = $resultMatricula[0]['disciplina'];
						$professor = $resultMatricula[0]['professor'];
						$turma = $resultMatricula[0]['turma'];
						$oab = $resultMatricula[0]['oab'];
						$oficina = $resultMatricula[0]['oficina'];
						$tel = $resultMatricula[0]['telefone'];
						$email = $resultMatricula[0]['email'];
						
						$exclamacaoTel = "";
						if ($tel == "---" || $tel == "xxx" || $tel == "")
							$exclamacaoTel = "<label style=\"color:#DD0000\">&#9888; Atualize seu cadastro</label>";
						
						$exclamacaoEmail = "";
						if ($email == "---" || $email == "xxx" || $email == "")
							$exclamacaoEmail = "<label style=\"color:#DD0000\">&#9888; Atualize seu cadastro</label>";
						
						
						
						$primeiraFase = $resultMatricula[0]['primfase'];
						
						$L1 = $resultMatricula[0]['l1'];
						if($L1 < 0)
							$L1 = "Ainda não possui";
						else
							$L1 = number_format($L1,2);
						
						$pas1 = $resultMatricula[0]['passado1'];
						$pas2 = $resultMatricula[0]['passado2'];
						$atu1 = $resultMatricula[0]['atual1'];
						$atu2 = $resultMatricula[0]['atual2'];
						
						$horas = 0;
						$sqlHoras = "SELECT * FROM `atividades` WHERE `matricula` = $matricula AND `pendente` = 0";
						$queryHoras = $conexao->query($sqlHoras);
						if ($queryHoras != false)
						{
							$ano = date('Y');
							$mes = date('n');
							if (intval($mes) < 8)
							{
								$strInicio = "$ano-01-01";
								$strFim = "$ano-07-31";
							}
							else
							{
								$strInicio = "$ano-08-01";
								$strFim = "$ano-12-31";
							}
							
							$dataInicio = new DateTime($strInicio);
							$dataFim = new DateTime($strFim);
							$dataFim->setTime(23,59);
							
							//echo "sqlHoras = $sqlHoras<br>";
							$resultHoras = $queryHoras->fetchAll(PDO::FETCH_ASSOC);
							for($i=0;$i<count($resultHoras);$i++)
							{
								try {
									$dataAtv = new DateTime($resultHoras[$i]['dataAtv']);
								} catch (Exception $e) {
									echo "A atividade [". $resultHoras[$i]['descricao'] . "] foi cadastrada de forma errada. Contate a informatica para rever as informações<br>".$e->getMessage()."<br><br>";
									continue;
								}
									
								if ($dataFim < $dataAtv)
									continue;
								if ($dataInicio > $dataAtv)
									continue;
								
								$horas += $resultHoras[$i]['horas']; 
							}
						}
						
						switch($pas1)
						{
							case -1:
								$pas1 = "Inscrito";
								break;
							case -2:
								$pas1 = "Em Processamento";
								break;
							case -3:
								$pas1 = "Não Realizou";
								break;
						}
						switch($pas2)
						{
							case -1:
								$pas2 = "Inscrito";
								break;
							case -2:
								$pas2 = "Em Processamento";
								break;
							case -3:
								$pas2 = "Não Realizou";
								break;
						}
						switch($atu1)
						{
							case -1:
								$atu1 = "Inscrito";
								break;
							case -2:
								$atu1 = "Em Processamento";
								break;
							case -3:
								$atu1 = "Não Realizou";
								break;
						}
						switch($atu2)
						{
							case -1:
								$atu2 = "Inscrito";
								break;
							case -2:
								$atu2 = "Em Processamento";
								break;
							case -3:
								$atu2 = "Não Realizou";
								break;
						}	
						
						{// SQL PLANTAO
							include ('../utils/professores.php');
							$plantao = PROFESSORES_GETPROFESSORPLANTAONAME($matricula);
							/*
							$plantao = "asd";
							$sqlAbr = "SELECT * FROM `alunosplantao` WHERE `matricula` = $matricula";
							$queryAbr = $conexao->query($sqlAbr);
							if ($queryAbr != false)
							{
								$resultAbr = $queryAbr->fetchAll( PDO::FETCH_ASSOC );
								$abr = $resultAbr[0]['professor'];
								
								$sqlNome = "SELECT * FROM `horariosplantao` WHERE `abr` = \"$abr\"";
								$queryNome = $conexao->query($sqlNome);
								if ($queryNome != false)
								{
									$resultNome = $queryNome->fetchAll(PDO::FETCH_ASSOC);
									$plantao = $resultNome[0]['nome'];
								}
							}*/
						}
						
						
						echo "
								<table class=\"table table-bordered table-hover\">
								
									<tr style=\"background-color: #AAAAAA\">
										<td colspan=\"3\"> </td>
									</tr>
									<tr>
										<td align=\"center\"><strong>Matricula</strong></td>
										<td colspan=\"2\">$matricula</td>
									</tr>
									
									<tr>
										<td align=\"center\"><strong>Nome</strong></td>
										<td colspan=\"2\">$nome</td>
									</tr>
									
									<tr>
										<td align=\"center\"><strong>Disciplina</strong></td>
										<td colspan=\"2\">$disciplina</td>
									</tr>
									
									<tr>
										<td align=\"center\"><strong>Turma</strong></td>
										<td colspan=\"2\">$turma</td>
									</tr>
									
									<tr>
										<td align=\"center\"><strong>Professor</strong></td>
										<td colspan=\"2\">$professor</td>
									</tr>
									
									<tr>
										<td align=\"center\"><strong>Professor Plantao</strong></td>
										<td colspan=\"2\">$plantao</td>
									</tr>
									
									<tr>
										<td align=\"center\"><strong>Telefone</strong></td>
										<td colspan=\"2\">";
											if ($tel == "---" || $tel == "xxx" || $tel == "")
												echo "<input type=\"text\" name=\"tel\" value=\"$tel\" size='40'> $exclamacaoTel";
											else
												echo "<input type=\"text\" name=\"tel\" value=\"$tel\" size='40'>";
										echo "</td>
									</tr>
									
									<tr>
										<td align=\"center\"><strong>Email</strong></td>
										<td colspan=\"2\">";
											if ($email == "---" || $email == "xxx" || $email == "")
												echo "<input type=\"text\" name=\"email\" value=\"$email\" size='40'> $exclamacaoEmail";
											else
												echo "<input type=\"text\" name=\"email\" value=\"$email\" size='40'>";
										echo "</td>
									</tr>
									
									<tr style=\"background-color: #AAAAAA\">
										<td colspan=\"3\"> </td>
									</tr>
									<tr>
										<td align=\"center\" colspan=\"3\"><strong>HORAS EMA ACEITAS: $horas</strong></td>
										<!--<td colspan=\"2\" align=\"center\">$horas</td>-->
									</tr>
									<tr style=\"background-color: #AAAAAA\">
										<td colspan=\"3\"> </td>
									</tr>
									<!--<tr>
										<td colspan=\"3\" align=\"center\"><b>OAB</b></td>
									</tr>-->
									
									<tr>
										<td align=\"center\"><strong> Oficina </strong></td> <td align=\"center\"><strong> Primeira Fase OAB</strong></td> <td align=\"center\"><strong> Segunda Fase OAB</strong></td> 
									</tr>
									<tr>
										<td align=\"center\"><input type=\"checkbox\" name=\"oficina\" onclick=\"return false;\" ";
										
										if($oficina==1)
											echo "checked";
											
											echo " readonly=\"readonly\" ></td>
											
											<td align=\"center\">$primeiraFase</td>
											<td align=\"center\"><input type=\"checkbox\" name=\"oab\" onclick=\"return false;\" ";
											
										if($oab==1)
											echo "checked";
											
											echo  " readonly=\"readonly\" ></td>
									</tr>
									
									<tr style=\"background-color: #AAAAAA\">
										<td colspan=\"3\"> </td>
									</tr>
									<tr>
										<td align=\"center\"><b></b></td>
										<td align=\"center\"><b>Simulado 1</b></td>
										<td align=\"center\"><b>Simulado 2</b></td>
									</tr>";
									
									echo "<tr>
												<td align=\"center\"><strong>Semestre Atual</strong></td>
												<td align=\"center\">$atu1</td>
												<td align=\"center\">$atu2</td>
										  </tr>";
										  
									echo "<tr>
												<td align=\"center\"><strong>Semestre Passado</strong></td>
												<td align=\"center\">$pas1</td>
												<td align=\"center\">$pas2</td>
										  </tr>";	
									
									echo "
									
									<tr style=\"background-color: #AAAAAA\">
										<td colspan=\"3\"> </td>
									</tr>
									<tr>
										<td align=\"center\"><strong>L1 (Nota do Simulado)</strong></td>
										<td colspan=\"2\" align=\"center\">$L1</td>
									</tr>
									
									<tr style=\"background-color: #AAAAAA\">
										<td colspan=\"3\"> </td>
									</tr>
									<tr>
										<td colspan=\"3\" align=\"center\"><button type=\"submit\" formaction=\"atualizacadastro.php\" class=\"button btn-primary btn-lg btn-block\">Atualizar Informações</button></td>
									</tr>
								</table>
						";
					?>