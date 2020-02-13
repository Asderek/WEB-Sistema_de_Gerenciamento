<?php 
	include("../../newconexao.php");

	$escolha = $_POST['index'];
	$index = substr($escolha,4);
	
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
			
			echo "matricula = $matriculaAluno<br>";
			$comentario = $_POST['comentario'];
			
			$sqlRej = "UPDATE `atividades` SET `pendente`=-1, `horas`=0, `comentario` = \"$comentario\"  WHERE `index` = $index";
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
		if ($resultAcc[0]['tipo'] == "oab")
		{
			$sqlAcc = "UPDATE `atividades` SET `pendente`=0 WHERE `index` = $index";
			$queryAcc = $conexao->query($sqlAcc);
			if ($queryAcc == false)
			{
				echo "return Acc<br>";
				return;
			}
			$sqlOAB = "UPDATE `alunos` SET `oab`= 1, `L1` = 10 WHERE `matricula` = $matriculaAluno";
			$queryOAB = $conexao->query($sqlOAB);
			if ($queryOAB == false)
			{
				echo "return OAB<br>$sqlOAB<br>";
				return;
			}
		}
		else if ($resultAcc[0]['tipo'] == "oficina")
		{
			$sqlAcc = "UPDATE `atividades` SET `pendente`=0 WHERE `index` = $index";
			$queryAcc = $conexao->query($sqlAcc);
			if ($queryAcc == false)
			{
				echo "return Acc<br>";
				return;
			}
			$sqlOAB = "UPDATE `alunos` SET `oficina`= 1 WHERE `matricula` = $matriculaAluno";
			$queryOAB = $conexao->query($sqlOAB);
			if ($queryOAB == false)
			{
				echo "return oficina<br>$sqlOAB<br>";
				return;
			}
		}
		else if ($resultAcc[0]['tipo'] == "primFase")
		{
			$primFase = $_POST['acertos'];
			$sqlAcc = "UPDATE `atividades` SET `pendente`=0 WHERE `index` = $index";
			$queryAcc = $conexao->query($sqlAcc);
			if ($queryAcc == false)
			{
				echo "return Acc<br>";
				return;
			}
			$sqlOAB = "UPDATE `alunos` SET `primFase`= $primFase WHERE `matricula` = $matriculaAluno";
			$queryOAB = $conexao->query($sqlOAB);
			if ($queryOAB == false)
			{
				echo "return primFase<br>$sqlOAB<br>";
				return;
			}
		}
		else
		{
			$sqlAcc = "UPDATE `atividades` SET `pendente`=1 WHERE `index` = $index";
			$queryAcc = $conexao->query($sqlAcc);
			if ($queryAcc == false)
			{
				echo "return Acc<br>";
				return;
			}
		}
	}
	echo "
						<form id=\"myForm\" class=\"form col-md-12 center-block\" action='mainSecretaria.php' method=\"post\">
							<input type=\"hidden\" name=\"mode\" value=\"pendencias\"></input>
						</form>		
						<script type=\"text/javascript\">
							document.getElementById('myForm').submit();
						</script>
				";
	
	
?>