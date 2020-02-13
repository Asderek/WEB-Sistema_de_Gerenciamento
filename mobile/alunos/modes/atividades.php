<form action="registraratividade.php" method="post" enctype="multipart/form-data">
<?php
	
	$matricula = $_POST['matricula'];
	
	$sqlMatricula = "SELECT * FROM `alunos` WHERE matricula = $matricula";
	$queryMatricula = $conexao->query($sqlMatricula);
	if ($queryMatricula == false)
	{
		echo "Matricula Incorreta tente novamente<br>";
		return;
	}
	$resultMatricula = $queryMatricula->fetchAll( PDO::FETCH_ASSOC );
	$rowsMatricula = count($resultMatricula);
	echo "<input type='hidden' name='matricula' value='$matricula'/>";	

	if($rowsMatricula<0)
	{
		echo "Matricula nao encontrada somehow wtf??";
	}
	
	$nome = $resultMatricula[0]['nome'];
	$disciplina = $resultMatricula[0]['disciplina'];
	$professor = $resultMatricula[0]['professor'];
	
	{// SQL PLANTAO
		include ('../../utils/professores.php');
		$plantao = PROFESSORES_GETPROFESSORPLANTAONAME($matricula);
		
	}
	
	$primeiroNome = substr($plantao,0,strpos($plantao," "));
	$pieces = explode(' ', $plantao);
	$ultimoNome = array_pop($pieces);
	
	$displayName = $primeiroNome." ".$ultimoNome;
	
	echo "<div class=\"w3-container\">";
		echo "
		<hr>
			<div class=\"w3-cell-row\">
				<div class=\"w3-cell w3-container\">
					<table class=\"table table-bordered\" style=\"margin-left:-25px;\">
						<tr>
							<td align=\"center\" colspan=\"2\"><strong>Cadastrar Atividade</strong></td>
						</tr>
						<tr>
							<td align=\"center\"><strong>Nome</strong></td>
							<td align=\"center\">$nome</td>
						</tr>
						<tr>
							<td align=\"center\"><strong>Professor Solicitante<br>(Aula/Plantão)</strong></td>
							<td width='70%'>
								<input type=\"radio\" value=\"$professor\" name=\"destino\" required checked> $professor</input><br>";
								
								if ($plantao != "NONE" && $plantao != $professor)
								{
									echo "
									<input type=\"radio\" value=\"$plantao\" name=\"destino\" required> $displayName </input>";
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
							<td>Data de Realização da Atividade<br>(dd/mm/aaaa)</td>
							<td>
								<input type=\"date\" id=\"id_date\" name=\"dataAtv\" onchange=\"checaData()\" style=\"float: left;\" required placeholder=\"dd/mm/aaaa\">
								<h4 id=\"id_aviso\" style=\"visibility: hidden; float: right;\" align=\"center\">&nbsp;&nbsp;Atividade fora do prazo estabelecido de cadastro</h4>
							</td>
						</tr>
						<tr>
							<td width='30%'>Atividade</td>
							<td width='70%'><input type\"text\" name=\"atividade\" placeholder=\"Titulo da atividade\" required></td>
						</tr>
						<tr>
							<td width='30%'>Descrição</td>
							<td width='70%'>
								<textarea rows=\"4\" name=\"descricao\" placeholder=\"Descreva a atividade\" required></textarea>
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
								<input type=\"submit\" id=\"id_Enviar\" class=\"btn btn-primary btn-lg btn-block\"></input>
							</td>
						</tr>
					</table>
				</div>
			</div>";		
			
				
	//include('modes/listaatividades.php');
	
	echo "  
		</hr></div>";
?>
</form>
<script>
function checaData()
{
	var date = document.getElementById('id_date').value;
	
	var n = date.indexOf("/");
	if (n != -1)
	{
		var dia = date.substr(0,2);
		var mes = date.substr(3,2);
		var ano = date.substr(6);
		console.log("ano = " + ano + " mes = " + mes + " dia = " + dia);
		date = ano + '-' + mes + '-' + dia;
	}
	
	var today = new Date();
	var atvDate = new Date(date);
	atvDate.setDate(atvDate.getDate()+1);
	allowed = true;
	
	document.getElementById('id_Enviar').setAttribute("style","visibility: visible;");
	document.getElementById('id_aviso').setAttribute("style","visibility: hidden; float: left; vertical-allign: middle;");
	
	if(atvDate.getYear() != today.getYear())
		allowed = false;
	if (atvDate.getMonth() > today.getMonth())
		allowed = false;
	if (atvDate.getMonth() == today.getMonth() && atvDate.getDate() > today.getDate())
		allowed = false;
	if (atvDate.getMonth() < today.getMonth()-1)
		allowed = false;
	
	if (today.getMonth()-1 == atvDate.getMonth() && today.getDate() > 10)
		allowed = false;
	
	
	if (allowed == false)
	{
		document.getElementById('id_Enviar').setAttribute("style","visibility: hidden;");
		document.getElementById('id_aviso').setAttribute("style","visibility: visible; float: left; vertical-allign: middle;");
	}
	
}
</script>