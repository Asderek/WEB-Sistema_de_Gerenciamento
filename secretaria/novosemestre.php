<?php

	include("../utils/newconexao.php");
	$choice = $_POST['choice'];
	echo "choice = $choice<br>";
	if($choice == "plantao")
	{
		$sqlZeraPlantao = "UPDATE `horariosplantao` SET 
								`dia1`=0,
								`ini1`=0,
								`fim1`=0,
								`dia2`=0,
								`ini2`=0,
								`fim2`=0,
								`dia3`=0,
								`ini3`=0,
								`fim3`=0,
								`atendimento1`=0,
								`atendimento2`=0,
								`atendimento3`=0,
								`alunos1`=0,
								`alunos2`=0,
								`alunos3`=0,
								`assistidos1`=0,
								`assistidos2`=0,
								`assistidos3`=0 
							WHERE 1";
							
		$queryZeraPlantao = $conexao->query($sqlZeraPlantao);
		if ($queryZeraPlantao == false)
		{
			echo "<h4 class=\"text-center\">Não foi possivel apagar os plantoes, tente novamente e/ou fale com a informatica</h4>";
		}
		
		$sqlDeletaAlunos = "DELETE FROM `alunosplantao` WHERE 1";
		$queryDeletaAlunos = $conexao->query($sqlDeletaAlunos);
		if ($queryDeletaAlunos == false)
		{
			echo "<h4 class=\"text-center\">Não foi possivel remover os alunos, tente novamente e/ou fale com a informatica</h4>";
		}
		
		$sqlBloqueioPlantoes = "DELETE FROM `NPJ_bloqueioPlantoes` WHERE 1";
		$queryBloqueioPlantoes = $conexao->query($sqlBloqueioPlantoes);
		if ($queryBloqueioPlantoes == false)
		{
			echo "<h4 class=\"text-center\">Não foi possivel remover os bloqueios de aula dos professores, tente novamente e/ou fale com a informatica</h4>";
		}
		
		$sqlFechamentoPlantoes = "DELETE FROM `NPJ_fechamentoPlantoes` WHERE 1";
		$queryFechamentoPlantoes = $conexao->query($sqlFechamentoPlantoes);
		if ($queryFechamentoPlantoes == false)
		{
			echo "<h4 class=\"text-center\">Não foi possivel remover os bloqueios de plantão dos alunos, tente novamente e/ou fale com a informatica</h4>";
		}
		
		
		
		echo "<form action=\"mainSecretaria.php\" id=\"id_auto\">
					<input type=\"hidden\" name=\"mode\" value=\"novoSemestre\">
					<input type=\"submit\" value=\"Voltar\">
				</form>
				";
		
		
		if ($queryZeraPlantao != false && $queryDeletaAlunos != false && $queryBloqueioPlantoes != false && $queryFechamentoPlantoes != false)
		{
			echo "
				<script>
					document.getElementById('id_auto').submit();
				</script>
			";
		}
		
	}
	if($choice == "afericao")
	{
		$sqlRemoveAlunos = "DELETE FROM `inscritosafericao` WHERE 1";
							
		$queryRemoveAlunos = $conexao->query($sqlRemoveAlunos);
		if ($queryRemoveAlunos == false)
		{
			echo "<h4 class=\"text-center\">Não foi possivel apagar os alunos inscritos na aferição, tente novamente e/ou fale com a informatica</h4>";
		}
		
		$sqlBancas = "DELETE FROM `NPJ_BancasAfericao` WHERE `index` != 1";
		$queryBancas = $conexao->query($sqlBancas);
		if ($queryBancas == false)
		{
			echo "<h4 class=\"text-center\">Não foi possivel remover as bancas, tente novamente e/ou fale com a informatica</h4>";
		}
		
		echo "<form action=\"mainSecretaria.php\" id=\"id_auto\">
					<input type=\"hidden\" name=\"mode\" value=\"novoSemestre\">
					<input type=\"submit\" value=\"Voltar\">
				</form>
				";
		
		
		if ($queryBancas != false && $queryRemoveAlunos != false)
		{
			echo "
				<script>
					document.getElementById('id_auto').submit();
				</script>
			";
		}
		
	}
	if($choice == "simulado")
	{
		$sqlUpdate = "UPDATE `alunos` SET `passado2`=`atual2`, `passado1`=`atual1`, `atual2`=-3, `atual1`=-3 WHERE 1";
		$queryUpdate = $conexao->query($sqlUpdate);
		
		echo "<form action=\"mainSecretaria.php\" id=\"id_auto\">
			<input type=\"hidden\" name=\"mode\" value=\"novoSemestre\">
			<input type=\"submit\" value=\"Voltar\">
		</form>
		";
		
		if ($queryUpdate == false)
		{
			echo "<h4 class=\"text-center\">Não foi possivel atualizar os alunos, tente novamente e/ou fale com a informatica</h4>";
		}
		
		if ($queryUpdate != false)
		{
			echo "
				<script>
					document.getElementById('id_auto').submit();
				</script>
			";
		}
				
	}
	if($choice == "visita")
	{
		$sqlDeleteAlunos = "DELETE FROM `visitasAlunos` WHERE 1";
		$sqlDeleteVisitas = "DELETE FROM `visitasAbertas` WHERE 1";
		$queryDeleteAlunos = $conexao->query($sqlDeletaAlunos);
		$queryDeleteVisitas = $conexao->query($sqlDeletaVisitas);
		
		echo "<form action=\"mainSecretaria.php\" id=\"id_auto\">
			<input type=\"hidden\" name=\"mode\" value=\"novoSemestre\">
			<input type=\"submit\" value=\"Voltar\">
		</form>
		";
		
		if ($queryDeleteAlunos == false)
		{
			echo "<h4 class=\"text-center\">Não foi possivel remover os alunos, tente novamente e/ou fale com a informatica</h4>";
		}
		
		if ($queryDeleteVisitas == false)
		{
			echo "<h4 class=\"text-center\">Não foi possivel remover as visitas, tente novamente e/ou fale com a informatica</h4>";
		}
		
		if ($queryDeleteAlunos != false && queryDeleteVisitas)
		{
			echo "
				<script>
					document.getElementById('id_auto').submit();
				</script>
			";
		}
	}

?>