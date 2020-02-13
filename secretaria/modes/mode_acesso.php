<?php

	include ("../utils/newconexao.php");
	$sqlProfessores = "SELECT * FROM professores WHERE 1";
	$sqlAlunos = "SELECT * FROM alunos WHERE 1 ORDER BY nome ASC";
	$sqlMonitores = "SELECT * FROM monitores WHERE 1";
	
	
	$queryMonitores = $conexao->query($sqlMonitores);
	$queryProfessores = $conexao->query($sqlProfessores);
	$queryAlunos = $conexao->query($sqlAlunos);
	
	$resultMonitores = $queryMonitores->fetchAll(PDO::FETCH_ASSOC);
	$resultProfessores = $queryProfessores->fetchAll(PDO::FETCH_ASSOC);
	$resultAlunos = $queryAlunos->fetchAll(PDO::FETCH_ASSOC);
	
	$arrayAlunos = array();
	$arrayMatriculas = array();
	
	for ($i=0;$i<count($resultMonitores);$i++)
	{
		$matricula = $resultMonitores[$i]['monitor'];
		
		$sqlNome = "SELECT * FROM alunos WHERE matricula = $matricula";
		$queryNome = $conexao->query($sqlNome);
		$resultNome = $queryNome->fetchAll(PDO::FETCH_ASSOC);
		
		$nome = $resultNome[0]['nome'];
		$matricula = 'monitor - '.$matricula;
		
		array_push($arrayAlunos,$nome);
		array_push($arrayMatriculas,$matricula);
	}
	
	for ($i=0;$i<count($resultAlunos);$i++)
	{
		$matricula = $resultAlunos[$i]['matricula'];
		$nome = $resultAlunos[$i]['nome'];
		
		if (!in_array($matricula,$arrayMatriculas))
		{
			array_push($arrayAlunos,$nome);
			array_push($arrayMatriculas,$matricula);
		}
	}
	
	$index = 1;
	
	echo "<br><strong>Professor   </strong><select id=\"selectProf\" name=\"matProfessor\">";
	echo "<option value=\"NONE\"> </option>";
	for($i=0;$i<count($resultProfessores);$i++)
	{
		$matricula = $resultProfessores[$i]['matricula'];
		$nome = $resultProfessores[$i]['nome'];
		echo "<option value=\"$matricula\">$nome</option>";
	}
	echo "</select><br>";
	
	echo "<strong>Pesquisar: </strong><input type=\"text\" id=\"search\" name=\"search\" style=\"margin: 10px;width: 165px;\" onkeyup=\"filter(this.value,$index)\">";
	echo "<strong>Aluno: </strong><select align=\"center\" id=\"select$index\" name=\"matAluno\" onchange=\"checkMonitor(); return false;\">";
	echo "<option value=\"NONE\"></option>";
		for($j=0;$j<count($arrayAlunos);$j++)
		{
			$nome = $arrayAlunos[$j];
			$matricula = $arrayMatriculas[$j];
			
			echo "<option value=\"$matricula\">$matricula - $nome</option>";
		}
	echo "</select><br>";
	
	
	echo "<button id=\"id_button\" onclick=\"myFunction()\">Ir</button><br><br>";
	echo "<button id=\"id_buttonMonitor\" style=\"display:none\" formaction=\"../monitor/debug_login.php\">Ir Perfil Monitor</button>";

	echo "<script>
		function filter(keyword, destino) 
		{
			console.log(\"Destino = \" + destino);
			var id=\"select\"+destino;
			
			
			var select = document.getElementById(id);
			for (var i = 0; i < select.length; i++) {
				var txt = select.options[i].text;
				var include = txt.toLowerCase().includes(keyword.toLowerCase());
				select.options[i].style.display = include ? 'list-item':'none';
			}
		}
		
		function myFunction() 
		{
			var select = document.getElementById(\"selectProf\");
			if (select.value==\"NONE\")
			{
				document.getElementById(\"id_button\").setAttribute(\"formaction\",\"../aluno/debug_login.php\");
				document.getElementById(\"id_button\").setAttribute(\"type\",\"submit\");
				document.getElementById(\"id_button\").click();
			}
			else
			{
				document.getElementById(\"id_button\").setAttribute(\"formaction\",\"../professor/debug_login.php\");
				document.getElementById(\"id_button\").setAttribute(\"type\",\"submit\");
				document.getElementById(\"id_button\").click();	
			}
		}
		</script>
		";
?>

		<script>
			
		function checkMonitor()
		{
			var select = document.getElementById('select1');
			var aluno = document.getElementById('select1').value;
			if (aluno[0] == 'm')
			{
				var e = document.getElementById("select1");
				var strUser = e.options[e.selectedIndex].text;
				strUser = strUser.substr(aluno.length);
				console.log("strUser = " + strUser);
				if (strUser==" -")
					document.getElementById('id_button').setAttribute("style","display:none");
				else
					document.getElementById('id_button').setAttribute("style","");
				
				document.getElementById('id_buttonMonitor').setAttribute("style","");
				document.getElementById('id_button').innerHTML = "Ir Perfil Aluno";
			}
			else
			{
				document.getElementById('id_buttonMonitor').setAttribute("style","display:none");
				document.getElementById('id_button').innerHTML = "Ir";		
				document.getElementById('id_button').setAttribute("style","");		
			}
		}
		</script>

