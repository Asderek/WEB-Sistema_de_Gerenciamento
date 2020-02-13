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
				
				
				$matricula = $_POST['matricula'];
				$primFase = $_POST['primFase'];
				$oab = $_POST['oab'];
				$oficina = $_POST['oficina'];
				$passado1 = $_POST['passado1'];
				$passado2 = $_POST['passado2'];
				$atual1 = $_POST['atual1'];
				$atual2 = $_POST['atual2'];
				$disciplina = $_POST['disciplina'];
				$professor = $_POST['professor'];
				$turma = $_POST['turma'];
				$email = $_POST['email'];
				$tel = $_POST['tel'];
				
				if ($passado1 == "Inscrito")
				{
					$passado1 = -1;
				}
				else if ($passado1 == "Em processamento")
				{
					$passado1 = -2;
				}
				else if ($passado1 == "Não Realizou")
				{
					$passado1 = -3;
				}
				
				if ($passado2 == "Inscrito")
				{
					$passado2 = -1;
				}
				else if ($passado2 == "Em processamento")
				{
					$passado2 = -2;
				}
				else if ($passado2 == "Não Realizou")
				{
					$passado2 = -3;
				}
				
				if ($atual1 == "Inscrito")
				{
					$atual1 = -1;
				}
				else if ($atual1 == "Em processamento")
				{
					$atual1 = -2;
				}
				else if ($atual1 == "Não Realizou")
				{
					$atual1 = -3;
				}
				
				if ($atual2 == "Inscrito")
				{
					$atual2 = -1;
				}
				else if ($atual2 == "Em processamento")
				{
					$atual2 = -2;
				}
				else if ($atual2 == "Não Realizou")
				{
					$atual2 = -3;
				}
				
				if(isset($_POST['oab']))
				{
					$oab = 1;
				}
				else
				{
					$oab = 0;
				}
				
				if(isset($_POST['oficina']))
				{
					$oficina = 1;
				}    
				else
				{
					$oficina = 0;
				}    
				
				
				
				/*CALCULA L1*/
				$L1 = 0;
				
				if ($oab == 1)
					$L1 = 10;
				else if ($oficina == 0)
				{
					$L1 = 0;
				}
				else
				{
					$maior = max($passado1,$passado2,$atual1,$atual2);
					
					
					switch ($disciplina)
					{
						case "JUR1961":
							$peso = 0.17;
						break;
						case "JUR1962":
							$peso = 0.17;
						break;
						case "JUR1963":
							$peso = 0.143;
						break;
						case "JUR1964":
							$peso = 0.125;
						break;
					}
					
					$maiorNota = max($primFase,$maior);
					$L1 = $maiorNota * $peso;
					
					/*if ($maior < $criterio)
					{
						if ($primFase > 0)
						{
							 $L1 = $primFase * $peso;
						}
						else
						{
							$L1 = $maior*$peso;
						}
					}
					else
					{
						$L1 = $maior*$peso;
					}*/
				}
				
				if($L1>10)
				{
					echo "L1 > 10<br>";
					$L1 = 10;
				}
				
				$L1 = sprintf("%.1f",$L1);
				/*/CALCULA L1*/
				
				//<Calcula Horas>
					if ($atual1<= 0)
						$hora1 = 0;
					else if ($atual1 < 33)
						$hora1 = 2;
					else if ($atual1 < 41)
						$hora1 = 3;
					else if ($atual1 < 49)
						$hora1 = 4;
					else if ($atual1 < 57)
						$hora1 = 5;
					else if ($atual1 < 65)
						$hora1 = 6;
					else if ($atual1 < 73)
						$hora1 = 7;
					else
						$hora1 = 8;
					
					if ($atual2<= 0)
						$hora2 = 0;
					else if ($atual2 < 33)
						$hora2 = 2;
					else if ($atual2 < 41)
						$hora2 = 3;
					else if ($atual2 < 49)
						$hora2 = 4;
					else if ($atual2 < 57)
						$hora2 = 5;
					else if ($atual2 < 65)
						$hora2 = 6;
					else if ($atual2 < 73)
						$hora2 = 7;
					else
						$hora2 = 8;
				//</Calcula Horas>
				
				echo "matricula = $matricula<br>";
				echo "primFase = $primFase<br>";
				echo "oab = $oab<br>";
				echo "oficina = $oficina<br>";
				echo "simulado Passado 1 = $passado1<br>";
				echo "simulado Passado 2 = $passado2<br>";
				echo "simulado Atual 1 = $atual1<br>";
				echo "simulado Atual 2 = $atual2<br>";
				echo "L1 = $L1<br>";
				echo "Hora1 = $hora1<br>";
				echo "Hora2 = $hora2<br>";
				
				echo "Email = $email<br>";
				echo "Telefone = $tel<br>";
				
				
				$sqlUpdate = " UPDATE `alunos` SET `professor`=\"$professor\", `turma`=\"$turma\", `telefone`=\"$tel\", `email`=\"$email\", `disciplina`=\"$disciplina\", `primfase`=$primFase, `oab`=$oab, `oficina`=$oficina, `passado1`=$passado1, `passado2`=$passado2, `atual1`=$atual1, `atual2`=$atual2, `l1`=$L1, `hora1`=$hora1, `hora2`=$hora2 WHERE matricula = $matricula";
				$queryUpdate = $conexao->query($sqlUpdate);
				
				for($i=0;$i<9;$i++)
				{
					if (!isset($_POST["extraMat$i"]))
						continue;
					
					$extraMat = $_POST["extraMat$i"];
					foreach ($_POST as $key => $value)
					{
						if (strpos($key,$extraMat) != false)
						{
							if (strpos($key,"disciplina") !== false)
								$disciplinaMat = $value;
							if (strpos($key,"turma") !== false)
								$turmaMat = $value;
							if (strpos($key,"professor") !== false)
								$professorMat = $value;
						}
					}
					
					echo "Matricula = $extraMat<br>disciplina = $disciplinaMat<br>Turma = $turmaMat<br>Professor = $professorMat<br><br>";
					
					/*CALCULA L1*/
					$L1 = 0;
					
					if ($oab == 1)
						$L1 = 10;
					else if ($oficina == 0)
					{
						$L1 = 0;
					}
					else
					{
						$maior = max($passado1,$passado2,$atual1,$atual2);
						
						
						switch ($disciplinaMat)
						{
							case "JUR1961":
								$peso = 0.17;
							break;
							case "JUR1962":
								$peso = 0.17;
							break;
							case "JUR1963":
								$peso = 0.143;
							break;
							case "JUR1964":
								$peso = 0.125;
							break;
						}
						
						$maiorNota = max($primFase,$maior);
						$L1 = $maiorNota * $peso;
						
						/*if ($maior < $criterio)
						{
							if ($primFase > 0)
							{
								 $L1 = $primFase * $peso;
							}
							else
							{
								$L1 = $maior*$peso;
							}
						}
						else
						{
							$L1 = $maior*$peso;
						}*/
					}
					
					if($L1>10)
					{
						$L1 = 10;
					}
					
					$L1 = sprintf("%.1f",$L1);
					
					$sqlUpdate = " UPDATE `alunos` SET `professor` = \"$professorMat\",`turma` = \"$turmaMat\",`telefone`=\"$tel\",`email`=\"$email\", `disciplina` = \"$disciplinaMat\",`primfase`=$primFase,`oab`=$oab,`oficina`=$oficina,`passado1`=$passado1,`passado2`=$passado2,`atual1`=$atual1,`atual2`=$atual2,`l1`=$L1, `hora1`=$hora1, `hora2`=$hora2 WHERE matricula = $extraMat";
					$queryUpdate = $conexao->query($sqlUpdate);				
				}
				
				
				
				echo "<br>sqlUpdate= $sqlUpdate<br>";
				//$queryUpdate = (mysql_query($sqlUpdate,$conexao));
				if($queryUpdate != false)
				{
					echo "<h3 align=\"center\">Dados atualizados com sucesso<br>";
				}
				else
				{
					echo "<h3 align=\"center\">Erro, tente novamente<br>";
				}
				
				echo "<button type=\"submit\" name=\"query\" value=\"$matricula\" formaction=\"resultado.php\" class=\"btn btn-primary btn-lg btn-block\">Voltar</button>";
			?>

			</br>
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
        
        </script>
        
    </body>
</html>