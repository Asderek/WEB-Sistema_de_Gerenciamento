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
						<form action='opcoes.php' method='post' enctype='multipart/form-data'>
						
							<?php
								include('conexao.php');	
								
								$sqlLive = "SELECT * FROM  `switchboard` WHERE  `nome` =  \"inscricaoPlantoes(Alunos)\" LIMIT 0 , 30";
								$queryLive = $conexao->query($sqlLive);
								$result = $queryLive->fetchAll( PDO::FETCH_ASSOC );
								$status = $result[0]['status'];
																
								if($status == 0)
								{
									echo '<h5 class="text-center">O processo de inscrição de plantão foi encerrado<br></h5>';
									echo '<h5 class="text-center">Qualquer dúvida, entre em contato com o professor do plantão<br></h5>';
									echo '<br>';
									echo '<a href=javascript:history.go(-1) class="btn btn-primary btn-lg btn-block">Voltar</a>';
									return;
								}
								
								if (isset($_POST['matricula']))
								{
									$matricula = $_POST['matricula'];
									echo "<div class=\"form-group\">
											<label for=\"matricula\">Matricula: </label>
											<input type=\"text\"  name=\"matricula\" class=\"form-control input-lg\" value=\"$matricula\">
										</div>";
								}
								else
								{
									echo "<div class=\"form-group\">
											<label for=\"matricula\">Matricula: </label>
											<input type=\"number\"  name=\"matricula\" class=\"form-control input-lg\" placeholder=\"Matricula\">
										</div>";
								}
								
								echo '<br>';
							?>
							
							<div class="form-group">
								<input type="checkbox" name="Read" value="Read" onclick="action = inscricao-cadastro.php">Estou ciente de que esta inscrição indica, apenas, o horário de preferência para os plantões deste semestre. A decisão final será dada pelo(a) professor(a) escolhido(a).
							</div>
							
							
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg btn-block" onclick="ValidateCheckBox('Read')">Ver plantões existentes</button>
								<a href="javascript:history.go(-1)" class="btn btn-primary btn-lg btn-block">Voltar</a>
							</div>
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