<?php

	include('../../newconexao.php');
	
	if (!empty($_POST['novosemestre']))
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
	}
	
	$sqlDeletaAlunos = "DELETE FROM `alunosplantao` WHERE 1";
	$queryDeletaAlunos = $conexao->query($sqlDeletaAlunos);
	if ($queryDeletaAlunos == false)
	{
		echo "<h4 class=\"text-center\">Não foi possivel remover os alunos, tente novamente e/ou fale com a informatica</h4>";
	}
	
	echo "<form action=\"inicio.php\" id=\"id_auto\">
				<input type=\"submit\" value=\"Voltar\">
			</form>
			";
	
	if (!empty($_POST['novosemestre']))
	{
		if ($queryZeraPlantao != false && $queryDeletaAlunos != false)
		{
			echo "
				<script>
					document.getElementById('id_auto').submit();
				</script>
			";
		}
	}
	else
	{
		if ($queryDeletaAlunos != false)
		{
			echo "
				<script>
					document.getElementById('id_auto').submit();
				</script>
			";
		}
	}

?>