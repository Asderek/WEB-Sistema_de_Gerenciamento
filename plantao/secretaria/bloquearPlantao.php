<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio 2015</title>
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
			.modal-footer {   border-top: 0px; }
			#loginModal { margin-top: 0px;}
        </style>
    </head>
    
    
	<?php
		include('../../newconexao.php');
		include('../../teste/utils/professores.php');
		$professor = $_POST['professor'];
		$matricula = PROFESSORES_GETMATRICULABYNAME($professor);
	?>
	
    <body  >
        
        <!--login modal-->
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="text-center">Bloqueio de Horarios de Plantão</h1><br>
						<h3 class="text-center">Professor(a): <?php echo $professor; ?></h3>						
					</div>
					
					<div class="modal-body">
						<form action="registrarBloqueio.php" method="post">
						<?php
						
							echo '
										<table style="width:100%">
											<tr>
												<td align ="center"><b>Horario</b></td>
												<td align ="center"><b>Segunda</b></td>
												<td align ="center"><b>Terça</b></td> 
												<td align ="center"><b>Quarta</b></td>
												<td align ="center"><b>Quinta</b></td> 
												<td align ="center"><b>Sexta</b></td>
											</tr>';
								
										echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
										
										for($hora = 8;$hora<21;$hora++)
										{
											$display = true;
											$aula = false;
											$end = $hora+1; 
											if($hora % 2 == 0)
												echo '<tr bgcolor="#DDDDDD">';
											else
												echo '<tr>';
											echo '<td align="center"><label for="nome">'.$hora.':00-'.$end.':00</label></td>';
											
											for($dia=2;$dia<7;$dia++)
											{
												$checked = false;
												$sqlChecked = "SELECT * FROM `NPJ_bloqueioPlantoes` WHERE `matricula` = $matricula AND `dia` = $dia AND `hora` = $hora";
												$queryChecked = $conexao->query($sqlChecked);
												if ($queryChecked != false)
												{
													$resultChecked = $queryChecked->fetchAll(PDO::FETCH_ASSOC);
													if (count($resultChecked) > 0)
														$checked = true;
												}
												echo '<td align="center"><input type="checkbox" name="'.$dia.'-'.$hora.'-'.$end.'" "'.$hora.'-'.$end.'"';
													if ($checked == true)
														echo " checked";
												echo '></td>';
											}
											echo '</tr>';
											
											
										}
										
										echo '</table><br><br>';
										
										echo '
											<div class="form-group">
												<button type="submit" class="btn btn-primary btn-lg btn-block">Ir para Passo 2 &rarr;</button>
											</div>';
						
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
        
        $(document).ready(function() {
        
            
        
        });
		
		function avisa()
		{
			return confirm("Essa ação vai zerar os plantoes, valeu?");
		}
        
        </script>
        
    </body>
</html>