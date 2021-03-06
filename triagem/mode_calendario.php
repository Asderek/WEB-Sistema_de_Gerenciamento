<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <title>NPJ - PUC Rio</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        <script type="text/javascript" src="javascript/index.js"></script>
		
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- CSS code from Bootply.com editor -->
        
        <style type="text/css">
				html 
				{ 
				  background: url(assets/img/bg.jpg) no-repeat center center fixed; 
				  -webkit-background-size: cover;
				  -moz-background-size: cover;
				  -o-background-size: cover;
				  background-size: cover;
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
          <h5 class="text-center">Consulta de Informações dos Assistidos</h5>
      </div>
		<div class="modal-body" id="id_div">

			<form action="index.html">
				<input type="submit" value="Voltar" class="btn btn-primary btn-lg btn-block">
			</form>
			<br>
			<form class="form col-md-12 center-block" id="id_Forma" method="post" action="mode_calendario.php">
				
				<?php
					$nomeDoArquivo = "novoCalendario.php";
					$AZUL_ESCURO = "#428BCA";
					$AZUL_CLARO = "#A4DDFF";
					$VERDE_CLARO = "#90FF90";
					
					include ('../../newconexao.php');
					include ('calendarioSecretaria.php');
					
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
							$insert = $mes;

					}
					
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
					
					
					echo "
							<table class=\"table table-bordered table-hover\">
										<tbody>";
										
							echo "<tr><td align=\"left\"><button type=\"submit\" value=\"$valorAnterior\" name=\"mesano\">Anterior</button></td>";
							echo "<td align=\"right\"><button type=\"submit\" value=\"$valorProximo\" name=\"mesano\">Proximo</button></td></tr>";
							echo "</tbody></table>";
							
					echo "	
							<table class=\"table table-bordered table-hover\">
								<tbody>
									<tr align=\"center\">
										<td colspan=\"7\"><strong>Calendario</strong></td>
									</tr>";
									echo "
									<tr align=\"center\" style=\"background-color:#A0A0A0\">
										<td colspan=\"7\"><strong>$displayMes-$ano</strong></td>
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
													echo "<td";
												}
												else
													echo "<td";
											}
											else
												echo "<td";
											
											{//sqlBloqueio
												$displaySqlMonth = $sqlMonths[intval($mes)];
												if ($contDias < 10)
													$sqlDias = '0'.$contDias;
												else
													$sqlDias = $contDias;
												$sqlBloqueio = "SELECT * FROM `calendario` WHERE `dia` = \"$sqlDias\" AND `mes` = \"$displaySqlMonth\" AND `ano` = \"$ano\" AND `bloqueado` = 1";
												
												$queryBloqueio = $conexao->query($sqlBloqueio);
												if($queryBloqueio != false)
												{
													$resultBloqueio = $queryBloqueio->fetchAll(PDO::FETCH_ASSOC);
													$rowsBloqueio = count($resultBloqueio);									
													if ($rowsBloqueio>0)
													{
														echo " style=\"vertical-align:middle;background-color:$VERMELHO_ESCURO \" align=\"center\" ";
													}
												}
											}
											
											$currentDoMes = intval(date('d'));
											if ($contDias == $currentDoMes)
												echo " style=\"vertical-align:middle;background-color:$VERDE_CLARO \" align=\"center\">";
											else
												echo ">";
											
											
											CALENDARIO_INSERECONTEUDO($contDias,$insert,$ano);
											
											echo "</td>";
										}
										echo "</tr>";
										if($contDias>$limite)
										{
											break;
										}
									}
									
									echo "</tbody></table>";
									
									
							echo "	
							</tbody>
						</table>";
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
        
		document.getElementById("id_div").style.height = (screen.height-screen.height*0.34)+"px";
		//document.getElementById("id_div").style.width = (screen.width-screen.width*0.34)+"px";
            
        
        });
		
        
        </script>
        
    </body>
</html>