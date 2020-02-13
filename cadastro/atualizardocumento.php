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
						
						<?php
							include('../utils/documentos.php');
							include('../../newconexao.php');
							include('../../injection.php');
							
							$CPF = $_POST['cpf'];
							
							$diretorio = DOCUMENTS_GETDOCUMENTPATH($CPF);
							
							$sqlDados = "SELECT * FROM `assistidos` WHERE `cpf` = \"$CPF\"";
							$queryDados = $conexao->query($sqlDados);
							if ($queryDados == false)
							{
								echo "Cliente Não Encontrado<br>";
								return;
							}
							$resultDados = $queryDados->fetchAll(PDO::FETCH_ASSOC );
							$rg = $resultDados[0]['rg'];
							$nome = $resultDados[0]['nome'];
							$tel1 = $resultDados[0]['tel1'];
							$tel2 = $resultDados[0]['tel2'];
							$cel = $resultDados[0]['cel'];
							$bairro = $resultDados[0]['bairro'];
							$dob = $resultDados[0]['dob'];
							$email = $resultDados[0]['email'];
							
							if(injection($CPF))
							{
								echo "My code is Sanitized";
								return;
							}
							
							echo "<div>";
							echo "
										<form action=\"atualizarcadastro.php\" method=\"post\" enctype=\"multipart/form-data\" >
										
											<input type=\"hidden\" name=\"cpf\" value=\"$CPF\">
											<table class=\"table table-bordered table-hover\">
												<tbody>
														<tr align=\"center\">
															<td colspan=\"2\"><strong>Documentos</strong></td>
														</tr>";?>
														
														<tr>
															<td width='30%'><strong>Documentos</strong></td>
															<td width='70%'>
																<strong>RG</strong>
																<input type="file"  name="rgdoc" accept=".pdf">
																<strong>CPF</strong>
																<input type="file"  name="cpfdoc" accept=".pdf">
																<strong>Comprovante de Renda</strong>
																<input type="file"  name="crendoc" accept=".pdf">
																<strong>Comprovante de Residencia</strong>
																<input type="file"  name="cresdoc" accept=".pdf">
																<strong>Foto</strong>
																<input type="file"  name="foto" accept=".pdf,image/*">
															</td>
														</tr>
														<?php
														echo "
														<tr>
															<td colspan=\"2\"><input type=\"submit\" name=\"tipo\" value=\"Atualizar Documento\" class=\"btn btn-primary btn-lg btn-block\"></td>
														</tr>
														</tbody>
														</table><br><br>
														";
								
								echo "</div>";
						?>
						
						
						
						
					
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