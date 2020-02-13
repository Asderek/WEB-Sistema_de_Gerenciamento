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
			  background: url(../../assets/img/digitar.jpg) no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			}
			.modal-footer {   border-top: 0px; }
			#loginModal { margin-top: 0px;}
        </style>
    </head>
    
    
    <body  >
        
        <!--login modal-->
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="text-center">Núcleo de Prática Jurídica</h1>
						<h3 class="text-center">Pré-Cadastro de Alunas(os) para Plantão</h3>						
					</div>
					
					<div class="modal-body">
						<form action='cadastro.php' method='post' enctype='multipart/form-data'>
							<?php
								include('conexao.php');
								include('../../professores.php');
								define ("MAXALUNO",15);
								$matricula = $_POST['matricula'];
								$professor = $_POST['plantaoprofessor'];
																	
								echo '<input type="hidden" name="matricula" value='.$matricula.'></input>';
								echo "<input type=\"hidden\" name=\"professor\" value=\"$professor\"></input>";
								
								$matricula = filter_var($matricula,FILTER_SANITIZE_NUMBER_INT);
								
								$dias = array();
										
								$sqlAluno = "SELECT * FROM alunos WHERE matricula = $matricula";
								$queryAluno = $conexao->query($sqlAluno);
								$resultAluno = $queryAluno->fetchAll( PDO::FETCH_ASSOC );
										
								array_push($dias, "a");
								array_push($dias, "b");
								array_push($dias, "segunda");
								array_push($dias, "terca");
								array_push($dias, "quarta");
								array_push($dias, "quinta");
								array_push($dias, "sexta");
												
								$sqlProfessor = "SELECT * FROM horariosplantao WHERE nome = \"$professor\"";
								$queryProfessor = $conexao->query($sqlProfessor);
								$resultProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
								
								if(count($resultProfessor) <= 0)
								{
									echo '<h5 class="text-center">Este professor nao está oferecendo plantoes</h5>';
									echo '<br>';
									echo '<a href="inicio.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
								}else if(count($resultAluno) <= 0)
								{
									echo '<h5 class="text-center">Aluno não está cadastrado no EMA</h5>';
									echo '<br>';
									echo '<a href="inicio.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
								}
								else {
									$sqlInscricao = "SELECT * FROM alunosplantao WHERE matricula = $matricula";
									$queryInscricao = $conexao->query($sqlInscricao);
									$resultInscricao = $queryInscricao->fetchAll( PDO::FETCH_ASSOC );
									$rowsInscricao = count($resultInscricao);
									
									if(count($resultInscricao)>0)
									{
											echo "<h5 class=\"text-center\">Sua inscrição atual: <br><b>    Professor:  </b>".$resultInscricao[0]['professor'].'<br><b>     Horario:  </b>'.$resultInscricao[0]['horario'].'</h5><br>';
									}
									
									echo "<label for=\"label\">Escolha o dia e hora do seu plantão para o(a) professor(a) $professor: </label>";
									echo '<select class="form-control" id="escolha" name="escolha">';
									
									
									for($dia=2;$dia<7;$dia++)
									{
										
										if ($dia == $resultProfessor[0]['dia1'])
										{
											$start = $resultProfessor[0]['ini1'];
											$end = $resultProfessor[0]['fim1'];
											$maxAluno = $resultProfessor[0]['alunos1'];
											//echo "<option name=\"blasd\" disabled=\"true\">$maxAluno</option>";
											
											for(;$start<$end;$start++)
											{	
												$startM1 = $start+1;
												
												$sqlOverflow = "SELECT * FROM alunosplantao WHERE horario = \"$dias[$dia] - ";
												if ($start < 10)
													$sqlOverflow .= '0'.$start.":00 ~ ";
												else 
													$sqlOverflow .= $start.":00 ~ ";
												
												if ($startM1 < 10)
													$sqlOverflow .= '0'.$startM1.":00\"";
												else
													$sqlOverflow .= $startM1.":00\"";
												
												
												$sqlOverflow .= " AND professor = \"$professor\"";
												
												$queryOverflow = $conexao->query($sqlOverflow);
												$resultOverflow = $queryOverflow->fetchAll( PDO::FETCH_ASSOC );
												$rowsOverflow = count($resultOverflow);
												
												$matriculaProfessor = PROFESSORES_GETMATRICULA($professor);
												$sqlBloqueado = "SELECT * FROM `NPJ_fechamentoPlantoes` WHERE `matricula` = $matriculaProfessor AND `dia` = $dia AND `inicio` = $start AND `fim` = $startM1";
												$queryBloqueado = $conexao->query($sqlBloqueado);
												if ($queryBloqueado != false)
												{
													$resultBloqueado = $queryBloqueado->fetchAll(PDO::FETCH_ASSOC);
													if (count($resultBloqueado) > 0)
														continue;
												}
												
												if($start<9)
												{
													if($rowsOverflow<$maxAluno)
														echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00</option>';
													else
														echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00 - LOTADO</option>';
												}
												else if($start==9)
												{
													if($rowsOverflow<$maxAluno)
														echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00</option>';
													else
														echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00 - LOTADO</option>';
												}
												else
												{
													if ($rowsOverflow<$maxAluno)
														echo "<option name=\"$dia-$start\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00</option>';
													else
														echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00 - LOTADO</strike></option>';
												}
											}
										}
										
										if ($dia == $resultProfessor[0]['dia2'])
										{
											$start = $resultProfessor[0]['ini2'];
											$end = $resultProfessor[0]['fim2'];
											$maxAluno = $resultProfessor[0]['alunos2'];	
											
											for(;$start<$end;$start++)
											{	
												$startM1 = $start+1;
												$sqlOverflow = "SELECT * FROM alunosplantao WHERE horario = \"$dias[$dia] - ";
												if ($start < 10)
													$sqlOverflow .= '0'.$start.":00 ~ ";
												else 
													$sqlOverflow .= $start.":00 ~ ";
												
												if ($startM1 < 10)
													$sqlOverflow .= '0'.$startM1.":00\"";
												else
													$sqlOverflow .= $startM1.":00\"";
												
												$sqlOverflow .= " AND professor = \"$professor\"";
												
												$queryOverflow = $conexao->query($sqlOverflow);
												$resultOverflow = $queryOverflow->fetchAll( PDO::FETCH_ASSOC );
												$rowsOverflow = count($resultOverflow);
											
												$matriculaProfessor = PROFESSORES_GETMATRICULA($professor);
												$sqlBloqueado = "SELECT * FROM `NPJ_fechamentoPlantoes` WHERE `matricula` = $matriculaProfessor AND `dia` = $dia AND `inicio` = $start AND `fim` = $startM1";
												$queryBloqueado = $conexao->query($sqlBloqueado);
												if ($queryBloqueado != false)
												{
													$resultBloqueado = $queryBloqueado->fetchAll(PDO::FETCH_ASSOC);
													if (count($resultBloqueado) > 0)
														continue;
												}
												
												if($start<9)
												{
													if($rowsOverflow<$maxAluno)
														echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00</option>';
													else
														echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00 - LOTADO</strike></option>';
												}
												else if($start==9)
												{
													if($rowsOverflow<$maxAluno)
														echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00</option>';
													else
														echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00 - LOTADO</strike></option>';
												}
												else
												{
													if ($rowsOverflow<$maxAluno)
														echo "<option name=\"$dia-$start\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00</option>';
													else
														echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00 - LOTADO</strike></option>';
												}
											}
										}
										
										if ($dia == $resultProfessor[0]['dia3'])
										{
											$start = $resultProfessor[0]['ini3'];
											$end = $resultProfessor[0]['fim3'];
											$maxAluno = $resultProfessor[0]['alunos3'];		//Dobrei os alunos mas tenho que mudar
											//echo "<option name=\"blasd\" disabled=\"true\">$maxAluno</option>";
											
											for(;$start<$end;$start++)
											{	
												$startM1 = $start+1;
												$sqlOverflow = "SELECT * FROM alunosplantao WHERE horario = \"$dias[$dia] - ";
												if ($start < 10)
													$sqlOverflow .= '0'.$start.":00 ~ ";
												else 
													$sqlOverflow .= $start.":00 ~ ";
												
												if ($startM1 < 10)
													$sqlOverflow .= '0'.$startM1.":00\"";
												else
													$sqlOverflow .= $startM1.":00\"";
												
												
												$sqlOverflow .= " AND professor = \"$professor\"";
												
												$queryOverflow = $conexao->query($sqlOverflow);
												$resultOverflow = $queryOverflow->fetchAll( PDO::FETCH_ASSOC );
												$rowsOverflow = count($resultOverflow);
												
												$matriculaProfessor = PROFESSORES_GETMATRICULA($professor);
												$sqlBloqueado = "SELECT * FROM `NPJ_fechamentoPlantoes` WHERE `matricula` = $matriculaProfessor AND `dia` = $dia AND `inicio` = $start AND `fim` = $startM1";
												$queryBloqueado = $conexao->query($sqlBloqueado);
												if ($queryBloqueado != false)
												{
													$resultBloqueado = $queryBloqueado->fetchAll(PDO::FETCH_ASSOC);
													if (count($resultBloqueado) > 0)
														continue;
												}
												
												if($start<9)
												{
													if($rowsOverflow<$maxAluno)
														echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00</option>';
													else
														echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00 - LOTADO</strike></option>';
												}
												else if($start==9)
												{
													if($rowsOverflow<$maxAluno)
														echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00</option>';
													else
														echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00 - LOTADO</strike></option>';
												}
												else
												{
													if ($rowsOverflow<$maxAluno)
														echo "<option name=\"$dia-$start\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00</option>';
													else
														echo "<option name=\"$dia-$start\" disabled=\"true\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00 - LOTADO</strike></option>';
												}
											}
										}
									}
									echo '</select>';
									
									
								}
									echo '
											<br>
											<button type="submit" class="btn btn-primary btn-lg btn-block">Cadastrar</button>
										  ';
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
        
        $(document).ready(function() {
        
            
        
        });
		
		function ValidateCheckBox(clickedid) 
			{ 
				if (document.getElementsByName(clickedid)[0].checked == true) 
				{
					return false;
				} 
				else 
				{
					var box= alert("Estou ciente de que esta inscrição indica, apenas, o horário de preferência para os plantões deste semestre. A decisão final será dada pelo(a) professor(a) escolhido(a)");
				}
			}
        
        </script>
        
    </body>
</html>