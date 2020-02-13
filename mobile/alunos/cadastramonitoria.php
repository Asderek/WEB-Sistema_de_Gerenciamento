<?php
	include('../../utils/newconexao.php');

	$matriculaInscrito = $_POST['matricula'];


	$sqlSearch = "SELECT * FROM alunos WHERE matricula = $matriculaInscrito ";
	$querySearch = $conexao->query($sqlSearch);
	$rowsSearch = $querySearch->fetchAll( PDO::FETCH_ASSOC );

	if(count($rowsSearch) > 0)
	{
		//Aluno é de ema
		$nome = $rowsSearch[0]['nome'];
		$email = $_POST['email'];
		$professor = $_POST['professor'];
		$tel = $_POST['tel'];
		$formatura = $_POST['formatura'];
		
		$apresentacao = $_POST['apresentacao'];
		$exp = $_POST['exp'];
		$razao = $_POST['razao'];
		
		$OAB = $_POST['OAB'];
		if($OAB != 1)
			$OAB=0;
		
		$inject = false;
		$injections = array ("DROP TABLE","ALTER TABLE","INSERT","DELETE","UPDATE","SELECT");
											
		foreach($injections as $inj)
		{
			if(strpos($formatura,$inj) !== false )
			{
				$inject = true;
			}
			if(strpos($apresentacao,$inj) !== false )
			{
				$inject = true;
			}
			if(strpos($exp,$inj) !== false )
			{
				$inject = true;
			}
			if(strpos($razao,$inj) !== false )
			{
				$inject = true;
			}
		}
		
		if($inject == true)
		{
			include ("../../utils/email.php");
			
			$email = "pinheiro.lucasn@gmail.com";
			$sbj = "Tentativa de SQL Injection";
			$msg = "O usuario matricula: $matricula nome: $nome, acabou de tentar um SQL Injection no registro de monitoria.<br> Os dados sao: apresentacao = $apresentacao\nexp = $exp \n razao = $razao \n formatura = $formatura \n<br>";
			
			EMAIL_SEND_SUPRESSED($email,$sbj,$msg);
			echo "<h3> Don't think I don't know what you're trying to do.</h3>";
			echo "<a href=\"javascript:history.go(-1)\" class=\"btn btn-primary btn-lg btn-block\">Voltar</a>";
			return;
		}

		$continue = true;
		$sqlDuplicated = "SELECT * FROM inscritosmonitoria WHERE matricula = $matriculaInscrito ";
		$queryDuplicated = $conexao->query($sqlDuplicated);
		$rowsDuplicated = $queryDuplicated->fetchAll( PDO::FETCH_ASSOC );
		
		
		if(count($rowsDuplicated)>0)
		{
			for($i=0;$i<count($rowsDuplicated);$i++)
			{
				$professorDuplicated = $rowsDuplicated[$i]['professor'];
				
				if($professorDuplicated == $professor)
				{
					$continue = false;
					echo '<h5 class="text-center">Aluno ja está candidatado para a monitoria desse professor.<p></p>';
					echo '<a href=javascript:history.go(-2) class="btn btn-primary btn-lg btn-block">Voltar</a>';
				}
			}
		}
		if($continue == true)
		{				
			$sqlinsert = "INSERT INTO `inscritosmonitoria`(`matricula`, `nome`, `tel`, `email`,`formatura`, `professor`, `apresentacao`, `razao`, `exp`, `oab`, `escolhido`) VALUES ($matriculaInscrito, \"$nome\", \"$tel\", \"$email\",\"$formatura\", \"$professor\", \"$apresentacao\", \"$razao\", \"$exp\", $OAB, 0)";	

			$queryinsert = $conexao->query($sqlinsert);
			if($queryinsert != false)
			{
				echo '<h5 class="text-center">Curriculo Cadastrado com sucesso<br>Boa Sorte!!<p></p>';
				echo "<form id=\"id_auto\" method=\"post\" action=\"main.php\">
						<input type=\"hidden\" name=\"matricula\" value=\"$matriculaInscrito\">
						<input type=\"hidden\" name=\"mode\" value=\"monitoria\">
						<input type=\"hidden\" name=\"sucesso\" value=\"true\">
						</form>";
				echo "<script>
						document.getElementById('id_auto').submit();
					</script>";
				
			}
			else
			{
				echo '<h5 class="text-center">Erro ao cadastrar aluno, por favor, contate a secretaria do npj</h5><p></p>';
				echo '<a href=javascript:history.go(-1) class="btn btn-primary btn-lg btn-block">Voltar</a>';
			}
		}
	}
	
	else
	{
		echo '<h5 class="text-center">Aluno não está inscrito em EMA</h5><p></p>';
		echo '<a href="cadastro.php" class="btn btn-primary btn-lg btn-block">Página Inicial</a>';
	}
	
?>