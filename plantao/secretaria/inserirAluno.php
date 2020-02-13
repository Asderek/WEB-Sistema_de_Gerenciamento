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
		function DisplayHorariosPlantao()
		{
			include("../../newconexao.php");
			include('../../professores.php');
			$professor = $_POST['professor'];
			$sqlProfessor = "SELECT * FROM horariosplantao WHERE nome = \"$professor\""; 
			$queryProfessor = $conexao->query($sqlProfessor);
			$resultProfessor = $queryProfessor->fetchAll( PDO::FETCH_ASSOC );
			
			echo "<input type=\"hidden\" name=\"professor\" value=\"$professor\">";
			
			echo '<select class="form-control" id="escolha" name="escolha">';
			
			$dias = array();
								
			array_push($dias, "a");
			array_push($dias, "b");
			array_push($dias, "segunda");
			array_push($dias, "terca");
			array_push($dias, "quarta");
			array_push($dias, "quinta");
			array_push($dias, "sexta");
					
			$matriculaProfessor = PROFESSORES_GETMATRICULA($professor);
			for($dia=2;$dia<7;$dia++)
			{
				if ($dia == $resultProfessor[0]['dia1'])
				{
					$start = $resultProfessor[0]['ini1'];
					$end = $resultProfessor[0]['fim1'];
					$maxAluno = $resultProfessor[0]['alunos1'];
					//echo "<option name=\"blasd\" disabled=\"true\">$maxAluno</option>";
					
					for(;$start<$end;$start++)
					{	
						$startM1 = $start+1;
						
						$sqlBloqueado = "SELECT * FROM `NPJ_fechamentoPlantoes` WHERE `matricula` = $matriculaProfessor AND `dia` = $dia AND `inicio` = $start AND `fim` = $startM1";
						$queryBloqueado = $conexao->query($sqlBloqueado);
						if ($queryBloqueado != false)
						{
							$resultBloqueado = $queryBloqueado->fetchAll(PDO::FETCH_ASSOC);
							if (count($resultBloqueado) > 0)
								continue;
						}
						
						if($start<9)
						{
								echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00</option>';
						}
						else if($start==9)
						{
								echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00</option>';
						}
						else
						{
								echo "<option name=\"$dia-$start\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00</option>';
						}
					}
				}
				
				if ($dia == $resultProfessor[0]['dia2'])
				{
					$start = $resultProfessor[0]['ini2'];
					$end = $resultProfessor[0]['fim2'];
					$maxAluno = $resultProfessor[0]['alunos2'];	
					
					for(;$start<$end;$start++)
					{	
						$startM1 = $start+1;
						
						$sqlBloqueado = "SELECT * FROM `NPJ_fechamentoPlantoes` WHERE `matricula` = $matriculaProfessor AND `dia` = $dia AND `inicio` = $start AND `fim` = $startM1";
						$queryBloqueado = $conexao->query($sqlBloqueado);
						if ($queryBloqueado != false)
						{
							$resultBloqueado = $queryBloqueado->fetchAll(PDO::FETCH_ASSOC);
							if (count($resultBloqueado) > 0)
								continue;
						}
						
						if($start<9)
						{
								echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00</option>';
						}
						else if($start==9)
						{
								echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00</option>';
						}
						else
						{
								echo "<option name=\"$dia-$start\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00</option>';
						}
					}
				}
				if ($dia == $resultProfessor[0]['dia3'])
				{
					$start = $resultProfessor[0]['ini3'];
					$end = $resultProfessor[0]['fim3'];
					$maxAluno = $resultProfessor[0]['alunos3'];		//Dobrei os alunos mas tenho que mudar
					//echo "<option name=\"blasd\" disabled=\"true\">$maxAluno</option>";
					
					for(;$start<$end;$start++)
					{	
						$startM1 = $start+1;
						
						$sqlBloqueado = "SELECT * FROM `NPJ_fechamentoPlantoes` WHERE `matricula` = $matriculaProfessor AND `dia` = $dia AND `inicio` = $start AND `fim` = $startM1";
						$queryBloqueado = $conexao->query($sqlBloqueado);
						if ($queryBloqueado != false)
						{
							$resultBloqueado = $queryBloqueado->fetchAll(PDO::FETCH_ASSOC);
							if (count($resultBloqueado) > 0)
								continue;
						}
						
						if($start<9)
						{
								echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ 0'.($start+1).':00</option>';
						}
						else if($start==9)
						{
								echo "<option name=\"$dia-$start\">".$dias[$dia].' - 0'.$start.':00 ~ '.($start+1).':00</option>';
						}
						else
						{
								echo "<option name=\"$dia-$start\">".$dias[$dia].' - '.$start.':00 ~ '.($start+1).':00</option>';
						}
					}
				}
			}
			echo '</select>';
		}
		function DisplayAlunos()
		{
			include ("../../newconexao.php");
			$sqlAlunos = "SELECT * FROM alunos WHERE 1 ORDER BY nome";
			$queryAlunos = $conexao->query($sqlAlunos);
			$resultAlunos = $queryAlunos->fetchAll(PDO::FETCH_ASSOC);
			
			echo "<select name=\"aluno\"  class=\"form-control\" >";
			for($i=0;$i<count($resultAlunos);$i++)
			{
				$nome = $resultAlunos[$i]['nome'];
				$matricula = $resultAlunos[$i]['matricula'];
				
				echo "<option value=\"$matricula\">$matricula - $nome</option>";
			}
			echo "</select>";
		}
		function TratarInsercao()
		{
			include ("../../newconexao.php");
			if (!empty($_POST['aluno']) && !empty($_POST['escolha']))
			{
				$matricula = $_POST['aluno'];
				$escolha = $_POST['escolha'];
				$professor = $_POST['professor'];
				
				$sqlAlunos = "SELECT * FROM alunos WHERE matricula = $matricula";
				$queryAlunos = $conexao->query($sqlAlunos);
				$resultAlunos = $queryAlunos->fetchAll(PDO::FETCH_ASSOC);
				$nome = $resultAlunos[0]['nome'];
				
				/*echo "Matricula  = $matricula <br>";
				echo "Escolha = $escolha<br>";
				echo "Nome = $nome<br>";
				echo "Professor = $professor<br>";*/
				
				$sqlDelete = "DELETE FROM `alunosplantao` WHERE `matricula` = $matricula";
				$queryDelete = $conexao->query($sqlDelete);
				
				$sqlInsert = "INSERT INTO `alunosplantao`(`matricula`, `nome`, `professor`, `horario`) VALUES ($matricula,\"$nome\",\"$professor\",\"$escolha\")";
				$queryInsert = $conexao->query($sqlInsert);
				if($queryInsert == false)
				{
					echo "<h3 class=\"text-center\">Não consegui inserir x alunx<br>sqlInsert = $sqlInsert<br>";
				}
				else
				{
					echo "<h3 class=\"text-center\">Alunx $nome inserido no plantão do professor $professor<br>no horario $escolha<br><br>";
				}
			}
		}
	?>
    
    <body  >
        
        <!--login modal-->
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="text-center">Núcleo de Prática Jurídica</h1><br>
						<h3 class="text-center">Forçar Cadastro de Aluno para Plantão dx Professor(a) <?php echo $_POST['professor']; ?></h3>						
					</div>
					
					<div class="modal-body">
						<form action="inserirAluno.php" method="post">
							<?php
								TratarInsercao();
							
								DisplayHorariosPlantao();
								echo "<br>";
								DisplayAlunos();
							?>
							<br>
							<input type="submit" value="Enviar" class="btn btn-primary btn-block btn-lg">
							<input type="submit" formaction="inicio.php" value="Voltar" class="btn btn-primary btn-block btn-lg">
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
			return confirm("Essa ação vai zerar os plantoes e remover todos os alunos inscritos em plantao. Ta de boa isso ai vei?");
		}
        
        </script>
        
    </body>
</html>