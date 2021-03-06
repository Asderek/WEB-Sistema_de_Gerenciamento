<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio 2017</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="javascript/mainProfessorJS.js"></script>
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">

			.panel {
				padding: 0 18px;
				background-color:	#FFFFFA;
				max-height: 0;
				overflow: hidden;
				transition: max-height 0.2s ease-out;
			}
					
			html { 
			  background: url(assets/img/bg.jpg) no-repeat center center fixed;  
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			  min-height: 100%; 
			}
            .modal-footer {   border-top: 0px; }
			#loginModal { margin-top: 0px;}
			
			.modal-content
			{
				margin-left:                       	-750px;
				margin-top:                        	0px;
				position:                        	absolute;
				width:                             	1500px;
				left:                               50%;
				top:                                50%;
				background-color:					#FFFFFA;
			}
			
        </style>
    </head>
    
    
    <body  >
        
        <!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 align="center">Calendario</h1>
			</div>
			<div class="modal-body">
				<form action="cadastraratendimento.php" method="POST">
					
				<?php
					$nomeDoArquivo = "escolhedata.php";
					$AZUL_ESCURO = "#428BCA";
					$AZUL_CLARO = "#A4DDFF";
					$VERDE_CLARO = "#90FF90";
					
					//print_r($_POST);
					include ('../../newconexao.php');
					include ('calendarioTriagem.php');
					
					foreach ($_POST as $a => $b) {
						echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
					}
					
					$diasPossiveis = array();
					$professor = $_POST['responsavel'];
					$sqlResponsavel = "SELECT * FROM `horariosplantao` WHERE `nome` = \"$professor\"";
					$queryResponsavel = $conexao->query($sqlResponsavel);
					if ($queryResponsavel!= false)
					{
						if ($_POST['area']!="PRE-MEDIACAO")
						{
							$resultResponsavel = $queryResponsavel->fetchAll(PDO::FETCH_ASSOC);
							array_push($diasPossiveis,$resultResponsavel[0]['dia1']);
							array_push($diasPossiveis,$resultResponsavel[0]['dia2']);
							array_push($diasPossiveis,$resultResponsavel[0]['dia3']);
						}
						else
						{							
							array_push($diasPossiveis,2);
							array_push($diasPossiveis,3);
							array_push($diasPossiveis,4);
							array_push($diasPossiveis,5);
							array_push($diasPossiveis,6);
						}
					}
					
					
					
					if (isset($_POST['mesano']))
					{
						$post = $_POST['mesano'];
						$mes = substr($post,0,2);
						$ano = substr($post,2);
						$insert = $mes;
					}
					else
					{
						$mes = intval(date('n'));
						$ano = date('Y');						
						if( $mes < 10)
						{
							$insert = '0'.$mes;
						}
						else
						{
							$insert = $mes;
						}

					}
					$ignore = false;
					$firstDayOfTheWeek = date('N',strtotime($ano.'-'.$mes.'-01'));
					
					$DaysOfTheWeek = array("Nothing","Segunda","Terça","Quarta","Quinta","Sexta","Sabado","Domingo");
					$writtenFirstDay = $DaysOfTheWeek[$firstDayOfTheWeek];
					
					$sqlMonths = array("nil","jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez");
					$displayMonths = array("nil","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
					
					$displayMes = $displayMonths[intval($mes)];
					
					$mesAnterior = intval($mes)-1;
					$anoAnterior = intval($ano);
					if ($mesAnterior <= 0)
					{
						$mesAnterior = 12;
						$anoAnterior -= 1;
					}
					if ($mesAnterior <10)
					{
						$mesAnterior = '0'.$mesAnterior;
					}
					$valorAnterior = $mesAnterior.$anoAnterior;
					
					$mesProximo = intval($mes)+1;
					$anoProximo = intval($ano);
					if ($mesProximo>12)
					{
						$mesProximo = 1;
						$anoProximo += 1;
					}
					if ($mesProximo <10)
					{
						$mesProximo = '0'.$mesProximo;
					}
					$valorProximo = $mesProximo.$anoProximo;
					$area = $_POST['area'];
					
					
						echo "
							<h2 class=\"text-center\">$professor - $area</h2>
							<table class=\"table table-bordered table-hover\">
										<tbody>";
										
							echo "<tr><td align=\"left\"><button type=\"submit\" value=\"$valorAnterior\" name=\"mesano\" formaction=\"$nomeDoArquivo\">Anterior</button></td>";
							echo "<td align=\"right\"><button type=\"submit\" value=\"$valorProximo\" name=\"mesano\" formaction=\"$nomeDoArquivo\">Proximo</button></td></tr>";
							echo "</tbody></table>";
							
					echo "	
							<table class=\"table table-bordered table-hover\">
								<tbody>
									<!--<tr align=\"center\">
										<td colspan=\"7\"><strong>Calendario</strong></td>
									</tr>-->";
									echo "
									<tr align=\"center\" style=\"background-color:#A0A0A0\">
										<td colspan=\"7\"><strong>$displayMes - $ano</strong></td>
									</tr>";
									echo "
									<tr style=\"background-color:#A0A0A0\">
										<th>Domingo</th>
										<th>Segunda</th>
										<th>Terça</th>
										<th>Quarta</th>
										<th>Quinta</th>
										<th>Sexta</th>
										<th>Sabado</th>
									</tr>";
								
									$qtdDiasNoMes = array(0,31,28,31,30,31,30,31,31,30,31,30,31);
									
									if(intval(date('L',strtotime($ano.'-'.$mes.'-01'))) == 1)
										$qtdDiasNoMes[2]++;
									
									$limite = $qtdDiasNoMes[intval($mes)];
									
									$contDias=0;
									for($semanas=0;$semanas<6;$semanas++)
									{
										echo "<tr>";
										for($dias=0;$dias<7;$dias++)
										{
											$ignore = false;
											$contDias++;
											if ($contDias>$limite)
											{
												break;		
											}
											if ($semanas == 0)
											{
												if ($firstDayOfTheWeek >= $dias+1)
												{
													$contDias--;
													$ignore = true;
													echo "<td";
												}
												else
												{
													$ignore = false;
													echo "<td";
												}
											}
											else
												echo "<td";
											
											$currentDoMes = intval(date('d'));
											if ($contDias == $currentDoMes)
												echo " style=\"vertical-align:middle;background-color:$VERDE_CLARO \" align=\"center\">";
											else
												echo ">";
											
											$currentDayOfTheWeek = date('N',strtotime($ano.'-'.$mes.'-'.$contDias));
											$currentDayOfTheWeek++;
											
											if ($ignore == true)
											{
												//echo "ignore = true<br>";
											}
											else
											{
												if (in_array($currentDayOfTheWeek,$diasPossiveis))
												{
													CALENDARIO_INSERECONTEUDO($contDias,$insert,$ano, $professor);
												}
											}
											
											echo "</td>";
										}
										echo "</tr>";
										if($contDias>$limite)
										{
											break;
										}
									}
									
									echo "</tbody></table>";
									echo "contDias = $contDias<br>";
									
									
							echo "	
							</tbody>
						</table>";
				?>
				
				</form>
			</div>
			<div class="modal-footer">
			</div>
		</div>
</div>
</div>
        
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


        <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>





        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
        
        $(document).ready(function() {
        
            
        
        });
        
        </script>
        
    </body>
</html>