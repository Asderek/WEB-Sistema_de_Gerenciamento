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
						<form action='escolherplantao.php' method='post' enctype='multipart/form-data'>
							<?php
								include('conexao.php');	
								$matricula = $_POST['matricula'];
								echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
								$sqlEma = "SELECT * FROM alunos WHERE matricula = $matricula";
								$queryEma = $conexao->query($sqlEma);
								$resultEma = $queryEma->fetchAll(PDO::FETCH_ASSOC);
								
								if (count($resultEma) <= 0)
								{
									echo "<h3 class=\"text-center\">Aluna(o) não cadastrada(o)</h3>";
									echo "<h5 class=\"text-center\">Contate a secretaria e aguarde</h5>";
									echo "<a href=\"javascript:history.go(-1)\" class=\"btn btn-primary btn-lg btn-block\">Voltar</a>";
									return; 
								}
								
								
								$disciplina = $resultEma[0]['disciplina'];
								$meuProfessor = $resultEma[0]['professor'];
								
								$sqlProfessor = "SELECT * FROM horariosplantao WHERE 1";
								$queryProfessor = $conexao->query($sqlProfessor);
								$result = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
								
								if(count($result) <= 0)
								{
									echo 'deu bug';
									echo '<a href="http://bit.ly/IqT6zt" class="btn btn-primary btn-lg btn-block">Back</a>';	
								}
								else
								{
									echo '<label for="Professor">Professor(a): </label>';
									echo '<select class="form-control" name="plantaoprofessor">';
									
									for($i=0;$i<count($result);$i++)
									{
										if ($result[$i]['nome'] == "LUCAS P NEPOMUCENO")
											continue;
										
										$accept = false;
										$dia1 = $result[$i]['dia1'];
										if ($dia1>0)
										{
											switch ($disciplina)
											{
												case "JUR1961":
													if ($result[$i]['disciplina'] == "JUR1961")
													{
														$accept = true;
													}
													if (strstr(strtolower($result[$i]['nome']),"firmino") != false)
													{
														$accept = true;
													}
												
												break;
												case "JUR1962":
													if ($result[$i]['disciplina'] == "JUR1962")
													{
														$accept = true;
													}
												break;
												case "JUR1963":
													if ($result[$i]['disciplina'] == "JUR1963")
													{
														$accept = true;
													}
												break;
												case "JUR1964":
													//FAMILIA
													if (strstr(strtolower($meuProfessor),"ines") != false || strstr(strtolower($meuProfessor),"pupo") != false)
													{
														if (	
																strstr(strtolower($result[$i]['nome']),"pupo") || 
																strstr(strtolower($result[$i]['nome']),"ines") || 
																strstr(strtolower($result[$i]['nome']),"pedro")|| 
																strstr(strtolower($result[$i]['nome']),"pelajo") ||
																strstr(strtolower($result[$i]['nome']),"assed") || 
																strstr(strtolower($result[$i]['nome']),"mia")
															)
															{
																$accept=true;
															}
													}
													//GIMEC
													if (strstr(strtolower($meuProfessor),"mia") != false ||strstr(strtolower($meuProfessor),"pelajo") != false ||strstr(strtolower($meuProfessor),"assed") != false )
													{
														if (strstr(strtolower($result[$i]['nome']),"mia") != false ||strstr(strtolower($result[$i]['nome']),"pelajo") != false ||strstr(strtolower($result[$i]['nome']),"assed") != false )
														{
															$accept = true;
														}
													}
													//EMPRESARIAL
													if (strstr(strtolower($meuProfessor),"felipe") != false)
													{
														if (strstr(strtolower($result[$i]['nome']),"felipe") != false)
														{
															$accept = true;
														}
													}
													//POSSESSORIO
													if (strstr(strtolower($meuProfessor),"mendonca") != false)
													{
														if (strstr(strtolower($result[$i]['nome']),"mendonca") != false)
														{
															$accept = true;
														}
													}
													//IVAN
													if (strstr(strtolower($meuProfessor),"ivan") != false)
													{
														if (strstr(strtolower($result[$i]['nome']),"ivan") != false)
														{
															$accept = true;
														}
														if ($result[$i]['disciplina'] == "JUR1961")
														{
															$accept = true;
														}
													}
													//CARLOS AFONSO
													if (strstr(strtolower($meuProfessor),"affonso") != false)
													{
														if ($result[$i]['disciplina'] == "JUR1963")
														{
															$accept = true;
														}
														if (strstr(strtolower($result[$i]['nome']),"mendonca") != false)
														{
															$accept = true;
														}
													}
													
												break;
											}
											if ($accept == true)
											{
												$nome = $result[$i]['nome'];
												echo '<option name="'.$nome.'">'.$nome.'</option>'; 	
											}
										}
									}									
									
									echo '</select>';
								}
								
								echo '<br>';
								
								echo "
								<div class=\"form-group\">
															<input type=\"checkbox\" name=\"Read\" value=\"Read\" onclick=\"action = inscricao-cadastro.php\">Estou ciente de que esta inscrição indica, apenas, o horário de preferência para os plantões deste semestre. A decisão final será dada pelo(a) professor(a) escolhido(a).
														</div>
														
														
														<div class=\"form-group\">
															<button type=\"submit\" class=\"btn btn-primary btn-lg btn-block\" onclick=\"ValidateCheckBox('Read')\" name=\"mode\" value=\"escolherplantao\">Ver plantões existentes</button>
														</div>";
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