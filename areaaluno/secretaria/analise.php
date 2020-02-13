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
		
		input.a{
			border: 0;
		}

		h4, h5
		{
			font-weight:bold;
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
          <h4 class="text-center">Dados Academicos da Aluna</h4>
      </div>
      <div class="modal-body">
		<form class="form col-md-12 center-block" action='confirmacao.php' method="post">
      
	<?php
		include('../../newconexao.php');
		include('../../teste/utils/professores.php');
		
		/*if(is_null($_POST['matricula']));
		{
			$mat = $_POST['matricula'];
			echo "mat = $mat<br>";
			echo "Deu Pau";
			return;
		}*/
		
		$matricula = $_POST['matricula'];
		$nomeProfessorMonitoria = ""; 
		
		$sqlMonitor = "SELECT * FROM monitores WHERE monitor = $matricula";
		$queryMonitor = $conexao->query($sqlMonitor);
		if($queryMonitor != false)
		{
			$resultMonitor = $queryMonitor->fetchAll(PDO::FETCH_ASSOC);
			if (count($resultMonitor > 0))
			{
				$professorMonitoria = $resultMonitor[0]['professor'];
				$nomeProfessorMonitoria = PROFESSORES_GETNAME($professorMonitoria);
			}
		}
		
		$ema34 = false;
		$sql34 = "SELECT * FROM `alunos` WHERE `matricula` LIKE \"%$matricula%\"";
		$query34 = $conexao->query($sql34);
		if ($query34 != false)
		{
			$result34 = $query34->fetchAll(PDO::FETCH_ASSOC);
			if (count($result34) > 1)
				$ema34 = true;
		}
		
		$sqlMatricula = "SELECT * FROM `alunos` WHERE matricula = $matricula";
		$queryMatricula = $conexao->query($sqlMatricula);
		if($queryMatricula != false)
		{
			$rowsMatricula = $queryMatricula->fetchAll( PDO::FETCH_ASSOC );
		}
		
		
		echo "<input type='hidden' name='matricula' value='$matricula'/>";	
	
		
		if(count($rowsMatricula)<0)
		{
			echo "Matricula nao encontrada somehow wtf??";
		}
		
		$nome = $rowsMatricula[0]['nome'];
		$turma = $rowsMatricula[0]['turma'];
		$professor = $rowsMatricula[0]['professor'];
		$disciplina = $rowsMatricula[0]['disciplina'];
		$email = $rowsMatricula[0]['email'];
		$tel = $rowsMatricula[0]['telefone'];
		$oab = $rowsMatricula[0]['oab'];
		$oficina = $rowsMatricula[0]['oficina'];
		$primeiraFase = $rowsMatricula[0]['primfase'];
		$L1 = $rowsMatricula[0]['l1'];
		$horas = $rowsMatricula[0]['horas'];
		
		$hora1 = $rowsMatricula[0]['hora1'];
		$hora2 = $rowsMatricula[0]['hora2'];
		
		$professorPlantao = PROFESSORES_GETPROFESSORPLANTAONAME($matricula);
		
		if($L1 < 0)
			$L1 = "Ainda não possui";
		else
			$L1 = number_format($L1,2);
		
		$array = array();
		
		array_push($array,$rowsMatricula[0]['atual1']);
		array_push($array,$rowsMatricula[0]['atual2']);
		array_push($array,$rowsMatricula[0]['passado1']);
		array_push($array,$rowsMatricula[0]['passado2']);
		
		$editP1 = true;
		$editP2 = true;
		$editA1 = true;
		$editA2 = true;
		
		if ($array[0] == -1 || $array[0] == -2)
			$editA1 = false;
		if ($array[1] == -1 || $array[1] == -2)
			$editA2 = false;
		
		
		foreach($array as $key => $value)
		{
			if ($value>=0)
			{
				
			}
			else if ($value == -1)
			{
				$array[$key] = "Inscrito";
			}
			else if ($value == -2)
			{
				$array[$key] = "Em processamento";
			}
			else
			{
				$array[$key] = "Não Realizou";
			}
		}
		
		
		
		echo "
				<table class=\"table table-bordered table-striped table-hover\">
					<tr>
						<td>Matricula</td>
						<td colspan=\"2\">$matricula</td>
					</tr>
					<tr>
						<td>Nome</td>
						<td colspan=\"2\">$nome</td>
					</tr>
					<tr>
						<td>Disciplina</td>
						<td colspan=\"2\">
							<select name=\"disciplina\" align=\"center\">
								<option value=\"JUR1961\" "; if ($disciplina=="JUR1961") echo "selected"; echo">JUR1961</option>
								<option value=\"JUR1962\" "; if ($disciplina=="JUR1962") echo "selected"; echo">JUR1962</option>
								<option value=\"JUR1963\" "; if ($disciplina=="JUR1963") echo "selected"; echo">JUR1963</option>
								<option value=\"JUR1964\" "; if ($disciplina=="JUR1964") echo "selected"; echo">JUR1964</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Turma</td>
						<td colspan=\"2\">
							<select name=\"turma\" align=\"center\">
								<option value=\"2HA\" "; if ($turma=="2HA") echo "selected"; echo">2HA</option>
								<option value=\"2HB\" "; if ($turma=="2HB") echo "selected"; echo">2HB</option>
								<option value=\"2HC\" "; if ($turma=="2HC") echo "selected"; echo">2HC</option>
								<option value=\"2HD\" "; if ($turma=="2HD") echo "selected"; echo">2HD</option>
								<option value=\"2HE\" "; if ($turma=="2HE") echo "selected"; echo">2HE</option>
								<option value=\"2HF\" "; if ($turma=="2HF") echo "selected"; echo">2HF</option>
								<option value=\"2HX\" "; if ($turma=="2HX") echo "selected"; echo">2HX</option>
								<option value=\"2HY\" "; if ($turma=="2HY") echo "selected"; echo">2HY</option>
								<option value=\"2HZ\" "; if ($turma=="2HZ") echo "selected"; echo">2HZ</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Professor</td>
						<td colspan=\"2\">
							<select name=\"professor\" align=\"center\">";
							
								{
									$sqlProfessor = "SELECT * FROM `professores` WHERE 1";
									$queryProfessor = $conexao->query($sqlProfessor);
									$resultProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
									$rowsProfessor = count($resultProfessor);
									
									for ($i=0;$i<$rowsProfessor;$i++)
									{
										$nome = $resultProfessor[$i]['nome'];
										echo "<option value=\"$nome\" ";
										if ($professor == $nome)
												echo "selected";
										echo ">$nome</option>";
									}
								}
							echo "</select>
						</td>
					</tr>
					<tr>
						<td>Professor Plantão</td>
						<td colspan=\"2\">
							$professorPlantao
						</td>
					</tr>";
					if ($nomeProfessorMonitoria != "")
					{ 
						echo "
							<tr>
							<td>Aluno é monitor de</td>
							<td colspan=\"2\">
								$nomeProfessorMonitoria
							</td>
						</tr>";
					}
					
						$cont = 0;
						if ($ema34 == true)
						{
							for($i=0;$i<count($result34);$i++)
							{
								if ($result34[$i]['matricula'] == $matricula)
									continue;
								
								$matricula34 = $result34[$i]['matricula'];
								echo "<input type=\"hidden\" name=\"extraMat$cont\" value=\"$matricula34\">";
								$cont++;
								
								$nome34 = $result34[$i]['nome'];
								$turma34 = $result34[$i]['turma'];
								$professor34 = $result34[$i]['professor'];
								$disciplina34 = $result34[$i]['disciplina'];
								
								$professorPlantao34 = PROFESSORES_GETPROFESSORPLANTAONAME($matricula34);
								
								echo "
								<tr>
									<td colspan=\"3\" style=\"background-color: #1A1A1A;\"> </td>
								</tr>
								<tr>
									<td>Matricula</td>
									<td colspan=\"2\">$matricula34</td>
								</tr>
								<tr>
									<td>Nome</td>
									<td colspan=\"2\">$nome34</td>
								</tr>
								<tr>
									<td>Disciplina</td>
									<td colspan=\"2\">
										<select name=\"disciplina$matricula34\" align=\"center\">
											<option value=\"JUR1961\" "; if ($disciplina34=="JUR1961") echo "selected"; echo">JUR1961</option>
											<option value=\"JUR1962\" "; if ($disciplina34=="JUR1962") echo "selected"; echo">JUR1962</option>
											<option value=\"JUR1963\" "; if ($disciplina34=="JUR1963") echo "selected"; echo">JUR1963</option>
											<option value=\"JUR1964\" "; if ($disciplina34=="JUR1964") echo "selected"; echo">JUR1964</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Turma</td>
									<td colspan=\"2\">
										<select name=\"turma$matricula34\" align=\"center\">
											<option value=\"2HA\" "; if ($turma34=="2HA") echo "selected"; echo">2HA</option>
											<option value=\"2HB\" "; if ($turma34=="2HB") echo "selected"; echo">2HB</option>
											<option value=\"2HC\" "; if ($turma34=="2HC") echo "selected"; echo">2HC</option>
											<option value=\"2HD\" "; if ($turma34=="2HD") echo "selected"; echo">2HD</option>
											<option value=\"2HE\" "; if ($turma34=="2HE") echo "selected"; echo">2HE</option>
											<option value=\"2HF\" "; if ($turma34=="2HF") echo "selected"; echo">2HF</option>
											<option value=\"2HX\" "; if ($turma34=="2HX") echo "selected"; echo">2HX</option>
											<option value=\"2HY\" "; if ($turma34=="2HY") echo "selected"; echo">2HY</option>
											<option value=\"2HZ\" "; if ($turma34=="2HZ") echo "selected"; echo">2HZ</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Professor</td>
									<td colspan=\"2\">
										<select name=\"professor$matricula34\" align=\"center\">";
											{
												$sqlProfessor = "SELECT * FROM `professores` WHERE 1";
												$queryProfessor = $conexao->query($sqlProfessor);
												$resultProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
												$rowsProfessor = count($resultProfessor);
												
												for ($i=0;$i<$rowsProfessor;$i++)
												{
													$nome = $resultProfessor[$i]['nome'];
													echo "<option value=\"$nome\" ";
													if ($professor34 == $nome)
															echo "selected";
													echo ">$nome</option>";
												}
											}
										echo "</select>
									</td>
								</tr>
								<tr>
									<td>Professor Plantão</td>
									<td colspan=\"2\">
										$professorPlantao34
									</td>
								</tr>";
								
							}
						}
					
					echo "
					<tr>
						<td>Telefone</td>
						<td colspan=\"2\"><input type\"text\" name=\"tel\" value=\"$tel\" ></td>
					</tr>
					<tr>
						<td>Email</td>
						<td colspan=\"2\"><input type\"text\" name=\"email\" value=\"$email\" ></td>
					</tr>
					<tr>
						<td colspan=\"3\" align=\"center\"><b>NOTAS</b></td>
					</tr>
					<tr>
						<td>OAB</td>
						<td colspan=\"2\"><input type=\"checkbox\" name=\"oab\" ";
						
					if($oab==1)
						echo "checked";
						
						echo "></td>
					</tr>
					<tr>
						<td>Oficina</td>
						<td colspan=\"2\"><input type=\"checkbox\" name=\"oficina\" ";
						
					if($oficina==1)
						echo "checked";
						
						echo "></td>
					</tr>					
					<tr>
						<td>Primera Fase OAB</td>
						<td colspan=\"2\" align=\"center\"><input type\"text\" name=\"primFase\" value=\"$primeiraFase\" ></td>
					</tr>					
					<tr>
						<td>Total de Horas</td>
						<td colspan=\"2\" align=\"center\">$horas</td>
					</tr>
					<!--<tr>
						<td>Primera Fase OAB</td>
						<td colspan=\"2\" align=\"center\">$primeiraFase</td>
					</tr>-->
					<tr>
						<td align=\"center\"><b></b></td>
						<td align=\"center\"><b>Sim1</b></td>
						<td align=\"center\"><b>Sim2</b></td>
					</tr>";
					
					echo "<tr>
								<td>Horas</td>";
							echo "<td align=\"center\">$hora1</td>";
							echo "<td align=\"center\">$hora2</td>";
					echo "</tr>";
					
					echo "<tr>
								<td>Semestre Atual</td>";
								if ($editA1 == true)
									echo "<td><input type=\"text\" value=\"$array[0]\" name=\"atual1\"></td>";
								else
									echo "<td><input type=\"text\" style=\"border: none;background: transparent\" value=\"$array[0]\" readonly name=\"atual1\"></td>";
								
								if ($editA2 == true)
									echo "<td><input type=\"text\" value=\"$array[1]\" name=\"atual2\"></td>";
								else
									echo "<td><input type=\"text\" style=\"border: none;background: transparent\" value=\"$array[1]\" readonly name=\"atual2\"></td>";
						  echo "</tr>";
						  
					echo "<tr>
								<td>Semestre Passado</td>
								<td><input type=\"text\" value=\"$array[2]\" name=\"passado1\"></td>
								<td><input type=\"text\" value=\"$array[3]\" name=\"passado2\"></td>
						  </tr>";	  
					
					echo "
					
					<tr>
						<td>L1</td>
						<td colspan=\"2\" align=\"center\">$L1</td>
					</tr>
					
					
				</table>
		
		
		";
			
	?>

       </br>
	   
		<div class=\"form-group\">
			  <button type="submit" class="btn btn-primary btn-lg btn-block">Alterar Informações</button>
			  <br>
			  <button type="submit" class="btn btn-primary btn-lg btn-block" formaction="index.html">Voltar</button>
		</div>
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
		
		function myFunction() {
			var g1 = document.getElementById("g1");
			var g2 = document.getElementById("g2");
			var ch = document.getElementById("ch");
			var nf = document.getElementById("nf");
			var l1 = document.getElementById("l1");
			
			
			var aux = 0;
			aux = parseFloat(g1.value);
			aux += parseFloat(g2.value);
			
			if(parseInt(ch.value) < 75)
				aux += 4.9;
			else if ((parseInt(ch.value) >= 75) && (parseInt(ch.value) < 80))
				aux += 5;
			else if ((parseInt(ch.value) >= 80) && (parseInt(ch.value) < 85))
				aux += 6;
			else if ((parseInt(ch.value) >= 85) && (parseInt(ch.value) < 90))
				aux += 7;
			else if ((parseInt(ch.value) >= 90) && (parseInt(ch.value) < 95))
				aux += 8;
			else if ((parseInt(ch.value) >= 95) && (parseInt(ch.value) < 100))
				aux += 9;
			else 
				aux += 10;
			
			
			aux /= 3;
			
			if (parseInt(ch.value)<75)
				nf.value = 0;
			else if(parseFloat(l1.value) < 5 || aux<5)
			{
				if(parseFloat(l1.value)<=aux)
					nf.value = l1.value;
				else
					nf.value = aux;
			}
			else
			{
				nf.value = (3*aux + parseFloat(l1.value))/4;
			}
		}
        
        </script>
        
    </body>
</html>