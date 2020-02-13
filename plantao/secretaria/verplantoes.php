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
			background: url(../../assets/img/pilotis.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		
		.modal-content
		{
			margin-left:                       -512px;
			margin-top:                        0px;
			position:                        relative;
			width:                             1024px;
			left:                                 50%;
			top:                                  50%;
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
					<h3 class="text-center">Relação de Alunos por Horario</h3>
					</div>
					<div class="modal-body">
						
								<?php
									
									include('../../newconexao.php');
												
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
											echo '<tr bgcolor="#CCCCCC">';
										else
											echo '<tr>';
										echo '<td align="center"><label for="nome">'.$hora.':00-'.$end.':00</label></td>';
										
										for($dia=2;$dia<7;$dia++)
										{
											
											$sqlDia = "SELECT * FROM horariosplantao WHERE (dia1 = $dia OR dia2 = $dia OR dia3 = $dia)";
											$queryDia = $conexao->query($sqlDia);
											if($queryDia != false)
											{
												$rowsDia = $queryDia->fetchAll( PDO::FETCH_ASSOC );
											}
											
											echo '<td align="center"><strong>';
											for($i=0;$i<count($rowsDia);$i++)
											{
													$start1 = $rowsDia[$i]['ini1'];
													$start2 = $rowsDia[$i]['ini2'];
													$start3 = $rowsDia[$i]['ini3'];
													
													$end1 = $rowsDia[$i]['fim1'];
													$end2 = $rowsDia[$i]['fim2'];
													$end3 = $rowsDia[$i]['fim3'];
													
													if($rowsDia[$i]['dia1'] == $dia)
													{
														$nome = $rowsDia[$i]['abr'];
														
														if($start1<=$hora && $end1>$hora)
														{
															echo "$nome<br>";
														}
													}
													if ($rowsDia[$i]['dia2'] == $dia)
													{
														$nome = $rowsDia[$i]['abr'];
														
														if($start2<=$hora && $end2>$hora)
														{
															echo "$nome<br>";
														}
													}
													if ($rowsDia[$i]['dia3'] == $dia)
													{
														$nome = $rowsDia[$i]['abr'];
														
														if($start3<=$hora && $end3>$hora)
														{
															echo "$nome<br>";
														}
													}
											}
											echo '</strong></td>';
											
											
										}
											
										echo '</tr>';
										
										
									}
								
									echo '</table>';
								
									echo '<br><br>';
										
									
								?>
							
							<a href="inicio.php" class="btn btn-primary btn-lg btn-block">página inicial</a>
							<a href="gerartabela.php" class="btn btn-primary btn-lg btn-block">Gerar Tabela</a>
							
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