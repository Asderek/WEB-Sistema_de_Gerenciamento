<?php
									
	include('../../newconexao.php');
	
	$matricula = $_POST['matricula'];
	$professor = $_POST['professor'];
	$escolha = "";
	if (!empty($_POST["escolha"]))
	{    
		$escolha = $_POST['escolha'];
	}
	
	if ($professor == "" || $escolha == "")
	{
		echo "<form id=\"id_auto\" action=\"confirmacao.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"error\" value=\"1\">";
			echo "<input type=\"hidden\" name=\"professor\" value=\"$professor\">";
			echo "<input type=\"hidden\" name=\"escolha\" value=\"$escolha\">";
		echo "</form>";
		echo "<script>
				document.getElementById(\"id_auto\").submit();
			  </script>";
		return;
	}

	$sqlAluno1 = "SELECT * FROM alunos WHERE matricula = $matricula";
	$queryAluno1 = $conexao->query($sqlAluno1);
	$resultAluno1 = $queryAluno1->fetchAll( PDO::FETCH_ASSOC );
	$rowsAluno1 = count($resultAluno1);
	
	if($rowsAluno1 <0)
	{
		echo 'aluno nao esta escrito no ema';
		echo '<a href="inicio.php">asd</a>';
		
	}
	else
	{
		$nome = $resultAluno1[0]['nome'];									
	
		
		
		$sqlAluno = "SELECT * FROM alunosplantao WHERE matricula = $matricula";
		$queryAluno = $conexao->query($sqlAluno);
		$resultAluno = $queryAluno->fetchAll( PDO::FETCH_ASSOC );
		$rowsAluno = count($resultAluno);
		
		if($rowsAluno>0)
		{
			$sqlUpdate = "UPDATE `alunosplantao` SET `professor`=\"$professor\", `horario` = \"$escolha\"  WHERE matricula = $matricula";
			$queryUpdate = $conexao->query($sqlUpdate);
			if($queryUpdate != false)
			{
				echo '<h3 class="text-center">Cadastro atualizado com sucesso</h3>';
				echo '<br>';
				echo "<h4 class=\"text-center\">Seu novo horario é $escolha<br> com o professor $professor</h4>";
				
					$email = $resultAluno1[0]['email'];
					if(strpos($email,"@") != false)
					{
				
						$headers = 'From: npj@puc-rio.br' . "\r\n" .
					'Reply-To: npj@puc-rio.br' . "\r\n";
						$subject = "Confirmação Cadastro de Plantão";
						$msg = "Prezada(o) $nome, o seu cadastro no plantão foi atualizado com sucesso\nSeguem os dados do Cadastro:\n\nProfessor(a): $professor\nHorario: $escolha\n\n";
						$msg2 = "Esta é uma resposta automatica, por favor, não responda a este e-mail.\nQualquer duvida, dirija-se à secretária do NPJ\nNúcleo de Prática Jurídica da PUC-Rio\nEMA - 	Escritório Modelo de Advocacia\nnpj@puc-rio.br / https://www.facebook.com/npjpuc\nTelefax.:3527-1399";
						$msg = $msg.$msg2;
						mail($email,$subject,$msg,$headers);
					}
			}
			else
			{
				echo '<h3 class="text-center">Não foi possivel cadastrar o aluno.<br> Por favor, procure a secretaria.</h3>';
				echo "<a href=\"http://www.jur.puc-rio.br/npj/plantao/aluno/inicio.php\" class=\"btn btn-primary btn-lg\">Cadastrar Plantoes</a>";
			}										
		}else
		{
			$sqlInsert = "INSERT INTO `alunosplantao`(`matricula`, `nome`, `professor`, `horario`) VALUES ($matricula,\"$nome\",\"$professor\",\"$escolha\")	";
			$queryInsert = $conexao->query($sqlInsert);
			if($queryInsert != false)
			{
				echo '<h3 class="text-center">Cadastro realizado com sucesso</h3>';
				echo '<br>';
				echo "<h4 class=\"text-center\">Seu horario é $escolha<br> com o(a) professor(a) $professor</h4>";
				
					$email = $resultAluno1[0]['email'];
					if(strpos($email,"@") != false)
					{
				
						$headers = 'From: npj@puc-rio.br' . "\r\n" .
					'Reply-To: npj@puc-rio.br' . "\r\n";
						$subject = "Confirmação Cadastro de Plantão";
						$msg = "Prezada(o) $nome, o seu cadastro no plantão foi atualizado com sucesso\nSeguem os dados do Cadastro:\n\nProfessor(a): $professor\nHorario: $escolha\n\n";
						$msg2 = "Esta é uma resposta automatica, por favor, não responda a este e-mail.\nQualquer duvida, dirija-se à secretária do NPJ\nNúcleo de Prática Jurídica da PUC-Rio\nEMA - 	Escritório Modelo de Advocacia\nnpj@puc-rio.br / https://www.facebook.com/npjpuc\nTelefax.:3527-1399";
						$msg = $msg.$msg2;
						mail($email,$subject,$msg,$headers);
					}
			}
			else
			{
				echo '<h3 class="text-center">Não foi possivel cadastrar o aluno.<br> Por favor, procure a secretaria.</h3>';
				echo "<a href=\"http://www.jur.puc-rio.br/npj/plantao/aluno/inicio.php\" class=\"btn btn-primary btn-lg\">Cadastrar Plantoes</a>";
			}	
		}
		
		echo "<form id=\"id_auto\" action=\"confirmacao.php\" method=\"post\">";
			echo "<input type=\"hidden\" name=\"professor\" value=\"$professor\">";
			echo "<input type=\"hidden\" name=\"escolha\" value=\"$escolha\">";
		echo "</form>";
		echo "<script>
				document.getElementById(\"id_auto\").submit();
			  </script>";
	} 	
		
	
?>