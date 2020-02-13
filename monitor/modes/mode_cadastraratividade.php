 <?php
		include('../../newconexao.php');
		
		/*if(is_null($_POST['matricula']));
		{
			$mat = $_POST['matricula'];
			echo "mat = $mat<br>";
			echo "Deu Pau";
			return;
		}*/
		
		
		$matricula = $_POST['matricula'];
		
		$sqlMatricula = "SELECT * FROM `alunos` WHERE matricula = $matricula";
		$queryMatricula = $conexao->query($sqlMatricula);
		if($queryMatricula == false)
		{
			echo "ERROR";
			return;
		}
		$resultMatricula = $queryMatricula->fetchAll( PDO::FETCH_ASSOC );
		$rowsMatricula = count($resultMatricula);
		
		
	
		
		if($rowsMatricula<0)
		{
			echo "Matricula nao encontrada somehow wtf??";
			return;
		}
		
		$nome = $resultMatricula[0]['nome'];
		$professor = $resultMatricula[0]['professor'];
		$professorPlantao = PROFESSORES_GETPROFESSORPLANTAONAME($matricula);
		
		
		echo "<input type='hidden' name='matricula' value='$matricula'/>";	
		echo "<input type='hidden' name='nome' value='$nome'/>";	
		//echo "<input type='hidden' name='professor' value='$professor'/>";		
		
		echo "
				<table class=\"table table-bordered table-hover\">
					<tr style=\"text-align:center;background-color:#A0A0A0\">
						<td colspan=\"2\">
							<strong>Cadastrar Atividade</strong>
						</td>
					</tr>
					<tr>
						<td width='30%'>Matricula</td>
						<td width='70%' colspan=\"2\">$matricula</td>
					</tr>
					<tr>
						<td width='30%'>Nome</td>
						<td width='70%' colspan=\"2\">$nome</td>
					</tr>
					<tr>
						<td width='30%'>Professor Solicitante<br>(Aula / Plantão)</td>
						<td width='70%' colspan=\"2\">
							<input type=\"radio\" value=\"$professor\" name=\"destino\" required checked> $professor</input><br>";
							
							if ($professorPlantao != "NONE" && $professorPlantao != $professor)
							{
								echo "
								<input type=\"radio\" value=\"$professorPlantao\" name=\"destino\" required> $professorPlantao </input>";
							}
							echo "
						</td>
					</tr>
					
					<tr>
						<td>Tipo de Atividade</td>
						<td>
							<select id=\"id_TipoAtividade\" align=\"center\" name=\"tipo\" onchange=\"checaEstagio()\">
								<option value=\"acompanhamento\">Acompanhamento Processual</option>
								<option value=\"atendimento\">Atendimento</option>
								<option value=\"audiencia\">Audiência</option>
								";
								echo "<option value=\"primFase\">Aprovação na 1a fase OAB</option>";
								if ($resultMatricula[0]['oab'] == 0)
								{
									echo "<option value=\"oab\">Aprovação na 2a fase OAB</option>";
								}
								echo "<option value=\"diligencia\">Diligências</option>";
								
								$sqlChaveEstagio = "SELECT * FROM `switchboard` WHERE `nome` = \"estagio\"";
								$queryEstagio = $conexao->query($sqlChaveEstagio);
								if ($queryEstagio != false)
								{
									$resultEstagio = $queryEstagio->fetchAll(PDO::FETCH_ASSOC);
									$chave = $resultEstagio[0]['status'];
									if ($chave != 0)
										echo "<option value=\"estagio\">Estagio Profissional</option>";
								}
								
								echo "<option value=\"monitoria\">Monitoria</option>
								<option value=\"palestras\">Palestras</option>
								<option value=\"pesquisa\">Pesquisa</option>
								<option value=\"plantao\">Plantão</option>
								<option value=\"simulado\">Simulado</option>
								<option value=\"juridico\">Trabalhos Jurídicos</option>
								<option value=\"visitas\">Visitas</option>
								<option value=\"outros\">Outros</option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>Data de Realização da Atividade</td>
						<td>
							<input type=\"date\" id=\"id_date\" name=\"dataAtv\" onchange=\"checaData()\" style=\"float: left;\" required>
							<h4 id=\"id_aviso\" style=\"visibility: hidden; float: right;\" align=\"center\">&nbsp;&nbsp;Atividade fora do prazo estabelecido de cadastro</h4>
						</td>
					</tr>
					
					<tr>
						<td width='30%'>Atividade</td>
						<td width='70%'><input size=\"40\" type\"text\" name=\"atividade\" placeholder=\"Titulo da atividade\" required></td>
					</tr>
					<tr>
						<td width='30%'>Descrição</td>
						<td width='70%'>
							<textarea rows=\"4\" cols=\"42\" name=\"descricao\" placeholder=\"Descreva a atividade\" required></textarea>
						</td>
					</tr>
					<tr>
						<td width='30%'>Documento</td>
						<td width='70%'>
							<input type=\"file\"  name=\"comprovante\" accept=\".pdf,image/*\">
						</td>
					</tr>
					
					<tr>
						<td colspan=\"2\">
							<input type=\"submit\" id=\"id_Enviar\" formaction=\"registraratividade.php\" class=\"btn btn-primary btn-lg btn-block\"></input>
						</td>
					</tr>
					
					
				</table>
		
		
		";
			
	?>