<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../../assets/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
		html 
		{ 
			background: url(../../../assets/img/pilotis.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		.modal-footer {   border-top: 0px; }
	
		p.padding 
		{
				padding-left: 1cm;
		}
	
        </style>
    </head>
    
    
    <body  >
        
		<!--login modal-->
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
					<h1 class="text-center">Núcleo de Prática Jurídica</h1>
					<h3 class="text-center">Escolha seus Horarios</h3>
					</div>
					<div class="modal-body">
						
								<?php
									
									include('conexao.php');
									
									$matricula = $_POST['matricula'];
									
									$sqlProfessor = "SELECT * FROM professores WHERE matricula = $matricula";
									$queryProfessor = $conexao->query($sqlProfessor);
									$rowsProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
									
									
									$display = true;
									$ConflitoProfessor = array();
									
									$area = $rowsProfessor[0]['area'];
									$name = $rowsProfessor[0]['nome'];
								
									
								
									if(count($rowsProfessor) <= 0)
									{
										echo '<h5 class="text-center">Professor não está cadastrado no EMA</h5>';
										echo '<br>';
										echo '<a href="inicio.html" class="btn btn-primary btn-lg btn-block">página inicial</a>';
									}
									else
									{
										echo "<form action='confirmacao.php' method='post' enctype='multipart/form-data'>";
										
										echo '<input type="hidden" name="matricula" value='.$matricula.'></input>';
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
										
										echo '</table>';
										
										echo '
											<div class="form-group">
												<button type="submit" class="btn btn-primary btn-lg btn-block">Cadastrar</button>
											</div>';
										
										echo '<h5 class="text-left"><b><br><br>LOTADO - Não há mais espaço para plantão neste horário.</b></h5>';
										echo '<h5 class="text-left"><b>"<font color="FF0000">NOME</font>" - Indica que outro professor da sua area já está alocado neste horário.</b></h5>';
							
							
									}
									
									
								?>
							
							
						</form>
					</div>
					<div class="modal-footer"></div>
				</div>
			</div>
		</div>
				
		<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
		<!-- JavaScript jQuery code from Bootply.com editor -->
		<script type='text/javascript'>
			$(document).ready(function() {});				
		</script>
        
    </body>
</html>