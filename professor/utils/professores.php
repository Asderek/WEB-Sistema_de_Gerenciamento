<?php

function PROFESSORES_GETNAME($matricula)
{
	include("newconexao.php");
	
	
	$sqlName = "SELECT * FROM `professores` WHERE `matricula` = $matricula";
	$queryName = $conexao->query($sqlName);
	if ($queryName != false)
	{
		$resultName = $queryName->fetchAll( PDO::FETCH_ASSOC );
		$name = $resultName[0]['nome'];
		return $name;
	}
	else
	{
		return "Name not found";
	}
}

?>