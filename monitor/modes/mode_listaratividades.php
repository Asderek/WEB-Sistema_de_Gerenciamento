<?php
	include('../../newconexao.php');
	include ("modes/mode_cadastraratividade.php");
	/*if(is_null($_POST['matricula']));
	{
		$mat = $_POST['matricula'];
		echo "mat = $mat<br>";
		echo "Deu Pau";
		return;
	}*/
	
	$matricula = $_POST['matricula'];
	
	$sqlInformacao = "SELECT * FROM `alunos` WHERE matricula = $matricula";
	$queryInformacao = $conexao->query($sqlInformacao);
	if ($queryInformacao == false)
	{
		echo "Matricula Incorreta tente novamente<br>";
		return;
	}
	$resultInformacao = $queryInformacao->fetchAll( PDO::FETCH_ASSOC );
	
	$sqlAtividades = "SELECT * FROM `atividades` WHERE matricula = $matricula";
	$queryAtividades = $conexao->query($sqlAtividades);
	if ($queryAtividades == false)
	{
		echo "Matricula Incorreta tente novamente<br>";
		return;
	}
	$resultAtividades = $queryAtividades->fetchAll( PDO::FETCH_ASSOC );
	$rowsAtividades = count($resultAtividades);
	echo "<input type='hidden' name='Atividades' value='$Atividades'/>";	

	if($rowsAtividades<0)
	{
		echo "Atividades nao encontrada somehow wtf??";
	}

	
	$professor = $resultInformacao[0]['professor'];
	echo "
		<table class=\"table table-bordered \" style=\"border: 1px black;\">
			<tr bgcolor=\"#505050\" ><td colspan=\"7\" align=\"center\"><strong><font color=\"#FFFFFF\">HISTÓRICO DE ATIVIDADES</font></strong></td></tr>
			
			<tr align=\"center\" style=\"background-color: #F0F0F0;\">
				<td><strong>Horas</strong></td>
				<td><strong>Tipo</strong></td>
				<td><strong>Titulo</strong></td>
				<td><strong>Descricao</strong></td>
				<td><strong>Professor</strong></td>
				<td><strong>Status</strong></td>
				<td><strong>Delete</strong></td>
			</tr>
	";
		
	for($i=0;$i<$rowsAtividades;$i++)
	{
			
		$responsavel = $resultAtividades[$i]['responsavel'];
		{
			$tipo = $resultAtividades[$i]['tipo'];
			$atividade = $resultAtividades[$i]['atividade'];
			$descricao = $resultAtividades[$i]['descricao'];
			$pendente = $resultAtividades[$i]['pendente'];
			$horas = $resultAtividades[$i]['horas'];
			$index = $resultAtividades[$i]['index'];
			
			$button = "";
			switch ($pendente)
			{
				case -1:
					$pendente = "Rejeitado";
				break;
				case 0:
					$pendente = "Aceito";
				break;
				case 1:
					$pendente = "Pendente";
					$button = "<button type=\"submit\" formaction=\"deleteatividade.php\" name=\"index\" value=\"$index\" formnovalidate>X</button>";
				break;
				case 2:
					$pendente = "Secretaria";
					$button = "<button type=\"submit\" formaction=\"deleteatividade.php\" name=\"index\" value=\"$index\" formnovalidate>X</button>";
				break;
			}
			
			
			echo "<tr>";
				echo "
				<td width=\"5%\" align=\"center\">$horas</td>
				<td width=\"5%\" align=\"center\">$tipo</td>
				<td width=\"20%\" align=\"center\">$atividade</td>
				<td width=\"45%\">$descricao</td>
				<td width=\"20%\">$responsavel</td>
				<td width=\"5%\" align=\"center\">$pendente</td><td>$button</td>";
			echo "</tr>";
			
		}
		
	}
		/*echo "<tr>
				<td>
					<input type=\"submit\" formaction=\"registraratividade.php\"></input>
				</td>
				<td>
					<select id=\"target\" align=\"center\" name=\"tipo\">
						<option value=\"acompanhamento\">Acompanhamento Processual</option>
						<option value=\"atendimento\">Atendimento</option>
						<option value=\"audiencia\">Audiência</option>
						<option value=\"convenio\">Convênio</option>
						<option value=\"diligencia\">Diligências</option>
						<option value=\"monitoria\">Monitoria</option>
						<option value=\"palestras\">Palestras</option>
						<option value=\"pecas\">Peças Jurídicas</option>
						<option value=\"pesquisa\">Pesquisa</option>
						<option value=\"plantao\">Plantão</option>
						<option value=\"simulado\">Simulado</option>
						<option value=\"juridico\">Trabalhos Jurídicos</option>
						<option value=\"visitas\">Visitas</option>
					</select>
				</td>
				
				<td><input type\"text\" name=\"atividade\" placeholder=\"Titulo da atividade\" ></td>
				
				<td>
					<textarea rows=\"1\" name=\"descricao\" placeholder=\"Descreva a atividade\"></textarea>
				</td>
				
				<td>
					<input type=\"file\"  name=\"comprovante\" accept=\".pdf\">
				</td>
				
		</tr>";		*/
		echo	"</table><br>";
		
?>