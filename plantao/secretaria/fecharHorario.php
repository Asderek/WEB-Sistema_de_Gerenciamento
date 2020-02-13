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
						<form action="registraFechamento.php" method="post">
							<?php
								echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
								$sqlPlantoes = "SELECT * FROM `horariosplantao` WHERE `matricula` = $matricula";
								$queryPlantoes = $conexao->query($sqlPlantoes);
								if ($queryPlantoes == false)
									return;
								$resultPlantoes = $queryPlantoes->fetchAll(PDO::FETCH_ASSOC);
								$dia1 = $resultPlantoes[0]['dia1'];
								$ini1 = $resultPlantoes[0]['ini1'];
								$fim1 = $resultPlantoes[0]['fim1'];
								
								$dia2 = $resultPlantoes[0]['dia2'];
								$ini2 = $resultPlantoes[0]['ini2'];
								$fim2 = $resultPlantoes[0]['fim2'];
								
								$dia3 = $resultPlantoes[0]['dia3'];
								$ini3 = $resultPlantoes[0]['ini3'];
								$fim3 = $resultPlantoes[0]['fim3'];
								
								$dias = ["zero","um", "segunda", "terça", "quarta", "quinta", "sexta", "sabado"];
								echo "<h4 class=\"text-center\">Escolha um horario para bloquear</h4>";
								echo "<select name=\"fechamento\" class=\"form-control\">";
									if ($dia1 != 0)
									{
										for($i=$ini1;$i<$fim1;$i++)
										{
											$im1 = $i + 1;
											$diaMostrado = $dias[$dia1];
											$sqlFechado = "SELECT * FROM `NPJ_fechamentoPlantoes` WHERE `matricula`=$matricula AND `dia`=$dia1 AND `inicio`=$i AND `fim`=$im1";
											$queryFechado = $conexao->query($sqlFechado);
											if ($queryFechado == false)
											{
												continue;
											}
											$resultFechado = $queryFechado->fetchAll(PDO::FETCH_ASSOC);
											if(count($resultFechado) > 0)
												echo "<option value=\"UNBLOCK$dia1:$i-$im1\">$diaMostrado - $i ~ $im1 - DESBLOQUEAR</option>";
											else
												echo "<option value=\"$dia1:$i-$im1\">$diaMostrado - $i ~ $im1</option>";
										}
									}
									
									if ($dia2 != 0)
									{
										for($i=$ini2;$i<$fim2;$i++)
										{
											$im1 = $i + 1;
											$diaMostrado = $dias[$dia2];
											$sqlFechado = "SELECT * FROM `NPJ_fechamentoPlantoes` WHERE `matricula`=$matricula AND `dia`=$dia2 AND `inicio`=$i AND `fim`=$im1";
											$queryFechado = $conexao->query($sqlFechado);
											if ($queryFechado == false)
											{
												continue;
											}
											$resultFechado = $queryFechado->fetchAll(PDO::FETCH_ASSOC);
											if(count($resultFechado) > 0)
												echo "<option value=\"UNBLOCK$dia2:$i-$im1\">$diaMostrado - $i ~ $im1 - DESBLOQUEAR</option>";
											else
												echo "<option value=\"$dia2:$i-$im1\">$diaMostrado - $i ~ $im1</option>";
										}
									}
									
									if ($dia3 != 0)
									{
										for($i=$ini3;$i<$fim3;$i++)
										{
											$im1 = $i + 1;
											$diaMostrado = $dias[$dia3];
											$sqlFechado = "SELECT * FROM `NPJ_fechamentoPlantoes` WHERE `matricula`=$matricula AND `dia`=$dia3 AND `inicio`=$i AND `fim`=$im1";
											$queryFechado = $conexao->query($sqlFechado);
											if ($queryFechado == false)
											{
												continue;
											}
											$resultFechado = $queryFechado->fetchAll(PDO::FETCH_ASSOC);
											if(count($resultFechado) > 0)
												echo "<option value=\"UNBLOCK$dia3:$i-$im1\">$diaMostrado - $i ~ $im1 - DESBLOQUEAR</option>";
											else
												echo "<option value=\"$dia3:$i-$im1\">$diaMostrado - $i ~ $im1</option>";
										}
									}
								echo "</select>";
								
							?>
							<br>
							<input type="submit" value="Bloquear" class="btn btn-primary btn-block btn-lg">
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