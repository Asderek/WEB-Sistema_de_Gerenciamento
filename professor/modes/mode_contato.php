<?php
	include('../../newconexao.php');

	echo "<h3 class=\"text-center\">Fale com a Secretaria</h3>";
	echo "<table class=\"table table-bordered table-striped table-hover\">
			<tbody>";
			
	echo "
				
				<tr>
					<td width='30%'><strong>Assunto</strong></td>
					<td width='70%'><input type=\"text\" size=\"80\" name=\"subject\" placeholder=\"Assunto da Mensagem\"></td>
				</tr>
				
				<tr>
					<td width='30%' rowspan=\"5\"><strong>Mensagem</strong></td>
					<td width='70%' rowspan=\"5\"><textarea name=\"descricao\" cols=\"120\" rows=\"5\" placeholder=\"Corpo da Mensagem\" align=\"center\"></textarea></td>
				</tr>
				
				<tr>
					<td width='30%' style=\"display:none\"><strong></strong></td>
				</tr>
				
				<tr>
					<td width='30%' style=\"display:none\"><strong></strong></td>
				</tr>
				
				<tr>
					<td width='30%' style=\"display:none\"><strong></strong></td>
				</tr>
				
				<tr>
					<td width='30%' style=\"display:none\"><strong></strong></td>
				</tr>
					
				
				<tr align=\"center\">
					<td colspan=\"2\"><input type=\"submit\" formaction=\"enviarcontato.php\" class=\"btn btn-primary btn-lg\" value=\"Enviar Email\"></input></td>
				</tr>
			</tbody>
		</table>";
	
?>
						