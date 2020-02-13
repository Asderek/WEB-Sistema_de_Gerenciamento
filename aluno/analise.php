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
		<form class="form col-md-12 center-block" action='cadastraratividade.php' method="post">
      
	<?php
		include('../../newconexao.php');
		
		/*if(is_null($_POST['matricula']));
		{
			$mat = $_POST['matricula'];
			echo "mat = $mat<br>";
			echo "Deu Pau";
			return;
		}*/
		
		$matricula = $_POST['matricula'];
		
		$sqlMatricula = "SELECT * FROM `alunos` WHERE matricula = $matricula";
		$queryMatricula = $conexao->query($sqlMatricula);
		if ($queryMatricula == false)
		{
			echo "Matricula Incorreta tente novamente<br>";
			return;
		}
		$resultMatricula = $queryMatricula->fetchAll( PDO::FETCH_ASSOC );
		$rowsMatricula = count($resultMatricula);
		echo "<input type='hidden' name='matricula' value='$matricula'/>";	

		if($rowsMatricula<0)
		{
			echo "Matricula nao encontrada somehow wtf??";
		}
		
		$nome = $resultMatricula[0]['nome'];
		$disciplina = $resultMatricula[0]['disciplina'];
		$professor = $resultMatricula[0]['professor'];
		$turma = $resultMatricula[0]['turma'];
		$oab = $resultMatricula[0]['oab'];
		$oficina = $resultMatricula[0]['oficina'];
		$tel = $resultMatricula[0]['telefone'];
		$email = $resultMatricula[0]['email'];
		
		$primeiraFase = $resultMatricula[0]['primfase'];
		
		$L1 = $resultMatricula[0]['l1'];
		if($L1 < 0)
			$L1 = "Ainda não possui";
		else
			$L1 = number_format($L1,2);
		
		
		
		$pas1 = $resultMatricula[0]['passado1'];
		$pas2 = $resultMatricula[0]['passado2'];
		$atu1 = $resultMatricula[0]['atual1'];
		$atu2 = $resultMatricula[0]['atual2'];
		
		
		switch($pas1)
		{
			case -1:
				$pas1 = "Inscrito";
				break;
			case -2:
				$pas1 = "Em Processamento";
				break;
			case -3:
				$pas1 = "Não Realizou";
				break;
		}
		switch($pas2)
		{
			case -1:
				$pas2 = "Inscrito";
				break;
			case -2:
				$pas2 = "Em Processamento";
				break;
			case -3:
				$pas2 = "Não Realizou";
				break;
		}
		switch($atu1)
		{
			case -1:
				$atu1 = "Inscrito";
				break;
			case -2:
				$atu1 = "Em Processamento";
				break;
			case -3:
				$atu1 = "Não Realizou";
				break;
		}
		switch($atu2)
		{
			case -1:
				$atu2 = "Inscrito";
				break;
			case -2:
				$atu2 = "Em Processamento";
				break;
			case -3:
				$atu2 = "Não Realizou";
				break;
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
						<td colspan=\"2\">$disciplina</td>
					</tr>
					<tr>
						<td>Turma</td>
						<td colspan=\"2\">$turma</td>
					</tr>
					<tr>
						<td>Professor</td>
						<td colspan=\"2\">$professor</td>
					</tr>
					<tr>
						<td>Telefone</td>
						<td colspan=\"2\">$tel</td>
					</tr>
					<tr>
						<td>Email</td>
						<td colspan=\"2\">$email</td>
					</tr>
					<tr>
						<td colspan=\"3\" align=\"center\"><b>NOTAS</b></td>
					</tr>
					<tr>
						<td>OAB</td>
						<td colspan=\"2\"><input type=\"checkbox\" name=\"oab\" onclick=\"return false;\" ";
						
					if($oab==1)
						echo "checked";
						
						echo "></td>
					</tr>
					<tr>
						<td>Oficina</td>
						<td colspan=\"2\"><input type=\"checkbox\" name=\"oficina\" onclick=\"return false;\" ";
						
					if($oficina==1)
						echo "checked";
						
						echo "></td>
					</tr>					
					<!--<tr>
						<td>Primera Fase OAB</td>
						<td colspan=\"2\" align=\"center\"><input type\"text\" name=\"primFase\" value=\"$primeiraFase\" ></td>
					</tr>-->
					<tr>
						<td>Primera Fase OAB</td>
						<td colspan=\"2\" align=\"center\">$primeiraFase</td>
					</tr>
					<tr>
						<td align=\"center\"><b></b></td>
						<td align=\"center\"><b>Sim1</b></td>
						<td align=\"center\"><b>Sim2</b></td>
					</tr>";
					
					/*
					for($i=0;$i<8;$i++)
					{
						$val1 = $array[$i];
						$val2 = $array[$i+1];
						$ema = ceil(($i+1)/2);
						
						echo "
								<tr>
									<td>EMA$ema</td>
									<td align=\"center\">$val1</td>
									<td align=\"center\">$val2</td>
								</tr>
							";
							$i++;
					}*/
					echo "<tr>
								<td>Semestre Atual</td>
								<td align=\"center\">$atu1</td>
								<td align=\"center\">$atu2</td>
						  </tr>";
						  
					echo "<tr>
								<td>Semestre Passado</td>
								<td align=\"center\">$pas1</td>
								<td align=\"center\">$pas2</td>
						  </tr>";	
						  
					
						  
					  
			
					
					echo "
					
					<tr>
						<td>L1</td>
						<td colspan=\"2\" align=\"center\">$L1</td>
					</tr>
					
					<tr>
						<td colspan=\"3\">
							<input type=\"submit\" class=\"btn btn-primary btn-lg btn-block\" value=\"Cadastrar nova Atividade\"/>
						</td>
					</tr>
					
					
				</table>
		
		
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