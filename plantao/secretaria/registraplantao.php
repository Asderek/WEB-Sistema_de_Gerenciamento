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
						<form action="forcarplantao.php" method="post">
								<?php
									
									include('../../newconexao.php');
									$dias = array();
									$starts = array();
									$ends = array();
									$primAtendimentos = array();
									$numAlunos = array();
									$maxAssistidos = array();
									
									
									$professor = $_POST['professor'];
									print_r($_POST);
									
									if (empty($_POST['professor']))
									{
										echo "<button type=\"submit\" formaction=\"inicio.php\" id=\"id_button\"></button>";
										echo "<script>
											document.getElementById('id_button').click();
										</script>";
									}
									for($i=1;$i<4;$i++)
									{
										if(empty($_POST["dia$i"]))
											continue;
										
										if ($_POST["start$i"] == $_POST["end$i"])
										{
											echo "<input type=\"hidden\" value=\"$professor\" name=\"professor\">";
											echo "<h3 class=\"text-center\">Mermao o inicio e fim do plantao nao pode ser a merma hora velho, volta e faz de novo</h3>";
											echo "<input type=\"submit\" class=\"btn btn-primary btn-lg btn-block\" value=\"Voltar\">";
											return;
										}
										array_push($dias,$_POST["dia$i"]);
										array_push($starts,$_POST["start$i"]);
										array_push($ends,$_POST["end$i"]);
										array_push($primAtendimentos,$_POST["primAtendimento$i"]);
										array_push($numAlunos,$_POST["numAlunos$i"]);
										array_push($maxAssistidos,$_POST["numAssistidos$i"]);
									}
									
									$countDias = count($dias);
									echo "numDias = $countDias<br>";
									
									$primeiroDia = 9;
									$primeiroIndice = -1;
									$ultimoDia = -1;
									$ultimoIndice = -1;
									
									for($i=0;$i<count($dias);$i++)
									{
										if ($primeiroDia > $dias[$i])
										{
											$primeiroDia = $dias[$i];
											$primeiroIndice = $i;
										}
										if ($ultimoDia < $dias[$i])
										{
											$ultimoDia = $dias[$i];
											$ultimoIndice = $i;
										}
									}
									for($i=0;$i<count($dias);$i++)
									{
										if ($i == $primeiroIndice)
										{
											$dia1 = $dias[$i];
											$start1 = $starts[$i];
											$end1 = $ends[$i];
											
											$primAtendimento1 = $primAtendimentos[$i];
											$numAluno1 = $numAlunos[$i];
											$maxAssistido1 = $maxAssistidos[$i];
											
										}
										else if ($i == $ultimoIndice)
										{
											if(count($dias)==2)
											{
												$dia2 = $dias[$i];
												$start2 = $starts[$i];
												$end2 = $ends[$i];
												
												$primAtendimento2 = $primAtendimentos[$i];
												$numAluno2 = $numAlunos[$i];
												$maxAssistido2 = $maxAssistidos[$i];
											}
											else
											{
												$dia3 = $dias[$i];
												$start3 = $starts[$i];
												$end3 = $ends[$i];
												
												$primAtendimento3 = $primAtendimentos[$i];
												$numAluno3 = $numAlunos[$i];
												$maxAssistido3 = $maxAssistidos[$i];
											}
										}
										else
										{
											$dia2 = $dias[$i];
											$start2 = $starts[$i];
											$end2 = $ends[$i];
											
											$primAtendimento2 = $primAtendimentos[$i];
											$numAluno2 = $numAlunos[$i];
											$maxAssistido2 = $maxAssistidos[$i];
										}
									}
									
									if (count($dias)<2)
									{
										$dia2 = $start2 = $end2 = 0;
										$primAtendimento2 = 0;
										$numAluno2 = 0;
										$maxAssistido2 = 0;
									}
									if(count($dias)<3)
									{
										$dia3 = $start3 = $end3 = 0;
										$primAtendimento3 = 0;
										$numAluno3 = 0;
										$maxAssistido3 = 0;
									}
									
									$sqlPlantao = "UPDATE `horariosplantao` SET `dia1`=\"$dia1\",`ini1`=\"$start1\",`fim1`=\"$end1\",`dia2`=\"$dia2\",`ini2`=\"$start2\",`fim2`=\"$end2\",`dia3`=\"$dia3\",`ini3`=\"$start3\",`fim3`=\"$end3\",`atendimento1`=\"$primAtendimento1\",`atendimento2`=\"$primAtendimento2\",`atendimento3`=\"$primAtendimento3\",`alunos1`=$numAluno1,`alunos2`=$numAluno2,`alunos3`=$numAluno3,`assistidos1`=$maxAssistido1,`assistidos2`=$maxAssistido2,`assistidos3`=$maxAssistido3 WHERE `nome` = \"$professor\"";
									
									echo "sqlPlantao = $sqlPlantao<br>";
									
									$queryPlantao = $conexao->query($sqlPlantao);
									
									if ($queryPlantao == false)
									{
										echo "Deu pau<br>";
									}
									else
									{
										echo "Foi";
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