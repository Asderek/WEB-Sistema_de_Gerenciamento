<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio 2017</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
			html { 
			  background: url(../assets/img/areaprofessor.jpg) no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			}
			.button {
				background-color: #085966;
				border: none;
				color: white;
				padding: 10px 39px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 19px;
				width: 49%;
				font-weight: bold;
			}
			
			.button2 {
				background-color: #085966;
				border: none;
				color: white;
				padding: 10px 39px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 19px;
				width: 49%;
				margin-left: 25%;
				font-weight: bold;
			}
			
			.button:hover {
				box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
			}
			
			button:disabled {
				background-color: #085966;
				opacity: 0.7;
				cursor: not-allowed;
			}
			
			label {
				cursor: default;
				font-size: 20px;
			}
			
			input[type=radio] {
				border: 0px;
				width: 100%;
				height: 1.5em;
			}
			
			.button-link
			{
				background:							none;
				color:								blue;
				border:								none; 
				padding:							0;
				font: 								inherit;
				border-bottom:						1px solid #444; 
				cursor: 							pointer;
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
          <h5 class="text-center">Acesso Restrito</h5>
      </div>
	 
		<?php
		

			include('../newconexao.php');
			include('../email.php');
			
			
			if(isset($_POST['newMat']) && isset($_POST['confirmMat']))
			{
				if($_POST['newMat'] != $_POST['confirmMat'])
				{
					echo "<p align=\"center\">Senha incorreta<br>";
					echo "
							<div class=\"form-group\">
							  <a align=\"center\" class=\"button2 btn-primary btn-lg\" href=\"javascript: window.history.go(-1)\">Voltar</a>
							</div>";
							return;
				}
				
				
				$senha = $_POST['newMat'];
				$matricula = $_POST['matricula'];
				$nome = $_POST['nome'];
				$email = $_POST['email'];
				
				$radio = $_POST['tipo'];
				
				if($radio == 1)
				{
					$sqlSecretaria = "SELECT * FROM `NPJ_login` WHERE `login` = \"$matricula\"";
					$querySecretaria = $conexao->query($sqlSecretaria);
					if ($querySecretaria != false)
					{
						$resultSecretaria = $querySecretaria->fetchAll(PDO::FETCH_ASSOC);
						if ( count($resultSecretaria) != 0)
						{
							$sqlUpdate = "UPDATE `NPJ_login` SET `senha`=\"$senha\", `alter` = 0  WHERE `login` = \"$matricula\"";
							$queryUpdate = $conexao->query($sqlUpdate);
				
							if($queryUpdate != false)
							{
								echo "<h4 class=\"text-center\">Um email foi enviado para você com sua nova senha</h4>";
								echo "<form class=\"form col-md-12 center-block\" action='index.php' method=\"post\">

										<div class=\"form-group\">
										<div class=\"form-group\">
										  <button type=\"submit\" class=\"button2 btn-primary btn-lg \">Fazer Login</button>
										</div>
										</div>
									  
									</form>";
								
								/*enviar email*/
								$subject = "NPJ - Alteração de Senha";
								$msg = "Prezada(o) $matricula, foi feito um pedido de alteração de senha de acesso à área restrita \"Acesso Restrito\", do site do NPJ\nSeguem os dados de Login e senha:\n\nMatricula: $matricula\nSenha = $senha\n\n";
								EMAIL_SEND("npj@puc-rio.br",$subject,$msg);
							}
							else
							{
								echo "error";
								echo "<a href=\"javascript: window.history.go(-2)\">Voltar</a>";
							}
							return;
						}
					}
				}
				
				if($radio==1)
					$sqlUpdate = "UPDATE `professores` SET `senha`=\"$senha\", `alter` = 0  WHERE matricula = $matricula";
				else if ($radio==2)
					$sqlUpdate = "UPDATE `alunos` SET `senha`=\"$senha\", `alter` = 0  WHERE matricula = $matricula";
				$queryUpdate = $conexao->query($sqlUpdate);
				
				if($queryUpdate != false)
				{
					echo "<h4 class=\"text-center\">Um email foi enviado para você com sua nova senha</h4>";
					echo "<form class=\"form col-md-12 center-block\" action='index.php' method=\"post\">

							<div class=\"form-group\">
							<div class=\"form-group\">
							  <button type=\"submit\" class=\"button2 btn-primary btn-lg \">Fazer Login</button>
							</div>
							</div>
						  
						</form>";
					
					
					
					/*enviar email*/
					$subject = "NPJ - Alteração de Senha";
					$msg = "Prezada(o) $nome, foi feito um pedido de alteração de senha de acesso à área restrita \"Acesso Restrito\", do site do NPJ\nSeguem os dados de Login e senha provisória:\n\nMatricula: $matricula\nSenha = $senha\n\n";
					EMAIL_SEND(EMAIL_GET($matricula),$subject,$msg);
					
				}
				else
				{
					echo "error";
					echo "<a href=\"javascript: window.history.go(-2)\">Voltar</a>";
				}
			}
			else
			{
				echo "<div>
					<form class=\"form col-md-12 center-block\" action='opcoes.php' method=\"post\">

						<div class=\"form-group\">
							<table class=\"table\"><tr align=\"center\"><td width = 50%>
							  <input type=\"radio\"  name=\"tipo\"  value=\"1\" required><label>Professor</td>
							  <td width = 50%><input type=\"radio\"  name=\"tipo\"  value=\"2\" required> <label>Aluno</td>
							  </tr>
							 </table>
						</div>

						<div class=\"form-group\">
						  <input type=\"text\"  name=\"matricula\" class=\"form-control input-lg\" placeholder=\"Matrícula\" required>
						</div>

						<div class=\"form-group\">
						  <input type=\"password\"  name=\"senha\" class=\"form-control input-lg\" placeholder=\"Senha\">
						</div>

						<div class=\"form-group\">
						  <button type=\"submit\" class=\"button btn-primary btn-lg \">Login</button>
						  <button type=\"submit\" class=\"button btn-primary btn-lg\" formaction=\"senha.php\">Esqueci a Senha</button>
						</div>
						
						<div class=\"form-group\" align=\"center\">
						  <a href=\"javascript:history.go(-1)\" class=\"button btn-primary btn-lg btn-block\">Voltar</a>
						</div>
						
						<div class=\"form-group\" align=\"center\">
						  Clique <button class=\"button-link\" formaction=\"emailInvalido.php\">aqui</button> caso não tenha recebido o email
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