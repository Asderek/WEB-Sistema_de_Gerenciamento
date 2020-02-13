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
			table, th, td 
			{
				border: 1px solid black;
				border-collapse: collapse;
			}
			
			.modal-content
			{
				margin-left:                       -512px;
				margin-top:                        0px;
				position:                        relative;
				width:                             150%;
				left:                                 50%;
				top:                                  50%;
			}
			
			.modal-footer {   border-top: 0px; }
			#loginModal { margin-top: 0px;}
			
				.inv {
						display: none;
					 }
			
        </style>
    </head>
    
    
    <body  >
        
        <!--login modal-->
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="text-center">Núcleo de Prática Jurídica</h1><br>
							<h5 class="text-center">Sistemas Implementados no NPJ</h5>
						</div>
						
						<div class="modal-header">
						
						
							<?php
								include('../../conexao.php');
								include('../../injection.php');
								mysql_set_charset("utf8", $conexao);
								
								$index = $_POST['index'];
								$comment = $_POST['comment'];
								
								if(injection($CPF))
								{
									echo "My code is Sanitized";
									return;
								}
								
								$sqlGetComment = "SELECT * FROM `atendimentos` WHERE `index` = $index";
								$queryComment = mysql_query($sqlGetComment,$conexao);
								if ($queryComment)
								{
									$commentInicial = mysql_result($queryComment,0,'comentarios');
								}
								else
								{
									echo "Nao Achei<br><br>";
									return;
								}
								
								$commentInicial = $commentInicial."$".date(DATE_RFC822)."#".$comment;
								
								$data = date(DATE_RFC822);
								$sqlAtendimento = "UPDATE `atendimentos` SET `dataUltimaAtualizacao`=\"$data\",`comentarios`=\"$commentInicial\" WHERE `index` = $index";
								
								$queryAtendimento = mysql_query($sqlAtendimento,$conexao);
								if ($queryAtendimento)
								{
									echo "Atendimento Inserido com Sucesso<br><br>";
								}
								else
								{
									echo "Nao Inserido<br><br>";
								}
									
								
							?>
							
							<div style="float:left">
								<a href="javascript:history.go(-2)" class="btn btn-primary btn-lg btn-block">Ver Informações do Assistido</a>
							</div>
							
							<div style="float:right">
								<a href="http://www.jur.puc-rio.br/npj/teste/" class="btn btn-primary btn-lg btn-block">Pagina Inicial</a>
							</div>
							
							<br><br><br><br>
						</div>
					</div>
				</div>
		</div>



        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
        
        $(document).ready(function() {
        
            
        
        });
        </script>
		
    </body>
</html>