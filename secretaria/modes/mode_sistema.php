<?php
	$show = $_POST['show'];
	echo "show = $show<br>";
	if ($show == "simulado")
	{
		 echo "
			<div id=\"content_1\" class=\"inv\">
				<div id='SimuladoOptionsDiv'>
					<div class='measuringWrapper'>
						<div class=\"text\" style=\"text-align:center\">
							<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/simulado\" class=\"btn btn-primary btn-lg\">Aluno</button>
							<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/simulado/secretaria/\" class=\"btn btn-primary btn-lg\">Secretaria</button>
							<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/simulado/professor\" class=\"btn btn-primary btn-lg\">Resultado Simulado - Professor</button>
							<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/simulado/secretaria/inscritos-professor.php\" class=\"btn btn-primary btn-lg\">Inscritos Separados por Professor</button>
						</div>
					</div>
				</div>
			</div>
		";
	}
	if ($show == "pauta")
	{
		 echo "
			<div id=\"content_1\" class=\"inv\">
				<div id='SimuladoOptionsDiv'>
					<div class='measuringWrapper'>
						<div class=\"text\" style=\"text-align:center\">
							<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/teste/pautas\" class=\"btn btn-primary btn-lg\">Pautas</button>
						</div>
					</div>
				</div>
			</div>
		";
	}
	if ($show == "plantao")
	{
		echo "
	<div id=\"content_2\" class=\"inv\">
		<div id='PlantaoOptionsDiv'>
			<div class='measuringWrapper'>
				<div class=\"text\" style=\"text-align:center\">
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/plantao/aluno/inicio.php\" class=\"btn btn-primary btn-lg\">Aluno</button>
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/plantao/professor/inicio.html\" class=\"btn btn-primary btn-lg\">Professor</button>
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/plantao/secretaria/inicio.php\" class=\"btn btn-primary btn-lg\">Secretaria</button>
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/plantao/professor/cadastro/inicio.php\" class=\"btn btn-primary btn-lg\">Cadastrar Plantoes</button>
				</div>
			</div>
		</div>
	</div>";
	}
	if ($show == "avaliacao")
	{
		echo "
	<div id=\"content_3\" class=\"inv\">
		<div id='AvaliacaoOptionsDiv'>
			<div class='measuringWrapper'>
				<div class=\"text\" style=\"text-align:center\">
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/avaliacao\" class=\"btn btn-primary btn-lg\">Aluno</button>
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/avaliacao/secretaria\" class=\"btn btn-primary btn-lg\">Secretaria</button>
				</div>
			</div>
		</div>
	</div>
	";
	}
	if ($show == "visita")
	{
		echo "
	<div id=\"content_4\" class=\"inv\">
		<div id='VisitaOptionsDiv'>
			<div class='measuringWrapper'>
				<div class=\"text\" style=\"text-align:center\">
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/visita/aluno\" class=\"btn btn-primary btn-lg\">Aluno</button>
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/visita/professor\" class=\"btn btn-primary btn-lg\">Professor</button>
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/visita/secretaria\" class=\"btn btn-primary btn-lg\">Secretaria</button>
				</div>
			</div>
		</div>
	</div>";
	}
	if ($show == "estagio")
	{
		echo "
	
	<div id=\"content_5\" class=\"inv\">
		<div id='EstagioOptionsDiv'>
			<div class='measuringWrapper'>
				<div class=\"text\" style=\"text-align:center\">
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/estagio/\" class=\"btn btn-primary btn-lg\">Cadastrar Estagio</button>
				</div>
			</div>
		</div>
	</div>";
	}
	if ($show == "monitoria")
	{
		echo "
	
	<div id=\"content_6\" class=\"inv\">
		<div id='MonitoriaOptionsDiv'>
			<div class='measuringWrapper'>
				<div class=\"text\" style=\"text-align:center\">
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/monitoria/aluno\" class=\"btn btn-primary btn-lg\">Aluno</button>
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/monitoria/professor\" class=\"btn btn-primary btn-lg\">Professor</button>
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/monitoria/secretaria\" class=\"btn btn-primary btn-lg\">Secretaria</button>
				</div>
			</div>
		</div>
	</div>";
	}
	if ($show == "quadro")
	{
		echo "
	
	<div id=\"content_7\" class=\"inv\">
		<div id='SwitchOptionsDiv'>
			<div class='measuringWrapper'>
				<div class=\"text\" style=\"text-align:center\">
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/switchboard\" class=\"btn btn-primary btn-lg\">Ver Quadro</button>
				</div>
			</div>
		</div>
	</div>";
	}
	if ($show == "downloads")
	{
		echo "
	
	<div id=\"content_8\" class=\"inv\">
		<div id='DownloadsOptionsDiv'>
			<div class='measuringWrapper'>
				<div class=\"text\" style=\"text-align:center\">
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/downloads\" class=\"btn btn-primary btn-lg\">Ver Arquivos</button>
				</div>
			</div>
		</div>
	</div>";
	}
	if ($show == "acessorestrito")
	{
		echo "
	
	<div id=\"content_9\" class=\"inv\">
		<div id='AcessoRestritoOptionsDiv'>
			<div class='measuringWrapper'>
				<div class=\"text\" style=\"text-align:center\">
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/acessorestrito\" class=\"btn btn-primary btn-lg\">Acesso Restrito Home</button>
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/areaaluno/secretaria\" class=\"btn btn-primary btn-lg\">AreaAluno - Secretaria</button>
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/teste/informacao/\" class=\"btn btn-primary btn-lg\">AreaProfessor - Secretaria</button>
				</div>
			</div>
		</div>
	</div>";
	}
	if ($show == "afericao")
	{
		echo "
	
	<div id=\"content_10\" class=\"inv\">
		<div id='AfericaoOptionsDiv'>
			<div class='measuringWrapper'>
				<div class=\"text\" style=\"text-align:center\">
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/afericao/\" class=\"btn btn-primary btn-lg\">Aluno</button>
					<button name=\"mode\" value=\"embed-$show!npj.jur.puc-rio.br/afericao/secretaria/\" class=\"btn btn-primary btn-lg\">Secretaria</button>
				</div>
			</div>
		</div>
	</div>";
	}
	if ($show == "clientes")
	{
		echo "
	
	<div id=\"content_11\" class=\"inv\">
		<div id='ClientesOptionsDiv'>
			<div class='measuringWrapper'>
				<div class=\"text\" style=\"text-align:center\">
					<button name=\"mode\" value=\"embed-$show!139.82.98.21/controle_clientes\" class=\"btn btn-primary btn-lg\">Controle de Clientes</button>
				</div>
			</div>
		</div>
	</div>";
	}
	if ($show == "nepple")
	{
		echo "
	
	<div id=\"content_12\" class=\"inv\">
		<div id='SistemaLucasOptionsDiv'>
			<div class='measuringWrapper'>
				<div class=\"text\" style=\"text-align:center\">
					<a href=\"https://npj.jur.puc-rio.br/teste/triagem/\" class=\"btn btn-primary btn-lg\">Sistema Nepomuceno - Triagem</a>
					<a href=\"https://npj.jur.puc-rio.br/teste/secretaria/mainSecretaria.php\" class=\"btn btn-primary btn-lg\">Sistema Nepomuceno - Secretaria</a><br><br>	
					<a href=\"https://npj.jur.puc-rio.br/teste/monitor/\" class=\"btn btn-primary btn-lg\">Sistema Nepomuceno - Monitor</a>	
					<a href=\"https://npj.jur.puc-rio.br/teste/cadastro\" class=\"btn btn-primary btn-lg\">Sistema Nepomuceno - NEAM</a>
					<br>";
					
					include("mode_acesso.php");
					
					echo "<br>
				</div>
			</div>
		</div>
	</div>";
	}
?>
	
