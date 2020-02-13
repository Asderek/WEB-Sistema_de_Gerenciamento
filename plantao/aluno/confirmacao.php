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
					<h3 class="text-center">Pré-Cadastro de Alunos para Plantão</h3>
					</div>
					<div class="modal-body">
						<form action='inicio.php' method='post' enctype='multipart/form-data'>
								<?php
									
									if (isset($_POST['error']))
									{
										$erro = $_POST['error'];
										echo '<h3 class="text-center">Não foi possivel cadastrar o aluno</h3>';
										echo '<br>';
										echo "<h4 class=\"text-center\">Volte e tente novamente, se o problema persistir, contate a secretaria</h4>";
									}
									else
									{
										$escolha = $_POST['escolha'];
										$professor = $_POST['professor'];
										echo '<h3 class="text-center">Cadastro realizado com sucesso</h3>';
										echo '<br>';
										echo "<h4 class=\"text-center\">Seu horario é $escolha<br> com o(a) professor(a) $professor</h4>";
									}
									
								?>
							
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg btn-block">Voltar</button>
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
			$(document).ready(function() {});				
		</script>
        
    </body>
</html>