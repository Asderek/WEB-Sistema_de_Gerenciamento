<form id="id_form" action="main.php" method="post">
<?php

	echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
	include ('../../utils/newconexao.php');
	if (empty($_POST['data']))
	{
		$dia = date('d');
		$mes = date('n');
		$ano = date('Y');
		
		$meses = ["null","jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez"];
		$mes = $meses[$mes];
		
		$data = $dia.'-'.$mes.'-'.$ano;
		$defaultDate = $ano.'-'.$mes.'-'.$dia;
		
	}
	else
	{
		$data = $_POST['data'];
		$ano = substr($data,0,4);
		$mes = substr($data,5,2);
		$mes = intval($mes);
		//$dia = substr($data,8,2);
		
		$defaultDate = $data;
		$meses = ["null","jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez"];
		$headerMeses = ["null","Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
		$headerData = $headerMeses[$mes];
		$mes = $meses[$mes];
		$headerData .= " de $ano";
		
		
		$data = '-'.$mes.'-'.$ano;
		
		
		
	}
	echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\">
					<h5 class=\"text-center\">CALENDÁRIO</h5>
					<h5 class=\"text-center\"><input type=\"month\" name=\"data\" class=\"form-control input-lg\"></h5>
					<h5 class=\"text-center\"><button type=\"submit\" value=\"calendario\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"background-color: #009688\">IR</button></h5>
				  </div>
				</div>  
			</hr>
			";
			
	$sqlCalendario = "SELECT * FROM `calendario` WHERE `mes` = \"$mes\" AND `ano` = \"$ano\" ORDER BY dia, mes";
	$queryCalendario = $conexao->query($sqlCalendario);
	$resultCalendario = $queryCalendario->fetchAll(PDO::FETCH_ASSOC);
	echo "
			<hr>
				<div class=\"w3-cell-row\" style=\"background-color: #eee\">
					<h4 class=\"text-center\"><strong>DATAS IMPORTANTES</strong></h4>
				</div>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\" style=\"background-color: #ccc\">
			";
	
	for($i=0;$i<count($resultCalendario);$i++)
	{
		$nome = $resultCalendario[$i]['nome'];
		$diaEvento = $resultCalendario[$i]['dia'];
		echo "<h5 class=\"text-center\">$diaEvento-$mes: $nome</h5>";
	}
	echo "
				  </div>
				</div>  
			</hr>
			";
	echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\" style=\"background-color: #ccc\">
					<h4 class=\"text-center\" style=\"color:#000000 \" ><strong>CLIENTES DO MÊS $headerData</strong></h4>
				  </div>
				</div>  
			</hr>
			";
	$sqlClientes = "SELECT * FROM `atendimentos` WHERE `dataDeRetorno` LIKE \"%$data\" ORDER BY `responsavel`,`dataDeRetorno`";
	//echo "sqlClientes = $sqlClientes<br>";
	$queryClientes = $conexao->query($sqlClientes);
	if ($queryClientes != false)
	{
		$resultClientes = $queryClientes->fetchAll(PDO::FETCH_ASSOC);
		$rowsClientes = count($resultClientes);
		echo "<div class=\"w3-container\">";
		
		if ($rowsClientes ==0)
		{
			echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\">
					<h4 class=\"text-center\">Nenhum cliente para este dia</h4>
				  </div>
				</div>  
			</hr>
			";
		}
		$dataAntiga = "";
		$responsavelAntigo = "";
		for($i=0;$i<$rowsClientes;$i++)
		{
			$nome = $resultClientes[$i]['nome'];
			$index = $resultClientes[$i]['index'];
			$hora = $resultClientes[$i]['hora'];
			$hora .= 'h';
			$dataDeRetorno = $resultClientes[$i]['dataDeRetorno'];
			$responsavel = $resultClientes[$i]['responsavel'];
			echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\">";
					if($responsavelAntigo != $responsavel)
					{
						echo "<h4 class=\"text-center\" style=\"background-color:#ccc\">Clientes do(a) Professor(a) $responsavel</h4>";
						echo "<h4 class=\"text-center\">Clientes do Dia $dataDeRetorno</h4>";
						$responsavelAntigo = $responsavel;
					}
					else if ($dataDeRetorno != $dataAntiga)
					{
						echo "<h4 class=\"text-center\">Clientes do Dia $dataDeRetorno</h4>";
						$dataAntiga = $dataDeRetorno;
					}
					echo "
					<h4 class=\"text-center\">
						<button type=\"submit\" name=\"mode\" value=\"cliente$index\" class=\"w3-bar-item w3-button\" style=\"border: 2px solid #009688\">$nome ($hora)</button>
					</h4>
				  </div>
				</div>  
			</hr>
			";
		}
		echo "</div>";
	}
	?>
</form>
	<script>
		function funct()
		{			
			document.getElementById('id_form').submit();
		}
	</script>