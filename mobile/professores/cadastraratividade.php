<?php 
	include("../../utils/newconexao.php");
	include("../../utils/email.php");

	$matricula = $_POST['matricula'];
	
	echo "matricula = $matricula<br>";
	
	$escolha = $_POST['index'];
	$index = substr($escolha,4);
	$comentario = $_POST['comentario'];
	print_r($_POST);
	echo " comentario = $comentario<br>	";
		
	$sqlAcc = "SELECT * FROM `atividades` WHERE `index` = $index";
	$queryAcc = $conexao->query($sqlAcc);
	if ($queryAcc == false)
	{
		echo "return Update Acc<br>";
		return;
	}
	else
	{
		echo "queryAcc == true<br>"; 
	}
	$resultAcc = $queryAcc->fetchAll( PDO::FETCH_ASSOC );
	$matriculaAluno = $resultAcc[0]['matricula'];
	
	if (strstr($escolha,"rej_"))
	{
			echo "Rejeitado = $escolha<br>";
			$escolha = substr($escolha,4);
			echo "newIndex = $index<br>";
			
			echo "matriculaAluno = $matriculaAluno<br>";
			
			$sqlRej = "UPDATE `atividades` SET `pendente`=-1, `horas`=0,`comentario`=\"$comentario\" WHERE `index` = $index";
			$queryRej = $conexao->query($sqlRej);
			if ($queryRej == false)
			{
				echo "return Rej<br>";
				return;
			}
			echo "Rej -> index = $index<br>";
			
			/*volta pra proxima tela*/
	}
	if (strstr($escolha,"acc_"))
	{
			echo "Aceito = $escolha<br>";
			$escolha = substr($escolha,4);
			echo "newIndex = $escolha<br>";
			$horasPOST = $_POST[$escolha."_horas"];
			$sqlAcc = "UPDATE `atividades` SET `pendente`=0,`horas`=$horasPOST,`comentario`=\"$comentario\" WHERE `index` = $index";
			echo "sqlAcc = $sqlAcc<br>";
			$queryAcc = $conexao->query($sqlAcc);
			if ($queryAcc == false)
			{
				echo "return Acc<br>";
				return;
			}
			echo "Accept -> index = $index<br>";
			
			$sqlInfo = "SELECT * FROM `alunos` WHERE `matricula` = $matriculaAluno";
			$queryInfo = $conexao->query($sqlInfo);
			if ($queryInfo == false)
			{
				echo "return SELECT Acc<br>";
				return;
			}
			else
			{
				echo "query = true<br>";
			}
			$resultInfo = $queryInfo->fetchAll( PDO::FETCH_ASSOC );
			$horas = $resultInfo[0]['horas'];
			
			echo "horas = $horas<br>horasPOST = $horasPOST<br>";
			
			$newHoras = $horas + $horasPOST;
			
			$sqlAcc = "UPDATE `alunos` SET `horas`=$newHoras WHERE `matricula` = $matriculaAluno";
			$queryAcc = $conexao->query($sqlAcc);
			if ($queryAcc == false)
			{
				echo "return Acc<br>";
				return;
			}
			echo "Accept -> index = $index<br>";
			
			
			
			
	}
	echo "
			<form id=\"myForm\" class=\"form col-md-12 center-block\" action='main.php' method=\"post\">
				<input type=\"hidden\" name=\"mode\" value=\"pendencias\"></input>
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\"></input>
			</form>		
			<script type=\"text/javascript\">
				document.getElementById('myForm').submit();
			</script>
	";
	
	
?>