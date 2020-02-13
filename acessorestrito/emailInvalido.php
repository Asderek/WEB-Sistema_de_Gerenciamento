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
									include('../email.php');
								
									$matricula = $_POST['matricula'];
									$radio = $_POST['tipo'];
	
									$inject = false;
									$injections = array ("DROP TABLE","ALTER TABLE","INSERT","DELETE","UPDATE","SELECT");
																		
									foreach($injections as $inj)
									{
										if(strpos($matricula,$inj) !== false )
										{
											$inject = true;
										}
									}
									
									if($inject == true)
									{										
										$email = "pinheiro.lucasn@gmail.com";
										$sbj = "Tentativa de SQL Injection";
										$msg = "O usuario matricula: $matricula, acabou de tentar um SQL Injection no comentario do caso $indexCaso.<br> O comentario é: $comentario<br>";
										
										EMAIL_SEND_SUPRESSED($email,$sbj,$msg);
										echo "<form id=\"id_auto\" action=\"mainAluno.php\" method=\"post\">";
											echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
											echo "<input type=\"hidden\" name=\"idCaso\" value=\"$indexCaso\">";
											echo "<input type=\"hidden\" name=\"mode\" value=\"mostracaso\">";
											echo "<h3> Don't think I don't know what you're trying to do.</h3>";
											echo "<button type=\"submit\">Voltar</button>";
										echo "</form>";
										return;
									}
																		
									$matricula = filter_var($matricula,FILTER_SANITIZE_NUMBER_INT);
									
									if ($radio==1)
										$sqlProfessor = "SELECT * FROM professores WHERE matricula = $matricula";
									else if ($radio==2)
										$sqlProfessor = "SELECT * FROM alunos WHERE matricula = $matricula";
									
									$queryProfessor = $conexao->query($sqlProfessor);
									$rowsProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );

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
									
									$email = "npj@puc-rio.br";
									$emailAluno = $rowsProfessor[0]['email'];
									$nome = $rowsProfessor[0]['nome'];
									$senha = $rowsProfessor[0]['senha'];
									if ($radio == 1)
										$tel = $rowsProfessor[0]['tel'];
									else
										$tel = $rowsProfessor[0]['telefone'];
									
									echo "<h4 class=\"text-center\">Um email foi enviado para a secretaria com instruções. Aguarde a resposta.</h4>";
									echo "<form class=\"form col-md-12 center-block\" action='index.php' method=\"post\">
		
											<div class=\"form-group\">
											  <button align=\"middle\" type=\"submit\" class=\"button2 btn-primary btn-lg btn-block\">Voltar</button>
											</div>
										  
										</form>";
									/*enviar email*/
										$msg = "O aluno $matricula - $nome solicitou uma alteração de senha, porém não recebeu o email de confirmação. Favor encaminhar este e-mail para o aluno, no email $emailAluno ou pelo telefone $tel.\n\nLogin: $matricula\nSenha: $senha\n\n";
										if ($radio == 1)
											$msg = str_replace("aluno","professor",$msg);
										$subject = "NPJ - Alteração de Senha - Aluno [$matricula] $nome";
										EMAIL_SEND($email,$subject,$msg)
									
									
																
									
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