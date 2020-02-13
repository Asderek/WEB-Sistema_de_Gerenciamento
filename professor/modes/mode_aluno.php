<?php
		/*if(is_null($_POST['matricula']));
		{
			$mat = $_POST['matricula'];
			echo "mat = $mat<br>";
			echo "Deu Pau";
			return;
		}*/
				
		include ("../utils/professores.php");

		
		$matriculaAluno = $_POST['matriculaAluno'];
		
		$sqlMatricula = "SELECT * FROM `alunos` WHERE matricula = $matriculaAluno";
		$queryMatricula = $conexao->query($sqlMatricula);
		$resultMatricula = $queryMatricula->fetchAll( PDO::FETCH_ASSOC );
		if($queryMatricula != true)
		{
			$rowsMatricula = count($resultMatricula);
		}
		
		
		echo "<input type='hidden' name='aluno' value='$matriculaAluno'/>";	
	
		
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
		
		
		$professorPlantao = PROFESSORES_GETPROFESSORPLANTAONAME($matriculaAluno);
		
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
		$horas = $resultMatricula[0]['horas'];
		
		
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
		
		
		if (file_exists("../uploads/alunos/$matriculaAluno.jpg"))
			$src = "../uploads/alunos/$matriculaAluno.jpg";
		else
			$src = "../uploads/defaultAssets/foto.png";
		
		echo "
				<table class=\"table table-bordered table-striped table-hover\">
					<tr>
						<td colspan=\"3\" align=\"center\"><img src=\"$src\" height=\"200%\"></td>
					</tr>
					
					<tr>
						<td>Matricula</td>
						<td colspan=\"2\">$matriculaAluno</td>
					</tr>
					<tr>
						<td>Nome</td>
						<td colspan=\"2\">$nome</td>
					</tr>
					<tr>
						<td>Disciplina</td>
						<td colspan=\"2\">$disciplina</td>
					</tr>
					<tr>
						<td>Turma</td>
						<td colspan=\"2\">$turma</td>
					</tr>
					<tr>
						<td>Professor Disciplina</td>
						<td colspan=\"2\">$professor</td>
					</tr>
					<tr>
						<td>Professor Plantão</td>
						<td colspan=\"2\">$professorPlantao</td>
					</tr>
					<tr>
						<td>Telefone</td>
						<td colspan=\"2\">$tel</td>
					</tr>
					<tr>
						<td>Email</td>
						<td colspan=\"2\">$email</td>
					</tr>
					<tr>
						<td colspan=\"3\" align=\"center\"><b>NOTAS</b></td>
					</tr>
					<tr>
						<td>Horas</td>
						<td colspan=\"2\" align=\"center\">$horas</td>
					</tr>
					<tr>
						<td>Oficina</td>
						<td colspan=\"2\"><input type=\"checkbox\" name=\"oficina\" onclick=\"return false;\" ";
						
					if($oficina==1)
						echo "checked";
						
						echo " readonly=\"readonly\" ></td>
					</tr>	
					<tr>
						<td>OAB</td>
						<td colspan=\"2\"><input type=\"checkbox\" name=\"oab\" onclick=\"return false;\" ";
						
					if($oab==1)
						echo "checked";
						
						echo  " readonly=\"readonly\" ></td>
					</tr>					
					<!--<tr>
						<td>Primera Fase OAB</td>
						<td colspan=\"2\" align=\"center\"><input type\"text\" name=\"primFase\" value=\"$primeiraFase\" ></td>
					</tr>-->
					<tr>
						<td>Primera Fase OAB</td>
						<td colspan=\"2\" align=\"center\">$primeiraFase</td>
					</tr>
					<tr>
						<td align=\"center\"><b></b></td>
						<td align=\"center\"><b>Sim1</b></td>
						<td align=\"center\"><b>Sim2</b></td>
					</tr>";
					
					/*
					for($i=0;$i<8;$i++)
					{
						$val1 = $array[$i];
						$val2 = $array[$i+1];
						$ema = ceil(($i+1)/2);
						
						echo "
								<tr>
									<td>EMA$ema</td>
									<td align=\"center\">$val1</td>
									<td align=\"center\">$val2</td>
								</tr>
							";
							$i++;
					}*/
					echo "<tr>
								<td>Semestre Atual</td>
								<td align=\"center\">$atu1</td>
								<td align=\"center\">$atu2</td>
						  </tr>";
						  
					echo "<tr>
								<td>Semestre Passado</td>
								<td align=\"center\">$pas1</td>
								<td align=\"center\">$pas2</td>
						  </tr>";	
						  
					
						  
					  
			
					
					echo "
					
					<tr>
						<td>L1</td>
						<td colspan=\"2\" align=\"center\">$L1</td>
					</tr>
					
					<tr>
						<td colspan=\"3\" align=\"center\">
							<button type=\"submit\" name=\"mode\" value=\"veratividades$matriculaAluno\" class=\"button btn-primary btn-lg btn-block	\">Ver Atividades do Aluno</button>
						</td>
					</tr>
					
					
				</table>
		
		
		";
			
	?>