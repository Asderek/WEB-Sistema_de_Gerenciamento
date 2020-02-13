<?php
	$nomeDoArquivo = "mainProfessor.php";
	$AZUL_ESCURO = "#428BCA";
	$AZUL_CLARO = "#A4DDFF";
	$VERDE_CLARO = "#90FF90";
	$VERMELHO_ESCURO = "#FF5050";
	
	$matricula = $_POST['matricula'];
	
	include ('../../newconexao.php');
	include ("/var/www/npj/www/teste/professor/utils/professores.php");
	include ('calendarioProfessores.php');
	
	$nome = PROFESSORES_GETNAME($matricula);
	
	if (isset($_POST['mesano']))
	{
		$post = $_POST['mesano'];
		$mes = substr($post,0,2);
		$ano = substr($post,2);
	}
	else
	{
		//echo "elso mesano<br>";
		$mes = intval(date('n'));
		$ano = date('Y');
		
		//echo "mes = $mes<br>ano = $ano<br>";
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
	
	if (intval($mes) == 12)
	{
		$displayProximo = $displayMonths[1];
	}
	else 
		$displayProximo = $displayMonths[intval($mes)+1];
	
	if (intval($mes) == 1)
		$displayAnterior = $displayMonths[12];
	else
		$displayAnterior = $displayMonths[intval($mes)-1];
	
		/*echo "
			<table class=\"table table-bordered table-hover\">
						<tbody>";
						
			echo "<tr><td align=\"left\"><button type=\"submit\" value=\"$valorAnterior\" name=\"mesano\" formaction=\"$nomeDoArquivo\">Anterior</button></td>";
			echo "<td align=\"right\"><button type=\"submit\" value=\"$valorProximo\" name=\"mesano\" formaction=\"$nomeDoArquivo\">Proximo</button></td></tr>";
			echo "</tbody></table>";*/
			
	echo "	
			<table class=\"table table-bordered table-hover\">
				<tbody>
					<tr align=\"center\">
						<td colspan=\"7\"><strong>Calendario</strong></td>
					</tr>";
					echo "
									<tr align=\"center\" style=\"background-color:#A0A0A0\">
										<td align=\"left\"><button type=\"submit\" value=\"$valorAnterior\" name=\"mesano\" formaction=\"$nomeDoArquivo\">$displayAnterior</button></td>
										<td colspan=\"5\"><strong>$displayMes-$ano</strong></td>
										<td align=\"right\"><button type=\"submit\" value=\"$valorProximo\" name=\"mesano\" formaction=\"$nomeDoArquivo\">$displayProximo</button></td>
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
							if (($contDias == $currentDoMes) && ($ano == date('Y')) && ($mes == date('m')))
								echo " style=\"vertical-align:middle;background-color:$VERDE_CLARO \" align=\"center\">";
							else
								echo ">";
							CALENDARIO_INSERECONTEUDO($contDias,$mes,$ano, $nome);
							
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