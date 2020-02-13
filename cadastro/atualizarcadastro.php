<?php

	include ('../../newconexao.php');

	$tel1 = $_POST['tel1'];
	$tel2 = $_POST['tel2'];
	$cel = $_POST['cel'];
	$email = $_POST['email'];
	$cpf = $_POST['cpf'];
	$bairro = $_POST['bairro'];
	$comunidade = $_POST['comunidade'];
	$endereco = $_POST['endereco'];
	
	$tipo = $_POST['tipo'];
	
	echo "tel1 = $tel1<br>";
	echo "tel2 = $tel2<br>";
	echo "cel = $cel<br>";
	echo "email = $email<br>";
	echo "cpf = $cpf<br>";
	echo "bairro = $bairro<br>";


	if ($tipo == "Atualizar Documento")
	{
			include ('../utils/documentos.php');
			
			$CPF = $_POST['cpf'];
			
			$diretorio = DOCUMENTS_GETDOCUMENTPATH($CPF);
			
			
			{
				/*TRATAR OS ARQUIVOS*/
				
				$continue = true;
				
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
			
				if ($_FILES['cpfdoc']['size'] != 0 && $_FILES['cpfdoc']['error'] == 0)
				{
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
						$continue = false;
						echo '<h5 class="text-center">Arquivo1 nao pode ser enviado, contate a secretaria.<p></p>';
						//echo '<a href="inscricao-cadastro.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
					}
					
					
					$newpath = $diretorio.'/'."CPF".".".$ext1;
					$oldpath = $diretorio.'/'.$path1;
					rename	($oldpath,$newpath);
				}
			
			
				if ($_FILES['rgdoc']['size'] != 0 && $_FILES['rgdoc']['error'] == 0)
				{
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
						$continue = false;
						//echo '<a href="inscricao-cadastro.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
					}
					
					
					$newpath = $diretorio.'/'."RG".".".$ext2;
					$oldpath = $diretorio.'/'.$path2;
					rename	($oldpath,$newpath);
				}
				
				if ($_FILES['cresdoc']['size'] != 0 && $_FILES['cresdoc']['error'] == 0)
				{
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
						$continue = false;
						//echo '<a href="inscricao-cadastro.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
					}
					
					$newpath = $diretorio.'/'."CompResidencia".".".$ext3;
					$oldpath = $diretorio.'/'.$path3;
					rename	($oldpath,$newpath);
				}
				
				
				if ($_FILES['crendoc']['size'] != 0 && $_FILES['crendoc']['error'] == 0)
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
						$continue = false;
						//echo '<a href="inscricao-cadastro.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
					}
					
					$newpath = $diretorio.'/'."CompRenda".".".$ext4;
					$oldpath = $diretorio.'/'.$path4;
					rename	($oldpath,$newpath);
				}
				
				if ($_FILES['foto']['size'] != 0 && $_FILES['foto']['error'] == 0)
				{
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
						$continue = false;
						//echo '<a href="inscricao-cadastro.php" class="btn btn-primary btn-lg btn-block">página inicial</a>';
					}
					
					$newpath = $diretorio.'/'."foto".".jpg";
					$oldpath = $diretorio.'/'.$path5;
					rename	($oldpath,$newpath);
				}
				
			}
			if ($continue == false)
			{
				echo "Cadastro não foi atualizado<br>Confirme os dados, e tente novamente<br>";
				return;
			}
			else
			{		
				echo "	<form id=\"id_form\" action=\"index.php\" method=\"post\">
						</form>
						<script>
							document.getElementById('id_form').submit();
						</script>
				";
			}
	}
	else 
	{
		$sqlUpdate = "UPDATE `assistidos` SET ";
		if (!empty($tel1))
		{
			$sqlUpdate = $sqlUpdate."`tel1`=\"$tel1\"";
			$virgula = true;
		}
		if (!empty($tel2))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`tel2`=\"$tel2\"";
			$virgula = true;
		}
		if (!empty($cel))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`cel`=\"$cel\"";
			$virgula = true;
		}
		if (!empty($email))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`email`=\"$email\"";
			$virgula = true;
		}
		if (!empty($bairro))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`bairro`=\"$bairro\"";
		}
		if (!empty($comunidade))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`comunidade`=\"$comunidade\"";
		}
		if (!empty($endereco))
		{
			if ($virgula == true)
				$sqlUpdate = $sqlUpdate.",";
			$sqlUpdate = $sqlUpdate."`endereco`=\"$endereco\"";
		}
		
		$sqlUpdate = $sqlUpdate." WHERE `cpf` = \"$cpf\"";
		
		echo "sqlUpdate = $sqlUpdate<br>";
		
		$queryUpdate = $conexao->query($sqlUpdate);
		if ($queryUpdate == false)
		{
			echo "Cadastro não foi atualizado<br>Confirme os dados, e tente novamente<br>";
			return;
		}
		else
		{		
			echo "	<form id=\"id_form\" action=\"index.php\" method=\"post\">
					</form>
					<script>
						document.getElementById('id_form').submit();
					</script>
			";
		}
	}
	
	
	
?>