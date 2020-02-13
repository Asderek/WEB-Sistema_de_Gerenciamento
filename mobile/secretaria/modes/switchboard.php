	<?php
	
		
	
	
		include('../../utils/newconexao.php');
	
		$sql = "SELECT * FROM `switchboard` WHERE 1";
		$query = $conexao->query($sql);
		$rows = $query->fetchAll( PDO::FETCH_ASSOC );

		if(isset($_POST['index']))
		{
			
			$butaoClicado = $_POST['index'];
			$stat = $rows[$butaoClicado]['status'];
			//$stat = mysql_free_result($query,$butaoClicado,'status');
			
			
			if($stat==0)
				$stat = 1;
			else
				$stat = 0;
			
			$sqlUpdate = "UPDATE `switchboard` SET `status`=$stat WHERE `index` = $butaoClicado";
			$queryUpdate = $conexao->query($sqlUpdate);
			
			$query = $conexao->query($sql);
			$rows = $query->fetchAll( PDO::FETCH_ASSOC );
			
			//$queryUpdate = mysqli_query($sqlUpdate, $conexao);
		}
	
	
		echo "<div class=\"modal-body\">";
		echo "<form id=\"id_auto\" action='main.php' method='post' enctype='multipart/form-data'>";
		
		echo '
						<table class="table table-bordered table-hover" border="2" bordercolor=BLACK >
							<tbody>';
		
		if(count($rows)>0)
		{
			
			for($i=0;$i<count($rows);$i++)
			{
				
				$nome = $rows[$i]['nome'];
				$status = $rows[$i]['status'];
				//$nome = mysql_result($query,$i,'nome');
				//$status = mysql_result($query,$i,'status');
				
				
				echo "
								<tr align='center'>
								<td width='50%'><strong>$nome</strong></td>
								<td width='16.666%'>";
								if($status == 0)
									echo "<font color=\"FF0000\">desativado</font>";
								else
									echo "<font color=\"00FF00\">ativado</font>";
								echo "</td>
								<td width='16.666%'><button onclick=\"myFunction($i);return false;\" type=\"submit\" name=\"mode\">Alterar</button></td>
								</tr>
								";
			}
		}
		
		echo' 		</tbody>
						</table>';
		
	?>
	
<script>
	function myFunction(index)
	{
		var form = document.getElementById('id_auto');
		var mode = document.createElement("input");
		mode.setAttribute("type","hidden");
		mode.setAttribute("value","switchboard");
		mode.setAttribute("name","mode");
		form.appendChild(mode);
		
		var pst = document.createElement("input");
		pst.setAttribute("type","hidden");
		pst.setAttribute("value",index);
		pst.setAttribute("name","index");
		form.appendChild(pst);
		
		form.submit();
	}
</script>