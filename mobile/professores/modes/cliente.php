<?php
	include ('../../utils/newconexao.php');
	$index = $_POST['indice'];
	$sqlCliente = "SELECT * FROM `atendimentos` WHERE `index` = $index";
	$queryCliente = $conexao->query($sqlCliente);
	if ($queryCliente != false)
	{
		$resultCliente = $queryCliente->fetchAll(PDO::FETCH_ASSOC);
		$CPF = $resultCliente[0]['cpf'];
		$nome = $resultCliente[0]['nome'];
		$descricao = $resultCliente[0]['descricao'];
		$comentarios = $resultCliente[0]['comentarios'];
			
		$sqlDados = "SELECT * FROM `assistidos` WHERE `cpf` = \"$CPF\"";
		$queryDados = $conexao->query($sqlDados);
		$resultDados = $queryDados->fetchAll(PDO::FETCH_ASSOC);
		$tel1 = $resultDados[0]['tel1'];
		$tel2 = $resultDados[0]['tel2'];
		$cel = $resultDados[0]['cel'];
		$email = $resultDados[0]['email'];
		$endereco = $resultDados[0]['endereco'];
		$cep = $resultDados[0]['CEP'];
		
		if (empty($email))
			$email = "---";
		
		$tel = "";
		if (!empty($cel))
			$tel = $cel;
		else if (!empty($tel1))
			$tel = $tel1;
		else if (!empty($tel2))
			$tel = $tel2;
		
		//echo "comentarios = $comentarios<br>";
		$arrayComentarios = array();
		$length = substr_count($comentarios,"|");
		for($i=0;$i<$length;$i++)
		{
			$start = strpos($comentarios,"|");
			$start++;
			$comentarios = substr($comentarios,$start);
			$end = strpos($comentarios,"|");
			if($end === false)
				$insert = substr($comentarios,0);
			else
				$insert = substr($comentarios,0,$end);
			array_push($arrayComentarios,$insert);
			$comentarios = substr($comentarios,$end);
		}
		//echo "arrayComentarios.size = ".count($arrayComentarios)."<br>";
							
		echo "<div class=\"w3-container\">";
		
		echo "	<hr>
					<div class=\"w3-cell-row\">
					  <div class=\"w3-cell w3-container\">
						<h3 class=\"text-center\"><img width=\"256\" height=\"192\" src=\"../../uploads/$CPF/foto.jpg\"></h3>
					  </div>
					</div>  
					<div class=\"w3-cell-row\">
					  <div class=\"w3-cell w3-container\">
						<h3 class=\"text-center\">$nome</h3>
					  </div>
					</div>  
				</hr>";
		
		
		echo "	<hr>
					<div class=\"w3-cell-row\">
					  <div class=\"w3-cell w3-container\">
						<table class=\"table table-bordered\">
							<tr>
								<td align=\"center\">Tel</td>
								<td align=\"center\">$tel</td>
							</tr>
							<tr>
								<td align=\"center\">Email</td>
								<td align=\"center\">$email</td>
							</tr>
							<tr>
								<td align=\"center\">Endereco</td>
								<td align=\"center\">$endereco</td>
							</tr>
							<tr>
								<td align=\"center\">CEP</td>
								<td align=\"center\">$cep</td>
							</tr>
						</table>
					  </div>
					</div>  
				</hr>";		
				
				echo "
				<hr>
					<div class=\"w3-cell-row\">
					  <div class=\"w3-cell w3-container\">
						<table class=\"table table-bordered\">
							<tr>
								<td align=\"center\">Descrição</td>
							</tr>
							<tr>
								<td align=\"center\">$descricao</td>
							</tr>
						</table>
					  </div>
					</div>
				</hr>";
				
				
				/*echo "<form action=\"reagendar.php\" method=\"post\">";
				echo "<input type=\"hidden\" name=\"index_caso\" value=\"$index\">";
				echo "<input type=\"hidden\" name=\"matricula\" value=\"$matricula\">";
				echo "
				<hr>
					<div class=\"w3-cell-row\">
					  <div class=\"w3-cell w3-container\">
						<table class=\"table table-bordered\">
							<tr>
								<td align=\"center\">Dia</td>
								<td align=\"center\">Hora</td>
							</tr>
							<tr>
								<td align=\"center\"><input type=\"date\" name=\"data\" value=\"\"></td>
								<td align=\"center\"><input type=\"time\" name=\"hora\"></td>
							</tr>
							<tr>
								<td colspan=\"2\"><input type=\"submit\" value=\"Reagendar\" class=\"btn btn-primary btn-lg btn-block\"></td>
							</tr>
						</table>
					  </div>
					</div>
				</hr>";
				echo "</form>";*/
				
				
				
				echo "<button id=\"id_accordionCoordenacao\" class=\"accordion\" onclick=\"return false\" style=\"color:#FFFFFF\">COMENTÁRIOS</button>";
						echo "<div class=\"panel\">";
						echo "
							<hr>
								<div class=\"w3-cell-row\">
								  <div class=\"w3-cell w3-container\">
									";
									echo "<table class=\"table\"><tbody>";
							for($i=0;$i<$length;$i++)
							{
								$dateEnd = strpos($arrayComentarios[$i],"#");
								$date = substr($arrayComentarios[$i],0,$dateEnd);
								$coment = substr($arrayComentarios[$i],$dateEnd+1);
								$autorEnd = strpos($coment,"&");
								$commentAutor = substr($coment,0,$autorEnd);
								$coment = substr($coment,$autorEnd+1);
								
								echo"
										<tr>
											<td class=\"text-justify: auto\">$coment</td>	
										</tr>
									";
							}
								echo "</tbody></table>";
							echo "</div>
								</div>
							</hr>";
						echo "</div>";
				
				echo "
			</div>
		";
	}




?>