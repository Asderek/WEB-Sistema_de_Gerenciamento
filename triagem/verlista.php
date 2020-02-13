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
			  background: url(assets/img/bg.jpg) no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			}
			table, th, td 
			{
				border: 1px solid black;
				border-collapse: collapse;
				background-color:	#FFFFFF;
			}
			
			.modal-content
			{
				margin-left:                       	-750px;
				margin-top:                        	0px;
				position:                        	absolute;
				width:                             	1500px;
				left:                               50%;
				top:                                50%;
			}
			
			.modal-body2
			{
				float:								right;
				position:                        	relative;
				width:                             	75%;
				top:                                50%;
			}
			
			.modal-body1
			{
				float:								left;
				position:                        	relative;
				width:                             	25%;
			}
			
			.modal-footer {   border-top: 0px; }
			#loginModal { margin-top: 0px;}
			
				.inv {
						display: none;
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
							<h5 class="text-center">Lista de Assistidos em Espera</h5>
						</div>
						
						<form action="procurar.php" method="post">
						<?php
							include('../../newconexao.php');
							$sqlLista = "SELECT * FROM `listadeespera` WHERE 1 ORDER BY `index` ASC";
							$queryLista = $conexao->query($sqlLista);
							if ($queryLista == false)
							{
								echo "Não consegui<br>";
								echo "sqlLista = $sqlLista<br>";
								
							}
							$resultLista = $queryLista->fetchAll(PDO::FETCH_ASSOC);
							$rowsLista = count($resultLista);
							echo "
							<table class=\"table table-bordered table-hover\">
												<tbody>
												<tr><td colspan=\"3\" align=\"center\">Lista de Espera</td></tr>
												<tr><td>Posição</td><td>Nome</td><td></td></tr>";
							for($i=0;$i<$rowsLista;$i++)
							{
								$cpf = $resultLista[$i]['CPF'];
								$sqlDados = "SELECT * FROM `assistidos` WHERE `cpf` = \"$cpf\"";
								$queryDados = $conexao->query($sqlDados);
								if ($queryDados == false)
								{
									$nome = "Assistido Não Encontrado";
									$index = -1;
								}
								else
								{
									$resultDados = $queryDados->fetchAll(PDO::FETCH_ASSOC);
									$nome = $resultDados[0]['nome'];
									$index = $resultLista[$i]['index'];
								}
								echo "<tr>";
									echo "<td>";
										echo "$i";
									echo "</td>";
									echo "<td>";
										echo "$nome";
									echo "</td>";
									echo "<td>";
										echo "<button type=\"submit\" value=\"$cpf\" name=\"cpf\">Ver Assistido</button>";
									echo "</td>";
								echo "</tr>";
							}
							echo "<tr><td colspan=\"3\" align=\"center\"><a href=\"index.html\">Voltar</a></td></tr>";
							echo "</tbody></table>";
						?>
						</form>
						
						
						
					
					</div>
				</div>
		</div>



        
        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
        
        $(document).ready(function() {
        
            
        
        });
        </script>
		
    </body>
</html>