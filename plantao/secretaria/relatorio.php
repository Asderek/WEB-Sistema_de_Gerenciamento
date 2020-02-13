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
									
									$abr = $_POST['professor'];
									
									$sqlAlunos = "SELECT * FROM alunosplantao WHERE `professor` = \"$abr\"";
									$queryAlunos = $conexao->query($sqlAlunos);
									if($queryAlunos != false)
									{
										$rowsAlunos = $queryAlunos->fetchAll( PDO::FETCH_ASSOC );
									}
									
									$dias = array();
									for($i=0;$i<5;$i++)
									{
										$dias[$i] = array();
									}
									
									for ($i=0;$i<5;$i++)
									{
										for($j=0;$j<13;$j++)
										{
											$dias[$i][$j] = array();
										}
									}
									
									
									$sqlTotalAlunos = "SELECT * FROM `horariosplantao` WHERE `nome` = \"$abr\"";
									$queryTotalAlunos = $conexao->query($sqlTotalAlunos);
									$resultTotalAlunos = $queryTotalAlunos->fetchAll(PDO::FETCH_ASSOC);
									$total = $resultTotalAlunos[0]['alunos1'];
									echo '<h3 class="text-center">'.$abr."<br>[maxAlunos - $total]".'</h3>';
									
									
									for($i=0;$i<count($rowsAlunos);$i++)
									{
										$horario = $rowsAlunos[$i]['horario'];
										$nome = $rowsAlunos[$i]['nome'];
										$matAluno = $rowsAlunos[$i]['matricula'];

										if (strpos($horario, 'segunda') !== false) 
										{
											$hora = $horario[10].$horario[11];
											$hora = intval($hora)-8;
											array_push($dias[0][$hora],array($matAluno,$nome));
										}
										else if (strpos($horario, 'terca') !== false) 
										{
											$hora = $horario[8].$horario[9];
											$hora = intval($hora)-8;
											array_push($dias[1][$hora],array($matAluno,$nome));
											
										}
										else if (strpos($horario, 'quarta') !== false) 
										{
											$hora = $horario[9].$horario[10];
											$hora = intval($hora)-8;
											array_push($dias[2][$hora],array($matAluno,$nome));
										}
										else if (strpos($horario, 'quinta') !== false) 
										{
											$hora = $horario[9].$horario[10];
											$hora = intval($hora)-8;
											array_push($dias[3][$hora],array($matAluno,$nome));
										}
										else if (strpos($horario, 'sexta') !== false) 
										{
											$hora = $horario[8].$horario[9];
											$hora = intval($hora)-8;
											array_push($dias[4][$hora],array($matAluno,$nome));;
										}
					
									}
									
									$dia = array("segunda","terca","quarta","quinta","sexta");
									$hora = array("08:00~09:00","09:00~10:00","10:00~11:00","11:00~12:00","12:00~13:00","13:00~14:00","14:00~15:00","15:00~16:00","16:00~17:00","17:00~18:00","18:00~19:00","19:00~20:00","20:00~21:00");									
									
									for($day=0;$day<5;$day++)
									{	
										for($hour=0;$hour<13;$hour++)
										{												
											if(count($dias[$day][$hour])>0)
											{
												
												echo '
													<table style="width:100%">
														<tr>
															<td colspan="2" align="center"><b><font size="4">'.$dia[$day].' - '.$hora[$hour].'</font></b></td>
														</tr>';
												echo '
														<tr>
															<td align="center"><b><font size="4">Matricula</font></b></td>
															<td align="center"><b><font size="4">Nome</font></b></td>
														</tr>';
												
												for($aluno=0;$aluno<count($dias[$day][$hour]);$aluno++)
												{
													if($aluno % 2 == 0)
														echo '<tr bgcolor="#DDDDDD">';
													else
														echo '<tr>';
													
													for($atr=0;$atr<count($dias[$day][$hour][$aluno]);$atr++)
													{
														echo '<td align="center">'.$dias[$day][$hour][$aluno][$atr].'</td>';														
													}
													echo '</tr>';
												}
												
												
												echo '</table>';
												echo '<br><br>';
											}
											
											
										}
									}
									
									
								?>
							
							<a href="inicio.php" class="btn btn-primary btn-lg btn-block">página inicial</a>
							
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