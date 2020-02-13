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
			}
			
			.modal-content
			{
				margin-left:                       -512px;
				margin-top:                        0px;
				position:                        relative;
				width:                             150%;
				left:                                 50%;
				top:                                  50%;
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
							<h3 class="text-center">Assistido não encontrado<br><br> Cadastro de novo assistido</h3>
						</div>
						
						<?php
							include('../../newconexao.php');
							include('../../injection.php');
							
							$CPF = $_POST['cpf'];
							
							
							if(injection($CPF))
							{
								echo "My code is Sanitized";
								return;
							}
							
							$comunidades = array();
							array_push($comunidades,"Cantagalo");
							array_push($comunidades,"Pavão-Pavãozinho");
							array_push($comunidades,"Cruzada");
							array_push($comunidades,"São Sebastião");
							array_push($comunidades,"Vidigal");
							array_push($comunidades,"Rocinha");
							array_push($comunidades,"Babilônia");
							array_push($comunidades,"Chapéu-Mangueira");
							array_push($comunidades,"Dona Marta");
							array_push($comunidades,"Cerro Corá");
							array_push($comunidades,"Tabajaras");
							array_push($comunidades,"Pererão");
							array_push($comunidades,"Julio Otoni");
							array_push($comunidades,"Santo Amáro");
							array_push($comunidades,"Morro Azul");
							array_push($comunidades,"Cabritos");
							array_push($comunidades,"Chácara do Céu");
							array_push($comunidades,"Parque da Cidade");
							array_push($comunidades,"Horto");
							array_push($comunidades,"Grotão");
							array_push($comunidades,"Tuiuti");
							array_push($comunidades,"Funcionarios PUC");
							array_push($comunidades,"Minhocão");
							
							sort($comunidades);
							
							
							echo "
									<form action=\"cadastrar.php\" method=\"post\" enctype=\"multipart/form-data\" >
										<div class=\"modal-body\">
											<table class=\"table table-bordered table-striped table-hover\">
												<tbody>
														<tr>
															<td width='30%'><strong>CPF</strong></td>
															<td width='70%'><input type=\"text\" name=\"cpf\" value=\"$CPF\" readonly=\"readonly\"></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Nome</strong></td>
															<td width='70%'><input type=\"text\" name=\"nome\" placeholder=\"Nome\" required></input></td>
														</tr>
													
														<tr>
															<td width='30%'><strong>RG</strong></td>
															<td width='70%'><input type=\"text\" name=\"rg\" placeholder=\"12345678-21\" required></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Telefone 1</strong></td>
															<td width='70%'><input type=\"text\" name=\"tel1\" placeholder=\"2266-0847\"></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Telefone 2</strong></td>
															<td width='70%'><input type=\"text\" name=\"tel2\"></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Celular</strong></td>
															<td width='70%'><input type=\"text\" name=\"cel\" placeholder=\"92266-0847\"></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Email</strong></td>
															<td width='70%'><input type=\"text\" name=\"email\" placeholder=\"asd@zxc.com\"></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Data de Nascimento</strong></td>
															<td width='70%'><input type=\"date\" name=\"dob\" placeholder=\"02/01/1990\"></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Endereço</strong></td>
															<td width='70%'><input type=\"text\" name=\"endereco\" placeholder=\"Voluntariaos da Patria\" required></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>CEP</strong></td>
															<td width='70%'><input type=\"text\" name=\"cep\" placeholder=\"22270-010\" required></input></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Bairro</strong></td>
															<td width='70%'><select name=\"bairro\" align=\"center\" style=\"font-size:125%\">
																<option value=\"Outros\">OUTROS</option>
																<option value=\"-----------\">--------------------------</option>
																<option value=\"Aeroporto\">AEROPORTO</option>
																<option value=\"Alto Da Boa Vista\">ALTO DA BOA VISTA</option>
																<option value=\"Andaraí\">ANDARAÍ</option>
																<option value=\"Benfica\">BENFICA</option>
																<option value=\"Botafogo\">BOTAFOGO</option>
																<option value=\"Cajú\">CAJÚ</option>
																<option value=\"Castelo\">CASTELO</option>
																<option value=\"Catete\">CATETE</option>
																<option value=\"Catumbi\">CATUMBI</option>
																<option value=\"Centro\">CENTRO</option>
																<option value=\"Cidade Nova\">CIDADE NOVA</option>
																<option value=\"Copacabana\">COPACABANA</option>
																<option value=\"Cosme Velho\">COSME VELHO</option>
																<option value=\"Estácio\">ESTÁCIO</option>
																<option value=\"Fátima\">FÁTIMA</option>
																<option value=\"Flamengo\">FLAMENGO</option>
																<option value=\"Gamboa\">GAMBOA</option>
																<option value=\"Gávea\">GÁVEA</option>
																<option value=\"Glória\">GLÓRIA</option>
																<option value=\"Grajaú\">GRAJAÚ</option>
																<option value=\"Humaitá\">HUMAITÁ</option>
																<option value=\"Ipanema\">IPANEMA</option>
																<option value=\"Jardim Botânico\">JARDIM BOTÂNICO</option>
																<option value=\"Lagoa\">LAGOA</option>
																<option value=\"Lapa\">LAPA</option>
																<option value=\"Laranjeiras\">LARANJEIRAS</option>
																<option value=\"Leblon\">LEBLON</option>
																<option value=\"Leme\">LEME</option>
																<option value=\"Mangueira\">MANGUEIRA</option>
																<option value=\"Maracanã\">MARACANÃ</option>
																<option value=\"Praça Da Bandeira\">PRAÇA DA BANDEIRA</option>
																<option value=\"Praça Mauá\">PRAÇA MAUÁ</option>
																<option value=\"Rio Comprido\">RIO COMPRIDO</option>
																<option value=\"Rocinha\">ROCINHA</option>
																<option value=\"Santa Teresa\">SANTA TERESA</option>
																<option value=\"Santo Cristo\">SANTO CRISTO</option>
																<option value=\"São Conrado\">SÃO CONRADO</option>
																<option value=\"São Cristóvão\">SÃO CRISTÓVÃO</option>
																<option value=\"Saúde\">SAÚDE</option>
																<option value=\"Tijuca\">TIJUCA</option>
																<option value=\"Urca\">URCA</option>
																<option value=\"Vasco Da Gama\">VASCO DA GAMA</option>
																<option value=\"Vila Isabel	\">VILA ISABEL</option>
																<option value=\"Vidigal\">VIDIGAL</option>
															<select></td>
														</tr>
														
														<tr>
															<td width='30%'><strong>Comunidade</strong></td>
															<td width='70%'><select name=\"comunidade\" align=\"center\" style=\"font-size:125%\">
																<option value=\"---\">---</option>
															";
															for ($i=0;$i<count($comunidades);$i++)
															{
																$value = $comunidades[$i];
																echo "<option value=\"$value\">$value</option>";
															}
															echo "<select></td>
														</tr>
														";
														?>

														<tr>
															<td width='30%'><strong>Documentos</strong></td>
															<td width='70%'>
																<strong>RG</strong>
																<input type="file"  name="rgdoc" accept=".pdf" required>
																<strong>CPF</strong>
																<input type="file"  name="cpfdoc" accept=".pdf" required>
																<strong>Comprovante de Renda</strong>
																<input type="file"  name="crendoc" accept=".pdf" required>
																<strong>Comprovante de Residencia</strong>
																<input type="file"  name="cresdoc" accept=".pdf" required>
															</td>
														</tr>
														
														<?php
														echo "
														<tr bgcolor=\"#000000\">
															<td colspan=\"2\"><strong></strong></td>
														</tr>
														<tr>
															
																<td><strong>Foto</strong></td>
																<td><input type=\"file\"  name=\"foto\" accept=\".pdf,image/*\" required></td>
															
														</tr>
														
														<tr align=\"center\">
															<td colspan=\"2\"><input type=\"submit\" value=\"Cadastrar\"></input></td>
														</tr>
														
													</tbody>
											</table>;
										</div>
									</form>
								";
								
							
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