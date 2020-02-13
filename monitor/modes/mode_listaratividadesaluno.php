<?php
		/*if(is_null($_POST['matricula']));
		{
			$mat = $_POST['matricula'];
			echo "mat = $mat<br>";
			echo "Deu Pau";
			return;
		}*/
		
		$matriculaAluno = $_POST['matriculaAluno'];
		$matriculaResponsavel = $_POST['matriculaResponsavel'];
		
		$sqlNome = "SELECT * FROM professores WHERE matricula = $matriculaResponsavel";
		$queryNome = $conexao->query($sqlNome);
		$resultNome = $queryNome->fetchAll( PDO::FETCH_ASSOC );
		$nome = $resultNome[0]['nome'];
		
		$sqlAtividades = "SELECT * FROM `atividades` WHERE `matricula` = $matriculaAluno AND `responsavel` = \"$nome\"";
		$queryAtividades = $conexao->query($sqlAtividades);
		$resultAtividades = $queryAtividades->fetchAll( PDO::FETCH_ASSOC );
		if($queryAtividades != false)
		{
			$rowsAtividades = count($resultAtividades);
		}
	
		if($rowsAtividades<0)
		{
			echo "Matricula nao encontrada somehow wtf??";
		}
		
		$sqlAluno = "SELECT * FROM `alunos` WHERE `matricula` = $matriculaAluno";
		$queryAluno = $conexao->query($sqlAluno);
		$resultAluno = $queryAluno->fetchAll( PDO::FETCH_ASSOC );
		if($queryAluno != false)
		{
			$horasTot = $resultAluno[0]['horas'];
		}
		
		
		$nome = $resultAtividades[0]['nome'];
		if ($rowsAtividades > 0)
		{
			echo "
					<table class=\"table table-bordered table-hover\">
						<tr>
							<td>Matricula</td>
							<td colspan=\"3\">$matriculaAluno</td>
						</tr>
						<tr>
							<td>Nome</td>
							<td colspan=\"3\">$nome</td>
						</tr>
						<tr align=\"center\" style=\"background-color: #F0F0F0;\">
							<td width=\"25%\"><strong>Atividade</strong></td>
							<td width=\"45%\"><strong>Descricao</strong></td>
							<td width=\"10%\"><strong>Horas</strong></td>
							<td width=\"20%\"><strong>Situação</strong></td>
						</tr>
						";

			for ($i=0;$i<$rowsAtividades;$i++)
			{
				$atividade = $resultAtividades[$i]['atividade'];
				$descricao = $resultAtividades[$i]['descricao'];
				$horas = $resultAtividades[$i]['horas'];
				$pendente = $resultAtividades[$i]['pendente'];
				switch ($pendente)
				{
					case -1:
						$pendente = "Recusado";
						break;
					case 0:
						$pendente = "Aceito";
						break;
					case 1:
						$pendente = "Pendente";
						break;
				}
				echo "
						<tr align=\"center\">
							<td width=\"25%\">$atividade</td>
							<td width=\"45%\">$descricao</td>
							<td width=\"10%\">$horas</td>
							<td width=\"20%\">$pendente</td>
						</tr>
					";
			}
						
			echo "	
					</table>
			
			
			";
			
			echo "
					<table class=\"table table-bordered table-striped table-hover\">";
			echo "
						<tr align=\"center\">
							<td colspan=\"2\">Total de Horas do(a) Aluno(a)</td>
							<td colspan=\"2\">Horas que faltam</td>
						</tr>
					";
			
			$horasQueFaltam = 75 - $horasTot;
			if ($horasQueFaltam <0 )
				$horasQueFaltam = 0;
			echo "
						<tr align=\"center\">
							<td colspan=\"2\">$horasTot</td>
							<td colspan=\"2\">$horasQueFaltam</td>
						</tr>
					";
						
			echo "	
					</table>
			
			
			";
		}
		else
		{
			echo "<p align=\"center\">A(o) aluna(o) não possui atividades cadastradas</p>";
			include("mode_aluno.php");
		}
			
	?>