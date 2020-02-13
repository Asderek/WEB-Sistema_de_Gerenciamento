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
					<h3 class="text-center">Acesso Restrito</h3>
					</div>
					<div class="modal-body">
								<?php
									
									include('../newconexao.php');
								
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
										echo "<a href=\"javascript: window.history.go(-1)\">Voltar</a>";
										return;
									}
									
									$senhas = array (	"PUC-Ri0*","NPJ#EM@","n0v4s3nh4","3squec1m1nh4s3nh@","4HQU3MM3D3R4S3R1P31X3","934MatoGrosso","W4SH1ngt0nBR4G4","1NF0RM471K");
									
									$senha = $senhas[rand(0,(count($senhas)-1))];
									
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
												$sqlUpdate = "UPDATE `NPJ_login` SET `senha`=\"$senha\", `alter` = 1  WHERE `login` = \"$matricula\"";
												$queryUpdate = $conexao->query($sqlUpdate);
									
												//if($queryUpdate = mysql_query($sqlUpdate,$conexao))
												if ($queryUpdate != false)
												{
													echo "<h4 class=\"text-center\">Um email foi enviado para você com sua nova senha</h4>";
													echo "<form class=\"form col-md-12 center-block\" action='index.php' method=\"post\">
						
															<div class=\"form-group\">
															  <button align=\"middle\" type=\"submit\" class=\"button2 btn-primary btn-lg btn-block\">Voltar</button>
															</div>
														  
														</form>";
													
													
													
													/*enviar email*/
													
														$email = "npj@puc-rio.br";
														$headers = 'From: npj@puc-rio.br' . "\r\n" .
													'Reply-To: npj@puc-rio.br' . "\r\n";
														$subject = "NPJ - Alteração de Senha";
														$msg = "Prezada(o) $matricula, foi feito um pedido de alteração de senha de acesso à área dos professores \"Acesso Restrito\", do site do NPJ\nSeguem os dados de Login e senha provisória:\n\nMatricula: $matricula\nSenha = $senha\nCOPIE E COLE esta senha no campo senha.\n\n";
														$msg2 = "Por favor, acesse o site (http://www.jur.puc-rio.br/npj), na área de acesso restrito, para cadastrar sua nova senha. \n\nEsta é uma resposta automatica, por favor, não responda a este e-mail.\nQualquer duvida, dirija-se à secretária do NPJ\nNúcleo de Prática Jurídica da PUC-Rio\nEMA - Escritório Modelo de Advocacia\nnpj@puc-rio.br / https://www.facebook.com/npjpuc\nTelefax.:3527-1399";
														$msg = $msg.$msg2;
														mail($email,$subject,$msg,$headers);
													
												}
												else
												{
													echo "error";
													echo "<a href=\"javascript: window.history.go(-1)\">Voltar</a>";
												}
											}
										}
									}
									
									$matricula = filter_var($matricula,FILTER_SANITIZE_NUMBER_INT);
									
									if ($radio==1)
										$sqlProfessor = "SELECT * FROM professores WHERE matricula = $matricula";
									else if ($radio==2)
										$sqlProfessor = "SELECT * FROM alunos WHERE matricula = $matricula";
									
									$queryProfessor = $conexao->query($sqlProfessor);
									$rowsProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
									//$queryProfessor = mysql_query($sqlProfessor,$conexao);
									//$rowsProfessor = mysql_num_rows($queryProfessor);		

									if(count($rowsProfessor) <= 0)
									{
										echo "<p align=\"center\">Matricula não encontrada<br>";
										echo "
											<div class=\"form-group\">
											  <a align=\"center\" class=\"button2 btn-primary btn-lg\" href=\"javascript: window.history.go(-1)\">Voltar</a>
											</div>
									";
										return;
									}
									
									$email = $rowsProfessor[0]['email'];
									$nome = $rowsProfessor[0]['nome'];
									
									//$email = mysql_result($queryProfessor,0,'email');
									//$nome = mysql_result($queryProfessor,0,'nome');
									
															
									if($radio==1)
										$sqlUpdate = "UPDATE `professores` SET `senha`=\"$senha\", `alter` = 1  WHERE matricula = $matricula";
									else if($radio==2)
										$sqlUpdate = "UPDATE `alunos` SET `senha`=\"$senha\", `alter` = 1  WHERE matricula = $matricula";
									
									$queryUpdate = $conexao->query($sqlUpdate);
									
									//if($queryUpdate = mysql_query($sqlUpdate,$conexao))
									if ($queryUpdate != false)
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
											$msg = "Prezada(o) $nome, foi feito um pedido de alteração de senha de acesso à área dos professores \"Acesso Restrito\", do site do NPJ\nSeguem os dados de Login e senha provisória:\n\nMatricula: $matricula\nSenha = $senha\nCOPIE E COLE esta senha no campo senha.\n\n";
											$msg2 = "Por favor, acesse o site (http://www.jur.puc-rio.br/npj), na área de acesso restrito, para cadastrar sua nova senha. \n\nEsta é uma resposta automatica, por favor, não responda a este e-mail.\nQualquer duvida, dirija-se à secretária do NPJ\nNúcleo de Prática Jurídica da PUC-Rio\nEMA - Escritório Modelo de Advocacia\nnpj@puc-rio.br / https://www.facebook.com/npjpuc\nTelefax.:3527-1399";
											$msg = $msg.$msg2;
											mail($email,$subject,$msg,$headers);
										
									}
									else
									{
										echo "error";
										echo "<a href=\"javascript: window.history.go(-1)\">Voltar</a>";
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