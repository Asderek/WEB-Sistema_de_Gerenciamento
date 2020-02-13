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
          <h5 class="text-center">Login de Professores</h5>
      </div>
	 
		<?php
		

			include('../conexao.php');
			mysql_set_charset("utf8", $conexao);
			
			
			if(isset($_POST['newMat']) && isset($_POST['confirmMat']))
			{
				if($_POST['newMat'] != $_POST['confirmMat'])
				{
					echo "As senhas devem ser iguais";
					return;
				}
				
				
				$senha = $_POST['newMat'];
				$matricula = $_POST['matricula'];
				$nome = $_POST['nome'];
				$email = $_POST['email'];
				
				$sqlUpdate = "UPDATE `professores` SET `senha`=\"$senha\", `alter` = 0  WHERE matricula = $matricula";
				if($queryUpdate = mysql_query($sqlUpdate,$conexao))
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
					
						$headers = 'From: npj@puc-rio.br' . "\r\n" .
					'Reply-To: npj@puc-rio.br' . "\r\n";
						$subject = "NPJ - Alteração de Senha";
						$msg = "Prezada(o) $nome, foi feito um pedido de alteração de senha de acesso à área dos professores \"Acesso Restrito\", do site do NPJ\nSeguem os dados de Login e senha provisória:\n\nMatricula: $matricula\nSenha = $senha\n\n";
						$msg2 = "Por favor, acesse o site (http://www.jur.puc-rio.br/npj), na área de acesso restrito, para cadastrar sua nova senha. \n\nEsta é uma resposta automatica, por favor, não responda a este e-mail.\nQualquer duvida, dirija-se à secretária do NPJ\nNúcleo de Prática Jurídica da PUC-Rio\nEMA - Escritório Modelo de Advocacia\nnpj@puc-rio.br / https://www.facebook.com/npjpuc\nTelefax.:3527-1399";
						$msg = $msg.$msg2;
						mail($email,$subject,$msg,$headers);
					
				}
				else
				{
					echo "error";
				}
			}
			else
			{
				echo "<div class=\"modal-body\">
			  <form class=\"form col-md-12 center-block\" action='opcoes.php' method=\"post\">
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