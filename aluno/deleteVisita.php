<?php

	include("../utils/newconexao.php");

	$matricula = $_POST['matricula'];
	$visitaID = $_POST['deleteData'];
	
	$sqlEspera = "SELECT * FROM `visitasAlunos` WHERE `Matricula` = $matricula AND `VisitaID` = $visitaID";
	$queryEspera = $conexao->query($sqlEspera);
	$resultEspera = $queryEspera->fetchAll(PDO::FETCH_ASSOC);
	$espera = $resultEspera[0]['Espera'];
	
	$sqlDelete = "DELETE FROM `visitasAlunos` WHERE `Matricula` = $matricula AND `VisitaID` = $visitaID";
	$queryDelete = $conexao->query($sqlDelete);
	
	if ($espera == 0)
	{
		$sqlTurma = "SELECT * FROM alunos WHERE matricula = $matricula";
		$queryTurma = $conexao->query($sqlTurma);
		$resultTurma = $queryTurma->fetchAll(PDO::FETCH_ASSOC);
		
		$turma = $resultTurma[0]['turma'];
		
		echo "turma = $turma<br>";
		
		$sqlVisitaInfo = "SELECT * FROM `visitasAbertas` WHERE `ID` = $visitaID";
		$queryVisitaInfo = $conexao->query($sqlVisitaInfo);
		$resultVisitaInfo = $queryVisitaInfo->fetchAll(PDO::FETCH_ASSOC);
		
		switch ($turma)
		{
			case "2HA":
				$indice = 1;
				break;
			case "2HB":
				$indice = 4;
				break;
			case "2HC":
				$indice = 7;
				break;
			case "2HD":
				$indice = 10;
				break;
			case "2HE":
				$indice = 13;
				break;
			case "2HF":
				$indice = 16;
				break;
			case "2HG":
				$indice = 19;
				break;
			case "2HH":
				$indice = 22;
				break;
			case "2HX":
				$indice = 25;
				break;														
		}
		
		$vg = $resultVisitaInfo[0]['vagas'][$indice].$resultVisitaInfo[0]['vagas'][$indice+1];
		echo "VG = $vg<br>";
		$vagasTurma = intval($vg);
		echo "vagasTurma = $vagasTurma<br>";
		$vagasTurma++;
		
		$vagas = $resultVisitaInfo[0]['vagas'];
		echo "vagas = $vagas<br>";
		if ($vagasTurma < 10)
		{
			$vagasTurma = '0'.$vagasTurma;
		}
		$vagas[$indice] = $vagasTurma[0];
		$vagas[$indice+1] = $vagasTurma[1];
		echo "vagas = $vagas<br>";
		
		$sqlUpdateVagas = "UPDATE `visitasAbertas` SET `vagas`=\"$vagas\" WHERE `ID` = $visitaID";
		$queryUpdateVagas = $conexao->query($sqlUpdateVagas);
	}
	echo "<form action=\"mainAluno.php\" method=\"post\" id=\"id_auto\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
				<input type=\"hidden\" name=\"mode\" value=\"listavisitas\">
			</form>
			<script>
				document.getElementById('id_auto').submit();
			</script>
	";
?>