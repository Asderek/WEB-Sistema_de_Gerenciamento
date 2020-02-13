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
									
									include('../newconexao.php');
									
									$matricula = $_POST['matricula'];
									$senha = $_POST['senha'];
			
									echo '<input type="hidden" name="matricula" value='.$matricula.'></input>';
									
									#{
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
										
									#}
									
									$matricula = filter_var($matricula,FILTER_SANITIZE_NUMBER_INT);
								
									
									$sqlProfessor = "SELECT * FROM professores WHERE matricula = $matricula";
									$queryProfessor = $conexao->query($sqlProfessor);
									$rowsProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
									//$queryProfessor = mysql_query($sqlProfessor,$conexao);
									//$rowsProfessor = mysql_num_rows($queryProfessor);									
								
									/*if(mysql_result($queryProfessor,0,'alter') == 1)
									{
																			
										$email = mysql_result($queryProfessor,0,'email');
										$nome = mysql_result($queryProfessor,0,'nome');

										echo "  
												<form class=\"form col-md-12 center-block\" action='index.php' method=\"post\">
				
				
												    <input type=\"hidden\" name=\"matricula\" value=\"$matricula\"></input>
													<input type=\"hidden\" name=\"nome\" value=\"$nome\"></input>
													<input type=\"hidden\" name=\"email\" value=\"$email\"></input>
				
													<div class=\"form-group\">
													  <input type=\"password\" name=\"newMat\" class=\"form-control input-lg\" placeholder=\"Nova Senha\" required>
													</div>				
													
													<div class=\"form-group\">
													  <input type=\"password\" name=\"confirmMat\" class=\"form-control input-lg\" placeholder=\"Repita a Senha\" required>
													</div>	
													
													<div class=\"form-group\">
													  <button type=\"submit\" class=\"button2 btn-primary btn-lg \">Enviar</button>
													</div>
											  
												</form>		
											";
									}
									else*/
									{
										
										echo "<div align = \"center\" class=\"form-group\">";
											echo "	<form action=\"https://npj.jur.puc-rio.br/visita/professor/consulta.php\" method=\"post\">
														<button align = \"center\" type=\"submit\" name=\"matricula\" value=\"$matricula\" class=\"button btn-primary btn-lg\">Consultar Eventos</button>
													</form><br>";
										echo "</div>";
										
										
										echo "<div align = \"center\" class=\"form-group\">";
											echo "	<form action=\"https://npj.jur.puc-rio.br/plantao/professor/analise.php\" method=\"post\">
														<button align = \"center\" type=\"submit\" name=\"matricula\" value=\"$matricula\" class=\"button btn-primary btn-lg\">Ver Relação de Plantão</button>
													</form><br>";
										echo "</div>";
									
										echo "<div align = \"center\" class=\"form-group\">";
											echo "	<form action=\"https://npj.jur.puc-rio.br/simulado/professor/resultado.php\" method=\"post\">
														<button align = \"center\" type=\"submit\" name=\"matricula\" value=\"$matricula\" class=\"button btn-primary btn-lg\">Resultado Simulado</button>
													</form><br>";
										echo "</div>";
										
										if (true)
										{
											echo "<div align = \"center\" class=\"form-group\">";
												echo "	<form action=\"https://npj.jur.puc-rio.br/monitoria/professor/resultado.php\" method=\"post\">
															<button align = \"center\" type=\"submit\" name=\"matricula\" value=\"$matricula\" class=\"button btn-primary btn-lg\">Monitoria</button>
														</form><br>";
											echo "</div>";
										}
										
										$sql = "SELECT * FROM  `switchboard` WHERE  `nome` =  \"cadastroPlantoes(Professor)\" LIMIT 0 , 30";
										$query = $conexao->query($sql);
										$result = $query->fetchAll( PDO::FETCH_ASSOC );
										$status = $result[0]['status'];
										//$query = mysql_query($sql,$conexao);
										//$status = mysql_result($query,0,'status');
										
										if($status==1)
										{
											echo "<div align = \"center\" class=\"form-group\">";
											echo "	<form action=\"https://npj.jur.puc-rio.br/plantao/professor/cadastro/cadastro.php\" method=\"post\">
															<button  ";
											
											
											echo "type=\"submit\" name=\"matricula\" value=\"$matricula\" class=\"button btn-primary btn-lg\">Cadastrar Plantoes</button>
												</form><br>";
											echo "</div>";	
										}
																		
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