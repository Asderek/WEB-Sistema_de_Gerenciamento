<?php

	echo "<form id=\"id_auto\" action=\"main.php\" method=\"post\">
				<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">
		";

	include('../../utils/newconexao.php');
	$matricula = $_POST['matricula'];
	$clienteName = $_POST['clienteName'];
	$sqlCliente = "SELECT * FROM atendimentos WHERE nome LIKE \"%$clienteName%\" AND responsavel = \"$nomeProfessor\"";
	$queryCliente = $conexao->query($sqlCliente);
	//echo "sqlCliente = $sqlCliente<br>";
	if ($queryCliente != false)
	{
		$resultCliente = $queryCliente->fetchAll(PDO::FETCH_ASSOC);
		$rowsCliente = count($resultCliente);
		
		if( $rowsCliente == 0)
		{
			echo "
				<hr>
					<div class=\"w3-cell-row\">
					  <div class=\"w3-cell w3-container\">
						<h4 class=\"text-center\">
							Nenhum cliente encontrado com esse nome
						</h4>
					  </div>
					</div>  
				</hr>
				";	
		}
		else if (count($resultCliente) == 1)
		{
			$index = $resultCliente[0]['index'];
			echo "
				<hr>
					<div class=\"w3-cell-row\">
					  <div class=\"w3-cell w3-container\">
						<h4 class=\"text-center\">
							<input type=\"hidden\" name=\"mode\" value=\"cliente$index\">
						</h4>
					  </div>
					</div>  
				</hr>
				";
		}
		else
		{
			for($i=0;$i<$rowsCliente;$i++)
			{
				$nome = $resultCliente[$i]['nome'];
				$index = $resultCliente[$i]['index'];
				$dataRetorno = $resultCliente[$i]['dataDeRetorno'];
				echo "
				<hr>
					<div class=\"w3-cell-row\">
					  <div class=\"w3-cell w3-container\">
						<h4 class=\"text-center\">
							<button type=\"submit\" name=\"mode\" value=\"cliente$index\" class=\"w3-bar-item w3-button\" style=\"border: 2px solid #009688\">$nome<br>($dataRetorno)</button>
						</h4>
					  </div>
					</div>  
				</hr>
				";
			}
		}
	}
	
	echo "</form>";
	if ($rowsCliente == 1)
	{
		echo "<script> document.getElementById('id_auto').submit();</script>";
	}
	
?>


