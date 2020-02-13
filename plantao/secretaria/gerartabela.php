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
		
		.modal-content
		{
			margin-left:                       -512px;
			margin-top:                        0px;
			position:                        relative;
			width:                             1024px;
			left:                                 50%;
			top:                                  50%;
		}
		
		.modal-footer {   border-top: 0px; }
	
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
					<h3 class="text-center">Relação de Alunos por Horario</h3>
					</div>
					<div class="modal-body">
						
								<?php
									
									include('../../newconexao.php');
												
									$sqlPlantoes = "SELECT  * FROM  `horariosplantao` WHERE  1 ORDER BY  `disciplina`,  `area`,  `nome` ASC";
									$queryPlantao = $conexao->query($sqlPlantoes);
									$resultPlantao = $queryPlantao->fetchAll(PDO::FETCH_ASSOC);
									$auxDisc = "";
									$auxArea = "";
									$countEMA = 1;
									$arrayValidos = ["JUR1961","JUR1962","JUR1963","JUR1964"];
									
									
									
									echo '<table id="printTable" border=\"1\" class="table" style="width:100%; border-color: #000000"><tbody>';
									
									for($i=0;$i<count($resultPlantao);$i++)
									{
										$disciplina = $resultPlantao[$i]['disciplina'];
										$area = $resultPlantao[$i]['area'];
										$nome = $resultPlantao[$i]['nome'];
										
										$dia1 = $resultPlantao[$i]['dia1'];
										$ini1 = $resultPlantao[$i]['ini1'];
										$fim1 = $resultPlantao[$i]['fim1'];
										
										$dia2 = $resultPlantao[$i]['dia2'];
										$ini2 = $resultPlantao[$i]['ini2'];
										$fim2 = $resultPlantao[$i]['fim2'];
										
										$dia3 = $resultPlantao[$i]['dia3'];
										$ini3 = $resultPlantao[$i]['ini3'];
										$fim3 = $resultPlantao[$i]['fim3'];
										
									
										if (!in_array($disciplina,$arrayValidos) || strstr($nome,"NEPOMUCENO") != false)
											continue;
									
										if ($auxDisc != $disciplina)
										{
											echo "<tr bgcolor=\"gray\"><td colspan=\"6\" align=\"center\" style=\"color: white; font-weight: bold; font-size: 25px\">EMA $countEMA</td></tr>";
											echo "<tr bgcolor=\"gray\">
											<td> </td>
											<td align=\"center\" style=\"color: white; font-weight: bold\"> SEGUNDA </td>
											<td align=\"center\" style=\"color: white; font-weight: bold\"> TERÇA </td>
											<td align=\"center\" style=\"color: white; font-weight: bold\"> QUARTA </td>
											<td align=\"center\" style=\"color: white; font-weight: bold\"> QUINTA </td>
											<td align=\"center\" style=\"color: white; font-weight: bold\"> SEXTA </td>
											</tr>";
											$countEMA += 1;
										}
										
										if ($auxArea != $area)
										{
											echo "<tr bgcolor=\"#CCCCCC\"><td colspan=\"6\" align=\"center\" style=\"font-weight: bold\">DIREITO $area</td></tr>";
										}
										
										echo "<tr style=\"font-weight: bold\">
											<td align=\"center\"> $nome </td>
											<td align=\"center\">";
											if ($dia1 == 2)
												echo "$ini1 - $fim1";
											else if ($dia2 == 2)
												echo "$ini2 - $fim2";
											else if ($dia3 == 2)
												echo "$ini3 - $fim3";
											else
												echo "-";
											echo "</td>
											<td align=\"center\">";
											if ($dia1 == 3)
												echo "$ini1 - $fim1";
											else if ($dia2 == 3)
												echo "$ini2 - $fim2";
											else if ($dia3 == 3)
												echo "$ini3 - $fim3";
											else
												echo "-";
											echo "</td>
											<td align=\"center\">";
											if ($dia1 == 4)
												echo "$ini1 - $fim1";
											else if ($dia2 == 4)
												echo "$ini2 - $fim2";
											else if ($dia3 == 4)
												echo "$ini3 - $fim3";
											else
												echo "-";
											echo "</td>
											<td align=\"center\">";
											if ($dia1 == 5)
												echo "$ini1 - $fim1";
											else if ($dia2 == 5)
												echo "$ini2 - $fim2";
											else if ($dia3 == 5)
												echo "$ini3 - $fim3";
											else
												echo "-";
											echo "</td>
											<td align=\"center\">";
											if ($dia1 == 6)
												echo "$ini1 - $fim1";
											else if ($dia2 == 6)
												echo "$ini2 - $fim2";
											else if ($dia3 == 6)
												echo "$ini3 - $fim3";
											else
												echo "-";
											echo "</td>
											</tr>";
										$auxDisc = $disciplina;
										$auxArea = $area;
									}
									
									echo '</tbody></table>';
								
									echo '<br><br>';
										
									
								?>
							
							<button>Print me</button>
							<a href="inicio.php" class="btn btn-primary btn-lg btn-block">página inicial</a>
							<a href="gerartabela.php" class="btn btn-primary btn-lg btn-block">Gerar Tabela</a>
							
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
			function printData()
			{
			   var divToPrint=document.getElementById("printTable");
			   newWin= window.open("");
			   newWin.document.write(divToPrint.outerHTML);
			   newWin.print();
			   newWin.close();
			}

			$('button').on('click',function(){
			printData();
			})
		</script>
        
    </body>
</html>