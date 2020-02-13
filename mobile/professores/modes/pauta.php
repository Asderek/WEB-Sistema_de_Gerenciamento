
<?php
	include ('../../utils/newconexao.php');
	$nomeProfessor = PROFESSORES_GETNAME($matricula);
	$sqlPauta = "SELECT * FROM `alunos` WHERE `professor` = \"$nomeProfessor\" ORDER BY nome";
	$queryPauta = $conexao->query($sqlPauta);
	if ($queryPauta != false)
	{
		$resultPauta = $queryPauta->fetchAll(PDO::FETCH_ASSOC);
		$rowsPauta = count($resultPauta);
		echo "<div class=\"w3-container\">";
		echo "<form action=\"main.php\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
		for($i=0;$i<$rowsPauta;$i++)
		{
			$matriculaAluno = $resultPauta[$i]['matricula'];
			$nome = $resultPauta[$i]['nome'];
			$L1 = $resultPauta[$i]['l1'];
			$horas = $resultPauta[$i]['horas'];
			
			$primeiroNome = substr($nome,0,strpos($nome," "));
			$pieces = explode(' ', $nome);
			$ultimoNome = array_pop($pieces);
			
			$nome = $primeiroNome." ".$ultimoNome;
			
			if($horas < 75)
				$horas = 0;
			else if (($horas >= 75) && ($horas < 80))
				$horas = 5;
			else if (($horas >= 80) && ($horas < 85))
				$horas = 6;
			else if (($horas >= 85) && ($horas < 90))
				$horas = 7;
			else if (($horas >= 90) && ($horas < 95))
				$horas = 8;
			else if (($horas >= 95) && ($horas < 100))
				$horas = 9;
			else 
				$horas = 10;
			
			echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\">
					<h4><button type=\"submit\" value=\"infoAluno_$matriculaAluno\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\">$nome</button></h4>
				  </div>
				</div>  
			</hr>
			";
		}
		echo "</form>";
		echo "</div>";
	}
?>
