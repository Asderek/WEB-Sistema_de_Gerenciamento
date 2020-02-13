<?php

	include ('../../newconexao.php');
	include ('../../email.php');

	$goBack = false;
	$professor = $_POST['professor'];
	$sbj = $_POST['subject'];
	$msg = $_POST['descricao'];
	$ema1 = $_POST['EMA1'];
	$ema2 = $_POST['EMA2'];
	$ema3 = $_POST['EMA3'];
	$ema4 = $_POST['EMA4'];
	$cc = $_POST['cc'];
	$destino = $_POST['destino'];
	
	$emails = array();
	
	$ema1 = $ema1 == 'on' ? 1:0;
	$ema2 = $ema2 == 'on' ? 1:0;
	$ema3 = $ema3 == 'on' ? 1:0;
	$ema4 = $ema4 == 'on' ? 1:0;
	
	$sql = '';
	
	if (($ema1 + $ema2 + $ema3 + $ema4) == 0)
	{
		if ($professor == 'none')
		{
			$goBack = true;
		}
		else
		{
			if ($destino == 'turma')
				$sql = "`professor` = \"$professor\"";
			else
			{
				$sqlAbr = "SELECT * FROM `horariosplantao` WHERE `nome` = \"$professor\"";
				$queryAbr = $conexao->query($sqlAbr);
				$resultAbr = $queryAbr->fetchAll( PDO::FETCH_ASSOC );
				$abr = $resultAbr[0]['abr'];
				$sqlMatriculas = "SELECT * FROM `alunosplantao` WHERE `professor` = \"$abr\"";
				$queryMatriculas = $conexao->query($sqlMatriculas);
				$resultMatriculas = $queryMatriculas->fetchAll( PDO::FETCH_ASSOC );
				for ($i=0;$i<count($resultMatriculas);$i++)
				{
					$matricula = $resultMatriculas[$i]['matricula'];
					$sqlEmail = "SELECT * FROM `alunos` WHERE matricula = $matricula";
					$queryEmail = $conexao->query($sqlEmail);
					$resultEmail = $queryEmail->fetchAll( PDO::FETCH_ASSOC );
					array_push($emails,$resultEmail[0]['email']);
				}
				
			}
		}
	}
	else
	{
		if ($professor != 'none')
		{
			$goBack = true;
		}
		else
		{
			if ($ema1 == 1)
			{
				if ($sql != '')
					$sql = $sql." OR ";
				$sql = $sql."`disciplina` = \"JUR1961\" ";
			}
			if ($ema2 == 1)
			{
				if ($sql != '')
					$sql = $sql." OR ";
				$sql = $sql."`disciplina` = \"JUR1962\" ";
			}
			if ($ema3 == 1)
			{
				if ($sql != '')
					$sql = $sql." OR ";
				$sql = $sql."`disciplina` = \"JUR1963\" ";
			}
			if ($ema4 == 1)
			{
				if ($sql != '')
					$sql = $sql." OR ";
				$sql = $sql."`disciplina` = \"JUR1964\" ";
			}
		}
	}
	
	if (($sbj == '') || ($msg == ''))
	{
		$goBack = true;
	}
	
	if ($goBack == true)
	{
		echo "<form id=\"id_form\" action=\"chooseClass.php\" method=\"post\">
					</form>
					<script>
						document.getElementById(\"id_form\").submit();
					</script>";
	}
	
	if (count($emails) == 0)
	{
		$sqlEmails = "SELECT * FROM `alunos` WHERE " . $sql;
		$queryEmails = $conexao->query($sqlEmails);
		$resultEmails = $queryEmails->fetchAll( PDO::FETCH_ASSOC );
		for ($i=0;$i<count($resultEmails);$i++)
		{
			array_push($emails,$resultEmails[$i]['email']);
		}
	}
	
	$cont = 0;
	while (strpos($cc,';') != false)
	{
		$cont++;
		$email = substr($cc,0,strpos($cc,';'));
		$cc = substr($cc,strpos($cc,';')+1);
		
		echo "email = $email<br>";
		echo "cc = $cc<br>";
		
		array_push($emails,$email);
		
		if ($cont > 10)
			break;
	}
	array_push($emails,$cc);
	
	for ($i=0;$i<count($emails);$i++)
	{
		$email = $emails[$i];
		if (strpos($email,"@") != false)
		{
			echo "sent to $email<br>";
			EMAIL_SEND($email,$sbj,$msg);
		}
	}
	echo "<form id=\"id_form\" action=\"mainSecretaria.php\" method=\"post\">
					</form>
					<script>
						document.getElementById(\"id_form\").submit();
					</script>";


?>