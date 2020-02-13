<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
		html 
		{ 
			background: url(../assets/img/areaprofessor.jpg) no-repeat center center fixed; 
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		.modal-footer {   border-top: 0px; }
	
		.button {
			background-color: #16B7CC;
			border: none;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			width: 70%;
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
			background-color: #0B5B66;
			opacity: 0.6;
			cursor: not-allowed;
		}
	
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
					<h3 class="text-center">Area do Professor</h3>
					</div>
					<div class="modal-body">
								<?php
									
									include('../conexao.php');
									mysql_set_charset("utf8", $conexao);
									
									
										$matricula = $_POST['matricula'];
		
										$inject = false;
										
										
										$injection1 = "DROPTABLE";
										$injection2 = "aluno";
										$injection3 = "ALTER";
										$injection4 = "OR";
										
										$injections = array (	"DROPTABLE","aluno","ALTER","OR","INSERT","DELETE","UPDATE","SELECT");
										
										foreach($injections as $inj)
										{
											if(strpos($matricula,$inj) !== false )
											{
												$inject = true;
											}
										}
										
										if($inject == true)
										{
											echo "My code is sanitized bitch";
											return;
										}
										
										$matricula = filter_var($matricula,FILTER_SANITIZE_NUMBER_INT);
									
										
										$sqlProfessor = "SELECT * FROM professores WHERE matricula = $matricula";
										$queryProfessor = mysql_query($sqlProfessor,$conexao);
										$rowsProfessor = mysql_num_rows($queryProfessor);		

										if($rowsProfessor <= 0)
										{
											echo "Matricula não encontrada";
											return;
										}
										
										$email = mysql_result($queryProfessor,0,'email');
										$nome = mysql_result($queryProfessor,0,'nome');
										
										$senhas = array (	"PUC-Ri0*","NPJ#EM@","n0v4s3nh4","3squec1m1nh4s3nh@","4HQU3MM3D3R4S3R1P31X3","934MatoGrosso","W4SH1ngt0nBR4G4","1NF0RM471K");
										
										$senha = $senhas[rand(0,(count($senhas)-1))];
																				
										$sqlUpdate = "UPDATE `professores` SET `senha`=\"$senha\", `alter` = 1  WHERE matricula = $matricula";
										if($queryUpdate = mysql_query($sqlUpdate,$conexao))
										{
											echo "<h4 class=\"text-center\">Um email foi enviado para você com sua nova senha</h4>";
											echo "<form class=\"form col-md-12 center-block\" action='index.php' method=\"post\">
				
													<div class=\"form-group\">
													  <button align=\"middle\" type=\"submit\" class=\"button2 btn-primary btn-lg btn-block\">Voltar</button>
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
																	
									
								?>
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