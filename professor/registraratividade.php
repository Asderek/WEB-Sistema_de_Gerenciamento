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
		   background: url(../../assets/img/areaprofessor.jpg) no-repeat center center fixed; 
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
		<form id="myForm" class="form col-md-12 center-block" action='mainProfessor.php' method="post">
      
	<?php
	
		function transactionFailed($msg)
		{
			echo "<h5 class=\"text-center\">$msg<p></p>";
			echo "<br>
				
					<a href=\"javascript:history.go(-1)\" class=\"btn btn-primary btn-lg btn-block\">Voltar</a>
						   </form>
					  </div>
						  <div class=\"modal-footer\"></div>
					  </div>
					  </div>
					</div>
							
							<script type='text/javascript' src=\"//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>


							<script type='text/javascript' src=\"//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js\"></script>





							
							<!-- JavaScript jQuery code from Bootply.com editor -->
							
							<script type='text/javascript'>
							
							$(document).ready(function() {
							
								
							
							});
							
							</script>
							
						</body>
					</html>";
			return;	
		}
	
		include('../../newconexao.php');
		{	
		
			$matricula = $_POST['matriculaAluno'];
			$nome = $_POST['nome'];
			//$professor = $_POST['professor'];
			$professor = $_POST['destino'];
			
			$atividade = $_POST['atividade'];
			$descricao = $_POST['descricao'];
			
			$dataAtv = $_POST['dataAtv'];
			
			if (strstr($dataAtv,"/"))
			{
				$dia = substr($dataAtv,0,2);
				$mes = substr($dataAtv,3,2);
				$ano = substr($dataAtv,6);
				$dataAtv = $ano.'-'.$mes.'-'.$dia;
			} else if (strstr($dataAtv,"."))
			{
				$dia = substr($dataAtv,0,2);
				$mes = substr($dataAtv,3,2);
				$ano = substr($dataAtv,6);
				$dataAtv = $ano.'-'.$mes.'-'.$dia;
			} else if(strstr($dataAtv,"-") === false)
			{
				$dia = substr($dataAtv,0,2);
				$mes = substr($dataAtv,3,2);
				$ano = substr($dataAtv,6);
				$dataAtv = $ano.'-'.$mes.'-'.$dia;
			}
			
			
			if (preg_match("/^[a-zA-Z]+$/", $dataAtv))
			{
				$dataAtv = "2001-09-11";
			}
						
			$atividade = str_replace("\"","'",$atividade);
			$descricao = str_replace("\"","'",$descricao);
			
			$tipo = $_POST['tipo'];
			
			$pendente = 1;
			
			if ($tipo == "estagio" )
			{
				include_once ("../utils/professores.php");
				$professor = PROFESSORES_GETNAMEBYALUNO($matricula);
			}
			
			if($tipo == "estagio" || $tipo == "oab" || $tipo == "primFase" || $tipo == "oficina")
				$pendente = 2;
			if($tipo == "oab" || $tipo == "primFase" || $tipo == "oficina")
				$professor = "SECRETARIA";
			
			$inject = false;
			$injections = array ("DROP TABLE","ALTER TABLE","INSERT","DELETE","UPDATE","SELECT");
												
			foreach($injections as $inj)
			{
				if(strpos($atividade,$inj) !== false )
				{
					$inject = true;
				}
				if(strpos($descricao,$inj) !== false )
				{
					$inject = true;
				}
			}
			
			if($inject == true)
			{
				include ("../utils/email.php");
				
				//$email = "pinheiro.lucasn@gmail.com";
				$email = "";
				$sbj = "Tentativa de SQL Injection";
				$msg = "O usuario matricula: $matricula nome: $nome, acabou de tentar um SQL Injection na atividade $atividade.<br> A descricao é: $descricao<br>";
				
				EMAIL_SEND_SUPRESSED($email,$sbj,$msg);
				//echo "<h3> Don't think I don't know what you're trying to do.</h3>";
				echo "<a href=\"javascript:history.go(-1)\" class=\"btn btn-primary btn-lg btn-block\">Voltar</a>";
				return;
			}
		
			$path = $_FILES['comprovante']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$ext = strtolower($ext);
			$path = $_FILES['comprovante']['tmp_name'];
			
			
			if ($tipo == "estagio" && $ext != "pdf" && ($_FILES['comprovante']['error'] != UPLOAD_ERR_NO_FILE))
			{
				transactionFailed("Comprovantes de Atividades do tipo Estagio Profissional devem ser apenas em PDF");
				return;
			}
			
			if ($ext != "pdf" && !is_array(getimagesize($path)) && ($_FILES['comprovante']['error'] != UPLOAD_ERR_NO_FILE))
			{
				transactionFailed("Arquivo não é imagem nem pdf");
				return;
			}
				
			echo "
			
				matricula = $matricula<br>
				nome = $nome<br>
				professor = $professor<br>
				atividade = $atividade<br>
				descricao = $descricao<br>
				dataAtv = $dataAtv<br>
			
			";
			
			$sqlDisciplina = "SELECT * FROM `alunos` WHERE `matricula` = $matricula";
			$queryDisciplina = $conexao->query($sqlDisciplina);
			$resultDisciplina = $queryDisciplina->fetchAll(PDO::FETCH_ASSOC);
			$disciplina = $resultDisciplina[0]['disciplina'];
			
			$sqlInsert = "INSERT INTO `atividades`(`nome`, `matricula`, `disciplina`, `responsavel`, `tipo`, `atividade`, `descricao`, `pendente`, `horas`, `dataAtv`) VALUES (\"$nome\",$matricula,\"$disciplina\",\"$professor\", \"$tipo\", \"$atividade\",\"$descricao\",$pendente,0,\"$dataAtv\")";
			$queryInsert = $conexao->query($sqlInsert);
			if ($queryInsert == false)
			{
				echo "erro ao entrar os dados, tente novamente";
				return;
			}
			else
			{
				if ( $_FILES['comprovante']['error'] == UPLOAD_ERR_NO_FILE )
				{
					
				}
				else
				{//armazenar arquivo
					echo "<br><br>";
				
					$path = $_FILES['comprovante']['name'];
					$ext = pathinfo($path, PATHINFO_EXTENSION);
					$ext = strtolower($ext);
					
					echo "path = $path<br>";
					echo "ext = $ext<br><br>";
					echo "zxc";
					include ('../utils/documentos.php');
					echo "qwe";
					include_once ('../utils/professores.php');
					echo "asd<br>";
					$matProfessor = PROFESSORES_GETMATRICULABYNAME($professor);
					echo "matProfessor = $matProfessor<br>";
					if($matProfessor == "Matricula not found")
					{
						echo '<h5 class="text-center">Arquivo nao pode ser enviado, contate a secretaria.<p></p>';
						echo "<br>
							
								<a href=\"javascript:history.go(-1)\" class=\"btn btn-primary btn-lg btn-block\">Voltar</a>
									   </form>
								  </div>
									  <div class=\"modal-footer\"></div>
								  </div>
								  </div>
								</div>
										
										<script type='text/javascript' src=\"//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>


										<script type='text/javascript' src=\"//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js\"></script>





										
										<!-- JavaScript jQuery code from Bootply.com editor -->
										
										<script type='text/javascript'>
										
										$(document).ready(function() {
										
											
										
										});
										
										</script>
										
									</body>
								</html>";
						return;		
					}
					
					
					$target_Path = DOCUMENTS_GETDOCUMENTPATH($matProfessor).'/atividades/';
					if (is_dir($target_Path) != 1)
					{
						echo "path doesn't exist<br>";
						var_dump(mkdir($target_Path,0777, true));
						chmod($target_Path, 0777);
					}
					else
					{
						echo "path exists<br>";
						chmod($target_Path, 0777);
					}
					
					echo "Target_Path = $target_Path<br>";
					$target_Path = $target_Path.basename($path);
					echo "Target_Path = $target_Path<br><br>";
					 
					if(move_uploaded_file( $_FILES['comprovante']['tmp_name'], $target_Path ) == false)
					{
						echo '<h5 class="text-center">Arquivo nao pode ser enviado, contate a secretaria.<p></p>';
						echo "<br>
							
								<a href=\"javascript:history.go(-1)\" class=\"btn btn-primary btn-lg btn-block\">Voltar</a>
									   </form>
								  </div>
									  <div class=\"modal-footer\"></div>
								  </div>
								  </div>
								</div>
										
										<script type='text/javascript' src=\"//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>


										<script type='text/javascript' src=\"//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js\"></script>





										
										<!-- JavaScript jQuery code from Bootply.com editor -->
										
										<script type='text/javascript'>
										
										$(document).ready(function() {
										
											
										
										});
										
										</script>
										
									</body>
								</html>";
								return;		
					}
					$sqlIndex = "SELECT * FROM `atividades` WHERE 1";
					$queryIndex = $conexao->query($sqlIndex);
					$resultIndex = $queryIndex->fetchAll(PDO::FETCH_ASSOC);
					$count = count($resultIndex)-1;
					$lastIndex = $resultIndex[$count]['index'];
					$arquivo = $lastIndex.'-'.$matricula.'-Comprovante'.".".$ext;
					$newpath = DOCUMENTS_GETDOCUMENTPATH($matProfessor).'/atividades/'.$arquivo;
					$oldpath = DOCUMENTS_GETDOCUMENTPATH($matProfessor).'/atividades/'.$path;
					
					rename	($oldpath,$newpath);
					chmod($oldpath,0777);
					
				}
				
			}
		}
		
		echo "<input type='hidden' name='matriculaAluno' value='$matricula'/>";
		$matricula = $_POST['matricula'];	
		echo "<input type='hidden' name='matricula' value='$matricula'/>";	
		echo "<input type='hidden' name='mode' value='listaratividadesaluno'/>";	
		echo "<input type='submit' value='avançar'>";
		echo "
					<script type=\"text/javascript\">
						document.getElementById('myForm').submit();
					</script>
		";
			
			
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