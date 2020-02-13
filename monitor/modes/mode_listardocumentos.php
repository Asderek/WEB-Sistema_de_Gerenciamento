<?php
	include ('../../newconexao.php');
	include ('../utils/documentos.php');

	$matriculaResponsavel = $_POST['matriculaResponsavel'];
	
	$arquivos = array();
	
	$dir = DOCUMENTS_GETDOCUMENTPATH($matriculaResponsavel);
	//$dir = "../uploads/$matriculaResponsavel";
	
	if (is_dir($dir)){	
	  if ($dh = opendir($dir)){
		while (($file = readdir($dh)) !== false){
			if (strpos($file,'.') != false)
					array_push($arquivos,$file);
		}
		closedir($dh);
	  }
	}
	
	echo "
	
	
	
	<table class=\"table table-bordered table-hover\">
		<tbody>";
				for($i=0;$i<count($arquivos);$i++)
				{
					$input = $arquivos[$i];
					if ($input==".." || $input == ".")
					{}
					else
					{
						echo "<tr align=\"center\">";
							echo "<td>";
									echo "<a href=\"$dir/$input\" target=\"_blank\">$input</a><br>";
							echo "</td>";
						echo "</tr>";
					}
				}
				
				echo "
		</tbody>
	</table>	";
	
	echo "
	<table class=\"table table-bordered table-hover\">
		<tbody> <tr> ";
			echo "
			<td><input type=\"file\" name=\"documento\">
			<br><br><input type=\"submit\" formaction=\"archivefile.php\"></td>";
		echo " </tr>
		</tbody>
	</table>	";
	

?>
