<?php
	
	/*if(is_null($_POST['matricula']));
	{
		$mat = $_POST['matricula'];
		echo "mat = $mat<br>";
		echo "Deu Pau";
		return;
	}*/
	
	include("../../utils/newconexao.php");
	$matricula = $_POST['matriculaAluno'];
	
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
	$turma = $resultMatricula[0]['turma'];
	$oab = $resultMatricula[0]['oab'];
	$oficina = $resultMatricula[0]['oficina'];
	$tel = $resultMatricula[0]['telefone'];
	$email = $resultMatricula[0]['email'];
	
	$exclamacaoTel = "";
	if ($tel == "---" || $tel == "xxx" || $tel == "")
		$exclamacaoTel = "<label style=\"color:#DD0000\">&#9888; Atualize seu cadastro</label>";
	
	$exclamacaoEmail = "";
	if ($email == "---" || $email == "xxx" || $email == "")
		$exclamacaoEmail = "<label style=\"color:#DD0000\">&#9888; Atualize seu cadastro</label>";
	
	
	
	$primeiraFase = $resultMatricula[0]['primfase'];
	
	$L1 = $resultMatricula[0]['l1'];
	if($L1 < 0)
		$L1 = "Ainda não possui";
	else
		$L1 = number_format($L1,2);
	
	$pas1 = $resultMatricula[0]['passado1'];
	$pas2 = $resultMatricula[0]['passado2'];
	$atu1 = $resultMatricula[0]['atual1'];
	$atu2 = $resultMatricula[0]['atual2'];
	
	$horas = 0;
	$sqlHoras = "SELECT * FROM `atividades` WHERE `matricula` = $matricula AND `pendente` = 0";
	$queryHoras = $conexao->query($sqlHoras);
	if ($queryHoras != false)
	{
		$ano = date('Y');
		$mes = date('n');
		if (intval($mes) < 8)
		{
			$strInicio = "$ano-01-01";
			$strFim = "$ano-07-31";
		}
		else
		{
			$strInicio = "$ano-08-01";
			$strFim = "$ano-12-31";
		}
		
		$dataInicio = new DateTime($strInicio);
		$dataFim = new DateTime($strFim);
		$dataFim->setTime(23,59);
		
		$resultHoras = $queryHoras->fetchAll(PDO::FETCH_ASSOC);
		for($i=0;$i<count($resultHoras);$i++)
		{
			$dataAtv = new DateTime($resultHoras[$i]['dataAtv']);
				
			if ($dataFim < $dataAtv)
				continue;
			if ($dataInicio > $dataAtv)
				continue;
			
			$horas += $resultHoras[$i]['horas']; 
		}
	}
	
	switch($pas1)
	{
		case -1:
			$pas1 = "Inscrito";
			break;
		case -2:
			$pas1 = "Em Processamento";
			break;
		case -3:
			$pas1 = "Não Realizou";
			break;
	}
	switch($pas2)
	{
		case -1:
			$pas2 = "Inscrito";
			break;
		case -2:
			$pas2 = "Em Processamento";
			break;
		case -3:
			$pas2 = "Não Realizou";
			break;
	}
	switch($atu1)
	{
		case -1:
			$atu1 = "Inscrito";
			break;
		case -2:
			$atu1 = "Em Processamento";
			break;
		case -3:
			$atu1 = "Não Realizou";
			break;
	}
	switch($atu2)
	{
		case -1:
			$atu2 = "Inscrito";
			break;
		case -2:
			$atu2 = "Em Processamento";
			break;
		case -3:
			$atu2 = "Não Realizou";
			break;
	}	
	
	{// SQL PLANTAO
		include ('../../utils/professores.php');
		$plantao = PROFESSORES_GETPROFESSORPLANTAONAME($matricula);
		
	}
	
	if (file_exists("../../uploads/alunos/$matricula.jpg"))
		$foto = "../../uploads/alunos/$matricula.jpg";
	else
		$foto = "../../uploads/defaultAssets/foto.png";
	
	echo "<div class=\"w3-container\">";
		
		echo "	<hr>
					<div class=\"w3-cell-row\">
					  <div class=\"w3-cell w3-container\">
						<h3 class=\"text-center\"><img width=\"256\" height=\"192\" src=\"$foto\"></h3>
					  </div>
					</div>
				</hr>";

		echo "	<hr>
					<div class=\"w3-cell-row\">
					  <div class=\"w3-cell w3-container\">
						<table class=\"table table-bordered\">
							<tr>
								<td align=\"center\"><strong>Matricula</strong></td>
								<td align=\"center\">$matricula</td>
							</tr>
							<tr>
								<td align=\"center\"><strong>Nome</strong></td>
								<td align=\"center\">$nome</td>
							</tr>
							<tr>
								<td align=\"center\"><strong>Disciplina</strong></td>
								<td align=\"center\">$disciplina</td>
							</tr>
							<tr>
								<td align=\"center\"><strong>Turma</strong></td>
								<td align=\"center\">$turma</td>
							</tr>
							<tr>
								<td align=\"center\"><strong>Professor</strong></td>
								<td align=\"center\">$professor</td>
							</tr>
							<tr>
								<td align=\"center\"><strong>Professor Plantao</strong></td>
								<td align=\"center\">$plantao</td>
							</tr>
							<tr>
								<td align=\"center\"><strong>Telefone</strong></td>
								<td>";
									if ($tel == "---" || $tel == "xxx" || $tel == "")
										echo "<input type=\"text\" name=\"tel\" value=\"$tel\"> $exclamacaoTel";
									else
										echo "<input type=\"text\" name=\"tel\" value=\"$tel\">";
								echo "</td>
							</tr>
							<tr>
								<td align=\"center\"><strong>Email</strong></td>
								<td>";
									if ($email == "---" || $email == "xxx" || $email == "")
										echo "<input type=\"text\" name=\"email\" value=\"$email\"> $exclamacaoEmail";
									else
										echo "<input type=\"text\" name=\"email\" value=\"$email\">";
								echo "</td>
							</tr>
							<!--<tr>
								<td align=\"center\" colspan=\"2\"><input type=\"submit\" formaction=\"atualizacadastro.php\" value=\"Atualizar Informações\" class=\"btn btn-primary btn-lg btn-block\"></td>
							</tr>-->
							<tr>
								<td align=\"center\" colspan=\"2\"><strong>HORAS EMA ACEITAS: $horas</strong></td>
							</tr>
							<tr>
								<td align=\"center\"><strong>Oficina</strong></td>
								<td align=\"center\"><input type=\"checkbox\" name=\"oficina\" onclick=\"return false;\" ";
										
										if($oficina==1)
											echo "checked";
											
											echo " readonly=\"readonly\" ></td>
							</tr>
							<tr>
								<td align=\"center\"><strong>Primera Fase OAB</strong></td>
								<td align=\"center\">$primeiraFase</td>
							</tr>
							<tr>
								<td align=\"center\"><strong>Segunda Fase OAB</strong></td>
								<td align=\"center\"><input type=\"checkbox\" name=\"oab\" onclick=\"return false;\" ";
											
										if($oab==1)
											echo "checked";
											
											echo  " readonly=\"readonly\" ></td>
							</tr>
						</table>
						
						<table class=\"table table-bordered\">
							<tr>
								<td align=\"center\"><strong></strong></td>
								<td align=\"center\">Simulado 1</td>
								<td align=\"center\">Simulado 2</td>
							</tr>
							<tr>
								<td align=\"center\"><strong>Semestre Atual</strong></td>
								<td align=\"center\">$atu1</td>
								<td align=\"center\">$atu2</td>
							</tr>
							<tr>
								<td align=\"center\"><strong>Semestre Passado</strong></td>
								<td align=\"center\">$pas1</td>
								<td align=\"center\">$pas2</td>
							</tr>
							<tr>
								<td align=\"center\"><strong>L1 (Nota do Simulado)</strong></td>
								<td colspan=\"2\" align=\"center\">$L1</td>
							</tr>
						</table>
					  </div>
					</div>  
				</hr>";		
				
				echo "</div>";
?>