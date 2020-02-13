<?php
	echo "<table class=\"table table-bordered\">";
	echo "<tr align=\"center\">";
		echo "<td>";
			echo "<button formaction=\"novosemestre.php\" name=\"choice\" value=\"plantao\" class=\"btn btn-primary\"  onclick=\"return avisa('plantao');\">Novo Semestre Plantão</button><br>";
		echo "</td>";
		echo "<td>";
			echo "<button formaction=\"novosemestre.php\" name=\"choice\" value=\"afericao\" class=\"btn btn-primary\" onclick=\"return avisa('afericao');\">Novo Semestre Aferição</button><br>";
		echo "</td>";
	echo "</tr>";
	echo "<tr align=\"center\">";
		echo "<td>";
			echo "<button formaction=\"novosemestre.php\" name=\"choice\" value=\"simulado\" class=\"btn btn-primary\" onclick=\"return avisa('simulado');\">Novo Semestre Simulado</button>";
		echo "</td>";
		echo "<td>";
			echo "<button formaction=\"novosemestre.php\" name=\"choice\" value=\"visita\" class=\"btn btn-primary\" onclick=\"return avisa('visita');\">Novo Semestre Visitas</button>";
		echo "</td>";
	echo "</tr>";
?>

	<script>
		function avisa(value)
		{
			if (value == "plantao")
			{
				return confirm("Essa ação vai zerar os plantoes e remover todos os alunos inscritos em plantao. Ta de boa isso ai vei?");
			}
			if (value == "afericao")
			{
				return confirm("Essa ação vai apagar todos os alunos que se inscreveram no exame de aferição. Ta de boa isso ai vei?");
			}
			if (value == "simulado")
			{
				return confirm("Essa ação passara os valores do simulado atual para o semestre passado e zerara a nota do atual, deseja continuar?");
			}
			if (value == "visita")
			{
				return confirm("Essa ação apagará todos os inscritos em visitas e apagará as visitas cadastradas, deseja continuar?");
			}
			return false;
		}
	</script>