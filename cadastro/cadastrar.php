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
							include('../../newconexao.php');
							include ('../utils/documentos.php');
							include('../../injection.php');
							
							$CPF = $_POST['cpf'];
							$nome = $_POST['nome'];
							$rg = $_POST['rg'];
							$tel1 = $_POST['tel1'];
							$tel2 = $_POST['tel2'];
							$cel = $_POST['cel'];
							$dob = $_POST['dob'];
							$bairro = $_POST['bairro'];
							$email = $_POST['email'];
							$comunidade = $_POST['comunidade'];
							$endereco = $_POST['endereco'];
							$cep = $_POST['cep'];
							
							echo "endereco = $endereco<br>";
							
							$diretorio = DOCUMENTS_GETDOCUMENTPATH($CPF);
							
							
							{
								/*TRATAR OS ARQUIVOS*/
								
								$cpfdoc = $_FILES['cpfdoc'];
								$rgdoc = $_FILES['rgdoc'];
								$cresdoc = $_FILES['cresdoc'];
								$crendoc = $_FILES['crendoc'];
								$foto = $_FILES['foto'];
															
								$path1 = $_FILES['cpfdoc']['name'];
								$ext1 = pathinfo($path1, PATHINFO_EXTENSION);
								$path2 = $_FILES['rgdoc']['name'];
								$ext2 = pathinfo($path2, PATHINFO_EXTENSION);
								$path3 = $_FILES['cresdoc']['name'];
								$ext3 = pathinfo($path3, PATHINFO_EXTENSION);
								$path4 = $_FILES['crendoc']['name'];
								$ext4 = pathinfo($path4, PATHINFO_EXTENSION);
								$path5 = $_FILES['foto']['name'];
								$ext5 = pathinfo($path5, PATHINFO_EXTENSION);
								
								$ext1 = strtolower($ext1);
								$ext2 = strtolower($ext2);
								$ext3 = strtolower($ext3);
								$ext4 = strtolower($ext4);
								$ext5 = strtolower($ext5);
								
								echo "path1 = $path1<br>";
								echo "ext1 = $ext1<br><br>";
								
								echo "path2 = $path2<br>";
								echo "ext2 = $ext2<br><br>";
								
								echo "path3 = $path3<br>";
								echo "ext3 = $ext3<br><br>";
								
								echo "path4 = $path4<br>";
								echo "ext4 = $ext4<br><br>";
								
								echo "path5 = $path5<br>";
								echo "ext5 = $ext5<br><br>";
								
								if($ext1 != "pdf" || $ext2 != "pdf" || $ext3 != "pdf" || $ext4 != "pdf")
								{
									echo '<h5 class="text-center">Tipo do arquivo invalido, por favor, tente novamente.<p></p>';
									//echo '<a href="inscricao-cadastro.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
								}
							
							
								$target_Path = $diretorio.'/';
								if (is_dir($target_Path) != 1)
								{
									mkdir($target_Path, 0775);
								}
								else
								{
									chmod($target_Path, 0775);
								}

								$target_Path = $target_Path.basename($path1);
								
								 
								if(move_uploaded_file( $_FILES['cpfdoc']['tmp_name'], $target_Path ) == false)
								{
									echo "targetPath = $target_Path<br>";
									echo '<h5 class="text-center">Arquivo1 nao pode ser enviado, contate a secretaria.<p></p>';
									return;
									//echo '<a href="inscricao-cadastro.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
								}
								
								
								$newpath = $diretorio.'/'."CPF".".".$ext1;
								$oldpath = $diretorio.'/'.$path1;
								rename	($oldpath,$newpath);
								
								$target_Path2 = $diretorio.'/';
								if (is_dir($target_Path2) != 1)
								{
									mkdir($target_Path2, 0775);
								}
								else
								{
									chmod($target_Path2, 0775);
								}
								$target_Path2 = $target_Path2.basename($path2);
								 
								echo "TargetPath2 = $target_Path2<br><br>";
								 
								if(move_uploaded_file( $_FILES['rgdoc']['tmp_name'], $target_Path2 ) == false)
								{
									echo '<h5 class="text-center">Arquivo2 nao pode ser enviado, contate a secretaria.<p></p>';
									return;
									//echo '<a href="inscricao-cadastro.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
								}
								
								
								$newpath = $diretorio.'/'."RG".".".$ext2;
								$oldpath = $diretorio.'/'.$path2;
								rename	($oldpath,$newpath);
								
								
								$target_Path3 = $diretorio.'/';
								if (is_dir($target_Path3) != 1)
								{
									mkdir($target_Path3, 0775);
								}
								else
								{
									chmod($target_Path3, 0775);
								}
								$target_Path3 = $target_Path3.basename($path3);
								 
								echo "TargetPath3 = $target_Path3<br><br>";
								 
								if(move_uploaded_file( $_FILES['cresdoc']['tmp_name'], $target_Path3 ) == false)
								{
									echo '<h5 class="text-center">Arquivo3 nao pode ser enviado, contate a secretaria.<p></p>';
									return;
									//echo '<a href="inscricao-cadastro.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
								}
								
								$newpath = $diretorio.'/'."CompResidencia".".".$ext3;
								$oldpath = $diretorio.'/'.$path3;
								rename	($oldpath,$newpath);
								
								echo "crenDoc = $crendoc<br>";
								if (!($crendoc['error'] > 0))
								{
									$target_Path4 = $diretorio.'/';
									if (is_dir($target_Path4) != 1)
									{
										mkdir($target_Path4, 0775);
									}
									else
									{
										chmod($target_Path4, 0775);
									}
									$target_Path4 = $target_Path4.basename($path4);
									 
									echo "TargetPath4 = $target_Path4<br><br>";
									 
									if(move_uploaded_file( $_FILES['crendoc']['tmp_name'], $target_Path4 ) == false)
									{
										echo '<h5 class="text-center">Arquivo4 nao pode ser enviado, contate a secretaria.<p></p>';
										return;
										//echo '<a href="inscricao-cadastro.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
									}
									
									$newpath = $diretorio.'/'."CompRenda".".".$ext4;
									$oldpath = $diretorio.'/'.$path4;
									rename	($oldpath,$newpath);
								}
								
								$target_Path5 = $diretorio.'/';
								if (is_dir($target_Path5) != 1)
								{
									mkdir($target_Path5, 0775);
								}
								else
								{
									chmod($target_Path5, 0775);
								}
								$target_Path5 = $target_Path5.basename($path5);
								 
								echo "TargetPath5 = $target_Path5<br><br>";
								 
								if(move_uploaded_file( $_FILES['foto']['tmp_name'], $target_Path5 ) == false)
								{
									echo '<h5 class="text-center">Arquivo4 nao pode ser enviado, contate a secretaria.<p></p>';
									return;
									//echo '<a href="inscricao-cadastro.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
								}
								
								$newpath = $diretorio.'/'."foto".".jpg";
								$oldpath = $diretorio.'/'.$path5;
								rename	($oldpath,$newpath);
								
							}
							
							
							if(injection($CPF) || injection($nome) || injection($rg) || injection($tel) || injection($dob) || injection($bairro))
							{
								echo "CPF = $CPF<br>Nome = $nome<br>RG = $rg<br>Tel = $tel<br>DoB = $dob<br>Bairro = $bairro<br>";
								echo "My code is Sanitized";
								return;
							}
							
							$SQLInsert = "INSERT INTO `assistidos`(`cpf`, `nome`, `rg`, `tel1`,`tel2`,`cel`, `email`, `dob`,`endereco`,`cep`, `bairro`, `comunidade`) VALUES (\"$CPF\",\"$nome\",\"$rg\",\"$tel1\",\"$tel2\",\"$cel\",\"$email\",\"$dob\",\"$endereco\",\"$cep\",\"$bairro\",\"$comunidade\")";
							
							echo "sqlInsert = $SQLInsert<br>";
							
							$queryInsert = $conexao->query($SQLInsert);
							
							if ($queryInsert != false)
							{
								echo "<h1> Assistido inserido com sucesso</h1>";
								echo "
										<form id=\"myForm\" class=\"form col-md-12 center-block\" action='consulta.php' method=\"post\">
											<input type=\"hidden\" name=\"cpf\" value=\"$CPF\"></input>
											<input type=\"hidden\" name=\"nome\" value=\"$nome\"></input>
											<input type=\"hidden\" name=\"rg\" value=\"$rg\"></input>
											<input type=\"hidden\" name=\"tel\" value=\"$tel\"></input>
											<input type=\"hidden\" name=\"dob\" value=\"$dob\"></input>
											<input type=\"hidden\" name=\"bairro\" value=\"$bairro\"></input>
											<input type=\"hidden\" name=\"endereco\" value=\"$endereco\"></input>
										</form>		
										<script type=\"text/javascript\">
											document.getElementById('myForm').submit();
										</script>
								";
							}
							else
							{
								echo "sqlUpdate = $SQLInsert<br>";
								
								echo "<h1>Não consegui inserir oops</h1>";
								return;
							}
								
							
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