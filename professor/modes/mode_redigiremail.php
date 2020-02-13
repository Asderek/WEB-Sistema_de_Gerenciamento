<?php
	include('../../newconexao.php');
	include('../../professores.php');
	include('../../injection.php');

	$matricula = $_POST['matricula'];
	$nome = PROFESSORES_GETNAME($matricula);
	
	$arrayTurmas = array();
	
	$sqlAulas = "SELECT * FROM `alunos` WHERE `professor` = \"$nome\"";
	$queryAulas = $conexao->query($sqlAulas);
	if ($queryAulas != false)
	{
		$resultAulas = $queryAulas->fetchAll( PDO::FETCH_ASSOC );
		$rowsAulas = count($resultAulas);
		for ($i=0;$i<$rowsAulas;$i++)
		{
			if (!in_array($resultAulas[$i]['turma'],$arrayTurmas))
			{
				array_push($arrayTurmas,$resultAulas[$i]['turma']);
			}
		}
	}
	
	
	echo "<table class=\"table table-bordered table-striped table-hover\">
			<tbody>";
			
			
	echo "<tr><td><strong>Turma</strong></td><td><select name=\"turma\" align=\"center\">";
	for($i=0;$i<count($arrayTurmas);$i++)
	{
		$value = $arrayTurmas[$i];
		echo "<option value=\"$value\">$value</option>";
	}
	echo "</select></td></tr>";
	
	echo "
				
				<tr>
					<td width='30%'><strong>Assunto</strong></td>
					<td width='70%'><input type=\"text\" size=\"80\" name=\"subject\" placeholder=\"Assunto do Email\"></td>
				</tr>
				
				<tr>
					<td width='30%' rowspan=\"5\"><strong>Corpo do Email</strong></td>
					<td width='70%' rowspan=\"5\"><textarea name=\"descricao\" cols=\"120\" rows=\"5\" placeholder=\"Corpo do Email\" align=\"center\"></textarea></td>
				</tr>
				
				<tr>
					<td width='30%' style=\"display:none\"><strong></strong></td>
				</tr>
				
				<tr>
					<td width='30%' style=\"display:none\"><strong></strong></td>
				</tr>
				
				<tr>
					<td width='30%' style=\"display:none\"><strong></strong></td>
				</tr>
				
				<tr>
					<td width='30%' style=\"display:none\"><strong></strong></td>
				</tr>
					
				
				<tr align=\"center\">
					<td colspan=\"2\"><input type=\"submit\" formaction=\"enviaremailturma.php\" value=\"Enviar Email\"></input></td>
				</tr>
			</tbody>
		</table>";
	
?>
						