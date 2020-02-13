<?php include ('header.php'); ?>
    
    <body  >
        
        <!--login modal-->
		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="text-center">Núcleo de Prática Jurídica</h1><br>
							<h5 class="text-center">Sistemas Implementados no NPJ</h5>
						</div>
						
						<form action="remove.php" method="post">
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
										echo "<button type=\"submit\" value=\"$index\" name=\"id\">X</button>";
									echo "</td>";
								echo "</tr>";
							}
							echo "</tbody></table>";
							
							echo "<a href=\"index.php\" class=\"btn btn-primary btn-lg btn-block\">Voltar</a>";
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