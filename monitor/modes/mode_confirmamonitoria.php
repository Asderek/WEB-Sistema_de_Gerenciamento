<?php
							include('../../newconexao.php');
							include ('../../injection.php');
						
						
						
							$matriculaInscrito = $_POST['matricula'];

							$professor = $_POST['professor'];
							$tel = $_POST['tel'];
							
							$apresentacao = $_POST['apresentacao'];
							$exp = $_POST['exp'];
							$razao = $_POST['razao'];
							
							/*Parse entradas*/
							
								/*Apresentacao*/	
								
									$apresentacao = str_replace("\\r\\n","<br>",$apresentacao);
									
									$apresentacao = str_replace("\\\"","'",$apresentacao);

								/*exp*/	
								
									$exp = str_replace("\\r\\n","<br>",$exp);
									
									$exp = str_replace("\\\"","'",$exp);

								/*razao*/	
								
									$razao = str_replace("\\r\\n","<br>",$razao);
									
									$razao = str_replace("\\\"","'",$razao);

									
							/*Parse entradas*/
							
							
							
							$previsao = $_POST['formatura'];
							
							$OAB = $_POST['OAB'];
							
							if($OAB != 1)
								$OAB=0;
							
							
							if (injection($matriculaInscrito))
							{
								echo "My code is sanitized bitch<br>";
								echo "<a href=javascript:history.go(-1) class=\"btn btn-primary btn-lg btn-block\">Voltar</a>";
								return;
							}
							
							$sqlSearch = "SELECT * FROM alunos WHERE matricula = $matriculaInscrito ";
							$querySearch = $conexao->query($sqlSearch);
							$rowsSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );
							
							if(count($rowsSearch) > 0)
							{
								$nome = $rowsSearch[0]['nome'];
								$email = $rowsSearch[0]['email'];
								$tel = $rowsSearch[0]['telefone'];
							}
							else
							{
								$nome = mysql_real_escape_string($_POST['nome']);
								$email = "---";
							}
						
							echo "<h3 class=\"text-center\">Confirme seus dados</h3>";
							
							echo '
											<table class="table table-bordered table-hover">
												<tbody>';
							echo "
											<tr>
											<td width='30%'><strong>Matricula</strong></td>
											<td width='70%'>$matriculaInscrito</td>
											</tr>
											";
											
							echo "
											<tr>
											<td width='30%'><strong>Nome</strong></td>
											<td width='70%'>$nome</td>
											</tr>
											";
											
							echo "
											<tr>
											<td width='30%'><strong>Telefone</strong></td>
											<td width='70%'>$tel</td>
											</tr>
											";
							echo "
											<tr>
											<td width='30%'><strong>Email</strong></td>
											<td width='70%'>$email</td>
											</tr>
											";
							echo "
											<tr>
											<td width='30%'><strong>Previsão de Formatura</strong></td>
											<td width='70%'>$previsao</td>
											</tr>
											";
											
							echo "
											<tr>
											<td width='30%'><strong>Vaga de Inscrição</strong></td>
											<td width='70%'>$professor</td>
											</tr>
											";
											
							echo "
											<tr>
											<td width='30%'><strong>Apresentação</strong></td>
											<td width='70%'>$apresentacao</td>
											</tr>
											";	
							
							echo "
											<tr>
											<td width='30%'><strong>Motivo para Inscrição</strong></td>
											<td width='70%'>$razao</td>
											</tr>
											";
											
							echo "
											<tr>
											<td width='30%'><strong>Experiencia Profissional</strong></td>
											<td width='70%'>$exp</td>
											</tr>
											";
											
							echo "
											<tr>
											<td width='30%'><strong>OAB</strong></td>
											<td width='70%'>"; 
											
											if($OAB == 1) 
												echo "SIM"; 
											else 
												echo "NÃO";
											
							echo "</td>
											</tr>
											";	

							
											
							echo' 		</tbody>
										</table>';
							echo "<input type=\"hidden\" name=\"matricula\" value=\"$matriculaInscrito\"></input>";
							echo "<input type=\"hidden\" name=\"email\" value=\"$email\"></input>";
							echo "<input type=\"hidden\" name=\"professor\" value=\"$professor\"></input>";
							echo "<input type=\"hidden\" name=\"tel\" value=\"$tel\"></input>";
							echo '<input type="hidden" name="apresentacao" value="'.$apresentacao.'"></input>';
							echo "<input type=\"hidden\" name=\"exp\" value=\"$exp\"></input>";
							echo "<input type=\"hidden\" name=\"razao\" value=\"$razao\"></input>";
							echo "<input type=\"hidden\" name=\"OAB\" value=\"$OAB\"></input>";
							echo "<input type=\"hidden\" name=\"formatura\" value=\"$previsao\"></input>";
							echo "<input type=\"hidden\" name=\"email\" value=\"$email\"></input>";
							
							
						?>

						</br>
						
						<h4 align="center">Atenção! <br>Confirme cuidadosamente os seus dados. <br>Após cadastrado, não é possivel alterar as informações.</h4>
						
						<div class="form-group" align="center">
							<input type="checkbox" name="Read" value="Read" onclick="action = inscricao-cadastro.php">Ciente
						</div>
						
						<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg btn-block" onclick="ValidateCheckBox('Read')" formaction="registraMonitoria.php">Cadastrar</button>
								<a href=javascript:history.go(-1) class="btn btn-primary btn-lg btn-block">Voltar</a>
						</div>