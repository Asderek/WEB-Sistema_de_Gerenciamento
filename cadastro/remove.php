<?php
	
	include('../../newconexao.php');
	
	$id = $_POST['id'];
	echo "id = $id<br>";
	
	$sqlRemove = "DELETE FROM `listadeespera` WHERE `index` = $id";
	$queryRemove = $conexao->query($sqlRemove);
	if ($queryRemove == false)
	{
		echo "Deu problema<br>sqlRemove = $sqlRemove<br>";
	}
	else
	{
		echo "
				<form id=\"id_form\" action=\"verlista.php\" method=\"post\">
				</form>
				<script>
					document.getElementById('id_form').submit();
				</script>
		";
	}

?>