<?php
								include('newconexao.php');
								
								$matriculaInscrito = $_POST['matricula'];
								
								$sqlSearch = "SELECT * FROM professoresmonitoria WHERE matricula = $matriculaInscrito";
								$querySearch = $conexao->query($sqlSearch);
								$resultSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );
								
								$rowsSearch = count($resultSearch);
	  
								if($rowsSearch > 0)
								{
									//professor está cadastrado
									$name = $resultSearch[0]['nome'];
									echo "<input type=\"hidden\" name=\"nome\" value=\"$name\"></input>";
									$sqlFind = "SELECT * FROM `inscritosmonitoria` WHERE `professor` LIKE '$name%' ORDER BY `oab` DESC";
									$queryFind = $conexao->query($sqlFind);
									$resultFind = $queryFind->fetchAll( PDO::FETCH_ASSOC );
									$rowsFind = count($resultFind);
									
									if($rowsFind > 0)
									{
										echo '<h5 class="text-center">Você possui '. $rowsFind.' candidatos inscritos para sua monitoria</h5><p></p><p></p><br>';									
					
										for($index =0;$index<$rowsFind;$index++)
										{
											$nome = $resultFind[$index]['nome'];
											$area = $resultFind[$index]['professor'];
											$matriculaAluno = $resultFind[$index][ 'matricula'];
											$formatura = $resultFind[$index][ 'formatura'];
											$oab = $resultFind[$index]['oab'];
											
											$area = strrchr($area,"-");
											$area = substr($area,2);
											
											echo '
													<table class="table table-bordered table-hover">
														<tbody>';
											echo "
															<tr>
															<td width='40%'><strong>Matricula</strong></td>
															<td width='60%'>$matriculaAluno</td>
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
															<tr align=\"center\">
																<td colspan=\"2\"><button type=\"submit\" value=\"clickmonitoria$matriculaAluno\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" onclick=\"eatFood();\">Ver</button></td>
															</tr>
															";
															
											echo' 		</tbody>
														</table>';
										}
									}
									else
									{
										echo '<h5 class="text-center">Não existem candidatos inscritos para sua monitoria</h5><p></p>';
									}
									
								}
								else
								{
									echo '<h5 class="text-center">Professor não está cadastrado no EMA</h5><p></p>';
								}
								
							?>
	
	<script>
		function eatFood()
		{
			var objDelete = document.createElement("input");
			objDelete.setAttribute("type","hidden");
			objDelete.setAttribute("value","vermonitoria");
			objDelete.setAttribute("name","mode");		
			document.getElementById("id_FormRight").appendChild(objDelete);
			document.getElementById("id_FormRight").submit();
		}
	</script>
	
	
	
	
	
	
	
	
	
	