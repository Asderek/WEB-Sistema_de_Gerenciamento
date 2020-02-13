<?php
	echo "<form action=\"main.php\" method=\"post\" id=\"id_form\">";
	include('../../utils/newconexao.php');
	include('../../utils/documentos.php');	
	
	$nome = PROFESSORES_GETNAME($matricula);
	
	echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
		
	$sqlAtividade = "SELECT * FROM atividades WHERE `responsavel` = \"$nome\" AND pendente = 1";
	$queryAtividade = $conexao->query($sqlAtividade);
	if($queryAtividade != false)
	{
		$resultAtividade = $queryAtividade->fetchAll( PDO::FETCH_ASSOC );
		$rowsAtividade = count($resultAtividade);
	}
	
	echo "<div class=\"w3-container\">";
	
	if ($rowsAtividade == 0)
	{
		echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\">";
					echo "<table class=\"table\" ><tbody>";
						echo "<tr><td align=\"center\"><strong><h3>Não há pendencias</h3></strong></td></tr>";
					echo "</tbody></table>";
				  echo "</div>
				</div>  
			</hr>
		";
	}
	for($i=0;$i<$rowsAtividade;$i++)
	{
		
		$matriculaAluno = $resultAtividade[$i]['matricula'];
		$nomeAluno = $resultAtividade[$i]['nome'];
		$atividade = $resultAtividade[$i]['atividade'];
		$descricao = $resultAtividade[$i]['descricao'];
		$index = $resultAtividade[$i]['index'];
		$checkBox = $index."_checkbox";
		$indexRej = "rej_".$index;
		$indexAcc = "acc_".$index;
		$selectName = $index."_horas";
		
		$dir    = DOCUMENTS_GETDOCUMENTPATH($matricula)."/atividades";
		$dir = "../".$dir;
		$filename = $index."-".$matriculaAluno."-Comprovante";
		$files = glob("$dir/$filename.*");
		$filePath = $files[0];
			
		echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\">";
					echo "<table class=\"table table-bordered\" ><tbody>";
						echo "<tr><td>Nome</td><td colspan=\"2\"><button class=\"button-link\" name=\"mode\" value=\"infoAluno_$matriculaAluno\">$nomeAluno</td></tr>";
						echo "<tr><td>Atividade</td><td colspan=\"2\">$atividade</td></tr>";
						echo "<tr><td>Descricao</td><td colspan=\"2\">$descricao</td></tr>";
						echo "<tr><td width=\"33%\" align=\"center\"><button type=\"submit\" formaction=\"cadastraratividade.php\" name=\"index\" value=\"$indexAcc\" onclick=\"addCommentary('$indexAcc'); return false;\" class=\"accept btn-primary btn-lg\">V</button></td>";
							echo "<td width=\"33%\" align=\"center\"><select name=\"$selectName\" class=\"form-control\" align=\"center\">
									<option value=1>1</option>
									<option value=2>2</option>
									<option value=3>3</option>
									<option value=4>4</option>
									<option value=5>5</option>
									<option value=6>6</option>
									<option value=7>7</option>
									<option value=8>8</option>
									<option value=9>9</option>
									<option value=10>10</option>
									<option value=25>25</option>
									<option value=32>32</option>
								</select></td>";
						echo "<td width=\"33%\" align=\"center\"><button type=\"submit\"  formaction=\"cadastraratividade.php\"   name=\"index\"  value=\"$indexRej\" onclick=\"addCommentary('$indexRej'); return false;\" class=\"reject btn-primary btn-lg\">X</button></td></tr>";
						if (file_exists($filePath))
							echo "<tr><td colspan=\"3\" align=\"center\"><a href=\"$filePath\" target=\"_blank\">Comprovante</a></td></tr>";
						else
							echo "<tr><td colspan=\"3\" align=\"center\">--<s>Sem Comprovante</s>--</td></tr>";
						
					echo "</tbody></table>";
				  echo "</div>
				</div>  
			</hr>
		";
		
	}
	echo "
		</div>";
	echo "</form>";
	
?>
	<script>
		function addCommentary(value)
		{
			var commentary = prompt("Digite seu comentario");
			if (commentary == null)
				return false;
			
			var indexinput = document.createElement("input");
			indexinput.setAttribute("type","hidden");
			indexinput.setAttribute("value",value);
			indexinput.setAttribute("name","index");
			
			var comentario = document.createElement("input");
			comentario.setAttribute("type","hidden");
			comentario.setAttribute("value",commentary);
			comentario.setAttribute("name","comentario");
			
			
			document.getElementById('id_form').appendChild(indexinput);
			document.getElementById('id_form').appendChild(comentario);
			
			document.getElementById('id_form').setAttribute("action","cadastraratividade.php");
			
			document.getElementById('id_form').submit();
		}
	</script>
