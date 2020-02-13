<?php
	
	
	echo "<form id=\"id_auto\" action=\"main.php\" method=\"post\">";
	
	include("../../utils/newconexao.php");
	$sqlProfessores = "SELECT * FROM `professores` WHERE 1 ORDER BY `nome` ASC";
	$queryProfessores = $conexao->query($sqlProfessores);
	$resultProfessores = $queryProfessores->fetchAll(PDO::FETCH_ASSOC);
	
	echo "<div class=\"w3-container\">";

		echo "	<hr>
					<div class=\"w3-cell-row\">
					  <div class=\"w3-cell w3-container\">
						<select name=\"professor\" onchange=\"myFunction();return false;\" class=\"form-control\">
							<option value=\"\"></option>
							";
							for($i=0;$i<count($resultProfessores);$i++)
							{
								$nomeProfessor = $resultProfessores[$i]['nome'];
								echo "<option value=\"$nomeProfessor\">$nomeProfessor</option>";
							}
						echo "	
						</select><br><br><br>
						<table class=\"table table-bordered\">
			";
			
		
		
		if (!empty($_POST['professor']))
		{
			$nomeProfessor = $_POST['professor'];
			echo "<tr style=\"background-color:#ccc\"><td align=\"center\" colspan=\"2\">$nomeProfessor</td></tr>";
			
			$sqlAlunos = "SELECT * FROM alunos WHERE `professor` = \"$nomeProfessor\" AND `status` = 1 ORDER BY `turma`, `nome` ASC";
			$queryAlunos = $conexao->query($sqlAlunos);
			$resultAlunos = $queryAlunos->fetchAll(PDO::FETCH_ASSOC);
			
			$total = count($resultAlunos);
			echo "<tr style=\"background-color:#c88\"><td align=\"center\" colspan=\"2\"><strong>Total Inscritos = $total</strong></td></tr>";
			for($j=0;$j<count($resultAlunos);$j++)
			{
				$nome = $resultAlunos[$j]['nome'];
				$turma = $resultAlunos[$j]['turma'];
				echo "<tr><td align=\"center\">$turma</td><td align=\"center\">$nome</td></tr>";
			}
		}
	
	echo "
						</table>
					  </div>
					</div>  
				</hr>";		
				
	echo "</div>";
	
	echo "</form>";
?>

<script>
	function myFunction(index)
	{
		var form = document.getElementById('id_auto');
		var mode = document.createElement("input");
		mode.setAttribute("type","hidden");
		mode.setAttribute("value","inscritossimulado");
		mode.setAttribute("name","mode");
		form.appendChild(mode);
		
		form.submit();
	}
</script>
