 
	<?php
		include('../../newconexao.php');
		include ("../utils/professores.php");
		
		/*if(is_null($_POST['matricula']));
		{
			$mat = $_POST['matricula'];
			echo "mat = $mat<br>";
			echo "Deu Pau";
			return;
		}*/
		
		$sqlMatricula = "SELECT * FROM `alunos` WHERE matricula = $matriculaAluno";
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
		$professorPlantao = PROFESSORES_GETPROFESSORPLANTAONAME($matriculaAluno);
		
		
		echo "<input type='hidden' name='matriculaAluno' value='$matriculaAluno'/>";	
		echo "<input type='hidden' name='nome' value='$nome'/>";	
		//echo "<input type='hidden' name='professor' value='$professor'/>";		
		
		echo "
				<table class=\"table table-bordered table-hover\">
					<tr style=\"text-align:center;background-color:#A0A0A0\">
						<td colspan=\"2\">
							<strong>Cadastrar Atividade</strong>
						</td>
					</tr>";
					if (!empty($_POST['alert']))
					{
						if (strstr($_POST['alert'],"cadastrada com sucesso") != false)
						{
							echo "
							<tr id=\"id_disappear\" style=\"text-align:center;background-color:#66FF66; opacity: 1\">
								<td colspan=\"2\" style=\"font-size: 150%\">
									ATIVIDADE CADASTRADA COM SUCESSO
								</td>
							</tr>";
							echo "
								<script> 
									var a = setInterval(function() 
									{
										var curStyle = document.getElementById('id_disappear').getAttribute(\"style\");
										var curStyleLength = curStyle.length;
										var opacity = document.getElementById('id_disappear').getAttribute(\"style\");
										var startOpacity = opacity.indexOf(\"opacity\");
										curStyle = curStyle.substr(0,startOpacity);
										opacity = opacity.substr(startOpacity);
										currentOpacity = opacity.substr(\"opacity: \".length);
										opacity = opacity.substr(0,opacity.length-currentOpacity.length);
										currentOpacity = parseFloat(currentOpacity);
										currentOpacity = currentOpacity * 0.95;
										opacity = opacity + currentOpacity;
										curStyle = curStyle + \" \" + opacity;
											
										if (currentOpacity < 0.05)
										{
											document.getElementById('id_disappear').setAttribute(\"style\",\"display:none\");
											clearInterval(a);
										}
										else
											document.getElementById('id_disappear').setAttribute(\"style\",curStyle);
									},100); 
								</script>";
						}
					}
					echo "<tr>
						<td width='30%'>Matricula</td>
						<td width='70%' colspan=\"2\">$matriculaAluno</td>
					</tr>
					<tr>
						<td width='30%'>Nome</td>
						<td width='70%' colspan=\"2\">$nome</td>
					</tr>
					<tr>
						<td width='30%'>Professor Solicitante<br>(Aula / Plantão)</td>
						<td width='70%' colspan=\"2\">
							<input type=\"radio\" value=\"$professor\" name=\"destino\" checked> $professor</input><br>";
							
							if ($professorPlantao != "NONE" && $professorPlantao != $professor)
							{
								echo "
								<input type=\"radio\" value=\"$professorPlantao\" name=\"destino\"> $professorPlantao </input>";
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
								if ($resultMatricula[0]['oficina'] == 0)
								{
									echo "<option value=\"oficina\">Oficina</option>";
								}
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
									if ($chave != 0 || $matriculaAluno == 222222)
										echo "<option value=\"estagio\">Estagio Profissional</option>";
								}
								
								echo "<option value=\"monitoria\">Monitoria</option>
								<option value=\"palestras\">Palestras</option>
								<option value=\"pesquisa\">Pesquisa</option>
								<option value=\"plantao\">Plantão</option>
								<option value=\"juridico\">Trabalhos Jurídicos</option>
								<option value=\"visitas\">Visitas</option>
								<option value=\"outros\">Outros</option>
							</select>
						</td>
					</tr>
					
					<tr>
						<td>Data de Realização da Atividade<br>(dd/mm/aaaa)</td>
						<td>
							<input type=\"date\" id=\"id_date\" name=\"dataAtv\" onchange=\"checaData()\" style=\"float: left;\" placeholder=\"dd/mm/aaaa\">
							<h4 id=\"id_aviso\" style=\"visibility: hidden; float: right;\" align=\"center\">&nbsp;&nbsp;Atividade fora do prazo estabelecido de cadastro</h4>
						</td>
					</tr>
					
					<tr>
						<td width='30%'>Atividade</td>
						<td width='70%'><input size=\"40\" type\"text\" name=\"atividade\" placeholder=\"Titulo da atividade\"></td>
					</tr>
					<tr>
						<td width='30%'>Descrição</td>
						<td width='70%'>
							<textarea rows=\"4\" cols=\"42\" name=\"descricao\" placeholder=\"Descreva a atividade\"></textarea>
						</td>
					</tr>
					<tr>
						<td width='30%'>Documento</td>
						<td width='70%'>
							<input type=\"file\" id=\"id_uploadFile\" name=\"comprovante\" accept=\".pdf,image/*\">
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
	
<script>
	var uploadField = document.getElementById("id_uploadFile");

	uploadField.onchange = function() {
		if(this.files[0].size > 15728640){
		   alert("Arquivo ultrapassa o valor maximo de 15mb por arquivo!");
		   this.value = "";
		};
	};
</script>