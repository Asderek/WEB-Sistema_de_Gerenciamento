<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio</title>
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

		#submit {
		  background-color: #B33;
		  padding: .5em;
		  -moz-border-radius: 5px;
		  -webkit-border-radius: 5px;
		  border-radius: 6px;
		  color: #fff;
		  font-family: 'Oswald';
		  font-size: 20px;
		  text-decoration: none;
		  border: none;
		}

		#submit:hover {
		  border: none;
		  background-color: #F33;
		  box-shadow: 0px 0px 1px #777;
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
					<h3 class="text-center">Confirme o seu plantão</h3>
					</div>
					<div class="modal-body">
						<form action='cadastro.php' method='post' enctype='multipart/form-data'>
							<?php
								include('conexao.php');
								
								$DiasSelecionados = array();
								$startSelecionados = array();
								$endSelecionados = array();
							
								$matriculaInscrito = $_POST['matricula'];
								echo '<input type="hidden" name="matricula" value='.$matriculaInscrito.'></input>';								
								$area = $_POST['area'];	
								
								echo "matricula = $matriculaInscrito<br>area = $area<br>";
							
								for($dia=2;$dia<7;$dia++)
								{
									for($hora=7;$hora<22;$hora++)
									{
										$end = $hora+1;
										if (isset($_POST[$dia.'-'.$hora.'-'.$end]))
										{
												array_push($DiasSelecionados, $dia);
												array_push($startSelecionados, $hora);
												array_push($endSelecionados, $end);
										}
									}
								}
								
								
								
								for($i=0;$i<count($DiasSelecionados)-1;$i++)
								{
									
									if($DiasSelecionados[$i] == $DiasSelecionados[$i+1])
									{
										if($startSelecionados[$i+1] == $endSelecionados[$i])
										{
											
											$endSelecionados[$i] = $endSelecionados[$i+1];
											array_splice($DiasSelecionados,$i+1,1);
											array_splice($startSelecionados,$i+1,1);
											array_splice($endSelecionados,$i+1,1);
											
											$i=-1;
										}
									}
									
								}
													
								if (count($DiasSelecionados)>3)
								{
									echo '<h5 class="text-center">Por favor, escolha apenas 2 dias</h5><p></p>';
									echo '
											<div class="form-group">
												<button type="submit" class="btn btn-primary btn-lg btn-block">Voltar</button>
											</div>';
								}else if (count($DiasSelecionados)<=0)
								{
									echo '<h5 class="text-center">Por favor, escolha pelo menos 1 dia</h5><p></p>';
									echo '
											<div class="form-group">
												<button type="submit" class="btn btn-primary btn-lg btn-block">Voltar</button>
											</div>';
								}else
								{
									echo "count Dias Selecionados = ".count($DiasSelecionados);
									for($i=0;$i<count($DiasSelecionados);$i++)
									{
										echo "atualizei dia ".($i+1)."<br>";
										$dia = $i+1;
										$str = "UPDATE `horariosplantao` SET `dia$dia`=$DiasSelecionados[$i],`ini$dia`=$startSelecionados[$i],`fim$dia`=$endSelecionados[$i] WHERE (`matricula` = $matriculaInscrito AND `area` = '$area')";									
										
										$sqlUpdate = $str;
										$queryUpdate = $conexao->query($sqlUpdate);
										//$ret[$i] = mysql_query($sqlUpdate,$conexao);
										
									}
									
									while($i<3)
									{
										echo "default dia ".($i+1)."<br>";
										$dia = $i+1;
										$str = "UPDATE `horariosplantao` SET `dia$dia`=0,`ini$dia`=0,`fim$dia`=0 WHERE (`matricula` = $matriculaInscrito AND `area` = '$area')";									
										
										$sqlUpdate = $str;
										$queryUpdate = $conexao->query($sqlUpdate);
										//$ret[$i] = mysql_query($sqlUpdate,$conexao);
										$i++;
										
									}
									
									echo "Por favor confirme sua Solicitação<br><br>";
									echo '<table style="width:100%">';
									
									for($i=0;$i<count($DiasSelecionados);$i++)
									{
										echo '<tr><td align ="center"><b>';
										switch ($DiasSelecionados[$i])
										{
											case 2:
												echo "Segunda";
											break;
											case 3:
												echo "Terça";
											break;
											case 4:
												echo "Quarta";
											break;
											case 5:
												echo "Quinta";
											break;
											case 6:
												echo "Sexta";
											break;
											
										}
										echo '</b></td>';
										
										echo '<td align ="center"><b>';
										if($startSelecionados[$i]<10)
											echo '0';
										echo $startSelecionados[$i].":00 - ";
										if ($endSelecionados[$i]<10)
											echo '0';
										echo $endSelecionados[$i].":00";
										echo '</b></td>';
										
										
										echo '</tr>';
									}
									echo '</table><br><br>';
									
									echo '<table style="width:100%">';
									echo '<tr><td align ="center">';
										echo '<a href="inicio2.html" class="btn btn-primary btn-lg btn-block">Confirmar</a></td>';	
										echo '<td><button id="submit" type="submit" class="btn btn-primary btn-lg btn-block">Voltar</button></td></tr></table>';
									
									
									
								}
								
							?>
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