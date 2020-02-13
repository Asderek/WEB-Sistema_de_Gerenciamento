<?php

	include("../utils/newconexao.php");
	echo "<table class=\"table\">";
	echo "<tr align=\"center\" style=\"background-color:#ccc\">";
		echo "<td colspan=\"3\">";
			echo "Dados de Novo Monitor";
		echo "</td>";
	echo "</tr>";
	echo "<tr align=\"center\">";
		echo "<td width=\"33%\">";
			echo "nomeProfessor";
		echo "</td>";
		echo "<td width=\"33%\">";
			echo "nomeMonitor";
		echo "</td>";
		echo "<td width=\"33%\">";
			echo "Data de Admissao";
		echo "</td>";
	echo "</tr>";
	echo "<tr align=\"center\">";
		echo "<td width=\"33%\">";
			echo "<select name=\"newProfessor\">";
				$sqlProfessores = "SELECT * FROM professores WHERE 1";
				$queryProfessores = $conexao->query($sqlProfessores);
				$resultProfessores = $queryProfessores->fetchAll(PDO::FETCH_ASSOC);
				for($i = 0 ;$i<count($resultProfessores);$i++)
				{
					$input = $resultProfessores[$i]['nome'];
					echo "<option value=\"$input\">$input</option>";
				}
			echo "</select>";
		echo "</td>";
		echo "<td width=\"33%\">";
			echo "<input type=\"text\" name=\"newMonitor\" placeholder=\"Edson Arantes do Nascimento\">";
		echo "</td>";
		echo "<td width=\"33%\">";
			echo "<input type=\"date\" name=\"newAdmissao\">";
		echo "</td>";
	echo "</tr>";
	echo "<tr align=\"center\">";
		echo "<td width=\"33%\">";
			echo "Area";
		echo "</td>";
		echo "<td width=\"33%\">";
			echo "Tel";
		echo "</td>";
		echo "<td width=\"33%\">";
			echo "Cel";
		echo "</td>";
	echo "</tr>";
	echo "<tr align=\"center\">";
		echo "<td width=\"33%\">";
			echo "<input type=\"text\" name=\"newArea\" placeholder=\"PENAL\">";
		echo "</td>";
		echo "<td width=\"33%\">";
			echo "<input type=\"text\" name=\"newTel\" placeholder=\"2266-0847\">";
		echo "</td>";
		echo "<td width=\"33%\">";
			echo "<input type=\"text\" name=\"newCel\" placeholder=\"92266-0847\">";
		echo "</td>";
	echo "</tr>";
	echo "<tr align=\"center\">";
		echo "<td width=\"33%\">";
			echo "Email";
		echo "</td>";
		echo "<td width=\"33%\">";
			echo "Percentual de Bolsa";
		echo "</td>";
		echo "<td width=\"33%\">";
			echo "CI de Substituição";
		echo "</td>";
	echo "</tr>";
	echo "<tr align=\"center\">";
		echo "<td width=\"33%\">";
			echo "<input type=\"email\" name=\"newEmail\" placeholder=\"asd@gmail.com\">";
		echo "</td>";
		echo "<td width=\"33%\">";
			echo "<input type=\"number\" name=\"newPercent\" value=\"10\">";
		echo "</td>";
		echo "<td width=\"33%\">";
			echo "<input type=\"text\" name=\"newCI\" placeholder=\"28/2019\">";
		echo "</td>";
	echo "</tr>";
	echo "<tr align=\"center\">";
		echo "<td width=\"33%\">";
			echo "Matricula";
		echo "</td>";
		echo "<td width=\"33%\" colspan=\"2\">";
			echo "Tipo de Monitor";
		echo "</td>";
	echo "</tr>";
	echo "<tr align=\"center\">";
		echo "<td>";
			echo "<input type=\"text\" name=\"newMatricula\" placeholder=\"0920721\">";
		echo "</td>";
		echo "<td colspan=\"2\">";
			echo "<select name=\"newTipo\">";
				echo "<option value=\"Bolsista\">Bolsista</option>";
				echo "<option value=\"Voluntario\">Voluntário</option>";
			echo "</select>";
		echo "</td>";
	echo "</tr>";

	echo "<tr align=\"center\" style=\"background-color:#ccc\">";
		echo "<td colspan=\"3\">";
			echo "<button type=\"submit\" formaction=\"cadastranovomonitor.php\" class=\"btn btn-primary\">Cadastrar</button>";
		echo "</td>";
	echo "</tr>";
	
	echo "</table>";
?>
	<br><br>
	<table class="table">
	<tr align="center">
		<td colspan="3">
			<button formaction="../informacao/">Atualizar Professores</button>
		</td>
	</tr>
	<tr align="center" style="background-color:#000">
		<td colspan="3"><font style="color:#FFFFFF;"><strong>
			Dados de Monitores Atuais
		</strong></font></td>
	</tr>
	
		<?php
			$sqlMonitores = "SELECT * FROM historicoMonitores WHERE 1";
			$queryMonitores = $conexao->query($sqlMonitores);
			$resultMonitores = $queryMonitores->fetchAll(PDO::FETCH_ASSOC);
			
			$nomeMonitorAux = "";
			for($i=0;$i<count($resultMonitores);$i++)
			{
				$nomeMonitor = $resultMonitores[$i]['nomeMonitor'];
				$nomeProfessor = $resultMonitores[$i]['nomeProfessor'];
				$admissao = $resultMonitores[$i]['admissao'];
				$area = $resultMonitores[$i]['area'];
				$tel = $resultMonitores[$i]['tel'];
				$cel = $resultMonitores[$i]['cel'];
				$email = $resultMonitores[$i]['email'];
				$percentual = $resultMonitores[$i]['percentual'];
				$CI = $resultMonitores[$i]['CI_substituicao'];
				$tipo = $resultMonitores[$i]['tipo'];
				$index = $resultMonitores[$i]['index'];
						
				if($nomeMonitor != $nomeMonitorAux)
				{
					$nomeMonitorAux = $nomeMonitor;
					$nomeMonitor = strtoupper($nomeMonitor);
					echo "<tr align=\"center\" style=\"background-color:#ccc\">
						<td colspan=\"3\"><strong>
							$nomeMonitor <button name=\"deleteMonitor\" value=\"$index\" formaction=\"deleteMonitor.php\" style=\"float:right\">X</button>
						</td></strong>
					</tr>";
				}
				
				echo "<tr align=\"center\">";
					echo "<td width=\"33%\">";
						echo "Professor: $nomeProfessor";
					echo "</td>";
					echo "<td width=\"33%\">";
						echo "Admissão: $admissao";
					echo "</td>";
					echo "<td width=\"33%\">";
						echo "Tipo: $tipo";
					echo "</td>";
				echo "</tr>";
				echo "<tr align=\"center\">";
					echo "<td width=\"33%\">";
						echo "Area: $area";
					echo "</td>";
					echo "<td width=\"33%\">";
						echo "Tel: $tel";
					echo "</td>";
					echo "<td width=\"33%\">";
						echo "Cel: $cel";
					echo "</td>";
				echo "</tr>";
						echo "<tr align=\"center\">";
					echo "<td width=\"33%\">";
						echo "Email: $email";
					echo "</td>";
					echo "<td width=\"33%\">";
						echo "Percentual: $percentual%";
					echo "</td>";
					echo "<td width=\"33%\">";
						echo "CI: $CI";
					echo "</td>";
				echo "</tr>";
			}
		?>
	
	</table>
