<?php
	include ('../../utils/newconexao.php');

	$matriculaAluno = $_POST['matriculaAluno'];
	$sqlInfo = "SELECT * FROM alunos WHERE matricula = $matriculaAluno";
	$queryInfo = $conexao->query($sqlInfo);
	if ($queryInfo != false)
	{
		$resultInfo = $queryInfo->fetchAll(PDO::FETCH_ASSOC);
		echo "<div class=\"w3-container\">";
		echo "<form action=\"main.php\" method=\"post\">";
		echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
		
		$nome = $resultInfo[0]['nome'];
		$tel = $resultInfo[0]['telefone'];
		$email = $resultInfo[0]['email'];
		$horas = $resultInfo[0]['horas'];
		$disciplina = $resultInfo[0]['disciplina'];
		$professor = $resultInfo[0]['professor'];
		$turma = $resultInfo[0]['turma'];
		$oab = $resultInfo[0]['oab'];
		$primFase = $resultInfo[0]['primfase'];
		
		$primeiroNome = substr($nome,0,strpos($nome," "));
		$pieces = explode(' ', $nome);
		$ultimoNome = array_pop($pieces);
		
		$nome = $primeiroNome." ".$ultimoNome;
		
		if (file_exists("../../uploads/alunos/$matriculaAluno.jpg"))
			$src = "../../uploads/alunos/$matriculaAluno.jpg";
		else
			$src = "../../uploads/defaultAssets/foto.png";
		
		if($horas < 75)
			$g3 = 0;
		else if (($horas >= 75) && ($horas < 80))
			$g3 = 5;
		else if (($horas >= 80) && ($horas < 85))
			$g3 = 6;
		else if (($horas >= 85) && ($horas < 90))
			$g3 = 7;
		else if (($horas >= 90) && ($horas < 95))
			$g3 = 8;
		else if (($horas >= 95) && ($horas < 100))
			$g3 = 9;
		else 
			$g3 = 10;
		
		echo "
		<hr>
			<div class=\"w3-cell-row\">
			  <div class=\"w3-cell w3-container\">
				<table class=\"table table-bordered\">
					<tr>
						<td align=\"center\" colspan=\"2\"><img src=\"$src\" height=\"200%\" ></td>
					</tr>
					<tr>
						<td align=\"center\">Matricula</td>
						<td align=\"center\">$matriculaAluno</td>
					</tr>
					<tr>
						<td align=\"center\">Nome</td>
						<td align=\"center\">$nome</td>
					</tr>					
					<tr>
						<td align=\"center\">Email</td>
						<td align=\"center\">$email</td>
					</tr>
					<tr>
						<td align=\"center\">Tel</td>
						<td align=\"center\">$tel</td>
					</tr>
					<tr>
						<td align=\"center\">Disciplina</td>
						<td align=\"center\">$disciplina</td>
					</tr>
					<tr>
						<td align=\"center\">Turma</td>
						<td align=\"center\">$turma</td>
					</tr>
					<tr>
						<td align=\"center\">Primeira Fase OAB</td>
						<td align=\"center\">$primFase</td>
					</tr>
					<tr>
						<td align=\"center\">OAB</td>
						<td align=\"center\">";
							if ($oab == 1)
							{
								echo "<input type=\"checkbox\" name=\"oab\" checked disabled=\"disabled\" >";
							}
							else
								echo "<input type=\"checkbox\" name=\"oab\" disabled=\"disabled\" >";
						echo "</td>
					</tr>
					<tr>
						<td align=\"center\">Horas</td>
						<td align=\"center\">$horas</td>
					</tr>
					<tr>
						<td align=\"center\">G3</td>
						<td align=\"center\">$g3</td>
					</tr>
				</table>
			  </div>
			</div>  
		</hr>
		";
		echo "</form>";
		echo "</div>";
	}
?>
