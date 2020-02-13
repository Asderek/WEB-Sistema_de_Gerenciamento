<?php

	include('../../utils/newconexao.php');
	echo "<form action=\"cadastrarevento.php\" method=\"post\">";
	
	$index = $_POST['indice'];
	$matricula = $_POST['matricula'];
	echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
	$sqlEvento = "SELECT * FROM `visitasAbertas` WHERE `ID` = $index";
	
	$queryEvento = $conexao->query($sqlEvento);
	$resultEvento = $queryEvento->fetchAll(PDO::FETCH_ASSOC);
	$horario = $resultEvento[0]['horario'];
	$professor = $resultEvento[0]['professor'];
	$disciplina = $resultEvento[0]['disciplina'];
	$local = $resultEvento[0]['local'];
	$horas = $resultEvento[0]['horas'];
	$vagas = $resultEvento[0]['vagas'];
	$descricao = $resultEvento[0]['descricao'];
	
	$arrayTable = array();
	array_push($arrayTable,"Professor");
	array_push($arrayTable,$professor);
	array_push($arrayTable,"Disciplina");
	array_push($arrayTable,$disciplina);
	array_push($arrayTable,"Local");
	array_push($arrayTable,$local);
	array_push($arrayTable,"Horas");
	array_push($arrayTable,$horas);
	array_push($arrayTable,"Descricao");
	array_push($arrayTable,$descricao);
	
	echo "
		<hr>
			<div class=\"w3-cell-row\">
			  <div class=\"w3-cell w3-container\">";
				if (!empty($_POST['sucesso']))
				{
					echo "<h4 class=\"text-center\">Cadastro Realizado com Sucesso</h4>";
				}
				echo "<table class=\"table table-bordered\">";
				
					for($i=0;$i<count($arrayTable)-1;$i+=2)
					{
						if ($arrayTable[$i] == "Descricao")
						{							
							echo "<tr>";
								echo "<td align=\"center\">".$arrayTable[$i]."</td><td align=\"justify\">".$arrayTable[$i+1]."</td>";
							echo "</tr>";
						}
						else
						{
							echo "<tr>";
								echo "<td align=\"center\">".$arrayTable[$i]."</td><td align=\"center\">".$arrayTable[$i+1]."</td>";
							echo "</tr>";
						}
					}
					
					$sqlJahInscrito = "SELECT * FROM `visitasAlunos` WHERE `Matricula` = $matricula AND `VisitaID` = $index";
					$queryJahInscrito = $conexao->query($sqlJahInscrito);
					$resultJahInscrito = $queryJahInscrito->fetchAll(PDO::FETCH_ASSOC);
					if (count($resultJahInscrito) > 0)
					{
						echo "<tr><td colspan=\"2\" align=\"center\"><h3>Aluno já inscrito</h3></td></tr>";
					}
					else
					{
						echo "<tr><td colspan=\"2\" align=\"center\"><button type=\"submit\" name=\"butaoClicado\" value=\"$index\" class=\"btn btn-primary btn-lg btn-block\">Inscrever-se</button></td></tr>";
					}
				echo "</table>
			  </div>
			</div>  
		</hr>
		";
	
	
	echo "</form>";
?>