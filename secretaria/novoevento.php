<?php
	$escolha= $_POST['data'];
	$dia = substr($escolha,0,2);
	$mes = substr($escolha,2,2);
	$ano = substr($escolha,4);
	
	
	echo "escolha = $escolha<br>";
	echo "mes = $mes<br>";
	
	echo "<form action=\"cadastraevento.php\" method=\"post\">";
	
	
	
	echo "<input type=\"hidden\" name=\"dia\" value=\"$dia\">";
	echo "<input type=\"hidden\" name=\"mes\" value=\"$mes\">";
	echo "<input type=\"hidden\" name=\"ano\" value=\"$ano\">";
	
	$sqlMonths = array("nil","jan","fev","mar","abr","mai","jun","jul","ago","set","out","nov","dez");
	$mes = $sqlMonths[intval($mes)];
	
	echo "<table class=\"table table-bordered table-hover\">
			<tbody>
				<tr align=\"center\">
					<td>
						<strong>Dia</strong>
					</td>
					<td>
						<strong>Mes</strong>
					</td>
					<td>
						<strong>Ano</strong>
					</td>
				</tr>
				<tr align=\"center\">
					<td>
						<strong>$dia</strong>
					</td>
					<td>
						<strong>$mes</strong>
					</td>
					<td>
						<strong>$ano</strong>
					</td>
				</tr>
				<tr align=\"center\">
					<td>
						Nome do Evento:
					</td>
					<td colspan=\"2\">
						<input type=\"text\" name=\"nome\" required></input>
					</td>
				</tr>
				<tr align=\"center\">
					<td colspan=\"2\">
						<input type=\"checkbox\" name=\"bloqueado\" value=\"true\">Bloqueado</button>
					</td>
				</tr>
				<tr align=\"center\">
					<td> Destino:	</td>
					<td >
						<select name=\"destino\" align=\"center\">
							<option value=\"global\">Todos</option>
							<option value=\"alunos\">Alunos</option>
							<option value=\"professores\">Professores</option>
						</select>
					</td>
				</tr>
				<tr align=\"center\">
					<td>
						<button type=\"submit\" name=\"escolha\" value=\"cadastrar\">Cadastrar Evento</button>
					</td>
					<td>
						<button type=\"submit\" name=\"escolha\" value=\"apagar\" formnovalidate>Limpar Dia</button>
					</td>
				</tr>";
	echo "</tbody></table>";
	echo "</form>";
?>