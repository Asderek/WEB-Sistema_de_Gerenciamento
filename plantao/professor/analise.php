<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
		html 
		{ 
			background: url(../../assets/img/areaprofessor.jpg) no-repeat center center fixed; 
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
		
		label
		{
		  display: block;
		  margin-bottom: 8px;
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
					<h3 class="text-center">Relação dos alunos inscritos para seu plantao</h3>
					</div>
					<div class="modal-body">
						<form action='relatorio.php' method='post' enctype='multipart/form-data'>
								<?php
									
									include('../../newconexao.php');
									
									$segunda = array();
									$terca = array();
									$quarta = array();
									$quinta = array();
									$sexta = array();
									
									$somaSegunda = 0;
									$somaTerca = 0;
									$somaQuarta = 0;
									$somaQuinta = 0;
									$somaSexta = 0;
									
									for($i=0;$i<24;$i++)
									{
										$segunda[$i] = $terca[$i] = $quarta[$i] = $quinta[$i] = $sexta[$i] = 0;										
									}
									
									$matricula = $_POST['matricula'];
									
									echo '<input type="hidden" name="matricula" value='.$matricula.'></input>';
																		
									$sqlProfessor = "SELECT * FROM `horariosplantao` WHERE `matricula` = $matricula";
									$queryProfessor = $conexao->query($sqlProfessor);
									$rowsProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
									
									$sqlMonitor = "SELECT * FROM `professores` WHERE `matMonitor` LIKE \"%$matricula%\"";
									$queryMonitor = $conexao->query($sqlMonitor);
									$rowsMonitor = $queryMonitor->fetchAll( PDO::FETCH_ASSOC );
									
									$ultimoHorario = '0';
									$primeiroHorario = '25';
				
									
									if(count($rowsMonitor)>0)
										$monitor=true;
								
									if(count($rowsProfessor) <= 0 && count($rowsMonitor) <= 0)
									{
										if(count($rowsProfessor) <= 0)
										{
											echo '<h5 class="text-center">Professor não está cadastrado no EMA</h5>';
											echo '<br>';
											echo '<a href=javascript:history.go(-1) class="btn btn-primary btn-lg btn-block">Voltar</a>';
										}
										else if(count($rowsMonitor) <= 0)
										{
											echo '<h5 class="text-center">Monitor não está cadastrado no EMA</h5>';
											echo '<br>';
											echo '<a href=javascript:history.go(-1) class="btn btn-primary btn-lg btn-block">Voltar</a>';
										}
									}
									else
									{										
										//professor está cadastrado
										if($monitor==true)
										{
											$professor = $rowsMonitor[0]['nome'];
							
											$sqlMonitor = "SELECT * FROM `horariosplantao` WHERE `nome` = \"$professor\"";
											$queryMonitor = $conexao->query($sqlMonitor);
											$rowsMonitor = $queryMonitor->fetchAll( PDO::FETCH_ASSOC );

											$abr = $rowsMonitor[0]['nome'];										
										}
										else
											$abr = $rowsProfessor[0]['nome'];
										
										
										echo "<input type=\"hidden\" name=\"abr\" value='$abr'></input>";
										
										
										
										$sqlAlunos = "SELECT * FROM alunosplantao WHERE `professor` = \"$abr\"";
										$queryAlunos = $conexao->query($sqlAlunos);
										if($queryAlunos != false)
										{
											$rowsAlunos = $queryAlunos->fetchAll( PDO::FETCH_ASSOC );
										}
										if(count($rowsAlunos) > 0)
										{
											for($i=0;$i<count($rowsAlunos);$i++)
											{
												$horario = $rowsAlunos[$i]['horario'];
												$nome = $rowsAlunos[$i]['nome'];
												
												if (strpos($horario, 'segunda') !== false) 
												{
													$hora = $horario[10].$horario[11];
													$segunda[intval($hora)]++;
												}
												else if (strpos($horario, 'terca') !== false) 
												{
													$hora = $horario[8].$horario[9];
													$terca[intval($hora)]++;
												}
												else if (strpos($horario, 'quarta') !== false) 
												{
													$hora = $horario[9].$horario[10];
													$quarta[intval($hora)]++;
												}
												else if (strpos($horario, 'quinta') !== false) 
												{
													$hora = $horario[9].$horario[10];
													$quinta[intval($hora)]++;
												}
												else if (strpos($horario, 'sexta') !== false) 
												{
													$hora = $horario[8].$horario[9];
													$sexta[intval($hora)]++;
												}
												
												if(intval($ultimoHorario)<intval($hora))
													$ultimoHorario = $hora;
												if(intval($primeiroHorario)>intval($hora))
													$primeiroHorario = $hora;
											}
										}
										
										for($i=0;$i<count($segunda);$i++)
										{
											$somaSegunda += $segunda[$i];
											$somaTerca += $terca[$i];
											$somaQuarta += $quarta[$i];
											$somaQuinta += $quinta[$i];
											$somaSexta += $sexta[$i];
										}
										
										$somatorio = $somaSegunda + $somaTerca + $somaQuarta + $somaQuinta + $somaSexta;
								
									
										if($somatorio == 0)
										{
											echo "<div class=\"text-center\">O professor não possui alunos inscritos para o seu plantão</div></br>";
											echo "<a href=javascript:history.go(-1) class=\"btn btn-primary btn-lg btn-block\">Voltar</a>";
											return;
										}
										
										for($i=0;$i<count($segunda);$i++)
										{
											if($segunda[$i] == 0)
												$segunda[$i] = '-';
											if($terca[$i] == 0)
												$terca[$i] = '-';
											if($quarta[$i] == 0)
												$quarta[$i] = '-';
											if($quinta[$i] == 0)
												$quinta[$i] = '-';
											if($sexta[$i] == 0)
												$sexta[$i] = '-';
										}
										echo '
												<table style="width:100%">
													<tr>
														<td align ="center"><b><font size="4">Horario</font></b></td>';
														
										if($somaSegunda!= 0)
												echo '<td align ="center"><b><font size="4">Segunda</font></b></td>';
										if($somaTerca!= 0)
												echo '<td align ="center"><b><font size="4">Terça</font></b></td>';
										if($somaQuarta!= 0)											
												echo '<td align ="center"><b><font size="4">Quarta</font></b></td>';
										if($somaQuinta!= 0)											
												echo '<td align ="center"><b><font size="4">Quinta</font></b></td> ';
										if($somaSexta!= 0)		
												echo '<td align ="center"><b><font size="4">Sexta</font></b></td>';
											
										echo '</tr>';
											
										for($hora = intval($primeiroHorario);$hora<intval($ultimoHorario)+1;$hora++)
										{											
											$end = $hora+1; 
											if($hora % 2 == 0)
												echo '<tr bgcolor="#DDDDDD">';
											else
												echo '<tr>';
											echo '<td align="center"><label for="nome"><font size="3">'.$hora.':00-'.$end.':00</font></label></td>';
											
											for($dia=2;$dia<7;$dia++)
											{
												if($dia==2 && $somaSegunda!=0)
													echo '<td align="center"><label for="checkbox"><font size="3">
														​'.$segunda[$hora].'
													</font></label></td>​​​​​​​​​​​​​​​​​​​​​​​​​​';
													//echo '<td align="center"><input type="checkbox" name="'.$dia.'-'.$hora.'-'.$end.'" "'.$hora.'-'.$end.'">'.$segunda[$hora].'</td>';
												else if($dia==3 && $somaTerca != 0)
													echo '<td align="center"><label for="checkbox"><font size="3">
														​'.$terca[$hora].'
													</font></label></td>​​​​​​​​​​​​​​​​​​​​​​​​​​';
													//echo '<td align="center"><input type="checkbox" name="'.$dia.'-'.$hora.'-'.$end.'" "'.$hora.'-'.$end.'">'.$terca[$hora].'</td>';
												else if($dia==4 && $somaQuarta != 0)
													echo '<td align="center"><label for="checkbox"><font size="3">
														'.$quarta[$hora].'
													</font></label></td>​​​​​​​​​​​​​​​​​​​​​​​​​​';
													// echo '<td align="center"><input type="checkbox" name="'.$dia.'-'.$hora.'-'.$end.'" "'.$hora.'-'.$end.'">'.$quarta[$hora].'</td>';
												else if($dia==5 && $somaQuinta != 0)
													echo '<td align="center"><label for="checkbox"><font size="3">
														'.$quinta[$hora].'
													</font></label></td>​​​​​​​​​​​​​​​​​​​​​​​​​​';
													// echo '<td align="center"><input type="checkbox" name="'.$dia.'-'.$hora.'-'.$end.'" "'.$hora.'-'.$end.'">'.$quinta[$hora].'</td>';
												else if($dia==6 && $somaSexta != 0)
													echo '<td align="center"><label for="checkbox"><font size="3">
														'.$sexta[$hora].'
													</font></label></td>​​​​​​​​​​​​​​​​​​​​​​​​​​';
													// echo '<td align="center"><input type="checkbox" name="'.$dia.'-'.$hora.'-'.$end.'" "'.$hora.'-'.$end.'">'.$sexta[$hora].'</td>';
												
											}
											echo '</tr>';
										}
										
										echo '</table>';
									
										echo '<div class="form-group">
												<button type="submit" class="btn btn-primary btn-lg btn-block">Gerar Relatorio</button>
											</div>';
									
									}
									
								?>
							
						</form>
					</div>
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