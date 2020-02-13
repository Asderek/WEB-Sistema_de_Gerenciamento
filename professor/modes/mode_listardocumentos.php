<?php
	include ('../../newconexao.php');

	$matricula = $_POST['matricula'];
	
	$arquivos = array();
	
	$dir = "../uploads/$matricula";
	
	if (is_dir($dir)){	
	  if ($dh = opendir($dir)){
		while (($file = readdir($dh)) !== false){
			if (strpos($file,'.')!=false)
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
							echo "<td>";
									echo "<button type=\"submit\" formaction=\"deletefile.php\" name=\"arquivo\" value=\"$matricula/$input\">X</button>";
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
