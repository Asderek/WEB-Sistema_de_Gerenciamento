<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio 2015</title>
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
					</div>
					
					<?php
					
					include('conexao.php');					
					
					$sql = "SELECT * FROM  `switchboard` WHERE  `nome` =  \"cadastroPlantoes(Professor)\" LIMIT 0 , 30";
					$query = $conexao->query($sql);
					$rows = $query->fetchAll( PDO::FETCH_ASSOC );
					$status = $rows[0]['status'];
					//$query = mysqli_query($sql,$conexao);
					//$status = mysqli_free_result($query,0,'status');
					
					if($status==0)
					{
						echo '
						<div class="modal-body">
							   <h3 class="text-center">O período de cadastro de plantões ainda não começou. <br> Qualquer duvida, por favor, dirija-se à secretaria.<br><br><a href="mailto:npj@puc-rio.com.br"> npj@puc-rio.br</a></h3><br>
							   
							   <a href="javascript:history.go(-1)" class="btn btn-primary btn-lg btn-block">Voltar</a>
						</div>';
					}
					else
					{
						echo "
							<div class=\"modal-body\">
								<form action='cadastro.php' method='post' enctype='multipart/form-data'>
								
									
									<div class=\"form-group\">
										<label for=\"matricula\">Matricula: </label>
										<input type=\"text\"  name=\"matricula\" class=\"form-control input-lg\" placeholder=\"Matricula\">
									</div>
									
									<div class=\"form-group\">
										<button type=\"submit\" class=\"btn btn-primary btn-lg btn-block\">Cadastrar Horarios</button>
										<a href=\"javascript:history.go(-1)\" class=\"btn btn-primary btn-lg btn-block\">Voltar</a>
									</div>
								</form>
							</div>";
					}
					
					?>
					
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
        
        </script>
        
    </body>
</html>