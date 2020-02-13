<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio 2015</title>
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
			#loginModal { margin-top: 0px;}
        </style>
    </head>
    
    
    <body  >
        
        <!--login modal-->
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="text-center">Núcleo de Prática Jurídica</h1><br>
						<h3 class="text-center">Cadastro de Alunos para Plantao</h3>						
					</div>
					
					<div class="modal-body">
						<form action='relatorio.php' method='post' enctype='multipart/form-data'>							
								<?php
								include('../../newconexao.php');	
								
								
								$sqlProfessor = "SELECT * FROM horariosplantao WHERE 1";
								$queryProfessor = $conexao->query($sqlProfessor);
								$rowsProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
								
								if(count($rowsProfessor) <= 0)
								{
									echo 'deu bug';
									echo '<a href="http://bit.ly/IqT6zt" class="btn btn-primary btn-lg btn-block">Back</a>';	
								}
								else
								{
									echo '<label for="Professor">Professor: </label>';
									echo '<select class="form-control" id="professor" name="professor">';
 									
									for($i=0;$i<count($rowsProfessor);$i++)
									{
										$nome = $rowsProfessor[$i]['nome'];
										echo '<option name="'.$nome.'">'.$nome.'</option>;'; 	
									}									
									
									echo '</select>';
								}
								
								echo '<br>';
							?>							
							
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg btn-block" onclick="ValidateCheckBox('Read')">Ver relação de alunos</button>
								<a href="https://npj.jur.puc-rio.br/plantao/secretaria/verplantoes.php" class="btn btn-primary btn-lg btn-block">Ver Todos os Plantoes</a>
								<input type="submit" formaction="forcarplantao.php" value="Forçar Plantao" class="btn btn-primary btn-lg btn-block">
								<input type="submit" formaction="inserirAluno.php" value="Forçar Inscrição de Aluno" class="btn btn-primary btn-lg btn-block">
								<button type="submit" formaction="zerarPlantao.php" name="novosemestre" value="true" onclick="return avisa();" class="btn btn-primary btn-lg btn-block">Zerar Plantões e Remover Alunos<br> (novo semestre)</button>
								<button type="submit" formaction="zerarPlantao.php" name="novociclo" value="true" onclick="return avisa();" class="btn btn-primary btn-lg btn-block">Novo Ciclo de Plantões</button>
								<button type="submit" formaction="bloquearPlantao.php" class="btn btn-primary btn-lg btn-block">Bloquear Horario</button>
								<button type="submit" formaction="fecharHorario.php" class="btn btn-primary btn-lg btn-block">Impedir inscrição de Aluno</button>
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
		
		function avisa()
		{
			return confirm("Essa ação vai zerar os plantoes e remover todos os alunos inscritos em plantao. Ta de boa isso ai vei?");
		}
        
        </script>
        
    </body>
</html>