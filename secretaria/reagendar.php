<?php 
	include("../../newconexao.php");
	include("../../email.php");
	
	$proximoAtendimento = $_POST['proximoatendimento'];
	$proximaHora = $_POST['proximahora'];
	$index = $_POST['index'];
	$matricula = $_POST['matricula'];
	
	
	$ano = substr($proximoAtendimento,0,4);
	$mes = substr($proximoAtendimento,5,2);
	$dia = substr($proximoAtendimento,8,2);
	
	
	switch($mes)
	{
		case "01":
			$mes = "jan";
			break;
		case "02":
			$mes = "fev";
			break;
		case "03":
			$mes = "mar";
			break;
		case "04":
			$mes = "abr";
			break;
		case "05":
			$mes = "mai";
			break;
		case "06":
			$mes = "jun";
			break;
		case "07":
			$mes = "jul";
			break;
		case "08":
			$mes = "ago";
			break;
		case "09":
			$mes = "set";
			break;
		case "10":
			$mes = "out";
			break;
		case "11":
			$mes = "nov";
			break;
		case "12":
			$mes = "dez";
			break;
	}
	
	
	
	$proximoAtendimento = $dia."-".$mes."-".$ano;
	if (isset($_POST['cancelar']))
	{
		print_R($_POST);
		$data = date(DATE_RFC822);
		$proximaHora = "";
		$proximoAtendimento = "";
		$sqlUpdate = "UPDATE `atendimentos` SET `dataDeRetorno`=\"$proximoAtendimento\", `hora`=\"$proximaHora\", `dataUltimaAtualizacao`=\"$data\"  WHERE `index` = $index";
		$queryUpdate = $conexao->query($sqlUpdate);
		if ($queryUpdate != false)
		{
			
			echo "
							<form id=\"myForm\" class=\"form col-md-12 center-block\" action='mainSecretaria.php' method=\"post\">	";
							
							echo "
									<input type=\"hidden\" value=\"vercaso$index\" name=\"mode\">
									<script type=\"text/javascript\">
										document.getElementById('id_Form').submit();
									</script>
							";
							
							echo "
							</form>		
							<script type=\"text/javascript\">
								document.getElementById('myForm').submit();
							</script>
					";
		}
		else
		{
			echo "Deu Problema, da uma olhada<br>";
		}
	}
	else if ($proximoAtendimento == "--")
	{
		echo "
						<form id=\"myForm\" class=\"form col-md-12 center-block\" action='mainSecretaria.php' method=\"post\">
							<input type=\"hidden\" name=\"mode\" value=\"calendario\"></input>
						</form>		
						<script type=\"text/javascript\">
							document.getElementById('myForm').submit();
						</script>
				";
	}
	else
	{
		$sqlBloqueio = "SELECT * FROM `calendario` WHERE `dia` = \"$dia\" AND `mes` = \"$mes\" AND `ano` = \"$ano\" AND `bloqueado` = 1";
		$queryBloqueio = $conexao->query($sqlBloqueio);
		if($queryBloqueio != false)
		{
			$resultBloqueio = $queryBloqueio->fetchAll(PDO::FETCH_ASSOC);
			$rowsBloqueio = count($resultBloqueio);
			if ($rowsBloqueio>0)
			{
				echo "<p align=\"center\">";
				echo "<h1>Não é possivel marcar um atendimento nesse dia<br>Tente Novamente</h1>";
				echo "<h2>Não é possivel marcar um atendimento nesse dia<br>Tente Novamente</h2>";
				echo "<h3>Não é possivel marcar um atendimento nesse dia<br>Tente Novamente</h3>";
				echo "<h4>Não é possivel marcar um atendimento nesse dia<br>Tente Novamente</h4>";
				echo "<h5>Não é possivel marcar um atendimento nesse dia<br>Tente Novamente</h5>";
				
				echo "<a href=\"javascript:history.go(-1)\" class=\"button btn-primary btn-lg btn-block\">Voltar</a>";
				echo "</p>";
				return;
			}
		}
		
		$sqlResponsavel = "SELECT * FROM `atendimentos` WHERE `index` = $index";
		$sqlResponsavel = "SELECT * FROM `professores` WHERE `matricula` = \"$matricula\"";
		$queryResponsavel = $conexao->query($sqlResponsavel);
		$resultResponsavel = $queryResponsavel->fetchAll(PDO::FETCH_ASSOC);
		$responsavel = $resultResponsavel[0]['responsavel'];
		
		$sqlOcupado = "SELECT * FROM `atendimentos` WHERE `dataDeRetorno` = \"$proximoAtendimento\" AND `hora` = \"$proximaHora\" AND `responsavel` = \"$responsavel\"";
		$queryOcupado = $conexao->query($sqlOcupado);
		if($queryOcupado != false)
		{
			$resultOcupado = $queryOcupado->fetchAll(PDO::FETCH_ASSOC);
			$rowsOcupado = count($resultOcupado);
			if ($rowsOcupado>0)
			{
				echo "<p align=\"center\">";
				echo "<h1>Já existe um outro cliente marcado para esse dia e esse horario<br>Tente Novamente</h1>";
				echo "<h2>Já existe um outro cliente marcado para esse dia e esse horario<br>Tente Novamente</h2>";
				echo "<h3>Já existe um outro cliente marcado para esse dia e esse horario<br>Tente Novamente</h3>";
				echo "<h4>Já existe um outro cliente marcado para esse dia e esse horario<br>Tente Novamente</h4>";
				echo "<h5>Já existe um outro cliente marcado para esse dia e esse horario<br>Tente Novamente</h5>";
				
				echo "<a href=\"javascript:history.go(-1)\" class=\"button btn-primary btn-lg btn-block\">Voltar</a>";
				echo "</p>";
				return;
			}
		}
		
		$data = date(DATE_RFC822);
		
		$sqlUpdate = "UPDATE `atendimentos` SET `dataDeRetorno`=\"$proximoAtendimento\", `hora`=\"$proximaHora\", `dataUltimaAtualizacao`=\"$data\"  WHERE `index` = $index";
		$queryUpdate = $conexao->query($sqlUpdate);
		if ($queryUpdate != false)
		{
			$input = $proximaHora.'h';
			echo "
							<form id=\"myForm\" class=\"form col-md-12 center-block\" action='cadastrarcomentario.php' method=\"post\">								
								<input type=\"hidden\" name=\"matricula\" value=\"Secretaria\"></input>
								<input type=\"hidden\" name=\"index\" value=\"$index\"></input>
								<input type=\"hidden\" name=\"comment\" value=\"Assistido reagendado para o dia $dia-$mes-$ano as $input\"></input>
							</form>		
							<script type=\"text/javascript\">
								document.getElementById('myForm').submit();
							</script>
					";
		}
		else
		{
			echo "Deu Problema, da uma olhada<br>";
		}
	}
	
	
?>