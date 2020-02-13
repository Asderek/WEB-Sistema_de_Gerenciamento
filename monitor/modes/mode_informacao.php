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
						$horas = $resultMatricula[0]['horas'];
						
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
							$plantao = "asd";
							$sqlAbr = "SELECT * FROM `alunosplantao` WHERE `matricula` = $matricula";
							$queryAbr = $conexao->query($sqlAbr);
							if ($queryAbr != false)
							{
								$resultAbr = $queryAbr->fetchAll( PDO::FETCH_ASSOC );
								$abr = $resultAbr[0]['professor'];
								
								$sqlNome = "SELECT * FROM `horariosplantao` WHERE `nome` = \"$abr\"";
								$queryNome = $conexao->query($sqlNome);
								if ($queryNome != false)
								{
									$resultNome = $queryNome->fetchAll(PDO::FETCH_ASSOC);
									$plantao = $resultNome[0]['nome'];
								}
							}
						}
						
						
						echo "
								<table class=\"table table-bordered table-striped table-hover\">
									<tr>
										<td>Matricula</td>
										<td colspan=\"2\">$matricula</td>
									</tr>
									
									<tr>
										<td>Nome</td>
										<td colspan=\"2\">$nome</td>
									</tr>
									
									<tr>
										<td>Disciplina</td>
										<td colspan=\"2\">$disciplina</td>
									</tr>
									
									<tr>
										<td>Turma</td>
										<td colspan=\"2\">$turma</td>
									</tr>
									
									<tr>
										<td>Professor</td>
										<td colspan=\"2\">$professor</td>
									</tr>
									
									<tr>
										<td>Professor Plantao</td>
										<td colspan=\"2\">$plantao</td>
									</tr>
									
									<tr>
										<td>Telefone</td>
										<td colspan=\"2\"><input type=\"text\" name=\"tel\" value=\"$tel\" size='40'></td>
									</tr>
									
									<tr>
										<td>Email</td>
										<td colspan=\"2\"><input type=\"text\" name=\"email\" value=\"$email\" size='40'></td>
									</tr>
									
									<tr>
										<td colspan=\"3\" align=\"center\"><b>NOTAS</b></td>
									</tr>
									<tr>
										<td>Horas</td>
										<td colspan=\"2\" align=\"center\">$horas</td>
									</tr>
									<tr>
										<td>Oficina</td>
										<td colspan=\"2\"><input type=\"checkbox\" name=\"oficina\" onclick=\"return false;\" ";
										
									if($oficina==1)
										echo "checked";
										
										echo " readonly=\"readonly\" ></td>
									</tr>	
									<tr>
										<td>OAB</td>
										<td colspan=\"2\"><input type=\"checkbox\" name=\"oab\" onclick=\"return false;\" ";
										
									if($oab==1)
										echo "checked";
										
										echo  " readonly=\"readonly\" ></td>
									</tr>							
									
									<tr>
										<td>Primera Fase OAB</td>
										<td colspan=\"2\" align=\"center\">$primeiraFase</td>
									</tr>
									
									<tr>
										<td align=\"center\"><b></b></td>
										<td align=\"center\"><b>Simulado 1</b></td>
										<td align=\"center\"><b>Simulado 2</b></td>
									</tr>";
									
									echo "<tr>
												<td>Semestre Atual</td>
												<td align=\"center\">$atu1</td>
												<td align=\"center\">$atu2</td>
										  </tr>";
										  
									echo "<tr>
												<td>Semestre Passado</td>
												<td align=\"center\">$pas1</td>
												<td align=\"center\">$pas2</td>
										  </tr>";	
									
									echo "
									
									<tr>
										<td>L1 (Nota do Simulado)</td>
										<td colspan=\"2\" align=\"center\">$L1</td>
									</tr>
									<tr>
										<td colspan=\"3\" align=\"center\"><button type=\"submit\" formaction=\"atualizacadastro.php\" class=\"button btn-primary btn-lg btn-block\">Atualizar Informações</button></td>
									</tr>
								</table>
						";
					?>