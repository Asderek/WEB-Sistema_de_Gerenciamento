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
			  background: url(../assets/img/vila.jpg) no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			}
			table, th, td 
			{
				border: 2px solid black;
				border-collapse: collapse;
				border-color: black;
			}
			
			.modal-content
			{
				margin-left:                       -512px;
				margin-top:                        0px;
				position:                        relative;
				width:                             150%;
				left:                                 50%;
				top:                                  50%;
				background-color: rgba(255,255,255,.75) !important;
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
							<h5 class="text-center">Quadro de Chaves para os Sistemas NPJ</h5>
						</div>
					  
						<?php
						
							include('../newconexao.php');
						
							$sql = "SELECT * FROM `switchboard` WHERE 1";
							$query = $conexao->query($sql);
							$rows = $query->fetchAll( PDO::FETCH_ASSOC );
				
							if(isset($_POST['Escolher']))
							{
								
								$butaoClicado = $_POST['Escolher'];
								$stat = $rows[$butaoClicado]['status'];
								//$stat = mysql_free_result($query,$butaoClicado,'status');
								
								
								if($stat==0)
									$stat = 1;
								else
									$stat = 0;
								
								$sqlUpdate = "UPDATE `switchboard` SET `status`=$stat WHERE `index` = $butaoClicado";
								$queryUpdate = $conexao->query($sqlUpdate);
								
								$query = $conexao->query($sql);
								$rows = $query->fetchAll( PDO::FETCH_ASSOC );
								
								//$queryUpdate = mysqli_query($sqlUpdate, $conexao);
							}
						
						
							echo "<div class=\"modal-body\">";
							echo "<form action='index.php' method='post' enctype='multipart/form-data'>";
							
							echo '
											<table class="table table-bordered table-hover" border="2" bordercolor=BLACK >
												<tbody>';
							
							if(count($rows)>0)
							{
								
								for($i=0;$i<count($rows);$i++)
								{
									
									$nome = $rows[$i]['nome'];
									$status = $rows[$i]['status'];
									//$nome = mysql_result($query,$i,'nome');
									//$status = mysql_result($query,$i,'status');
									
									
									echo "
													<tr align='center'>
													<td width='50%'><strong>$nome</strong></td>
													<td width='16.666%'>";
													
													if($status==0)
													{
														echo "<font color=\"FF0000\">";
													}
													else
													{
														echo "<font color=\"0000FF\"><strong>";
													}
													
													echo "ativado</font></strong></td>
													<td width='16.666%'>";
													
													if($status==0)
													{
														echo "<font color=\"0000FF\"><strong>";
													}
													else
													{
														echo "<font color=\"FF0000\">";
													}
													
													echo "desativado</font></strong></td>
													<td width='16.666%'><button type=\"submit\" name=\"Escolher\" value = $i>Alterar</button></td>
													</tr>
													";
								}
							}
							
							echo' 		</tbody>
											</table>';
							
							echo "</div>";
							
						?>
						
						<div class=\"form-group\">
							  <a align="center" class="btn btn-primary btn-lg btn-block" href="https://npj.jur.puc-rio.br/sistemas/">Voltar</a>
						</div>
					
					</div>
				</div>
		</div>




        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
        
        $(document).ready(function() {
        
            
        
        });
		
		function ValidateCheckBox(clickedid) 
			{ 
				if (document.getElementsByName(clickedid)[0].checked == true) 
				{
					return false;
				} 
				else 
				{
					var box= alert("Estou ciente de que esta avaliação possui contrato legal, qualquer falsidade ideologica está passivel de penas legais.");
				}
			}
        
		function SimuladogrowDiv() 
			{
				var growDiv = document.getElementById('SimuladoOptionsDiv');
				if (growDiv.clientHeight) {
				  growDiv.style.height = 0;
				} else {
				  var wrapper = document.querySelector('.measuringWrapper');
				  growDiv.style.height = 100 + "px";
				}
				document.getElementById("SimuladoOptions").value=document.getElementById("SimuladoOptions").value=='Simulado'?'Simulado(fechar)':'Simulado';
			}
			
		function PlantaogrowDiv() 
			{
				var growDiv = document.getElementById('PlantaoOptionsDiv');
				if (growDiv.clientHeight) {
				  growDiv.style.height = 0;
				} else {
				  var wrapper = document.querySelector('.measuringWrapper');
				  growDiv.style.height = 100 + "px";
				}
				document.getElementById("PlantaoOptions").value=document.getElementById("PlantaoOptions").value=='Plantao'?'Plantao(fechar)':'Plantao';
			}
			
		function AvaliacaogrowDiv() 
			{
				var growDiv = document.getElementById('AvaliacaoOptionsDiv');
				if (growDiv.clientHeight) {
				  growDiv.style.height = 0;
				} else {
				  var wrapper = document.querySelector('.measuringWrapper');
				  growDiv.style.height = 100 + "px";
				}
				document.getElementById("AvaliacaoOptions").value=document.getElementById("AvaliacaoOptions").value=='Avaliacao'?'Avaliacao(fechar)':'Avaliacao';
			}
			
		function VisitagrowDiv() 
			{
				var growDiv = document.getElementById('VisitaOptionsDiv');
				if (growDiv.clientHeight) {
				  growDiv.style.height = 0;
				} else {
				  var wrapper = document.querySelector('.measuringWrapper');
				  growDiv.style.height = 100 + "px";
				}
				document.getElementById("VisitaOptions").value=document.getElementById("VisitaOptions").value=='Visita'?'Visita(fechar)':'Visita';
			}
			
		function EstagiogrowDiv() 
			{
				var growDiv = document.getElementById('EstagioOptionsDiv');
				if (growDiv.clientHeight) {
				  growDiv.style.height = 0;
				} else {
				  var wrapper = document.querySelector('.measuringWrapper');
				  growDiv.style.height = 100 + "px";
				}
				document.getElementById("EstagioOptions").value=document.getElementById("EstagioOptions").value=='Estagio'?'Estagio(fechar)':'Estagio';
			}
					
				
        </script>
        
		
		
    </body>
</html>