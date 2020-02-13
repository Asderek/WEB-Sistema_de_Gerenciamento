<?php
	
	include('../utils/newconexao.php');
	
	$matricula = $_POST['matricula'];
	$indexAtendimento = $_POST['index_atendimento'];
	$cpf = $_POST['cpf'];
	$nome = $_POST['nome'];
	$local = $_POST['local'];
	$data = $_POST['data'];
	$hora = $_POST['hora'];
	
	
	$ano = substr($data,0,4);
	$mes = substr($data,5,2);
	$dia = substr($data,8,2);
	
	
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
	
	$sqlInsert = "INSERT INTO `audiencias`(`id_atendimento`, `cpf`, `nome`, `matricula`, `dia`, `mes`, `ano`, `hora`, `local`) VALUES ($indexAtendimento,\"$cpf\",\"$nome\",$matricula,\"$dia\",\"$mes\",\"$ano\", \"$hora\", \"$local\")";
	echo "sqlInsert = $sqlInsert<br>";
	$queryInsert = $conexao->query($sqlInsert);
	if ($queryInsert!=false)
	{
		echo "<form action=\"mainProfessor.php\" method=\"post\" id=\"id_auto\">
				<input type=\"hidden\" value=\"$matricula\" name=\"matricula\">
			  </form>
			  <script>
				document.getElementById('id_auto').submit();
			  </script>
		";
	}
	else
	{
		echo "<form action=\"mainProfessor.php\" method=\"post\" id=\"id_auto\">
				<input type=\"hidden\" value=\"$matricula\" name=\"matricula\">
				<h3 class=\"text-center\">Ocorreu um erro ao cadastrar a audiencia, contate a informatica</h3>
				<input type=\"submit\" value=\"Voltar\">
			  </form>";
	}
	
?>






