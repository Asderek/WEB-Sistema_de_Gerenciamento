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
		<form class="form col-md-12 center-block" action='registrar.php' method="post">
      
	<?php
		include('../../newconexao.php');
		
		
		echo "
				<table class=\"table table-bordered table-striped table-hover\">
					<tr>
						<td>Matricula</td>
						<td colspan=\"2\"><input type=\"text\" name=\"matricula\" placeholder=\"0920721\" required></td>
					</tr>
					<tr>
						<td>Nome</td>
						<td colspan=\"2\"><input type=\"text\" name=\"nome\" placeholder=\"Joao da Silva Sauro\" required></td>
					</tr>
					<tr>
						<td>Disciplina</td>
						<td colspan=\"2\"><input type=\"text\" name=\"disciplina\" placeholder=\"JUR1961\" required></td>
					</tr>
					<tr>
						<td>Turma</td>
						<td colspan=\"2\"><input type=\"text\" name=\"turma\" placeholder=\"2HX\" required></td>
					</tr>
					<tr>
						<td>Professor</td>
						<td colspan=\"2\">
							<select name=\"professor\" align=\"center\" style=\"font-size:120%\" required>";
								$sqlProfessores = "SELECT nome FROM professores WHERE 1 ORDER BY nome";
								$queryProfessores = $conexao->query($sqlProfessores);
								if ($queryProfessores != false)
								{
									$resultProfessores = $queryProfessores->fetchAll(PDO::FETCH_ASSOC);
									for($i=0;$i<count($resultProfessores);$i++)
									{
										$nome = $resultProfessores[$i]['nome'];
										echo "<option value=\"$nome\">$nome</option>";
									}
								}
							echo "</select>
						</td>
					</tr>
					<tr>
						<td>Telefone</td>
						<td colspan=\"2\"><input type=\"text\" name=\"tel\" placeholder=\"2266-0847\"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td colspan=\"2\"><input type=\"text\" name=\"email\" placeholder=\"asd@zxc.com\"></td>
					</tr>
					<tr>
						<td colspan=\"3\" align=\"center\"><b>NOTAS</b></td>
					</tr>
					
					<tr>
						<td>OAB</td>
						<td colspan=\"2\"><input type=\"checkbox\" name=\"oab\"></td>
					</tr>
					
					<tr>
						<td>Oficina</td>
						<td colspan=\"2\"><input type=\"checkbox\" name=\"oficina\"></td>
					</tr>					
					
				</table>
		
		
		";
			
	?>

       </br>
	   
		<div class=\"form-group\">
			  <button type="submit" class="btn btn-primary btn-lg btn-block">Cadastrar</button>
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