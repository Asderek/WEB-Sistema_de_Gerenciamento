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
		$dia = substr($data,8,2);
		
		$defaultDate = $data;
		$meses = ["null","jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez"];
		$mes = $meses[$mes];
		
		$data = $dia.'-'.$mes.'-'.$ano;
		
	}
	
	echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\" style=\"background-color: #ccc\">
					<h4 class=\"text-center\" style=\"color:#000000 \" ><strong>CLIENTES DO DIA $data</strong></h4>
				  </div>
				</div>  
			</hr>
			";
	
	$sqlClientes = "SELECT * FROM `atendimentos` WHERE `responsavel` = \"$nomeProfessor\" AND `dataDeRetorno` = \"$data\"";
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
		for($i=0;$i<$rowsClientes;$i++)
		{
			$nome = $resultClientes[$i]['nome'];
			$index = $resultClientes[$i]['index'];
			$hora = $resultClientes[$i]['hora'];
			echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\">
					<h4 class=\"text-center\">
						<button type=\"submit\" name=\"mode\" value=\"cliente$index\" class=\"w3-bar-item w3-button\" style=\"border: 2px solid #009688\">$nome ($hora)</button>
					</h4>
				  </div>
				</div>  
			</hr>
			";
		}
		
		echo "
			<hr>
				<div class=\"w3-cell-row\">
				  <div class=\"w3-cell w3-container\">
					<h5 class=\"text-center\">CALENDÁRIO</h5>
					<h5 class=\"text-center\"><input type=\"date\" name=\"data\" class=\"form-control input-lg\"></h5>
					<h5 class=\"text-center\"><button type=\"submit\" value=\"calendario\" name=\"mode\" class=\"btn btn-primary btn-lg btn-block\" style=\"background-color: #009688\">IR</button></h5>
				  </div>
				</div>  
			</hr>
			";
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