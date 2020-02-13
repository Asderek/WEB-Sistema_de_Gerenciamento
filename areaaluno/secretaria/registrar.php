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
			  background: url(../../assets/img/monitoria.jpg) no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
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
					<h4 class="text-center">Cadastro do Currículo</h4>
					<h5 class="text-center">Monitoria NPJ</h5><br>
					</div>
					<div class="modal-body">

						<?php
							include('../../newconexao.php');
							$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
							$matricula = $_POST['matricula'];
							$nome = $_POST['nome'];
							$disciplina = $_POST['disciplina'];
							$turma = $_POST['turma'];
							$professor = ($_POST['professor']);
							$tel = ($_POST['tel']);
							$email = ($_POST['email']);
							$oab = $_POST['oab'];
							$oficina = ($_POST['oficina']);
							
							if($oab == "on")
								$oab=1;
							else
								$oab = 0;
							if($oficina == "on")
								$oficina = 1;
							else
								$oficina=0;
							
							echo "
									matricula = $matricula<br>
									nome = $nome<br>
									disciplina = $disciplina<br>
									turma = $turma<br>
									professor = $professor<br>
									tel = $tel<br>
									email = $email<br>
									oab = $oab<br>
									oficina = $oficina<br>
							";
							
							

							$continue = true;
							$sqlDuplicated = "SELECT * FROM alunos WHERE matricula = $matricula ";
							$queryDuplicated = $conexao->query($sqlDuplicated);
							$resultDuplicated = $queryDuplicated->fetchAll( PDO::FETCH_ASSOC );
							$rowsDuplicated = count($resultDuplicated);
							
							echo "sqlDuplicated = $sqlDuplicated<br>";
							
							if($rowsDuplicated>0)
							{
								for($i=0;$i<$rowsDuplicated;$i++)
								{
									$professorDuplicated = $resultDuplicated[$i]['professor'];
									
									if($professorDuplicated == $professor)
									{
										$continue = false;
										echo '<h5 class="text-center">Aluno ja está cadastrado no BD do EMA<p></p>';
										echo '<a href=javascript:history.go(-2) class="btn btn-primary btn-lg btn-block">Voltar</a>';
									}
								}
							}
							
							if($continue == true)
							{				
								$sqlInsert = "INSERT INTO `alunos`(`matricula`, `nome`, `turma`, `professor`, `disciplina`, `status`, `email`, `telefone`, `passado1`, `passado2`, `atual1`, `atual2`, `l1`, `primfase`, `oab`, `oficina`, `senha`, `alter`, `hora1`, `hora2`, `horas`) VALUES ($matricula,\"$nome\",\"$turma\",\"$professor\",\"$disciplina\",0,\"$email\",\"$tel\",0,0,0,0,0,0,$oab,$oficina,\"ORioDeJaneiroCOntinuaLindo\",0,0,0,0)";	
								echo "sqlInsert = $sqlInsert<br>";

								$queryInsert = $conexao->query($sqlInsert);
								
								
								if ($queryInsert != false)
								{
									echo '<h5 class="text-center">Aluno Cadastrado com sucesso<br>';
									echo '<a href="index.html" class="btn btn-primary btn-lg btn-block">página inicial</a>';
									
								}
								else
								{
									echo '<h5 class="text-center">Erro ao cadastrar aluno, por favor, contate a secretaria do npj</h5><p></p>';
									echo '<a href=javascript:history.go(-1) class="btn btn-primary btn-lg btn-block">Voltar</a>';
								}
							}
							
						?>

						</br>
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